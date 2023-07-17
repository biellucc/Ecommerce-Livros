<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\
    {   BookController, CartController, CommentController,
        CustomerController, ProfileController,siteController,
        VendorController
    };
use App\Models\Book;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Rotas do Site
Route::get('/', [siteController::class, 'index']);
Route::get('/produto{id}', [siteController::class, 'produto'])->name('produto.view');

//Rotas do Customer
Route::get('/carrinho', [CustomerController::class, 'carrinho']);
Route::post('/carrinho/adicionar/{book}', [CartController::class, 'storeCart'])->name('cart.add');
Route::post('/carrinho/remover/{book}', [CartController::class, 'rmCart'])->name('cart.rm');
Route::get('/comprar{id}', [CustomerController::class, 'comprar']);

//Rotas do Vendor
Route::get('/livrosCadastrados', [VendorController::class, 'meuslivros']) ->name('meuslivros');
Route::get('/livros-informacoes{id}', [VendorController::class, 'informaLivro'])->name('informalivro');

//Rotas do Book
Route::get('/cadastroBook', [BookController::class, 'create_vender']);
Route::post('/cadastroBook', [BookController::class, 'storelivro'])->name('storelivro');
Route::get('/atualizarLivro{id}', [BookController::class, 'create_update']);
Route::post('/atualizarLivro{id}', [BookController::class, 'update_livro']);
Route::post('//livros-informacoes/remover/{id}', [BookController::class, 'rmLivro'])->name('livro.rm');

//Rota do Comment
Route::post('/produto{id}/comment', [CommentController::class, 'store'])->name('comment.add');
Route::post('/produto{id}/comment/atualizar/{id_cm}', [CommentController::class, 'upComment'])->name('comment.up');
Route::post('/produto{id}/comment/remover/{id_cm}', [CommentController::class, 'rmComment'])->name('comment.rm');

// Rota para exibir o formulário de registro
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

// Rota para processar o envio do formulário de registro
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

//Rota para o painel de controle do usuário
Route::get('/dashboard', function () {
    $books = Book::orderBy('created_at', 'desc')->get();
    return view('dashboard', compact('books'));
})->middleware(['auth', 'verified'])->name('dashboard');


//Rotas relacionadas ao perfil do usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Rotas de autenticação e registro
require __DIR__.'/auth.php';

//VRota para a página inicial do usuário
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
