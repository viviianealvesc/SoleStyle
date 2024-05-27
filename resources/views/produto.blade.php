@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

    <main>
       <div>
       <div class="pt-10 ml-6">
        <a href="{{Route('/')}}"><img width="30" src="{{ asset('img/desfazer.png')}}" alt="Voltar"></a>
       </div>
        <div class="flex items-center justify-center pt-10">
            <div class="bg-[#3F3F3F] rounded-lg p-3">
                <img width="360" src="{{ asset('img/image-removebg-preview.png')}}" alt="">
            </div>
        </div>
        <p class="text-white pl-7  truncate w-[largura] mt-2 text-2xl">{{ $product->nome}}</p>
        <div class="flex pl-7 gap-2">
            <p class="text-[#D9C549] font-semibold pl-1 text-2xl">{{ $product->preco}}</p>
            <small class="text-[#7E7E7E] line-through pt-1">74,90</small>
        </div>
       </div>

        <!-- Cores -->
        <div>
            <p class="text-[#D9C549] font-semibold pl-7 pt-9">Cores</p>
          <div class="flex items-center pl-7 pt-3">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8  bg-red-700 rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8  bg-green-800 rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8  bg-pink-700 rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8  bg-blue-700 rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label>

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8 bg-blue-400 rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center">
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label>           
          </div>
        </div>

        <!-- Numeração -->
        <div>
            <p class="text-[#D9C549] font-semibold pl-7 pt-9">Numeração</p>
          <div class="flex items-center pl-7 pt-3">
            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center"> <p class="p-2 font-bold text-white">34</p>
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label> 

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center"> <p class="p-2 font-bold text-white">35</p>
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label> 

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center"> <p class="p-2 font-bold text-white">36</p>
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label> 

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center"> <p class="p-2 font-bold text-white">37</p>
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label> 

            <label class="flex items-center space-x-2 cursor-pointer">
                <input type="checkbox" class="hidden peer">
                <span class="w-9 h-8 bg-[#3F3F3F] rounded-md peer-checked:bg-blue-500 peer-checked:border-blue-500 peer-checked:text-white flex items-center justify-center"> <p class="p-2 font-bold text-white">38</p>
                    <svg class="hidden w-4 h-4 text-white peer-checked:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
            </label> 
          </div>
        </div>

        <!--Adicionar ao carrinho -->

        <div class="flex items-center pl-9 pt-16 mb-20">
          <div>
            <form action="/carrinho/{{ $product->id }}" method="GET">
                <a class="bg-[#D9C549] font-bold p-3 w-64 rounded-md"  href="/carrinho/{{ $product->id }}"  onclick="event.preventDefault(); this.closest('form').submit(); ">Adicionar ao carrinho</a>
            </form>

            <form action="/favoritos/{{ $product->id }}" method="GET">
                @csrf
                <a class="bg-[#3F3F3F] p-3 rounded-md ml-2" href="/favoritos/{{ $product->id }}"  onclick="event.preventDefault(); this.closest('form').submit(); "><img width="30" src="{{ asset('img/coracao.png')}}" alt=""></a>
            </form>
          </div>
        </div>

        <!--Descrição do produto -->
        <div class="text-justify m-5">
            <h1 class="text-white font-bold">Descrição</h1>
            <p class="text-[#878686] mt-3">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis quo atque sunt fuga error rem, nam qui eaque unde. Magnam eveniet ipsam eligendi nulla repellendus modi sed ipsa iusto nesciunt!</p>
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
</body>
</html>

@endsection