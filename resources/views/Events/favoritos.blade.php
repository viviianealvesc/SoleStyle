@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class="m-3">
        <h1 class="text-[#D9C549] mb-4">Meus produtos Favoritados</h1>
       <div class="border rounded-lg p-2">
        <div class="flex">
            <img class="w-28 p-2 bg-[#3F3F3F] rounded-lg" src="img/image-removebg-preview.png" alt="">
            <div class="m-3">
                <p class="text-white truncate w-[largura] mt-2">Tênis feminino ultra</p>
                <p class="text-[#D9C549] font-semibold">R$ 60,90</p>
                <small class="text-[#7E7E7E] line-through">74,90</small>
            </div>
           </div>
           <div class="flex justify-end ">
            <a class="text-[#D9C549] font-semibold" href="#">Adicionar ao carrinho</a>
           </div>
         </div>
    </div>


    <div class="m-3">
       <div class="border rounded-lg p-2">
        <div class="flex">
            <img class="w-28 p-2 bg-[#3F3F3F] rounded-lg" src="img/image-removebg-preview.png" alt="">
            <div class="m-3">
                <p class="text-white truncate w-[largura] mt-2">Tênis feminino ultra</p>
                <p class="text-[#D9C549] font-semibold">R$ 60,90</p>
                <small class="text-[#7E7E7E] line-through">74,90</small>
            </div>
           </div>
           <div class="flex justify-end ">
            <a class="text-[#D9C549] font-semibold" href="#">Adicionar ao carrinho</a>
           </div>
         </div>
    </div>

    
</main>



@endsection