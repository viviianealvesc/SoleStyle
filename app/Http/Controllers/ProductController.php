<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Cupom;
use App\Models\Endereco;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

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

            return view('/welcome', ['products' => $products,'banners' => $banners]);

        }

       return view('/welcome', ['products' => $products, 'search' => $search]);
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

  
        return view('/produto', ['product' => $product, 'selectedColor' => $selectedColor, 'selectedColorIndex' => $selectedColorIndex, 'favorito' => $favorito]);
    }



    public function finalizarPedido()
    {
        $user = auth()->user();
    
        $carrinhos = $user->carrinho;
    
        $subtotal = 0;
        $totalDesconto = 0;
        $valorDesconto = 0;
    
            foreach ($carrinhos as $item) {
                $subtotal += $item->preco;
                if (!empty($item->discount)) {
                    $totalDesconto += $item->discount;
                }
            }
    
        $total = $subtotal - $totalDesconto;
    
        // Pegando o endereco do usuario logado
        $enderecoUser = $user->endereco; 

    
        return view('events.finalizarPedido', compact('carrinhos', 'subtotal', 'totalDesconto', 'total', 'enderecoUser'));
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



    public function pageRegister()
    {
        return view('livewire.page.auth.register');
    }

    public function pageLogin()
    {
        return view('livewire.page.auth.login');
    }
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
