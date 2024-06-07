@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class="m-3">
        @if(!isset($carrinhos) || $carrinhos->isEmpty())
        <div class="flex items-center justify-center mt-9">
           <div>
              <h1 class="text-center opacity-40 text-white font-semibold">Não há produtos favoritados!</h1>
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
            <div class="border border-[#676767] rounded-lg p-2">
                <div class="flex">
                    <img class="w-28 p-2 rounded-lg" src="/img/loja/{{$carrinho->imagem}}" alt="{{$carrinho->nome}}">
                    <div class="ml-3">
                        <p class="text-white truncate w-[largura] mt-2">{{$carrinho->nome}}</p>

                        @if($carrinho->discount == 0.00)
                            <div class="flex m-1 mb-2 items-center">
                                <p class="text-[#D9C549] font-semibold mr-1">{{$carrinho->preco}}</p>
                            </div>
                        @else
                            <div class="flex m-1 mb-2 items-center">
                                <p class="text-[#D9C549] font-semibold mr-1">{{$carrinho->preco - $carrinho->discount}}</p>
                                <small class="text-[#7E7E7E] line-through">{{$carrinho->preco}}</small>
                            </div>
                        @endif
                        <div class="flex items-center">
                            <form action="/events/carrinho/atualizar" method="post">
                                @csrf
                                <button type="submit" name="action" value="decrement" class="bg-[#D9C549] p-1 w-9 rounded-md">
                                    <i class="bi bi-caret-left-fill text-white"></i>
                                </button>
                                <small class="text-white p-2">{{ session('quantidade', 0) }}</small>
                                <button type="submit" name="action" value="increment" class="border p-1 rounded-md w-9">
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

            @if ($totalDesconto > 0)
            <div class="flex justify-between m-2">
                <p class="text-[#7E7E7E]">Descontos</p>
                <p class="text-[#7E7E7E] flex justify-end">- R$ {{ number_format($totalDesconto, 2, ',', '.') }}</p>
            </div>
            <hr class="border-[#676767] my-2 m-2">
            @endif

            <div class="flex justify-between m-2">
                <p class="text-white font-semibold">Total</p>
                <p class="text-white font-semibold">R$ {{ session('quantidade', 0) * $total }}</p>
                
            </div>
        </div>
    </div>

    <!-- Botão finalizar pedido -->
    <div class="m-3 mt-7">
      <a href="{{route('finalizarPedido')}}" class="p-2 rounded-md w-full bg-[#D9C549]">Finalizar pedido</a>
    </div>
    @endif
</main>

@endsection