<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function marca(Request $request, $nome) {
       
        $uri = $request->path();

        $products = Product::where('marca', '=', $nome)->get();

        return view('marcas', ['products' => $products, 'uri' => $uri]);
    }
}
