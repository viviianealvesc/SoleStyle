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
        $total = 0;
        $subtotal = 0;
        $subTotalDesconto = 0;
    
        foreach ($carrinhos as $item) {
            $totalParesTenis += $item->quantity;
            $subtotal += $item->product->preco * $item->quantity;
            $subTotalDesconto += $item->product->discount * $item->quantity;
            $total += ($item->product->preco - $item->product->discount) * $item->quantity;
        }
    
        $desconto = 0;
        if ($totalParesTenis >= 2) {
            $desconto = $total * 0.07; // 7% de desconto
        }

        $totalDesconto = $subTotalDesconto + $desconto;
    
        $totalComDesconto = $total - $desconto;


        return view('/events/carrinho', ['carrinhos' => $carrinhos, 'desconto' => $desconto, 'totalParesTenis' => $totalParesTenis, 'total' => $totalComDesconto, 'totalDesconto' => $totalDesconto, 'subtotal' => $subtotal]);
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


        return redirect()->back()->with('msg', 'Produto adicionado ao carrinho!');

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
        $user = auth()->user();

        $item = $user->carrinho()->where('id', $id)->first();

        $item->delete();

        return redirect()->back()->with('msg', 'Produto excluido!');
    }

 
    public function update(Request $request)
    {
        // Lógica para atualizar a quantidade de um item no carrinho
    }
}
