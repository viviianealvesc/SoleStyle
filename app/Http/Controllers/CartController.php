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
        
    
            return view('/events/carrinho', ['carrinhos' => $carrinhos, 'user' => $user, 'nomeUser' => $nomeUser, 'emailUser' => $emailUser]);
        }

        return view('/events/carrinho', ['carrinhos' => $carrinhos]);
    }

 

    public function add($id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $user->carrinho()->attach($id);

        return redirect()->route('cart.add')->with('msg', 'Produto adicionado ao carrinho!');
    }

    public function remove($id)
    {
        $user = auth()->user();

        $user->carrinho()->detach($id);

        return redirect()->route('cart.remove')->with('msg', 'Produto excluido!');
    }

    public function update(Request $request)
    {
        // Lógica para atualizar a quantidade de um item no carrinho
    }
}
