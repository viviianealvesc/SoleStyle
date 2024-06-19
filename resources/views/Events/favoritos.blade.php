@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<main>
    <div class="m-3">

        @if(!isset($favoritos) || $favoritos->isEmpty())
          <div class="flex items-center justify-center mt-9">
             <div>
                <h1 class="text-center opacity-40 text-white font-semibold">Não há produtos favoritados!</h1>
                <img class="opacity-40" src="{{asset('/img/favorito-vazio.png')}}" alt="">
             </div>
          </div>

          @else

         <h1 class="text-[#D9C549] mb-4">Meus produtos Favoritados</h1>

        <div class="flex justify-end">
            @if(session('msg'))
            <div class="alert border border-success alert-warning alert-dismissible fade show bg-[#3F3F3F] w-72 h-14 mr-2" role="alert">
                <p class="text-white">{{ session('msg') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
           @endif
        </div>

        @foreach ($favoritos as $favorito)
            
        <div class="border rounded-lg p-2 mt-3">
            <div class="flex justify-between">
               <div class="flex">
               <div class="flex items-center">
                <a href="/produto/{{ $favorito->id }}">
                    <img class="w-28 rounded-lg" src="/img/loja/{{$favorito->imagem}}" alt="">
                 </a>
               </div>
                 <div class="m-3">
                     <p class="text-white truncate w-[largura] mt-2">{{ $favorito->nome }}</p>
                     <p class="text-[#D9C549] font-semibold">R$ {{ $favorito->preco }}</p>
                     <small class="text-[#7E7E7E] line-through">74,90</small>
                        @foreach ($cor as $cores)
                          <p class="text-[#D9C549]">{{$cores->pivot->cor}}</p>
                        @endforeach
                 </div>

                 
               </div>
               <!-- Excluir dos favoritos -->
               <a href="/remove/{{ $favorito->id }}"><i class="bi bi-x text-white"></i></a>
            </div>
            <div class="flex justify-end ">
                <form action="/carrinho/{{ $favorito->id }}" method="GET">
                    <a class="text-[#D9C549] font-semibold"  href="/carrinho/{{ $favorito->id }}"  onclick="event.preventDefault(); this.closest('form').submit(); ">Adicionar ao carrinho</a>
                </form>
            </div>
        </div>
       @endforeach

      
     
      @endif

      
    </div>
</main>



@endsection