<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $cartController;
    public function __construct(CartController $cartController)
    {
        $this->cartController = $cartController;
    }

    //Retorna para a página de carrinho do usuario
    public function carrinho(Cart $cart)
    {
        $user = Auth::user();
        $carts = $cart->where('customer_id', $user->customer->id)
            ->where('status', 'Ativo')
            ->first();

        return view('Customer.carrinho', compact('carts'));
    }

    //Vai para a página de pedido com todos os carts_books do carrinho
    public function pedido(Request $request)
    {
        $user = Auth::user();
        $customer = Customer::find($user->customer->id);

        $cart_id = $request->input('cart_id');
        $book_id = $request->input('book_id');
        $book = Book::find($book_id);

        //dd('Request', $request, "Book_id", $book_id, "Book", $book);
        if (empty($request->input('cart_id'))) {
            $cart = $this->cartController->store_cart();
        } else {
            $cart = Cart::find($cart_id);
        }

        $cart_books_exists = $this->cartController->verifica_cartbook($cart, $book);
        if ($cart_books_exists == null) {
            DB::transaction(function () use ($book, &$cart) {
                $cart->books()->attach($book);
            }, 2);
        }

        $total = $cart->books()->sum('value');
        return View('Customer.pedido', compact(['cart', 'customer', 'total']));
    }
}
