@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class="flex justify-around flex-wrap ">
        <div class="m-4">
          <form action="" method="POST">
            @csrf
              <div class="bg-[#3F3F3F] rounded-md p-3 my-3">
                  <input type="checkbox" id="endereco">
                  <label class="font-semibold text-[#D9C549]" for="endereco">Enviar no meu endereço</label> <br>
                  <!-- aqui irá conter o endereço do usuario. caso não tiver endereço cadastrado ira aparecer a seguinte mensagem: nenhum endereço cadastrado. -->
              
                  <hr class=" border-[#676767] my-2">
                  @if(isset($enderecoUser))
                    @foreach ($enderecoUser as $endereco)
                      <p>{{$endereco->rua}}</p>
                    @endforeach
                    <hr class=" border-[#676767] my-2">
                  @else
                  <small class="text-white">Nenhum endereço cadastrado</small>

                  @endif
                  <a href="{{ route('endereco')}}">Editar ou adicionar um endereço</a>
                 
              </div>

              <div class="bg-[#3F3F3F] rounded-md p-3">
                  <input type="checkbox" id="loja">
                  <label class="font-semibold  text-[#D9C549]" for="loja">Retirar na loja</label>
                  <!-- aqui irá conter o endereço da loja. -->
                  <p class="text-white mt-2">Manuel de alcantará 67, Araçatuba - SP</p>
                  <p class="text-[#676767] my-2">Segunda á sexta das 9hs ás 18hs. - Sábado das 9h ás 12h</p>
              </div>
          </div>
      
          <div class="m-4">
            <div>
              <label class="text-[#D9C549]" for="text" id="cupom">Cupom de desconto</label>
              <input class="rounded-sm my-3 p-2 w-full" type="text" id="cupom" name="cupom" placeholder="Coloque o cupom">
            </div>
        </form>

          <div class="bg-[#3F3F3F] p-3 rounded-md my-4">
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
                    <p class="text-[#7E7E7E] flex justify-end">- R$ {{ number_format($totalDesconto, 2, ',', '.') }}</p>
                </div>
                <hr class="border-[#676767] my-2 m-2">
                @endif

                <div class="flex justify-between m-2">
                    <p class="text-white font-semibold">Total</p>
                    <p class="text-white font-semibold">R$ {{ number_format($total, 2, ',', '.') }}</p>
                </div>
            </div>
          </div>
        </div>
    </div>

     <!-- Botão finalizar pedido -->
     <div class="m-10 mt-20 flex justify-center items-center">
        <a href="{{route('formaPagamento')}}" class="p-2 rounded-md w-48 bg-[#D9C549] font-semibold">Continuar</a>
      </div>
</main>

@endsection