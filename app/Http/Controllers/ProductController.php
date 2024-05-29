<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::limit(10)->get();

       return view('/welcome', ['products' => $products]);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('/produto', ['product' => $product]);
    }


    public function finalizarPedido()
    {
        $user = auth()->user();
        
        $carrinhos = $user->carrinho;

        $subtotal = 0;
        $totalDesconto = 0;
    
        foreach ($carrinhos as $item) {
            $subtotal += $item['preco'];
            if (!empty($item['discount'])) {
                $totalDesconto += $item['discount'];
            }
        }
        
        $total = $subtotal - $totalDesconto;

         // Pegando o endereco do usuario logado
         $enderecoUser = $user->enderecos; 
    
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

        // Pegando o endereco do usuario logado
        $enderecoUser = $user->enderecos; 

      // Dados da compra
        $carrinhos = $user->carrinho;

        $subtotal = 0;
        $totalDesconto = 0;
    
        foreach ($carrinhos as $item) {
            $subtotal += $item['preco'];
            if (!empty($item['discount'])) {
                $totalDesconto += $item['discount'];
            }
        }
        
        $total = $subtotal - $totalDesconto;
    
        return view('events.finalizarPedido', compact('carrinhos', 'subtotal', 'totalDesconto', 'total', 'enderecoUser'));

    }


    public function pageLogin()
    {
        return view('livewire.page.auth.register');
    }


    public function formaPagamento()
    {
        return view('events.formaPagamento');
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
