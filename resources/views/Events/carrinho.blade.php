@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class="m-3">
        <h1 class="text-[#D9C549] mb-4">Carrinho</h1>
       <div class="border border-[#676767] rounded-lg p-2">
        <div class="flex">
            <img class="w-28 p-2 bg-[#3F3F3F] rounded-lg" src="img/image-removebg-preview.png" alt="">
            <div class="ml-3">
                <p class="text-white truncate w-[largura] mt-2">Tênis feminino ultra</p>
                <div class="flex m-1 mb-2 items-center">
                    <p class="text-[#D9C549] font-semibold mr-1">R$ 60,90</p>
                    <small class="text-[#7E7E7E] line-through">74,90</small>
                </div>
                <div class="flex items-center">
                    <button class="bg-[#D9C549] p-1 w-9 rounded-md"><i class="bi bi-caret-left-fill text-white"></i></button>
                    <small  class="text-white p-2">1</small>
                    <button class="border p-1 rounded-md w-9"><i class="bi bi-caret-right-fill text-white"></i></button>
                </div>
            </div>
          </div>
          <div class="flex justify-end items-center">
            <a href="#"><i class="bi bi-trash text-[#D9C549]"></i></a>
         </div>
        </div>

        <!-- Valor total -->
        <div class="border border-[#676767] p-2 mt-36 rounded-md">
            <div class="flex justify-between m-2">
                <p class="text-[#7E7E7E]">Descontos</p>
                <p class="text-[#7E7E7E] flex justify-end">- R$ 3,50</p>
            </div>
            <hr class=" border-[#676767] my-2 m-2">
            <div class="flex justify-between m-2">
                <p class="text-white font-semibold">Total</p>
                <p class="text-white font-semibold">R$ 53,50</p>
            </div>
        </div> 
    </div>

    <!-- Botão finalizar pedido -->
    <div class="m-3 mt-7">
      <a href="{{route('finalizarPedido')}}" class="p-2 rounded-md w-full bg-[#D9C549]">Finalizar pedido</a>
    </div>
</main>

@endsection