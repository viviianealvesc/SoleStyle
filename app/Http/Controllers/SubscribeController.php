<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Estrela;
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

     $user = auth()->user();

     $produto = $user->carrinho;

     foreach($produto as $prod) {
        $avatar = $prod->product->imagem;
        $nome = $prod->product->nome;
     }

      $price =  LaravelSession::get('total');

      $imagem_url = asset('img/loja/' . $avatar);

      $discounts = [];
      $totalDiscount = 0;
      $cupomCode = $request->input('cupom');
      if (!empty($cupomCode)) {
          try {
              // Pesquisar o código promocional usando o código fornecido
              $promotionCodes = PromotionCode::all(['code' => $cupomCode]);
              if (count($promotionCodes->data) > 0) {
                  $promotionCode = $promotionCodes->data[0];
                  $discounts[] = ['promotion_code' => $promotionCode->id];
                  $totalDiscount += $promotionCode->discount_amount;
              } else {
                  return redirect()->back()->withErrors('Esse código promocional não existe ou não é válido.');
              }
          } catch (\Exception $e) {
              return redirect()->back()->withErrors('Esse código promocional não existe ou não é válido.');
          }
      }

      $total = $price - $totalDiscount; 
      $unit_amount = $total * 100;

      session()->put('unit_amount', $unit_amount);

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
         'success_url' => route('payment.success'), 
     ]);


     LaravelSession::put('session', $session->id);
     LaravelSession::put('unit_amount', $unit_amount);

     return redirect()->away($session->url);
   }



   public function success()
   {

        Stripe::setApiKey(config('stripe.test.sk'));
        
        $user = auth()->user();

        $produto = $user->carrinho;

        foreach($produto as $prod) {
            $idProduct = $prod->product->id;
            $cor = $prod->cor;
            $numeracao = $prod->numeracao;
        }
        
            $price = LaravelSession::get('unit_amount');

            $produ = new Product();
            $user = auth()->user();
            $id = $produ->user_id = $user->id;

            $userEnd = $user->endereco;
            $end = new Payment();
            $idEndereco = $end->endereco_id = $userEnd->id;

            $session = LaravelSession::get('session');

            Payment::create([
            'stripe_session_id' => $session,
            'total' => $price,
            'currency' => 'brl',
            'status' => 'pendente',
            'user_id' => $id,
            'product_id' => $idProduct,
            'endereco_id' => $idEndereco,
            'cor' => $cor,
            'numeracao' => $numeracao,
        ]);


        Estrela::create([
            'user_id' => $id,
        ]);


       return view('/events/carrinho');
   }

   public function pedidos()
   {
       return view('welcome');
   }
}
