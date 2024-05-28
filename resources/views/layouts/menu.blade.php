<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-[#181818]">
    <header class="shadow-lg bg-[#D9C549]">
        <nav class="flex justify-between pt-4 p-4">
            <div>
               <a href="{{Route('/')}}"><img width="80" src="{{ asset('img/logo.png') }}" alt=""></a> 
            </div>
            <div class="pt-6">
                <button id="deactivateButton"><img src="{{ asset('img/menu-hamburguer.png') }}" alt="menu-lateral"></button>
            </div>
        </nav>
        <div class="flex items-center justify-center pb-3">
            <input class="rounded-lg p-2 bg-[#3F3F3F]" type="text" placeholder="O que você procura?">
            <img class="bg-[#3F3F3F] rounded-md ml-2 p-1" width="40" src="{{ asset('img/lupa (1).png') }}" alt="">
        </div>
    </header>

    <!-- Header section end -->
    @yield('content')

    <div id="modalContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> 
</body>

<script>
    document.getElementById("deactivateButton").addEventListener("click", function() {
        // HTML do modal
        var modalHtml = `
        <div  id="alert-box" class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
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
                <button type="button" class="btn-close" aria-label="Close" onclick="closeAlert()">x</button>
              </div>
              
              <div class="relative mt-6 px-4 sm:px-6">

                <!-------------------------------->
                @if(auth()->check())
                  @php
                      $user = auth()->user();
                      $nomeUser = $user->name;
                      $emailUser = $user->email;
                  @endphp
                  <div class="flex items-center gap-3">
                      <img class="w-10 rounded-full" src="{{ asset('img/perfil.jpg') }}" alt="">
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
                  <a class="p-1" href="{{Route('/')}}"><i class="bi bi-house pr-3 text-[#D9C549]"></i>Inicio</a>

                  @if(auth()->check())
                  @php
                      $user = auth()->user();
                      $nomeUser = $user->name;
                      $emailUser = $user->email;
                  @endphp
                  <a class="p-1" href="{{ Route('favorites.pageFavorito') }}"><i class="bi bi-heart pr-3 text-[#D9C549]"></i>Favoritos</a>
                  <a class="p-1" href="{{ Route('cart.pageCarrinho') }}"><i class="bi bi-basket2-fill pr-3 text-[#D9C549]"></i>Carrinho</a>

                  <hr class=" mt-7 mb-7 bg-[#3F3F3F] bg-opacity-75">
                
                  <!------ Configurações ------->
                  <a class="p-1" href="{{ route('profile') }}"><i class="bi bi-gear pr-3 text-[#D9C549]"></i>Configurações</a>

                  @endif

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
</div>
        `;
        
        // Inserir o HTML do modal dentro do elemento modalContainer
        document.getElementById("modalContainer").innerHTML = modalHtml;
    });
</script>

<script>
function closeAlert() {
    var alertBox = document.getElementById('alert-box');
    alertBox.style.display = 'none';
}
</script>

</html>