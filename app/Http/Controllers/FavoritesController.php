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



    public function index($id)
    {
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
        return view('events.favoritos');
      
    }

    public function add($id)
    {
        Product::findOrFail($id);

        $user = auth()->user();

        $user->favoritos()->attach($id);

        $favorito = false;

       

        return redirect()->route('product.product', ['id' => $id, 'favorito' => $favorito])->with('msg', 'Produto adicionado!'); 
    }


    public function remove($id)
    {
        $user = auth()->user();

        $user->favoritos()->detach($id);

        return redirect()->route('favorites.pageFavorito')->with('msg', 'Produto removido!');
    }
}
