@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')


    <main class="pt-10">
        <small class="text-white p-1 m-2 border-l-2 border-[#D9C549] font-semibold">MAIS VENDIDOS</small>

        <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
        @foreach ($products as $product)
            <div class="p-4">
                <div class="bg-[#3F3F3F] rounded-lg w-40">
                    <a href="/produto/{{ $product->id }}"> <img src="{{ asset('/img/image-removebg-preview.png')}}" alt=""></a>
                </div>
                <p class="text-white truncate w-[largura] mt-2 pl-1">{{ $product->nome }}</p>
                <div class="flex text-center gap-2">
                    <p class="text-[#D9C549] font-semibold pl-1">{{ $product->preco }}</p>
                     <small class="text-[#7E7E7E] line-through">74,90</small>
                </div>
            </div>
        @endforeach
        </div>
      
       <!-- Banner -->
       <div class="p-3">
        <img  class="rounded-lg" src="img/banner.png" alt="">
       </div>

       <!-- Mais produtos -->

      <div class="pt-10">
        <small class="text-white p-1 m-2 border-l-2 border-[#D9C549]">MAIS VENDIDOS</small>
        <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img  src="img/image-removebg-preview.png" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="img/image-removebg-preview.png" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="img/image-removebg-preview.png" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="img/image-removebg-preview.png" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="img/image-removebg-preview.png" alt="">
             </div>
             <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
             <div class="flex text-center gap-2 text">
                 <p class="text-[#D9C549] font-semibold pl-1">R$ 60,90</p>
                 <small class="text-[#7E7E7E] line-through">74,90</small>
             </div>
         </div>
 
         <div class="p-4">
             <div class="bg-[#3F3F3F] rounded-lg w-40">
                 <img src="img/image-removebg-preview.png" alt="">
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
        <small class="text-white p-1 m-2 border-l-2 border-[#D9C549] ">NAVEGUE POR MARCAS</small>
        <div class="flex gap-4 overflow-x-scroll px-2 mt-5 [&::-webkit-scrollbar]:hidden">
            <img src="img/marcas/adidas.webp" alt="">
            <img src="img/marcas/lacoste.webp" alt="">
            <img src="img/marcas/mizuno.webp" alt="">
            <img src="img/marcas/nike.webp" alt="">
            <img src="img/marcas/oakley.webp" alt="">
        </div>
      </div>

    </main>
@endsection