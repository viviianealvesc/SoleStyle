@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <h1 class="text-[#D9C549] font-semibold m-3 ml-16 text-center">Qual a forma de pagamento?</h1>
    <div class="flex justify-around flex-wrap items-center">
        <form action="{{ route('pagarCompra') }}" method="POST">
            @csrf
            <div class="m-4 w-96">
                <div class="bg-[#3F3F3F] rounded-md p-3">
                <div class="flex gap-2 items-center p-3">
                    <input type="checkbox" id="pix" name="pix">
                    <img width="40" src="img/logo-pix.webp" alt="Pix">
                    <label class="font-semibold  text-[#D9C549]" for="pix">Pix</label> <br>
                    <small class="text-[#7E7E7E]">Aprovação imediata</small> <br>
                </div>
                <hr class="border-[#676767] my-2">
                <div class="flex gap-2 items-center p-3">
                    <input type="checkbox" id="cartao" name="cartao">
                    <img width="40" src="img/cartao.png" alt="Pix">
                    <label class="font-semibold  text-[#D9C549]" for="cartao">cartão de crédito</label>
                </div>

                <hr class="border-[#676767] my-2">
                <div class="flex gap-2 items-center p-3">
                    <input type="checkbox" id="boleto" name="boleto">
                    <i class="bi bi-ticket-detailed text-white"></i>
                    <label class="font-semibold  text-[#D9C549]" for="boleto">Boleto</label>
                </div>
                </div>
                <p class="text-white font-semibold hidden" id="preco" name="preco">R$ {{ number_format($total, 2, ',', '.') }}</p>
                <button type="submit" class="btn btn-primary">Finalizar</button>
            </form>
        </div>

        <div class="m-4">
            <div>
              <form action="{{route('cupom')}}" method="POST">
                @csrf
                <label class="text-[#D9C549]" for="text" id="cupom">Cupom de desconto</label>
                <input class="rounded-sm my-3 p-2 w-full" type="text" id="nome" name="nome"  placeholder="Coloque o cupom">
                <button class="w-full bg-[#D9C549] p-2 rounded-sm" type="submit">Aplicar</button>
              </form>

              @if(session('msg'))
                  <p class="text-[#319f52] text-center">{{ session('msg') }}</p>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              @endif
            </div>
       </div>
        
        <div class="m-4 w-full md:w-1/2 bg-[#3F3F3F] p-3 rounded-md my-4">
            <h2 class="text-[#D9C549] font-semibold">Resumo da compra</h2>
            <hr class=" border-[#676767] my-2">
                  <!-- Valor total -->
                <div class="flex justify-between m-2">
                    <p class="text-[#7E7E7E]">Subtotal</p>
                    <p class="text-[#7E7E7E]">R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
                </div>
                <hr class="border-[#676767] my-2 m-2">

                @if ($totalDesconto > 0)
                <div class="flex justify-between m-2">
                    <p class="text-[#7E7E7E]">Descontos</p>
                    <p class="text-[#7E7E7E] flex justify-end">- R$ {{ number_format(($totalDesconto ), 2, ',', '.') }}</p>

                </div>
                <hr class="border-[#676767] my-2 m-2">
                @endif

                <div class="flex justify-between m-2">
                    <p class="text-white font-semibold">Total</p>
                    <p class="text-white font-semibold">R$ {{ number_format($total * session('quantidade', 0), 2, ',', '.') }}</p>
                </div>
        </div>
    </div>

     <!-- Botão finalizar pedido -->
     <div class="m-10 mt-20 flex justify-center items-center">
        <button class="p-2 rounded-md w-48 bg-[#D9C549] font-semibold">Continuar</button>
      </div>
</main>

@endsection