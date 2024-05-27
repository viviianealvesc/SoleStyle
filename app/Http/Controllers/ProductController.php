<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

       return view('/welcome', [ 'products' => $products]);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('/produto', ['product' => $product]);
    }


    public function voltarHome()
    {
       $products = Product::all();

       return view('/welcome', [ 'products' => $products]);
    }



    public function finalizarPedido()
    {
        return view('events.finalizarPedido');
    }

    public function pageLogin()
    {
        return view('livewire.page.auth.register');
    }

 

  

    public function formaPagamento()
    {
        return view('events.formaPagamento');
    }



   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
