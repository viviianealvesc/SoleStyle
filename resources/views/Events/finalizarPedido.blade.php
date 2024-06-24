@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class=" flex-wrap ">
        <div class="m-4">
              <div class="bg-[#3F3F3F] rounded-md p-3 my-3">
                  <label class="font-semibold text-[#D9C549]" for="endereco">Enviar no meu endereço</label> <br>
                  <!-- aqui irá conter o endereço do usuario. caso não tiver endereço cadastrado ira aparecer a seguinte mensagem: nenhum endereço cadastrado. -->
              
                  <hr class=" border-[#676767] my-2">
                  @if(isset($enderecoUser))
                    <p class="text-white">{{$enderecoUser->rua}}, {{$enderecoUser->numero}}, {{$enderecoUser->bairro}}, {{$enderecoUser->cidade}}, {{$enderecoUser->estado}}, {{$enderecoUser->cep}}</p>
                    <hr class=" border-[#676767] my-2">
                  
                  @else
                  <small class="text-white">Nenhum endereço cadastrado</small>
                    <hr class=" border-[#676767] my-2">
                
                  @endif

                  <a class="text-white" href="{{ route('endereco')}}">Editar ou adicionar um endereço</a>
              </div>
          </div>
      

          <div class="bg-[#3F3F3F] p-3 rounded-md m-4">
            <h2 class="text-[#D9C549] font-semibold">Resumo da compra</h2>
            <hr class=" border-[#676767] my-2">
                  <!-- Valor total -->
                <div class="flex justify-between m-2">
                    <p class="text-[#7E7E7E]">Subtotal</p>
                    <p class="text-[#7E7E7E]">R$ {{ $subtotal }}</p>
                </div>
                <hr class="border-[#676767] my-2 m-2">

                @if(session('desconto') > 0)
                <div class="flex justify-between m-2">
                    <p class="text-[#7E7E7E]">Descontos</p>
                    <p class="text-[#7E7E7E] flex justify-end">- R$ {{ $desconto }}</p>

                </div>
                <hr class="border-[#676767] my-2 m-2">
                @endif

                <div class="flex justify-between m-2">
                    <p class="text-white font-semibold">Total</p>
                    <p class="text-white font-semibold">R$ {{ $total }}</p>
                </div>
            </div>
          </div>
        </div>
    </div>

     <!-- Botão finalizar pedido -->

      <div class="m-3 mt-7">
        <form action="/subscribe" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$id}}">
            <input type="hidden" name="nome" value="{{$nome}}">
            <input type="hidden" name="preco" value="{{ $total }}">
            <input type="hidden" name="imagem" value="{{$imagem}}">

            <div class="mb-5 mt-5">
              <label for="cupom" class="text-[#D9C549]">Cupom de Desconto:</label>
              <input type="text" class="bg-[#3F3F3F] rounded-md p-2 text-white outline-none focus:outline-amber-300" id="cupom" name="cupom">
            </div>
        
            <button type="submit" class="p-2 rounded-md w-full bg-[#D9C549]">Finalizar pedido</button>
        </form>
            
    </div>
</main>

@endsection