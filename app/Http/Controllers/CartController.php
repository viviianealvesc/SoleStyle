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

        $carrinhoItem = Carrinho::where('user_id', $user->id)
        ->where('product_id', $id)
        ->where('cor', $request->input('cor'))
        ->where('numeracao', $request->input('numeracao'))
        ->first();

        if ($carrinhoItem) {

            $carrinhoItem->increment('quantity');

        } else {
            $carrinho = new Carrinho();
            $carrinho->user_id = $user->id;
            $carrinho->product_id = $id;
            $carrinho->cor = $request->input('cor');
            $carrinho->numeracao = $request->input('numeracao');
            $carrinho->save();

        }


        return redirect()->route('product.product', ['id' => $id])->with('msg', 'Produto adicionado!'); 

    }



    public function atualizarQuantidade(Request $request, $id)
{
    $action = $request->input('action');
    $cor = $request->input('cor');

    $carrinho = Carrinho::findOrFail($id);
    $produto = $carrinho->product()->first(); // Garante que o relacionamento 'produto' está carregado corretamente


    // Encontra a variação do produto pela cor especificada
    $variacao = null;
    foreach ($produto->cores as $var) {
        if ($var['color'] === $cor) {
            $variacao = $var;
            break;
        }
    }


    // Verifica se a ação é incrementar ou decrementar a quantidade
    if ($action === 'increment' && $carrinho->quantity < $variacao['estoque']) {
        $carrinho->quantity++;
    } elseif ($action === 'decrement' && $carrinho->quantity > 1) {
        $carrinho->quantity--;
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
