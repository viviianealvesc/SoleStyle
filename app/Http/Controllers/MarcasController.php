<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function marca(Request $request, $nome) {
       
        $uri = $request->path();

        $products = Product::where('marca', $nome)->get();

        return view('marcas', ['products' => $products, 'uri' => $uri]);
    }


    public function categoria(Request $request, $categoria) {
       
        $uri = $request->path();

        $category = Categorie::where('name', $categoria)->first();

        $products = $category->produtos;

        return view('marcas', ['products' => $products, 'uri' => $uri]);
    }
}
