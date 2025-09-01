@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class="m-3">
        @if(!isset($carrinhos) || $carrinhos->isEmpty())
        <div class="flex items-center justify-center mt-9">
           <div>
              <h1 class="text-center opacity-40 text-white font-semibold">Não há produtos no carrinho!</h1>
              <img class="opacity-40" src="{{asset('/img/carrinho-vazio.png')}}" alt="">
           </div>
        </div>

        @else

        <h1 class="text-[#D9C549] mb-4">Carrinho</h1>

        <div class="flex justify-end">
            @if(session('msg'))
            <div class="alert border border-success alert-warning alert-dismissible fade show bg-[#3F3F3F] w-72 h-14 mr-2" role="alert">
                <p class="text-white">{{ session('msg') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
           @endif
        </div>
        
        @foreach ($carrinhos as $carrinho)
            <div class="border border-[#676767] rounded-lg p-2 mb-3">
                <div class="flex">
                    <img class="w-28 p-2 rounded-lg" src="/img/loja/{{$carrinho->product->imagem}}" alt="{{$carrinho->product->nome}}">
                    <div class="ml-3">
                        <p class="text-white max-sm:w-[158px] truncate w-[largura] mt-2">{{$carrinho->product->nome}}</p>

                        @if($carrinho->product->discount == 0.00)
                            <div class="m-1 mb-2 items-center">
                                <div class="flex">
                                    <p class="text-[#D9C549] font-semibold mr-1">{{  number_format($carrinho->product->preco - $carrinho->product->discount, 2, ',', '.') }}</p>
                                </div>
                                <p class="text-[#D9C549]">{{$carrinho->cor}}, {{$carrinho->numeracao}}</p>

                            </div>
                        @else
                            <div class=" m-1 mb-2 items-center">
                                <div class="flex">
                                    <p class="text-[#D9C549] font-semibold mr-1">{{  number_format($carrinho->product->preco - $carrinho->product->discount, 2, ',', '.') }}</p>
                                    <small class="text-[#7E7E7E] line-through">{{$carrinho->product->preco}}</small>
                                </div>
                                <p class="text-[#D9C549]">{{$carrinho->cor}}, {{$carrinho->numeracao}}</p>
                            </div>
                        @endif
                 

                        <div class="flex items-center">
                                                    <!-- Formulário para decrementar a quantidade -->
                            <form action="/events/carrinho/{{$carrinho->id}}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="decrement" >
                                <button type="submit" class="bg-[#D9C549] p-1 w-9 rounded-md">
                                    <i class="bi bi-caret-left-fill text-white"></i>
                                </button>
                            </form>

                            <!-- Exibir a quantidade atual -->
                            <small class="text-white p-2">{{ $carrinho->quantity }}</small>

                            <!-- Formulário para incrementar a quantidade -->
                            <form action="/events/carrinho/{{$carrinho->id}}" method="post">
                                @csrf
                                <input type="hidden" name="action" value="increment">
                                <input type="hidden" name="cor" value="{{$carrinho->cor}}">
                                <button type="submit" class="border p-1 rounded-md w-9" >
                                    <i class="bi bi-caret-right-fill text-white"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center">
                    <a href="/removeCart/{{$carrinho->id}}"><i class="bi bi-trash text-[#D9C549]"></i></a>
                </div>
            </div>
            
        @endforeach
      
        <!-- Valor total -->
        <div class="border border-[#676767] p-2 mt-36 rounded-md">
            <div class="flex justify-between m-2">
                <p class="text-[#7E7E7E]">Subtotal</p>
                <p class="text-[#7E7E7E]">R$ {{ number_format($subtotal, 2, ',', '.') }}</p>
            </div>
            <hr class="border-[#676767] my-2 m-2">

     

           @if($carrinho->product->discount > 0 || $desconto > 0)
                <div class="flex justify-between mx-2">
                    <p class="text-[#7E7E7E]">Descontos</p>
                    <p class="text-[#7E7E7E] flex justify-end">- R$ {{ number_format($totalDesconto, 2, ',', '.') }}</p>
                </div>
                @if($desconto > 0)
                    <div class="flex justify-end">
                        <small class="text-green-400">Você ganhou um desconto de 7% por adicionar 2 pares de tênis ao seu carrinho!</small>
                    </div>
                @endif
                <hr class="border-[#676767] my-2 m-2">
            @endif

            <div class="flex justify-between m-2">
                <p class="text-white font-semibold">Total</p>
                <p class="text-white font-semibold">R$ {{ number_format($total , 2, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Botão finalizar pedido -->
    <div class="m-3 mt-7">

        <form action="{{route('finalizarPedido')}}" method="post">
            @csrf
            @method('GET')

         
           <input type="hidden" name="cor" value="{{$carrinho->cor}}">
           <input type="hidden" name="numeracao" value="{{$carrinho->numeracao}}">
         
           <input type="hidden" name="subtotal" value="{{ $subtotal }}">
           <input type="hidden" name="desconto" value="{{ $totalDesconto }}"/>
           <input type="hidden" name="total" value="{{ $total }}">
           <input type="hidden" name="quantidade" value="{{$carrinho->quantity }}">
           <input type="hidden" name="id" value="{{$carrinho->product->id }}">

        <button class="p-2 rounded-md w-full bg-[#D9C549]" href="{{route('finalizarPedido')}}">Continuar</button>
        </form>
    
    </div>
    @endif
</main>

@endsection