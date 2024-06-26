@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')


    <main class="pt-10">  
        @foreach ($categories as $index => $category) 
        <div class="flex items-center justify-between mr-2">
            <p class="uppercase text-white p-1 m-2 border-l-2 border-[#D9C549] font-semibold text-[0.90rem]">{{ $category->name }}</p>
            <a class="text-[#D9C549] text-[0.90rem]" href="#">Ver todos ></a>
        </div>
        

        <div class="flex gap-1 mb-5 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
            @foreach ($category->produtos as $product)
            <div class="p-2">
                <div class="p-2 rounded-lg w-40">
                    <a href="/produto/{{ $product->id }}"> <img class="rounded-md" src="/img/loja/{{ $product->imagem }}" alt=""></a>
              </div>
                <p class="text-white truncate w-[220px] mt-2 pl-1">{{ $product->nome }}</p>
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
      
       <!-- Banner -->
       @if (($index + 1) % 2 == 0 && isset($banners[($index + 1) / 2 - 1]))
        <div class="p-3 flex gap-1 overflow-x-scroll px-3  [&::-webkit-scrollbar]:hidden"> 
            <img class="rounded-lg mr-2" src="img/loja/{{ $banners[($index + 1) / 2 - 1]->banner }}" alt="{{ $banners[($index + 1) / 2 - 1]->nome }}">
        </div>
        @endif
    @endforeach

     

      <div class="pt-5 pb-20">
        <p class="uppercase font-semibold text-white p-1 m-2 text-sm border-l-2 border-[#D9C549] ">Navegue por marcas</p>
        <div class="flex gap-3 overflow-x-scroll px-2 mt-4 ml-4 [&::-webkit-scrollbar]:hidden">
            <a href="{{route('marca', ['nome' => 'adidas'])}}"><img src="{{ asset('img/marcas/adidas.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'lacoste'])}}"><img src="{{ asset('img/marcas/lacoste.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'mizuno'])}}"><img src="{{ asset('img/marcas/mizuno.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'nike'])}}"><img src="{{ asset('img/marcas/nike.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'oakley'])}}"><img src="{{ asset('img/marcas/oakley.webp')}}" alt=""></a>
        </div>
      </div>

    </main>
@endsection






