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
        <div class="pointer-events-none fixed inset-y-0 right-0 flex w-[400px] pl-10">
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
           
  
            <div class="flex h-full flex-col overflow-y-scroll bg-[#181818] py-6 shadow-xl">
              <div class=" flex justify-between px-4 sm:px-6">
                <h2 class="text-base font-bold leading-6 text-white" id="slide-over-title">Menu</h2>
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
              
              <div class="relative mt-6 px-4 sm:px-6">

                <!-------------------------------->
             @if($user)
                <div class="flex items-center gap-3">
                    <img class="w-10 rounded-full" src="img/perfil.jpg" alt="">
                    <div>
                        <h1 class="text-white pb-0">{{ $nomeUser }}</h1>
                        <small class="text-[#828282]">{{ $emailUser }}</small>
                    </div>
                </div>
            @else
                <div class="flex text-center justify-between items-center">
                    <div>
                        <h2 class="text-white font-semibold">Olá. Faça o seu login!</h2>
                    </div>
                    <div class="bg-[#3F3F3F] p-2 rounded-lg w-12">
                        <a href="{{ route('register') }}"><i class="bi bi-box-arrow-in-right text-[#D9C549]"></i></a>
                    </div>
                </div>
            @endif
            
               
               <hr class=" mt-7 mb-7 bg-[#3F3F3F] bg-opacity-75">

                  <!-------------------------------->
                <div class="text-white flex flex-col">
                  <a class="p-1" href="#"><i class="bi bi-house pr-3 text-[#D9C549]"></i>Inicio</a>
                  <a class="p-1" href="{{Route('pageFavorito')}}"><i class="bi bi-heart pr-3 text-[#D9C549]"></i>Favoritos</a>
                  <a class="p-1" href="{{Route('pageCarrinho')}}"><i class="bi bi-basket2-fill pr-3 text-[#D9C549]"></i>Carrinho</a>

                  <hr class=" mt-7 mb-7 bg-[#3F3F3F] bg-opacity-75">

                  <!------ Configurações ------->
                  <a class="p-1" href="{{ route('profile') }}"><i class="bi bi-gear pr-3 text-[#D9C549]"></i>Configurações</a>

                  <hr class=" mt-7 mb-7 bg-[#3F3F3F] bg-opacity-75">

                      <!------ Sair da conta ------->
                 <div class="grid grid-rows-[1fr_auto] h-[30vh]">
                  <div class="mt-auto text-white p-2">

                    @auth

                    <button id="deactivateButton"  class="p-1"><i class="bi bi-box-arrow-left pr-3 text-[#D9C549]"></i>Sair da conta</button>
                    <div id="modalContainer"></div>

                    @endauth
                  </div>
                 </div>
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


    <!-- Mensagem de aviso ao sair da conta -->
    
    <script>
        document.getElementById("deactivateButton").addEventListener("click", function() {
            // HTML do modal
            var modalHtml = `
            <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">

        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Sair da conta</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Deseja mesmo sair da plataforma?</p>
                    </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">

                    <a id="deactivateButton" href="{{ route('logout') }}" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                        @csrf
                    </form>

                <a href="{{Route('menuLateral')}}" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</a>
                </div>
            </div>
            </div>
        </div>
        </div>
            `;
            
            // Inserir o HTML do modal dentro do elemento modalContainer
            document.getElementById("modalContainer").innerHTML = modalHtml;
        });
    </script>
    



    
@endsection

