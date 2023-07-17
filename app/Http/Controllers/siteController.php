<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Book,
    Vendor
};
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Laravel\Ui\Presets\Vue;

class siteController extends Controller
{
    //Retorna para o welcome com todos os livros
    public function index(Book $book) {
        $books = $book->orderBy('created_at', 'desc')->get();
        return View('welcome', compact('books'));
    }

    //Vai para a página do produto
    public function produto($id) {
        $book = Book::find($id);
        return  View('Site.produto', compact('book'));
    }

}
