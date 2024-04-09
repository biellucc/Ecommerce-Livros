<?php

namespace App\Http\Controllers;

use App\Models\
{
    Book, User, Cart,
    Customer
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\SharedLogicTrait;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class CartController extends Controller
{
    use SharedLogicTrait;

    //Cria o carrinho
    public function store_cart() {
        $customer = Auth::user()->customer;
        DB::transaction( function() use ($customer, &$cart){
          $cart = $customer->carts()->create();
        },2);

        return $cart;
    }

    //Adiciona o livro no carts_books
    public function store_carts_books(Request $request){
        $book_id = $request->input('book_id');
        $book = Book::find($book_id);

        if(empty($request->input('cart_id'))){
            $cart = $this->store_cart();
        }else{
            $cart_id = $request->input('cart_id');
            $cart = Cart::find($cart_id);
        }

        DB::transaction( function() use ($book, &$cart){
         $cart->books()->attach($book);
        },2);

        return redirect()->back();
    }

    //Verifica se o carrinho está ativo
    public function verifica_cart_ativo($id){
        $cart = Cart::where('customer_id', $id)
                    ->where('status', 'Ativo')
                    ->first();

        return $cart;
    }

    //Verifica se o livro já foi adicionado no carrinho
    public function  verifica_cartbook($cart, $book){
        $cart_book = DB::table('carts_books')
                    ->where('book_id', $book->id)
                    ->where('cart_id', $cart->id)
                    ->first();

        return $cart_book;
    }

    //Remove o livro do carts_books e se não existir nenhum livro deleta o carrinho
    public function rm_cart_book(Request $request){
        $cart = $request->input('cart_id');
        $book = $request->input('book_id');

        DB::transaction(function() use ($cart, $book) {
            DB::table('carts_books')
                ->where('cart_id', $cart)
                ->where('book_id', $book)
                ->delete();

                $exists = DB::table('carts_books')
                    ->where('cart_id', $cart)
                    ->exists();

                if($exists == false){
                    DB::table('carts')
                        ->where('id', $cart)
                        ->delete();
                }

        },6);

        return redirect()->back();
    }

    //Pega todos os carts_books de determinado carrinho
    public function get_carts_books_cart($id){
        $carts_books = DB::table('carts_Books')
                        ->where('cart_id', $id)
                        ->orderBy('created_at', 'asc')
                        ->get();

        return $carts_books;
    }

    public function pedido(Request $request) {
        $user = Auth::user();
        $customer = Customer::find($user->customer->id);

        $cart_id = $request->input('cart_id');
        $cart = Cart::find($cart_id);

        return View('Customer.pedido', compact(['cart', 'customer']));
    }

}
