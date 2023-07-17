<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    //Página dos livros cadastrados do Vendor
    public function meuslivros(Book $book){
        $user = Auth::user();
        $books = $book->where('vendor_id', $user->vendor->user_id)
                ->orderBy('created_at', 'desc')
                ->get();
        return View('Vendor/livroscadastrados', compact('books'));
     }

     public function informaLivro($id){
        $user = Auth::user();
        $book = Book::find($id);
        return View('Vendor/informaLivro', compact('book'));
     }
}
