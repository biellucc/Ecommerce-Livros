<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Book, Vendor, User
};
use Illuminate\Contracts\View\View;
use PhpParser\Node\Stmt\Return_;

class BookController extends Controller
{
     //Vai para o forms de cadastro do livro
     public function create_vender(){
          return View('Vendor/form_vender');
    }

    //Store do livro
    public function storelivro(Request $request, Book $book, Vendor $vendor, User $user)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:80'],
            'summary' => ['required', 'string', 'max:200'],
            'pages' => ['required', 'integer', 'min:1'],
            'author' => ['required', 'string', 'max:100'],
            'amount' => ['required', 'integer', 'min:1'],
            'value' => ['required', 'numeric', 'min:1'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif'],
            //'vendor' => ['required', 'string'],
        ]);

        $user = Auth::user();

        $imagePath = $request->file('image')->store('public/assets/imagem');

        $vendor = $user->vendor;
        $book = $vendor->books()->create([
            'title' => $request->title,
            'summary' => $request->summary,
            'pages' => $request->pages,
            'author' => $request->author,
            'amount' => $request->amount,
            'value' => $request->value,
            'image' => $imagePath,
        ]);

        return redirect(RouteServiceProvider::HOME);
    }

    //Vai para a View de Update Livros
    public function create_update($id){
        $book = Book::find($id);
        return View('Book/update', compact('book'));
    }

    //Autaliza as informações de Books
    public function  update_livro($id, Request $request) {
        $inputs = $request->except(['_token']);

        $book = Book::find($id);
        if (!$book) {
            // Livro não encontrado
            return redirect()->back()->withErrors(['message' => 'Livro não encontrado.']);
        }

        foreach($inputs as $key => $value){
            if($request->filled($key)){
                 $book->$key = $value;
            }
        }

        $book->save();

        return redirect()->route('informalivro', ['id' => $book->id]);
    }

    public function rmLivro($id){
        DB::delete('Delete from books where id=?', [$id]);
        return redirect()->route('meuslivros');
    }
}
