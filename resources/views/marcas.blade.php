@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<div class="flex">
    <a href="{{route('home')}}">
        <img class="mx-3 pt-2 w-[30px] rounded-full" src="{{asset('/img/desfazer.png')}}" alt="">
    </a>
</div>

<div class="flex items-center flex-wrap gap-1 mt-4 px-1">
    @foreach ($products as $product)
    <div class="p-2">
        <div class="relative">
            <a href="/produto/{{ $product->id }}" class="relative block max-sm:w-32">
                <img class="rounded-md max-sm:w-32 w-40" src="/img/loja/{{ $product->imagem }}" alt="">
                
                @php
                    $esgotado = false;
                    foreach ($product->cores as $cor) {
                        if ($cor['estoque'] <= 0) {
                            $esgotado = true;
                            break;
                        }
                    }
                @endphp

                 @if ($esgotado)
                    <div class="absolute top-0 right-0 bg-red-600 text-white max-sm:text-[0.80rem] p-1 rounded-md">Esgotado</div>
                @elseif ($product->discount > 0)
                    <img class="absolute top-0 right-0 w-12 p-1 rounded-md" src="{{ asset('/img/oferta-unscreen.gif') }}" alt="Promoção">
                @endif
            </a>
        </div>
      <p class="text-white truncate w-[160px]  pl-1 max-sm:text-[0.80rem]">{{ $product->nome }}</p>
        <div class="flex text-center gap-2">
            @if($product->discount == 0.00)
                <p class="text-[#D9C549] font-semibold pl-1">{{  number_format($product->preco, 2, ',', '.') }}</p>
            @else
                <p class="text-[#D9C549] font-semibold pl-1">{{ number_format($product->preco - $product->discount, 2, ',', '.') }}</p>
                <small class="text-[#7E7E7E] line-through">{{  number_format($product->preco, 2, ',', '.') }}</small>
            @endif
        </div>
    </div>
  @endforeach
  
  </div>
    


@endsection