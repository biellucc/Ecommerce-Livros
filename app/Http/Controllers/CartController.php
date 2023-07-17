<?php

namespace App\Http\Controllers;

use App\Models\
{
    Book, User, Cart
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\SharedLogicTrait;

class CartController extends Controller
{
    use SharedLogicTrait;

    public function storeCart(Book $book){
        //Verifica se o user está logado e é um customer
        $customer = Auth::user()->customer;

        //Pega a data atual
        $currentDate = now()->format('Y-m-d');

        //Cria um cart usando o relacioanemto com customer e pega a data atual
        //e o customer_id
        $cart = $customer->carts()->create([
            'data' => $currentDate,
        ]);

        //Criar um carts_books, pegando o cart_id e o book_id
        $cart->books()->attach($book);

        //Retorna para a página produtos
        return redirect()->back();
    }

    public function rmCart(Book $book){
        //Verifica se o user está logado e é um customer
        $customer = Auth::user()->customer;

        // Remover o livro do relacionamento books do cliente
        $customer->books()->detach($book->id);

        // Encontrar o carrinho que contém o livro a ser removido
        $cart = $customer->carts()->whereHas('books', function ($query) use ($book) {
            $query->where('books.id', $book->id);
        })->first();

        if ($cart) {
            //Desfaz o carts_books usando o carrinho_id
            $cart->books()->detach($book->id);

            // Verificar se o carrinho está vazio e removê-lo
            if ($cart->books()->count() === 0) {
                $cart->delete();
            }
        }

        //Retorna para a página produtos
        return redirect()->back();
    }
}
