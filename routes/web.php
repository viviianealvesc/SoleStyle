<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


/******* Produtos *******/
Route::get('/', [ProductController::class, 'index'])->name('/');
Route::get('/produto/{id}/{index}', [ProductController::class, 'show'])->name('product.product');
Route::get('/produto/{id}', [ProductController::class, 'show'])->name('product.product');
Route::get('/register', [ProductController::class, 'pageRegister'])->name('product.pageLogin');
Route::get('/login', [ProductController::class, 'pageRegister'])->name('login');


/******* Favoritos *******/
Route::get('/events/favoritos', [FavoritesController::class, 'pageFavorito'])->name('favorites.pageFavorito')->middleware('auth');;
Route::get('/favoritos/{id}', [FavoritesController::class, 'add'])->name('favorites.add')->middleware('auth');;
Route::get('/remove/{id}', [FavoritesController::class, 'remove'])->name('remove');


/******* Carrinho *******/
Route::get('/events/carrinho', [CartController::class, 'pageCarrinho'])->name('cart.pageCarrinho')->middleware('auth');;
Route::post('/events/carrinho/atualizar', [CartController::class, 'atualizarQuantidade'])->name('cart.quant')->middleware('auth');;
Route::get('/carrinho/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');;
Route::get('/removeCart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');


/******* Navegue por marcas *******/
Route::get('/marca/{nome}', [MarcasController::class, 'marca'])->name('marca');



/******* Finalizando o pedido *******/
Route::match(['get', 'post'],'/pedido', [ProductController::class, 'finalizarPedido'])->name('finalizarPedido');
Route::get('/pedido/endereco', [ProductController::class, 'cadastrarEndereco'])->name('endereco');
Route::post('/endereco', [ProductController::class, 'enviarEndereco'])->name('cadastrar.endereco');
Route::post('/pedido', [ProductController::class, 'cupom'])->name('cupom');
Route::get('/formaPagamento', [ProductController::class, 'formaPagamento'])->name('formaPagamento');
Route::post('/events/pag', [PayController::class, 'pagarCompra'])->name('pagarCompra'); //pix


/******* Login com o Google *******/
Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');


/******* PayPal *******/
Route::get('/checkout', '\App\Http\Controllers\PayPalController@index')->name('checkout');
Route::get('/create/{amount}', '\App\Http\Controllers\PayPalController@create');
Route::post('/complete', '\App\Http\Controllers\PayPalController@complete');


Route::get('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
