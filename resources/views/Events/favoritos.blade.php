@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class="m-3">
        <h1 class="text-[#D9C549] mb-4">Meus produtos Favoritados</h1>

        @foreach ($favoritos as $favorito)
            
        <div class="border rounded-lg p-2 mt-3">
            <div class="flex">
                <a href="/produto/{{ $favorito->id }}">
                   <img class="w-28 p-2 bg-[#3F3F3F] rounded-lg" src="{{ asset('img/image-removebg-preview.png')}}" alt="">
                </a>
                <div class="m-3">
                    <p class="text-white truncate w-[largura] mt-2">{{ $favorito->nome }}</p>
                    <p class="text-[#D9C549] font-semibold">R$ {{ $favorito->preco }}</p>
                    <small class="text-[#7E7E7E] line-through">74,90</small>
                </div>
            </div>
            <div class="flex justify-end ">
                <a class="text-[#D9C549] font-semibold" href="#">Adicionar ao carrinho</a>
            </div>
        </div>
       @endforeach
    </div>
</main>



@endsection