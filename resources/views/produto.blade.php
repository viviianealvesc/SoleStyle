@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

    <main>
       <div class="pt-6 ml-6 flex items-center justify-between lg:w-1/2 ">
        <a href="{{Route('home')}}"><img width="30" src="{{ asset('img/desfazer.png')}}" alt="Voltar"></a>

        @if(session('msg'))
            <div class="alert border border-success alert-warning alert-dismissible fade show bg-[#3F3F3F] w-72 h-14 mr-5" role="alert">
                <p class="text-white">{{ session('msg') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
       </div>
 
       <div class="container mx-auto px-3 lg:px-0">
        <div class="flex flex-col lg:flex-row pt-10">
            <!-- Carrossel de Imagens -->
            <div id="carouselExampleIndicators" class="carousel slide w-full lg:w-1/2" data-bs-ride="carousel">
                <!-- Indicadores -->
                <div class="carousel-indicators">
                    @if(isset($selectedColor) && isset($selectedColor['avatar']))
                        @foreach ($selectedColor['avatar'] as $index => $imagem)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    @else
                        @foreach ($product->cores[0]['avatar'] as $index => $avatar)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    @endif
                </div>
                <!-- Itens do Carrossel -->
                <div class="carousel-inner">
                    @if(isset($selectedColor) && isset($selectedColor['avatar']))
                        @foreach ($selectedColor['avatar'] as $index => $imagem)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="/img/loja/{{ $imagem }}" class="d-block w-100" alt="Imagem do produto">
                            </div>
                        @endforeach
                    @else
                        @foreach ($product->cores[0]['avatar'] as $index => $avatar)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="/img/loja/{{ $avatar }}" class="d-block w-100" alt="Imagem do produto">
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- Controles do Carrossel -->
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
    
            <!-- Informações do Produto -->
            <div class="flex flex-col lg:ml-10 lg:w-1/2">
                <p class="text-white pl-2 mt-3 text-sm lg:text-3xl">{{ $product->nome }}</p>
                <div class="flex pl-2 gap-2">
                    <p class="text-[#D9C549] font-semibold text-xl lg:text-2xl">{{ $product->preco }}</p>
                    <small class="text-[#7E7E7E] line-through">{{ $product->preco_antigo }}</small>
                </div>
    
                <!-- Cores -->
                <h2 class="text-[#D9C549] font-semibold pt-9">Cores</h2>
                <div class="flex flex-wrap" id="color-selector">
                    @foreach ($product->cores as $index => $cor)
                        <form action="/produto/{{ $product->id . '/' . $index }}" method="GET" class="inline">
                            <input type="hidden" name="cor" value="{{ $cor['color'] }}">
                            <button type="submit" class="w-12 h-12 rounded-full overflow-hidden m-1 p-0 border-none bg-none color-option">
                                <img class="w-12 h-12 object-cover" src="/img/loja/{{ $cor['avatar'][0] }}" data-index="{{ $index }}" alt="Cor {{ $cor['color'] }}">
                            </button>
                        </form>
                    @endforeach
                </div>
    
                <!-- Numeração -->
                <div class="mt-6">
                    <p class="text-[#D9C549] font-semibold">Numeração</p>
                    <div class="flex flex-wrap items-center pt-3" id="num-selector">
                        @if($selectedColor)
                            @foreach ($selectedColor['numeracao'] as $numero)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="numeracao" value="{{ $numero }}" class="hidden peer numeracao-option">
                                    <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                                        <p class="p-2 font-bold text-white">{{ $numero }}</p>
                                    </span>
                                </label>
                            @endforeach
                        @else
                            @foreach ($product->cores[0]['numeracao'] as $numero)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" name="numeracao" value="{{ $numero }}" class="hidden peer numeracao-option">
                                    <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                                        <p class="p-2 font-bold text-white">{{ $numero }}</p>
                                    </span>
                                </label>
                            @endforeach
                        @endif
                    </div>
                </div>
    
                <!-- Botões Adicionar ao Carrinho e Favoritos -->
                <div class="flex items-center mt-6">
                    <div class="flex items-center">
                        @if(!$carrinho)
                            <form id="add-to-cart-form" action="/carrinho/{{ $product->id }}" method="POST" onsubmit="return validarFormulario()">
                                @csrf
                                <input type="hidden" name="cor" id="fav-selected-cor" value="{{ isset($corSelec) ? $corSelec : '' }}">
                                <input type="hidden" name="numeracao" id="selectedNumeracaoInput" value="">
                                <button type="submit" class="bg-[#D9C549] font-bold p-3 text-sm rounded-md">Adicionar ao carrinho</button>
                            </form>
                        @else
                            <button type="submit" class="bg-[#D9C549] font-bold p-3 rounded-md">Produto adicionado</button>
                        @endif
                        @if(!$favorito)
                            <form action="/favoritos/{{ $product->id }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-md">
                                    <img width="30" class="m-3" src="{{ asset('img/coracao.png') }}" alt="">
                                </button>
                            </form>
                        @else
                            <form action="/remove-coracao/{{$product->id}}" method="GET">
                                <a class="rounded-md" href="/remove-coracao/{{$product->id}}" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <img width="30" class="m-3" src="{{ asset('img/coracao2.png')}}" alt="">
                                </a>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    

 
         <!--Descrição do produto -->
         <div class="text-justify mt-5 mx-2">
             <h1 class="text-white font-bold">Descrição</h1>
             <p class="text-[#878686] mt-3">{{$product->descricao}}</p>
         </div>

 
         <!--Produtos -->
         <div class="pt-7 pb-10">
            <p class="uppercase text-white p-1 m-2 border-l-2 border-[#D9C549] font-semibold text-[0.90rem]">Você também pode gostar</p>
            @if(isset($todosProd))
            @foreach ($todosProd as $product)
            <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
             <div class="p-4">
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
            @endif
    


          <!-- Alerta personalizado -->
    <div id="custom-alert" class="hidden flex fixed top-0 left-0 w-full h-full items-center justify-center bg-black bg-opacity-50" aria-modal="true">
        <div class="bg-[#3F3F3F] bg-opacity-40 p-6 rounded-lg shadow-lg">
            <p id="alert-message" class="text-white"></p>
        </div>
    </div>
    
     </main>


     <script>
        document.addEventListener('DOMContentLoaded', function () {
            const colorOptions = document.querySelectorAll('.color-option');
            const numeracaoContainer = document.getElementById('numeracao-container');
            const cores = @json($product->cores); // Converte o array PHP para um objeto JS
    
            colorOptions.forEach(option => {
                option.addEventListener('click', function () {
                    const index = this.getAttribute('data-index');
                    const numeracoes = cores[index].numeracao;
                    
                    // Limpa o container de numerações antes de adicionar as novas
                    numeracaoContainer.innerHTML = '';
    
                    // Adiciona as novas numerações ao container
                    numeracoes.forEach(numero => {
                        const label = document.createElement('label');
                        label.classList.add('flex', 'items-center', 'space-x-2', 'cursor-pointer');
                        
                        const input = document.createElement('input');
                        input.type = 'checkbox';
                        input.classList.add('hidden', 'peer');
    
                        const span = document.createElement('span');
                        span.classList.add('w-9', 'h-8', 'bg-[#3F3F3F]', 'rounded-md', 'peer-checked:bg-blue-500', 'peer-checked:border-blue-500', 'peer-checked:text-white', 'flex', 'items-center', 'justify-center');
                        span.innerHTML = `<p class="p-2 font-bold text-white">${numero}</p>
                            <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
    
                        label.appendChild(input);
                        label.appendChild(span);
                        numeracaoContainer.appendChild(label);
                    });
                });
            });
        });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        let colorForms = document.querySelectorAll('.color-form');
        let selectedColorInput = document.getElementById('fav-selected-cor');
        let selectedNumeracaoInput = document.getElementById('fav-selected-numeracao');

        colorForms.forEach(function (form) {
            let colorInput = form.querySelector('.color-input');
            let colorOptionButton = form.querySelector('.numeracao-option');

            colorOptionButton.addEventListener('click', function () {
                let selectedIndex = colorOptionButton.dataset.index;
                selectedColorInput.value = colorInput.value;
            });
        });

    });


    document.addEventListener('DOMContentLoaded', function () {
            const selectedNumeracaoInput = document.getElementById('selectedNumeracaoInput');
            const favSelectedNumeracaoInput = document.getElementById('fav-selected-numeracao');

            document.querySelectorAll('.numeracao-option').forEach(function (element) {
                element.addEventListener('click', function () {
                    selectedNumeracaoInput.value = element.value;
                    favSelectedNumeracaoInput.value = element.value;
                    console.log('Numeração selecionada:', element.value); // Para depuração
                });
            });
        });
</script>


<script>
     function validarFormulario() {
            const selectedNumeracaoInput = document.getElementById('selectedNumeracaoInput').value;
            const favSelectedNumeracaoInput = document.getElementById('fav-selected-numeracao').value;
            const selectedCorInput = document.getElementById('fav-selected-cor').value;
            
            if (!selectedNumeracaoInput && !favSelectedNumeracaoInput) {
                showAlert('Por favor, escolha uma numeração.');
                return false; // Impede o envio do formulário
            }

            if (!selectedCorInput) {
                showAlert('Por favor, escolha uma cor.');
                return false; // Impede o envio do formulário
            }

            return true; // Permite o envio do formulário
        }

        function showAlert(message) {
            document.getElementById('alert-message').innerText = message;
            const alertBox = document.getElementById('custom-alert');
            alertBox.classList.remove('hidden');

        // Oculta o alerta após 2 segundos (2000 milissegundos)
        setTimeout(function() {
            alertBox.classList.add('hidden');
        }, 2000);
    }

    function closeAlert() {
        const alertBox = document.getElementById('custom-alert');
        alertBox.classList.add('hidden');
    }



    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.numeracao-option').forEach(function (element) {
            element.addEventListener('click', function () {
                const numeracaoValue = this.value;
                document.getElementById('selectedNumeracaoInput').value = numeracaoValue;
                document.getElementById('fav-selected-numeracao').value = numeracaoValue;
                console.log('Numeração selecionada:', numeracaoValue); // Para depuração
            });
        });
    });
</script>

    
</body>
</html>

@endsection