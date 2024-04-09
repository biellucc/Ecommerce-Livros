<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    //Página dos livros cadastrados do Vendor
    public function listarBooks(){
        $user = Auth::user();
        $books = Book::where('vendor_id', $user->vendor->id)
                ->orderBy('created_at', 'desc')
                ->get();
        return View('Vendor.meus_livros', compact('books'));
     }

     public function livro_informacao($id){
        $user = Auth::user();
        $book = Book::find($id);
        return View('Vendor.livro_informacao', compact('book'));
     }
}
