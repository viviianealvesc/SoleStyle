<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function pageCarrinho()
    {
        $user = auth()->user();
        
        $carrinhos = $user->carrinho;

        if($user) {

            $nomeUser = $user->name;
    
            $emailUser = $user->email;
        
    
            return view('events.carrinho', ['carrinhos' => $carrinhos, 'user' => $user, 'nomeUser' => $nomeUser, 'emailUser' => $emailUser]);
        }

        return view('events.carrinho', ['carrinhos' => $carrinhos]);
    }

    public function index()
    {
      
    }

    public function add($id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $user->carrinho()->attach($id);

        return redirect('events.carrinho')->with('message', 'Add aos carrinho'); 
    }

    public function remove(Request $request)
    {
        // Lógica para remover um item do carrinho
    }

    public function update(Request $request)
    {
        // Lógica para atualizar a quantidade de um item no carrinho
    }
}
