@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<div class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
    <!--
      Background backdrop, show/hide based on slide-over state.
  
      Entering: "ease-in-out duration-500"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in-out duration-500"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
  
    <div class="fixed inset-0 overflow-hidden">
      <div class="absolute inset-0 overflow-hidden">
        <div class="pointer-events-none fixed inset-y-0 right-0 flex w-[500px] pl-10">
          <!--
            Slide-over panel, show/hide based on slide-over state.
  
            Entering: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-full"
              To: "translate-x-0"
            Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-0"
              To: "translate-x-full"
          -->
          <div class="pointer-events-auto relative w-screen max-w-md">
            <!--
              Close button, show/hide based on slide-over state.
  
              Entering: "ease-in-out duration-500"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in-out duration-500"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4">
              <button type="button" class="relative rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                
                <a href="{{Route('voltar.product')}}">
                  <span class="absolute -inset-2.5"></span>
                <span class="sr-only">Close panel</span>
                  <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </a>
              </button>
            </div>
  
            <div class="flex h-full flex-col overflow-y-scroll bg-[#181818] py-6 shadow-xl">
              <div class="px-4 sm:px-6">
                <h2 class="text-base font-bold leading-6 text-white" id="slide-over-title">Menu</h2>
              </div>
              <div class="relative mt-6 px-4 sm:px-6">

                <!-------------------------------->
               <div class="flex text-center justify-between items-center">
                <div>
                  <h2 class="text-white font-semibold">Olá. Faça o seu login!</h2>
                </div>
                <div class="bg-[#3F3F3F] p-2 rounded-lg w-12">
                  <i class="bi bi-box-arrow-in-right  text-[#D9C549]"></i>
                </div>
               </div>
               <hr class=" mt-7 mb-7 bg-[#3F3F3F] bg-opacity-75">

                  <!-------------------------------->
                <div class="text-white flex flex-col">
                  <a class="p-1" href="#"><i class="bi bi-house pr-3 text-[#D9C549]"></i>Inicio</a>
                  <a class="p-1" href="#"><i class="bi bi-heart pr-3 text-[#D9C549]"></i>Favoritos</a>
                  <a class="p-1" href="#"><i class="bi bi-basket2-fill pr-3 text-[#D9C549]"></i>Carrinho</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


    <main class="pt-10">
        <small class="text-white p-1 m-2 border-l-2 border-[#D9C549] font-semibold">MAIS VENDIDOS</small>
       <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
        <div class="p-4">
            <div class="bg-[#3F3F3F] rounded-lg w-40">
                <a href="{{Route('produto.product')}}"> <img src="img/image-removebg-preview.png" alt=""></a>
              
            </div>
            <p class="text-white truncate w-[largura] mt-2 pl-1">Tênis feminino ultra</p>
            <div class="flex text-center gap-2">
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

