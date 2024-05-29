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

        $subtotal = 0;
        $totalDesconto = 0;
    
        foreach ($carrinhos as $item) {
            $subtotal += $item['preco'];
            if (!empty($item['discount'])) {
                $totalDesconto += $item['discount'];
            }
        }
        
        $total = $subtotal - $totalDesconto;
    
        return view('/events/carrinho', compact('carrinhos', 'subtotal', 'totalDesconto', 'total'));

    }

 

    public function add($id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $user->carrinho()->attach($id);

        return redirect()->route('cart.pageCarrinho')->with('msg', 'Produto adicionado ao carrinho!');
    }

    public function remove($id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $user->carrinho()->detach($id);

        return redirect()->route('cart.pageCarrinho')->with('msg', 'Produto excluido!');
    }

    public function update(Request $request)
    {
        // Lógica para atualizar a quantidade de um item no carrinho
    }
}
