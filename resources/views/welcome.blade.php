@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<style>
    .text-sm {
        font-size: 0.6rem;
    }
</style>

@if(isset($search) && count($products) > 0)

<div class="flex items-center flex-wrap gap-1  px-1">
  @foreach ($products as $product)
  <div class="p-2">
      <div class="p-2 rounded-lg w-40">
          <a href="/produto/{{ $product->id }}"> <img class="rounded-md max-sm:w-32 w-40" src="/img/loja/{{ $product->imagem }}" alt=""></a>
    </div>
      <p class="text-white truncate w-[200px] mt-2 pl-1">{{ $product->nome }}</p>
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

@elseif(!isset($search))

<div id="carouselExampleInterval" class="carousel slide m-2" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($banners as $banner)
        <div class="carousel-item active" data-bs-interval="10000">
          <img class="rounded-lg lg:h-80 w-full object-cover" src="img/loja/{{$banner->banner}}" alt="...">
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

    <main class="pt-7 md:m-20"> 
        @foreach ($categories as $index => $category) 
        <div class="flex items-center justify-between mr-2">
            <p class="uppercase text-white p-1 m-2 border-l-2 border-[#D9C549] font-semibold text-[0.90rem] max-sm:text-[0.70rem]">{{ $category->name }}</p>
            <a class="text-[#D9C549] text-[0.90rem] max-sm:text-[0.70rem]" href="{{route('categoria', ['categoria' => $category->name])}}">Ver todos ></a>
        </div>
        @php
            
        @endphp
        

        <div class="flex gap-1 mb-5 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
            @foreach ($category->produtos as $index => $product)
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
                            <div class="absolute top-0 right-0 bg-red-600 text-white text-sm p-1 rounded-md">Esgotado</div>
                        @elseif ($product->discount > 0)
                            <img class="absolute top-0 right-0 w-12 p-1 rounded-md" src="{{ asset('/img/oferta-unscreen.gif') }}" alt="Promoção">
                        @endif
                    </a>
                </div>
                
                <p class="text-white truncate w-[160px] mt-2 pl-1 max-sm:text-[0.80rem]">{{ $product->nome }}</p>
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
    @endforeach

     

    <div class="pb-20">
        <p class="uppercase text-white p-1 m-2 mb-4 border-l-2 border-[#D9C549] font-semibold text-[0.90rem] max-sm:text-[0.70rem]">Navegue por marcas</p>
        <div class="relative  w-full overflow-x-scroll [&::-webkit-scrollbar]:hidden ml-3">
            <div id="carousel" class="flex  gap-3">
                <a href="{{route('marca', ['nome' => 'adidas'])}}" class="flex-none "><img class="max-sm:w-32" src="{{ asset('img/marcas/adidas.webp')}}" alt="" class="w-40"></a>
                <a href="{{route('marca', ['nome' => 'lacoste'])}}" class="flex-none"><img class="max-sm:w-32" src="{{ asset('img/marcas/lacoste.webp')}}" alt="" class="w-40"></a>
                <a href="{{route('marca', ['nome' => 'mizuno'])}}" class="flex-none"><img  class="max-sm:w-32" src="{{ asset('img/marcas/mizuno.webp')}}" alt="" class="w-40"></a>
                <a href="{{route('marca', ['nome' => 'nike'])}}" class="flex-none"><img    class="max-sm:w-32" src="{{ asset('img/marcas/nike.webp')}}" alt="" class="w-40"></a>
                <a href="{{route('marca', ['nome' => 'oakley'])}}" class="flex-none"><img  class="max-sm:w-32" src="{{ asset('img/marcas/oakley.webp')}}" alt="" class="w-40"></a>
            </div>
           
        </div>
    </div>

   
    </div>
    </main>

@else
<div class="flex items-center justify-center mt-9">
    <div>
       <h1 class="text-center opacity-40 text-white font-semibold">Produto <span class="text-[#D9C549]">{{$search}}</span> não encontrado. <a href="/">Voltar ➡</a></h1>
       <img class="opacity-40" src="{{asset('/img/carrinho-vazio.png')}}" alt="">
    </div>
 </div>

@endif
@endsection


