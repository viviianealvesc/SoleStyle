@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

    <main>
       <div class="pt-10 ml-6 flex items-center justify-between">
        <a href="{{Route('/')}}"><img width="30" src="{{ asset('img/desfazer.png')}}" alt="Voltar"></a>

        @if(session('msg'))
            <div class="alert border border-success alert-warning alert-dismissible fade show bg-[#3F3F3F] w-72 h-14 mr-5" role="alert">
                <p class="text-white">{{ session('msg') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
       </div>
 
         <div class="flex items-center justify-center pt-10">
             <div class="ml-5">
                 <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
                    @if($selectedColor)
                        @foreach ($selectedColor['avatar'] as $imagem)
                          <img class="w-96 rounded-md m-1" src="/img/loja/{{ $imagem }}" alt="">
                        @endforeach
                    @else
                        @foreach ($product->cores[0]['avatar'] as $avatar)
                          <img class="w-96 rounded-md m-1" src="/img/loja/{{ $avatar }}" alt="">
                        @endforeach
                    @endif
                </div>
                <p class="text-white pl-2  truncate w-[largura] mt-3 text-2xl">{{ $product->nome}}</p>
                <div class="flex pl-2 gap-2">
                    <p class="text-[#D9C549] font-semibold pl-1 text-2xl">{{ $product->preco}}</p>
                    <small class="text-[#7E7E7E] line-through pt-1">74,90</small>
                </div>
              
                <div>
                    <h2 class="text-[#D9C549] font-semibold pt-9">Cores</h2>
                    <div class="flex" id="color-selector">
                        @foreach ($product->cores as $index => $cor)
                            <form action="/produto/{{$product->id . '/' . $index }}" method="GET" class="inline">
                                <button type="submit" class="w-20 rounded-md m-1 p-0 border-none bg-none">
                                <img class="w-20 rounded-md m-1 color-option" src="/img/loja/{{ $cor['avatar'][0]}}" data-index="{{ $index }}" alt="Cor {{ $cor['color'] }}">
                                </button>
                            </form>
                        @endforeach
                    </div>
               </div>
           </div>
         </div>
        </div>
 
          <!-- Numeração -->
          <div>
            <p class="text-[#D9C549] font-semibold pl-7 pt-9">Numeração</p>
            <div class="flex items-center pl-7 pt-3">
                @if($selectedColor)
                    @foreach ($selectedColor['numeracao'] as $numero)
                        <label class="flex items-center space-x-2 cursor-pointer">
                            <input type="checkbox" class="hidden peer">
                            <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                                <p class="p-2 font-bold text-white">{{ $numero }}</p>
                                <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </span>
                        </label>
                    @endforeach
                @else
                    @foreach ($product->cores[0]['numeracao'] as $numero)
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" class="hidden peer">
                        <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                            <p class="p-2 font-bold text-white">{{ $numero }}</p>
                            <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                    </label>
                    @endforeach
                @endif
            </div>
        </div>
 
         <!--Adicionar ao carrinho -->
         <div class="flex items-center pl-9 pt-16 mb-20">
           <div class="flex items-center">
             <form action="/carrinho/{{ $product->id }}" method="GET">
                 <a class="bg-[#D9C549] font-bold p-3 w-64 rounded-md"  href="/carrinho/{{ $product->id }}"  onclick="event.preventDefault(); this.closest('form').submit(); ">Adicionar ao carrinho</a>
             </form>
 
             <form action="/favoritos/{{ $product->id }}" method="GET">
                 <a class=" rounded-md " href="/favoritos/{{ $product->id }}"  onclick="event.preventDefault(); this.closest('form').submit(); "><img width="30" class="m-3 " src="{{ asset('img/coracao.png')}}" alt=""></a>
             </form>
           </div>
         </div>
    


 
         <!--Descrição do produto -->
         <div class="text-justify m-5">
             <h1 class="text-white font-bold">Descrição</h1>
             <p class="text-[#878686] mt-3">{{$product->descricao}}</p>
         </div>
 
         <!--Produtos -->
         <div class="pt-7 pb-10">
         <small class="text-white p-1 m-2 border-l-2 border-[#D9C549] font-semibold">MAIS VENDIDOS</small>
         <div class="flex gap-1 overflow-x-scroll px-1 [&::-webkit-scrollbar]:hidden">
          <div class="p-4">
              <div class="bg-[#3F3F3F] rounded-lg w-40">
                  <a href="produto.html"> <img src="img/image-removebg-preview.png" alt=""></a>
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
    
</body>
</html>

@endsection