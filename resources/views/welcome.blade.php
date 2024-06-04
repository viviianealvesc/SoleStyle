@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')


    <main class="pt-10">   
       <div class="flex items-center justify-between mr-2">
        <p class="uppercase text-white p-1 m-2 border-l-2 border-[#D9C549] font-semibold">Tênis para corrida</p>
        <a class="text-[#D9C549]" href="#">Ver todos ></a>
       </div>

        <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
        @if(isset($products))
        @foreach ($products as $product)
            <div class="p-4">
                <div class="bg-[#3F3F3F] p-2 rounded-lg w-40">
                    @foreach ($product->avatar as $imagem)
                      <a href="/produto/{{ $product->id }}"> <img src="/img/loja/{{ $imagem}}" alt=""></a>
                    @endforeach
                </div>
                <p class="text-white truncate w-[largura] mt-2 pl-1">{{ $product->nome }}</p>
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
        @endif
        </div>
      
       <!-- Banner -->
       <div class="p-3">
        <img  class="rounded-lg" src="{{ asset('img/banner.png')}}" alt="">
       </div>

       <!-- Mais produtos -->

      <div class="pt-10">
        <div class="flex items-center justify-between mr-2">
            <p class="uppercase font-semibold text-white p-1 m-2 border-l-2 border-[#D9C549]">Tênis feminino</p>
            <a class="text-[#D9C549]" href="#">Ver todos ></a>
        </div>
        <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img  src="{{ asset('img/image-removebg-preview.png')}}" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="{{ asset('img/image-removebg-preview.png')}}" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="{{ asset('img/image-removebg-preview.png')}}" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="{{ asset('img/image-removebg-preview.png')}}" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="{{ asset('img/image-removebg-preview.png')}}" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="{{ asset('img/image-removebg-preview.png')}}" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
        </div>
      </div>

      <div class="pt-10 pb-20">
        <p class="uppercase font-semibold text-white p-1 m-2 border-l-2 border-[#D9C549] ">Navegue por marcas</p>
        <div class="flex gap-4 overflow-x-scroll px-2 mt-5 [&::-webkit-scrollbar]:hidden">
            <img src="{{ asset('img/marcas/adidas.webp')}}" alt="">
            <img src="{{ asset('img/marcas/lacoste.webp')}}" alt="">
            <img src="{{ asset('img/marcas/mizuno.webp')}}" alt="">
            <img src="{{ asset('img/marcas/nike.webp')}}" alt="">
            <img src="{{ asset('img/marcas/oakley.webp')}}" alt="">
        </div>
      </div>

    </main>
@endsection