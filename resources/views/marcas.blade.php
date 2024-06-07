@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<h1 class="text-white font-semibold uppercase m-3 mt-5 text-3xl  border-l-2 border-[#D9C549] pl-2">{{$uri}}</h1>

@foreach ($products as $product)
<div class="p-4">
    <div class="p-2 rounded-lg w-40">
          <a href="/produto/{{ $product->id }}"> <img src="/img/loja/{{ $product->imagem }}" alt=""></a>
    </div>
    <p class="text-white truncate w-[220px] mt-2 pl-1">{{ $product->nome }}</p>
    <div class="flex text-center gap-2">
        @if($product->discount == 0.00)
            <p class="text-[#D9C549] font-semibold pl-1">{{ $product->preco }}</p>
        @else
            <p class="text-[#D9C549] font-semibold pl-1">{{$product->preco - $product->discount}}</p>
            <small class="text-[#7E7E7E] line-through">{{ $product->preco }}</small>
        @endif
    </div>
</div>
    
@endforeach


@endsection