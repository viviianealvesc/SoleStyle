<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function pageCarrinho()
    {
        $user = auth()->user();
        
        $carrinhos = $user->carrinho;

        $totalParesTenis = 0;

        foreach ($carrinhos as $item) {
            $totalParesTenis += $item->quantity;
            $total = $item->product->preco - $item->product->discount ;
        }
        

        $desconto = 0;
        if ($totalParesTenis >= 2) {
            $desconto =  7; 
        }

        return view('/events/carrinho', compact('carrinhos', 'desconto', 'totalParesTenis', 'total'));
    }


    public function add(Request $request, $id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $carrinho = new Carrinho();
        $carrinho->user_id = $user->id;
        $carrinho->product_id = $id;
        $carrinho->cor = $request->input('cor');
        $carrinho->numeracao = $request->input('numeracao');
        $carrinho->save();

        $carrinho = false;
       

        return redirect()->route('cart.pageCarrinho', ['carrinho' => $carrinho])->with('msg', 'Produto adicionado ao carrinho!');
    }



    public function atualizarQuantidade(Request $request, $id)
    {
        $action = $request->input('action');

        $carrinho = Carrinho::findOrFail($id);

        if ($action === 'increment') {
            $carrinho->quantity++;
        } elseif ($action === 'decrement') {
            if ($carrinho->quantity > 1) {
                $carrinho->quantity--;
            }
        }

        $carrinho->save();
        

       

        return redirect()->back();
    }
    

    public function remove($id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $user->carrinho()->detach($id);

        return redirect()->back()->with('msg', 'Produto excluido!');
    }

 
    public function update(Request $request)
    {
        // Lógica para atualizar a quantidade de um item no carrinho
    }
}
