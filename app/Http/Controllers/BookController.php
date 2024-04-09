<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Book,
    Vendor,
    User
};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;

class BookController extends Controller
{
    //Vai para o forms de cadastro do livro
    public function forms_books()
    {
        return View('Vendor.cadastrar_book');
    }

    //Store do livro
    public function store(Request $request, Book $book, Vendor $vendor, User $user)
    {
        //dd('antes validate');
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'summary' => ['required', 'string', 'max:200'],
            'pages' => ['required', 'integer', 'min:1'],
            'author' => ['required', 'string', 'max:80'],
            'amount' => ['required', 'integer', 'min:1'],
            'value' => ['required', 'numeric', 'min:1'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png'],
            'isbn13' => ['required', 'string', 'regex:/^(97)[8-9]-[0-9]{2}-[0-9]{6}-[0-9]-[0-9]$/'],
            'language'=>['required', 'string'],
            'edition'=> ['required', 'integer', 'min:1'],
            'publishing_company' => ['required', 'string', 'max:80'],
            'dimension' => ['required', 'string', 'regex:/^[1-2][0-6](0|5)\sx\s[1-3][0-8](0)$/'],
            'publication_date'=> ['required', 'date'],
            'parental_rating' => ['required', 'integer', 'min:3', 'max:18'],
            'type' => ['required', 'string']
        ]);
        //dd('depois validate');

        $user = Auth::user();

        // Obtenha a instância da imagem
        $image = $request->file('image');

        // Gere um nome único para a imagem
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Mova a imagem para a pasta public/assets/imagem
        $image->move(public_path('assets/imagem'), $imageName);

        $vendor = $user->vendor;
        $book = $vendor->books()->create([
            'title' => $request->title,
            'summary' => $request->summary,
            'pages' => $request->pages,
            'author' => $request->author,
            'amount' => $request->amount,
            'value' => $request->value,
            'image' => $imageName,
            'isbn13' =>$request->isbn13,
            'language'=> $request->language,
            'edition'=> $request->edition,
            'publishing_company' => $request->publishing_company,
            'dimension' => $request->dimension,
            'publication_date'=> $request->publication_date,
            'parental_rating' => $request->parental_rating,
            'type' => $request->type
        ]);

        return redirect()->route('vendor.listaMeusLivros');
    }

    //Vai para a View de Update Livros
    public function forms_update_book($id)
    {
        $book = Book::find($id);
        return View('Book.forms_update_book', compact('book'));
    }

    //Autaliza as informações de Books
    public function  update_livro($id, Request $request)
    {
        $inputs = $request->except(['_token']);

        $book = Book::find($id);
        if (!$book) {
            // Livro não encontrado
            return redirect()->back()->withErrors(['message' => 'Livro não encontrado.']);
        }

        foreach ($inputs as $key => $value) {
            if ($request->filled($key)) {
                $book->$key = $value;
            }
        }

        // Atualize a imagem apenas se uma nova imagem for fornecida
        if ($request->hasFile('image')) {
            // Remova a imagem antiga, se existir
            Storage::delete($book->image);

            // Obtenha a instância da nova imagem
            $newImage = $request->file('image');

            // Gere um nome único para a imagem
            $imageName = time() . '.' . $newImage->getClientOriginalExtension();

            // Mova a imagem para a pasta public/assets/imagem
            $newImage->move(public_path('assets/imagem'), $imageName);

            // Atualize o campo 'image' no modelo Book
            $book->image = $imageName;
        }

        $book->save();

        return redirect()->route('vendor.livro_informacao', ['id' => $book->id]);
    }

    public function rmLivro($id)
    {
        DB::delete('Delete from books where id=?', [$id]);
        return redirect()->route('vendor.listaMeusLivros');
    }
}
