<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CartController;
use App\Models\{
    Book,
    Comment,
    Vendor
};
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Ui\Presets\Vue;

class siteController extends Controller
{
    protected $cartController;

    public function __construct(CartController $cartController)
    {
        $this->cartController = $cartController;
    }

    //Retorna para o welcome com todos os livros
    public function index(Book $book) {
        $books = $book->orderBy('created_at', 'desc')->get();
        return View('welcome', compact('books'));
    }

    public function livro($id){
        $book = Book::find($id);
        $comment = Comment::where('book_id', $id)->first();

        if(Auth::check() && Auth::user()->customer){
            $id = Auth::user()->customer->id;
            $cart = $this->cartController->verifica_cart_ativo($id);
            if($cart !== null){
                $cart_book = $this->cartController->verifica_cartbook($cart, $book);
                return View('Site.produto', compact('book', 'comment', 'cart', 'cart_book'));
            }else{
                $cart = $this->cartController->store_cart();
                $cart_book = null;
                return View('Site.produto', compact('book', 'comment', 'cart', 'cart_book'));
            }
        }else{
            return View('Site.produto', compact('book', 'comment'));
        }

    }

    public function search(Request $request){
        $dado = $request->input('search');

        $searchs = null;
        $searchs = Book::where('title', 'LIKE', '%' . $dado . '%')
                ->get();

        return View('site.search',compact('searchs', 'dado'));
    }

}
