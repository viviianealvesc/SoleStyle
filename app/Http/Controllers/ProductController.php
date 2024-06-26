<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Categorie;
use App\Models\Cupom;
use App\Models\Endereco;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if($search) {

            $products = Product::where([
                ['nome', 'like', '%'. $search . '%']
            ])->get();

        }else {

         
            $categories  = Categorie::with('produtos')->get();
            $banners = Banner::all();

            return view('welcome', ['categories' => $categories ,'banners' => $banners]);

        }

       return view('welcome', ['products' => $products, 'search' => $search]);
    }


    public function show($id, $selectedColorIndex = null)
    {
 
        $product = Product::findOrFail($id);

        $selectedColor = $selectedColorIndex !== null ? $product->cores[$selectedColorIndex] : null;

    
        $user = auth()->user();

        $favorito = false;

        if($user) {
            $userFav = $user->favoritos->toArray();

            foreach($userFav as $userFavs) {
                if($userFavs['id'] == $id) {
                    $favorito = true;
                }
            }
        }


        $carrinho = false;

    if ($user) {
        // Obtém os IDs dos produtos no carrinho do usuário
        $usercart = $user->carrinho->pluck('id')->toArray();

        // Verifica se o produto atual está no carrinho
        if (in_array($product->id, $usercart)) {
            $carrinho = true;
        }
    }

        foreach ($product->cores as $index => $cor) {
            if ($selectedColor && $cor['color'] === $selectedColor['color']) {
             
                $corSelec = $selectedColor['color']; 

                $todosProd = Product::all();

                return view('/produto', ['product' => $product, 'todosProd' => $todosProd, 'selectedColor' => $selectedColor, 'selectedColorIndex' => $selectedColorIndex, 'corSelec' => $corSelec,  'favorito' => $favorito , 'carrinho' => $carrinho]);

            }
        }

        $todosProd = Product::all();


  
        return view('/produto', ['product' => $product, 'todosProd' => $todosProd, 'selectedColor' => $selectedColor, 'selectedColorIndex' => $selectedColorIndex, 'favorito' => $favorito, 'carrinho' => $carrinho]);
    }



    public function finalizarPedido(Request $request)
    {
           // Capturar os parâmetros da URL ou do formulário
           $cor = $request->input('cor');
           $numeracao = $request->input('numeracao');
           $subtotal = $request->input('subtotal', $request->query('subtotal'));
           $desconto = $request->input('desconto', $request->query('desconto'));
           $total = $request->input('total', $request->query('total'));

   
           // Armazenar os parâmetros na sessão, se fornecidos
           if ($cor) {
               Session::put('cor', $cor);
           }
           if ($numeracao) {
               Session::put('numeracao', $numeracao);
           }
           if ($subtotal) {
               Session::put('subtotal', $subtotal);
           }
           if ($desconto) {
               Session::put('desconto', $desconto);
           }
           if ($total) {
               Session::put('total', $total);
           }
   
           // Recuperar os valores da sessão
          session('subtotal');
          session('desconto');
          session('total');


        $user = auth()->user();
    
        $cart = $user->carrinho;

        foreach($cart as $carrinho) {
            $id = $carrinho->id;
            $nome = $carrinho->nome;
            $imagem = $carrinho->imagem;

        }
    
        /*$subtotal = 0;
        $totalDesconto = 0;
        $valorDesconto = 0;
    
            foreach ($cart as $item) {
                $subtotal += $item->preco;
                if (!empty($item->discount)) {
                    $totalDesconto += $item->discount;
                }
            }
    
        $total = $subtotal - $totalDesconto; */
    
        // Pegando o endereco do usuario logado
        $enderecoUser = $user->endereco; 

    
        return view('events.finalizarPedido', compact( 'total', 'enderecoUser', 'id', 'nome', 'imagem'));
    }
    


    public function cadastrarEndereco(Request $request) {
  
      
        
        return view('events.cadastroEnd');
    }


    public function enviarEndereco(Request $request) {
        $endereco = new Endereco();

        $endereco->nome = $request->nome;
        $endereco->telefone = $request->telefone;
        $endereco->cep = $request->cep;
        $endereco->estado = $request->estado;
        $endereco->cidade = $request->cidade;
        $endereco->bairro = $request->bairro;
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;

        $user = auth()->user();

        $endereco->user_id = $user->id;

        $endereco->save();


        return view('events.cadastroEnd')->with(['msg' => 'Endereço salvo com sucesso!']);

    }
    

    public function cupom(Request $request)
    {
        $cupomCodigo = $request->nome;
        $cupom = Cupom::where('nome', $cupomCodigo)->first();
        
        
        if ($cupom) {
            $user = auth()->user();
            
            if ($user && $cupom) {
                $user->cupons()->attach($cupom->id); 

                // Armazena o cupom na sessão
                session(['cupom_aplicado' => $cupom->id]);

                return redirect()->route('formaPagamento')->with('msg', 'Cupom aplicado com sucesso!');
            } else {
                return redirect()->route('formaPagamento')->with('msg', 'Erro ao aplicar cupom.');
            }
        }
    }
 


    public function formaPagamento()
    {
        $user = auth()->user();
    
        $carrinhos = $user->carrinho;
    
        $subtotal = 0;
        $totalDesconto = 0;
        $valorDesconto = 0;
    
        if (session()->has('cupom_aplicado')) {

            $cupom = Cupom::find(session('cupom_aplicado'));
            session()->forget('cupom_aplicado');
    
            foreach ($carrinhos as $item) {
                $subtotal += $item->preco;
                if (!empty($item->discount)) {
                    $totalDesconto += $item->discount;
                }
                $valorDesconto += $item->preco * ($cupom->porcentagem / 100);
            }
    
            $totalDesconto += $valorDesconto;
        } else {
            foreach ($carrinhos as $item) {
                $subtotal += $item->preco;
                if (!empty($item->discount)) {
                    $totalDesconto += $item->discount;
                }
            }
        }
    
        $total = $subtotal - $totalDesconto;
    
        // Pegando o endereco do usuario logado
        $enderecoUser = $user->endereco; 

    
        return view('events.formaPagamento', compact('carrinhos', 'subtotal', 'totalDesconto', 'total', 'enderecoUser'));
    }


    public function listarPedido() {

        $user = auth()->user();

        $pedidos = $user->payments;

        return view('events.pedido', ['pedidos' => $pedidos]);
    }


    public function cancelarPedido($id) {

        $pedido = Payment::findOrFail($id);

        $pedido->status = 'cancelado';
        $pedido->save();
  
        return redirect()->back();
    }


    public function estrelas() {

        $user = auth()->user();

        $estrelas = $user->estrela;

        if(count($estrelas) == 5) {
             // Concede o cupom de desconto
             $this->concederCupom($user);

            foreach ($estrelas as $estrela) {
                $estrela->delete();
            }
        }

        $currentDate = Carbon::now()->startOfDay();

        $cupons = Cupom::whereDate('expiry_date', $currentDate)->get();
        
        foreach($cupons as $cupom) {
            $cupom->delete();
        }


        return view('profile', ['estrelas' => $estrelas, 'user' => $user]);
    }


    private function concederCupom($user)
    {
        Cupom::create([
            'user_id' => $user->id,
            'code' => '40PERCENTOFF', 
            'discount' => 40,
            'expiry_date' => now()->addMonth(), 
        ]);

        //Notification::send($user, new CouponGrantedNotification('40PERCENTOFF'));
    }


    public function pageRegister()
    {
        return view('livewire.page.auth.register');
    }

    public function pageLogin()
    {
        return view('livewire.page.auth.login');
    }




   

}
