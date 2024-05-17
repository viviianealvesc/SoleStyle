<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('/produto', [ProductController::class, 'product'])->name('produto.product');
Route::get('/voltar', [ProductController::class, 'voltarHome'])->name('voltar.product');
Route::get('/menuLateral', [ProductController::class, 'menu'])->name('menuLateral');
Route::get('/register', [ProductController::class, 'pageLogin'])->name('register');
Route::get('/favoritos', [ProductController::class, 'pageFavorito'])->name('pageFavorito');
Route::get('/carrinho', [ProductController::class, 'pageCarrinho'])->name('pageCarrinho');
Route::get('/pedido', [ProductController::class, 'finalizarPedido'])->name('finalizarPedido');
Route::get('/formaPagamento', [ProductController::class, 'formaPagamento'])->name('formaPagamento');

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');



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
