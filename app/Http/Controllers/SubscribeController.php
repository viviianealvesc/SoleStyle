<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Payment;
use App\Models\Product;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Stripe\PromotionCode;
use Stripe\Stripe;
use Illuminate\Support\Facades\Session as LaravelSession;

class SubscribeController extends Controller
{
   public function __invoke(Request $request)
   {

      Stripe::setApiKey(config('stripe.test.sk'));

      $idProduct = $request->input('id');
      $avatar = $request->input('imagem');
      $nome = $request->input('nome');
      $price = $request->input('preco');
     
      $cor = LaravelSession::get('cor');
      $numeracao = LaravelSession::get('numeracao');

      $imagem_url = asset('img/loja/' . $avatar);

      $discounts = [];
      $cupomCode = $request->input('cupom');
      if (!empty($cupomCode)) {
          try {
              // Pesquisar o código promocional usando o código fornecido
              $promotionCodes = PromotionCode::all(['code' => $cupomCode]);
              if (count($promotionCodes->data) > 0) {
                  $promotionCode = $promotionCodes->data[0];
                  $discounts[] = ['promotion_code' => $promotionCode->id];
              } else {
                  return redirect()->back()->withErrors('Esse código promocional não existe ou não é válido.');
              }
          } catch (\Exception $e) {
              return redirect()->back()->withErrors('Esse código promocional não existe ou não é válido.');
          }
      }

      $session = Session::create([
         'payment_method_types' => ['card', 'boleto'], 
         'line_items' => [[
             'price_data' => [
                 'currency' => 'brl', 
                 'product_data' => [
                     'name' => $nome, 
                     'images' =>  [$imagem_url],
                 ],
                 'unit_amount' => $price * 100, 
             ],
             'quantity' => 1, 
         ]],
         'discounts' => $discounts,
         'mode' => 'payment',
         'success_url' => route('home'), 
     ]);

        $produ = new Product();
        $user = auth()->user();
        $id = $produ->user_id = $user->id;

        $userEnd = $user->endereco;
        $end = new Payment();
        $idEndereco = $end->endereco_id = $userEnd->id;

        Payment::create([
         'stripe_session_id' => $session->id,
         'total' => $price * 100,
         'currency' => 'brl',
         'status' => 'pendente',
         'user_id' => $id,
         'product_id' => $idProduct,
         'endereco_id' => $idEndereco,
         'cor' => $cor,
         'numeracao' => $numeracao,
     ]);

     return redirect()->away($session->url);
   }

   public function success()
   {
       return view('welcome');
   }
}
