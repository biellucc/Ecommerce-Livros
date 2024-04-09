<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\{
    BookController,
    CartController,
    CommentController,
    CustomerController,
    OrderController,
    ProfileController,
    siteController,
    VendorController,
    WalletController
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
Route::get('/', [siteController::class, 'index'])->name('index');
//Route::get('/produto-{id}', [siteController::class, 'produto'])->name('produto.view');
Route::get('/livro-{id}', [siteController::class, 'livro'])->name('site.view');
Route::get('/resultado-da-pesquisa',[siteController::class, 'search'])->name('site.search');

//Rotas do Customer
Route::get('/carrinho', [CustomerController::class, 'carrinho'])->name('carrinho');
Route::post('/carrinho-adicionar', [CartController::class, 'store_carts_books'])->name('carts_books.add');
Route::post('/carrinho-remover', [CartController::class, 'rm_cart_book'])->name('carts_books.rm');

//Rotas Pedido
//Pedido pela página do produto
Route::post('/pedido', [CustomerController::class, 'pedido'])->name('customer.pedido');
//Pedido pelo carrinho
Route::get('/pedido', [CartController::class, 'pedido'])->name('cart.pedido');
Route::post('/registrar-pedido', [OrderController::class, 'store_order'])->name('order.store');

//Rotas do Wallet
Route::get('/meus-cartões', [WalletController::class, 'listarWallets'])->name('wallet.lista');
Route::get('/cadastro-de-cartão', [WalletController::class, 'formsWallet'])->name('wallet.forms');
Route::post('/cadastro-de-cartão', [WalletController::class, 'store'])->name('wallet.add');
Route::get('/atualizar-cartão', [WalletController::class, 'walletUpdate'])->name('wallet.up');
Route::get('/remover-cartão', [WalletController::class, 'rmWallet'])->name('wallet.rm');
Route::get('/remover-alterar', [WalletController::class, 'update_or_remove'])->name('wallet.up_rm');

//Rotas do Vendor
Route::get('/meus-livros', [VendorController::class, 'listarBooks'])->name('vendor.listaMeusLivros');
Route::get('/livros-informações-{id}', [VendorController::class, 'livro_informacao'])->name('vendor.livro_informacao');

//Rotas do Book
Route::get('/cadastrar-livro', [BookController::class, 'forms_books'])->name('livro.forms');
Route::post('/cadastrar-livro', [BookController::class, 'store'])->name('livro.store');
Route::get('/formulário-atualizar-livro-{id}', [BookController::class, 'forms_update_book'])->name('livro.forms_update');
Route::post('/atualizar-livro-{id}', [BookController::class, 'update_livro'])->name('livro.update');
Route::post('/remover-livro-{id}', [BookController::class, 'rmLivro'])->name('livro.rm');

//Rota do Comment
Route::post('/produto-{id}-comentário', [CommentController::class, 'store'])->name('comment.add');
Route::post('/produto-{id}-atualizar-comentário', [CommentController::class, 'upComment'])->name('comment.up');
Route::post('/produto-{id}-remover-comentário', [CommentController::class, 'rmComment'])->name('comment.rm');

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
require __DIR__ . '/auth.php';

//VRota para a página inicial do usuário
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
