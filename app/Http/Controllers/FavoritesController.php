<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Models\Favoritos;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FavoritesController extends Controller
{
    public function pageFavorito()
    {
        $user = auth()->user();
        
        $favoritos = $user->favoritos;

        return view('/events/favoritos', ['favoritos' => $favoritos, 'user' => $user]);
    }


    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $user = auth()->user();

        $favorite = new Favorito();
        $favorite->user_id = $user->id;
        $favorite->product_id = $id;
        $favorite->save();

        $favorito = false;

        return redirect()->route('product.product', ['id' => $id, 'favorito' => $favorito])->with('msg', 'Produto adicionado!'); 
    }


    public function remove($id)
    {
        $user = auth()->user();

        $user->favoritos()->detach($id);

        return redirect()->route('favorites.pageFavorito')->with('msg', 'Produto removido!');
    }

    
    public function removeCoracao($id)
    {
        $user = auth()->user();

        $user->favoritos()->detach($id);

        return redirect()->back()->with('msg', 'Produto removido!');
    }
}
