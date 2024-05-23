@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <h1 class="text-[#D9C549] font-semibold m-3 ml-16 text-center">Qual a forma de pagamento?</h1>
    <div class="flex justify-around flex-wrap items-center">
        <div class="m-4 w-96">
            <div class="bg-[#3F3F3F] rounded-md p-3">
               <div class="flex gap-2 items-center p-3">
                <input type="checkbox" id="loja">
                <img width="40" src="img/logo-pix.webp" alt="Pix">
                <label class="font-semibold  text-[#D9C549]" for="loja">Pix</label> <br>
                <small class="text-[#7E7E7E]">Aprovação imediata</small> <br>
               </div>
               <hr class="border-[#676767] my-2">
               <div class="flex gap-2 items-center p-3">
                <input type="checkbox" id="loja">
                <img width="40" src="img/cartao.png" alt="Pix">
                <label class="font-semibold  text-[#D9C549]" for="loja">cartão de crédito</label>
               </div>

               <hr class="border-[#676767] my-2">
               <div class="flex gap-2 items-center p-3">
                <input type="checkbox" id="loja">
                <i class="bi bi-ticket-detailed text-white"></i>
                <label class="font-semibold  text-[#D9C549]" for="loja">Boleto</label>
               </div>
            </div>
        </div>
        
        <div class="m-4 w-full md:w-1/2">
            <div class="bg-[#3F3F3F] p-3 rounded-md">
                <h2 class="text-[#D9C549] font-semibold">Resumo da compra</h2>
                <hr class="border-[#676767] my-2">
                <div class="flex justify-between m-2">
                    <p class="text-[#7E7E7E]">Descontos</p>
                    <p class="text-[#7E7E7E]">- R$ 3,50</p>
                </div>
                <hr class="border-[#676767] my-2">
                <div class="flex justify-between m-2">
                    <p class="text-white font-semibold">Total</p>
                    <p class="text-white font-semibold">R$ 53,50</p>
                </div>
            </div>
        </div>
    </div>

     <!-- Botão finalizar pedido -->
     <div class="m-10 mt-20 flex justify-center items-center">
        <button class="p-2 rounded-md w-48 bg-[#D9C549] font-semibold">Continuar</button>
      </div>
</main>

@endsection