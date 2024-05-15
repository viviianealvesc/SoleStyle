<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    public function Product()
    {
        return view('/produto');
    }

    public function voltarHome()
    {
        return view('/welcome');
    }

    public function menu()
    {
        $user = auth()->user();

        if($user) {

            $nomeUser = $user->name;

            $emailUser = $user->email;
        

            return view('/menu-lateral', ['user' => $user, 'nomeUser' => $nomeUser, 'emailUser' => $emailUser]);
        }

        return view('/menu-lateral', ['user' => $user,]);
    }

    public function pageLogin()
    {
        return view('livewire.page.auth.register');
    }

    public function pageFavorito()
    {
        return view('events.favoritos');
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
     * Display the specified resource.
     */
    public function show(string $id)
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
