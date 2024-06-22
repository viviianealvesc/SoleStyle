<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cupom;
use App\Models\Endereco;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
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
            
            $products = Product::all();
            $banners = Banner::all();

            return view('welcome', ['products' => $products,'banners' => $banners]);

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

        foreach ($product->cores as $index => $cor) {
            if ($selectedColor && $cor['color'] === $selectedColor['color']) {
             
                $corSelec = $selectedColor['color']; 

                return view('/produto', ['product' => $product, 'selectedColor' => $selectedColor, 'selectedColorIndex' => $selectedColorIndex, 'corSelec' => $corSelec,  'favorito' => $favorito]);

            }
        }

  
        return view('/produto', ['product' => $product, 'selectedColor' => $selectedColor, 'selectedColorIndex' => $selectedColorIndex, 'favorito' => $favorito]);
    }



    public function finalizarPedido(Request $request)
    {
        $cor = $request->input('cor');
        $numeracao = $request->input('numeracao');
        $subtotal = $request->input('subtotal');
        $desconto = $request->input('desconto');
        $total = $request->input('total');
        
        // Armazene as informações na sessão
        Session::put('cor', $cor);
        Session::put('numeracao', $numeracao);
        Session::put('subtotal', $subtotal);
        Session::put('desconto', $desconto);
        Session::put('total', $total);


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
    


    public function cadastrarEndereco() {

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

        if(count($estrelas) == 2) {
             // Concede o cupom de desconto
             $this->concederCupom($user);

            foreach ($estrelas as $estrela) {
                $estrela->delete();
            }
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
