<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;


/******* Produtos *******/
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/produto/{id}/{index}', [ProductController::class, 'show'])->name('product.product');
Route::get('/produto/{id}', [ProductController::class, 'show'])->name('product.product');
Route::get('/register', [ProductController::class, 'pageRegister'])->name('product.pageLogin');
Route::get('/login', [ProductController::class, 'pageRegister'])->name('login');


/******* Favoritos *******/
Route::get('/events/favoritos', [FavoritesController::class, 'pageFavorito'])->name('favorites.pageFavorito')->middleware('auth');;
Route::post('/favoritos/{id}', [FavoritesController::class, 'add'])->name('favorites.add')->middleware('auth');
Route::get('/remove/{id}', [FavoritesController::class, 'remove'])->name('remove')->middleware('auth');
Route::get('/remove-coracao/{id}', [FavoritesController::class, 'removeCoracao'])->name('remove-coracao')->middleware('auth');


/******* Carrinho *******/
Route::get('/events/carrinho', [CartController::class, 'pageCarrinho'])->name('cart.pageCarrinho')->middleware('auth');
Route::match(['get', 'post'],'/events/carrinho/{id}', [CartController::class, 'atualizarQuantidade'])->name('atualiza-cart')->middleware('auth');

Route::post('/carrinho/{id}', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::get('/removeCart/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/update', [CartController::class, 'update'])->name('cart.update')->middleware('auth');


/******* Navegue por marcas *******/
Route::get('/marca/{nome}', [MarcasController::class, 'marca'])->name('marca');



/******* Finalizando o pedido *******/
Route::match(['get', 'post'],'/pedido', [ProductController::class, 'finalizarPedido'])->name('finalizarPedido')->middleware('auth');
Route::get('/pedido/endereco', [ProductController::class, 'cadastrarEndereco'])->name('endereco')->middleware('auth');
Route::post('/endereco', [ProductController::class, 'enviarEndereco'])->name('cadastrar.endereco')->middleware('auth');
Route::post('/pedido', [ProductController::class, 'cupom'])->name('cupom')->middleware('auth');
Route::get('/formaPagamento', [ProductController::class, 'formaPagamento'])->name('formaPagamento')->middleware('auth');
Route::post('/events/pag', [PayController::class, 'pagarCompra'])->name('pagarCompra'); //pix


/******* Login com o Google *******/
Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');


/******* PayPal 
Route::get('/checkout', '\App\Http\Controllers\PayPalController@index')->name('checkout');
Route::get('/create/{amount}', '\App\Http\Controllers\PayPalController@create');
Route::post('/complete', '\App\Http\Controllers\PayPalController@complete');*******/




Route::post('/subscribe',[ SubscribeController::class, '__invoke'])->name('subscribe')->middleware([Authenticate::class]);
Route::get('/billing-portal', [ProductController::class, 'listarPedido'])->name('portal')->middleware('auth');
Route::get('/pedido/{id}', [ProductController::class, 'cancelarPedido'])->name('cancelar-pedido')->middleware('auth');

Route::match(['get', 'post'],'/payment/success', [SubscribeController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [SubscribeController::class, 'cancel'])->name('payment.cancel');






Route::get('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::get('profile', [ProductController::class, 'estrelas'])
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
