<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Endereco;
use App\Models\Estrela;
use App\Models\Payment;
use App\Models\Product;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use Stripe\PromotionCode;
use Stripe\Stripe;
use Illuminate\Support\Facades\Session as LaravelSession;
use Escapework\Frete\Correios;

use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\Correios\Rastreamento;
use EscapeWork\Frete\FreteException;
use App\Services\RastreamentoService;


class SubscribeController extends Controller
{
    public function __invoke(Request $request)
    {
        Stripe::setApiKey(config('stripe.test.sk'));

    
        $user = auth()->user();
        $cartItems = $user->carrinho;
        
        $subtotal = LaravelSession::get('total', 0); // Valor total inicializado com 0
        $desconto = (int) LaravelSession::get('desconto');

    
        $totalFinal = $subtotal;
        $totalFinalCents = (int) ($totalFinal * 100);
    
        // Criar um único item de linha com o total definido
        $lineItems = [
            [
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => 'Total da Compra', // Nome indicando que é o total da compra
                    ],
                    'unit_amount' => $totalFinalCents, // Usar o total final ajustado com desconto
                ],
                'quantity' => 1, // Quantidade fixa como 1
            ]
        ];

        // Lógica para aplicar desconto se houver cupom
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
  

    
        // Criar a sessão no Stripe
        $session = Session::create([
            'payment_method_types' => ['card', 'boleto'],
            'line_items' => $lineItems,
            'discounts' => $discounts,
            'mode' => 'payment',
            'success_url' => route('payment.success'),
        ]);
    
        // Armazenar o ID da sessão e o total na sessão Laravel
        LaravelSession::put('session', $session->id);
    
        // Redirecionar para o checkout do Stripe
        return redirect()->away($session->url);
    }
    


    public function success()
    {
        Stripe::setApiKey(config('stripe.test.sk'));
    
        $session = LaravelSession::get('session');
        $total = (int) LaravelSession::get('total'); // Convertendo de centavos para reais
    
        $user = auth()->user();
        $cartItems = $user->carrinho;
    
        foreach ($cartItems as $item) {
            Payment::create([
                'stripe_session_id' => $session,
                'total' => $total,
                'currency' => 'brl',
                'status' => 'pendente',
                'user_id' => $user->id,
                'product_id' => $item->product->id,
                'endereco_id' => $user->endereco->id,
                'cor' => $item->cor,
                'numeracao' => $item->numeracao,
                'quantity' => $item->quantity,
            ]);

            $item->delete();
        }
    
        Estrela::create(['user_id' => $user->id]);

        $id = session('id');

        $productId = $id; 
        $produto = Product::find($productId);

     
        $cor =  session('cor');
        $quantidade = session('quantidade');
        

        $cores = $produto->cores;
        
        foreach ($cores as &$corItem) {
            if ($corItem['color'] == $cor) {
                // Subtrai a quantidade do estoque atual
                $corItem['estoque'] -= $quantidade;
    
                // Garantir que o estoque não seja negativo
                if ($corItem['estoque'] < 0) {
                    $corItem['estoque'] = 0;
                }
               
                $produto->cores = $cores;
                $produto->save(); 
                break; 
            }
        }

       
    
        // Limpar a sessão Laravel após a conclusão do pagamento
        LaravelSession::forget(['session', 'total']);
    
        return view('events.carrinho');
    }

    
    protected $rastreamentoService;

    public function __construct(RastreamentoService $rastreamentoService)
    {
        $this->rastreamentoService = $rastreamentoService;
    }
   
    public function frete(Request $request)
    {
        $codigo = $request->input('codigo'); // Obtém o código de rastreamento do formulário

        try {
            // Consulta o rastreamento usando o serviço de rastreamento
            $resultado = $this->rastreamentoService->consultarRastreamento($codigo);

            return view('events.pedido', ['resultado' => $resultado]);
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Houve um erro ao buscar os dados. Verifique se todos os dados estão corretos']);
        }
    }
    

    
    

   public function pedidos()
   {
       return view('welcome');
   }
}