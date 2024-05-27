<?php

namespace App\Http\Controllers;

use App\Models\Favoritos;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function pageFavorito()
    {
        $user = auth()->user();
        
        $favoritos = $user->favoritos;


        if($user) {

            $nomeUser = $user->name;
    
            $emailUser = $user->email;
        
    
            return view('/events/favoritos', ['favoritos' => $favoritos, 'user' => $user, 'nomeUser' => $nomeUser, 'emailUser' => $emailUser]);
        }

        return view('/events/favoritos', ['favoritos' => $favoritos, 'user' => $user]);
    }



    public function index()
    {
        return view('events.favoritos');
      
    }

    public function add($id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $user->favoritos()->attach($id);

        return redirect()->route('product.product', ['id' => $id])->with('message', 'Add aos favoritos'); 
    }


    public function remove($id)
    {
        $user = auth()->user();

        $user->favoritos()->detach($id);

        return redirect()->route('product.product')->with('message', 'Add aos favoritos');
    }
}
