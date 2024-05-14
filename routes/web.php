<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::get('/produto', [ProductController::class, 'product'])->name('produto.product');
Route::get('/voltar', [ProductController::class, 'voltarHome'])->name('voltar.product');
Route::get('/menuLateral', [ProductController::class, 'menu'])->name('menuLateral.menu');









Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
