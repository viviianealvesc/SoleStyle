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
                <div class="p-2  w-48">
                      <a  href="/produto/{{ $product->id }}"> <img class="rounded-lg" src="/img/loja/{{ $product->imagem }}" alt=""></a>
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
        @endif
        </div>
      
       <!-- Banner -->
     @if(isset($banners))
        <div class="p-3 flex gap-1 overflow-x-scroll px-3  [&::-webkit-scrollbar]:hidden">
            @foreach ($banners as $banner)  
                <img  class="rounded-lg mr-2" src="img/loja/{{$banner->banner}}" alt="{{$banner->nome}}">
            @endforeach
        </div>
    @endif

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

      <div class="pt-5 pb-20">
        <p class="uppercase font-semibold text-white p-1 m-2 border-l-2 border-[#D9C549] ">Navegue por marcas</p>
        <div class="flex gap-4 overflow-x-scroll px-2 mt-4 ml-4 [&::-webkit-scrollbar]:hidden">
            <a href="{{route('marca', ['nome' => 'adidas'])}}"><img src="{{ asset('img/marcas/adidas.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'lacoste'])}}"><img src="{{ asset('img/marcas/lacoste.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'mizuno'])}}"><img src="{{ asset('img/marcas/mizuno.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'nike'])}}"><img src="{{ asset('img/marcas/nike.webp')}}" alt=""></a>
            <a href="{{route('marca', ['nome' => 'oakley'])}}"><img src="{{ asset('img/marcas/oakley.webp')}}" alt=""></a>
        </div>
      </div>

    </main>
@endsection