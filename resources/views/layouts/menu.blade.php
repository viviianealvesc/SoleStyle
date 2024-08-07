<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link class="rounded-full" rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://js.stripe.com/v3/"></script>

    <script src="https://cdn.tailwindcss.com"></script>


</head>

<body class="bg-[#181818]">
    <header class="shadow-lg bg-[#D9C549]">
        <nav class="flex justify-between pt-4 p-4">
            <div>
               <a href="{{Route('home')}}"><img class="w-[80px] max-sm:w-[70px]" src="{{ asset('img/logo.png') }}" alt=""></a> 
            </div>
            <div class="pt-6">
                <button id="deactivateButton"><img class="max-sm:w-[30px]" src="{{ asset('img/menu-hamburguer.png') }}" alt="menu-lateral"></button>
            </div>
        </nav>
        <form action="{{ route('home') }}" method="GET">
        <div class="flex items-center justify-center pb-3">
          <input class="rounded-lg p-2 bg-[#3F3F3F] text-[0.90rem] w-52 max-sm:text-[0.70rem] outline-none md:w-96 focus:outline-amber-300 text-white" type="text" id="search" name="search" placeholder="O que você procura?">
          <button type="submit"><img class="bg-[#3F3F3F] rounded-md ml-2 p-1 w-[40px] max-sm:w-[35px]" src="{{ asset('img/lupa (1).png') }}" alt=""></button>
        </div>
      </form>
    </header>

    <!-- Header section end -->
    @yield('content')

    <div id="modalContainer"></div>
    <div id="container"></div>
    
    
    <footer class="bg-[#d9c649d1] text-white py-8 mt-36">
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- Informações de Contato -->
          <div>
              <h4 class="font-bold mb-2">Contato</h4>
              <p>Rua Exemplo, 123</p>
              <p>Cidade, Estado, CEP</p>
              <p>Telefone: (XX) XXXX-XXXX</p>
              <p>Email: suporte@exemplo.com</p>
          </div>
          
          <!-- Links Importantes -->
          <div>
              <h4 class="font-bold mb-2">Informações</h4>
              <ul>
                  <li><a href="#" class="hover:underline">Sobre Nós</a></li>
                  <li><a href="#" class="hover:underline">Contato</a></li>
                  <li><a href="#" class="hover:underline">FAQ</a></li>
                  <li><a href="#" class="hover:underline">Política de Privacidade</a></li>
                  <li><a href="#" class="hover:underline">Termos e Condições</a></li>
                  <li><a href="#" class="hover:underline">Política de Troca e Devolução</a></li>
              </ul>
          </div>
          
          <!-- Categorias de Produtos -->
          <div>
              <h4 class="font-bold mb-2">Categorias</h4>
              <ul>
                  <li><a href="#" class="hover:underline">Tênis Masculinos</a></li>
                  <li><a href="#" class="hover:underline">Tênis Femininos</a></li>
                  <li><a href="#" class="hover:underline">Tênis para Crianças</a></li>
                  <li><a href="#" class="hover:underline">Novidades</a></li>
                  <li><a href="#" class="hover:underline">Promoções</a></li>
              </ul>
          </div>
          
          <!-- Redes Sociais e Newsletter -->
          <div>
              <h4 class="font-bold mb-2">Siga-nos</h4>
              <div class="flex gap-2">
                  <a href="#" class="hover:underline">Facebook</a>
                  <a href="#" class="hover:underline">Instagram</a>
                  <a href="#" class="hover:underline">Twitter</a>
              </div>
              <h4 class="font-bold mt-4 mb-2">Newsletter</h4>
              <form>
                  <input type="email" placeholder="Seu email" class="bg-[#3F3F3F] text-white p-2 w-full mb-2">
                  <button class="bg-yellow-500 p-2 w-full">Inscrever-se</button>
              </form>
          </div>
      </div>
      <div class="container mx-auto mt-8 text-center">
          <p>© 2024 SoleStyle. Todos os direitos reservados.</p>
        </div>
      </footer>
      <div class="bg-[#3F3F3F] text-white p-2 text-center">
        <p>Desenvolvido por <a class="text-blue-600" href="https://www.instagram.com/mv__informatica/" target="_blank" rel="noopener noreferrer">  MV Informática</a></p>
      </div>
  

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
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-md:w-[270px] max-md:pl-[30px] w-[400px] ">
          
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
           
 
            <div class="flex h-full flex-col overflow-y-scroll bg-[#181818] py-6 shadow-xl  [&::-webkit-scrollbar]:hidden">
              <div class=" flex justify-between px-4 sm:px-6">
                <h2 class="text-base font-bold leading-6 text-white" id="slide-over-title">Menu</h2>
                <button type="button" class="btn-close bg-white" aria-label="Close" onclick="closeAlert()"></button>
              </div>
              
              <div class="relative mt-6 px-4 sm:px-6">

                <!-------------------------------->
                @if(auth()->check())
                  @php
                      $user = auth()->user();
                      $nomeUser = $user->name;
                      $emailUser = $user->email;
                      $avatar = $user->avatar;
                  @endphp
                  <div class="flex items-center gap-3">

                    @if(empty($avatar))
                     <p class="flex items-center justify-center w-16 h-16 rounded-full bg-[#828282] text-white">{{ substr($nomeUser, 0, 1) }}</p>
                    @else
                      <img class="w-10 rounded-full" src="{{ $avatar }}" alt="">
                    @endif
                    
                      <div class="flex flex-col">
                          <a href="{{ route('profile') }}" class="text-white pb-0">{{ $nomeUser }}</a>
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
                  <a class="p-1" href="{{Route('home')}}"><i class="bi bi-house pr-3 text-[#D9C549]"></i>Inicio</a>

                 
                  <a class="p-1" href="{{ Route('favorites.pageFavorito') }}"><i class="bi bi-heart pr-3 text-[#D9C549]"></i>Favoritos</a>
                  <a class="p-1" href="{{ Route('cart.pageCarrinho') }}"><i class="bi bi-basket2-fill pr-3 text-[#D9C549]"></i>Carrinho</a>
                  <a class="p-1" href="{{ Route('portal') }}"><i class="bi bi-bag-fill pr-3 text-[#D9C549]"></i>Dados da compra</a>
                  

                  <hr class=" mt-7 mb-7 bg-[#3F3F3F] bg-opacity-75">

                  <a class="p-1" href="{{ Route('portal') }}"><i class="bi bi-whatsapp pr-3 text-[#D9C549]"></i>Falar com o vendedor</a>

                      <!------ Sair da conta ------->
                 <div class="grid grid-rows-[1fr_auto] h-[30vh]">
                  <div class="mt-auto text-white p-2">

                    @auth

                    <a href="{{route('logout')}}" id="deactivate" class="p-1"><i class="bi bi-box-arrow-left pr-3 text-[#D9C549]"></i>Sair da conta</a>
                    
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


    document.getElementById("deactivate").addEventListener("click", function() {
      // HTML do modal
      var modalHtml = `
      <div class="relative z-10 " aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <!--
    Background backdrop, show/hide based on modal state.

    Entering: "ease-out duration-300"
      From: "opacity-0"
      To: "opacity-100"
    Leaving: "ease-in duration-200"
      From: "opacity-100"
      To: "opacity-0"
  -->
  <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <!--
        Modal panel, show/hide based on modal state.

        Entering: "ease-out duration-300"
          From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          To: "opacity-100 translate-y-0 sm:scale-100"
        Leaving: "ease-in duration-200"
          From: "opacity-100 translate-y-0 sm:scale-100"
          To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      -->
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
          <button type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Sair</button>
          <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</div>
      `;
      
      // Inserir o HTML do modal dentro do elemento modalContainer
      document.getElementById("container").innerHTML = modalHtml;
  });

</script>



<script>
function closeAlert() {
    var alertBox = document.getElementById('alert-box');
    alertBox.style.display = 'none';
}
</script>

<script src="https://js.stripe.com/v3/"></script>


</html>