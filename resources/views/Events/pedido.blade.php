@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<div>
    <div class="relative shadow-lg rounded-lg z-10 mb-5 rounded-b-3xl">
        <div class="flex">
            <a href="{{route('home')}}">
                <img class="mx-3 pt-2 w-[30px] rounded-full" src="{{asset('/img/desfazer.png')}}" alt="">
            </a>
            <p class="font-semibold pt-2 text-white">Minhas compras</p>
        </div>
    </div>

    @if(isset($pedidos))
        @foreach ($pedidos as $pedido)
        <div class="flex justify-between my-3 mx-2 p-3 bg-[#3F3F3F] rounded-md flex-wrap ">
            <div class="flex items-center">
                <img class="w-28 rounded-md" src="/img/loja/{{$pedido->product->imagem}}" alt="">
                <div class="m-2">
                    <p class="text-white">{{$pedido->product->nome}}</p>
                    <p class="text-[#767676]"><span class="text-[#f0d83a75]">Cor:</span> {{$pedido->cor}}, <span class="text-[#f0d83a75]">Numeração: </span>{{$pedido->numeracao}}</p>  
                    <p class="text-[#767676]"><span class="text-[#f0d83a75]">Total do Pedido:</span> R${{$pedido->total}}</p>  
                </div>
                
                </div>
            @if(isset($pedido->status) && $pedido->status == 'cancelado')
                <div class="flex justify-end items-center w-full">
                    <p class="text-[#f75a5a] p-2 rounded-md">{{\Carbon\Carbon::parse($pedido->updated_at)->format("d/m/y H:i") }}</p>
                    <p class="bg-[#f75a5a] text-white p-2 rounded-md">Cancelado</p>
                </div>
            @else
            <div class="flex justify-between items-center w-full">
            <p class="text-[#f0d83a75] mt-2 text-center rounded-md">{{$pedido->status}}</p>
            <p class="text-[#f0d83a75] mt-2 text-center rounded-md">Código de rastreio: {{$pedido->tracking_code}}</p>
            <button class="cancel-button bg-[#D9C549] p-2 rounded-md" data-pedido-id="{{$pedido->id}}">Cancelar pedido</button>
        </div>
            @endif
        </div>
        @endforeach
        @endif
</div>


<form class="mt-5" action="{{ route('frete') }}" method="POST">
    @csrf
    <input class="p-2 rounded-sm bg-[#3F3F3F] text-white max-sm:w-40" type="text" name="codigo" id="codigo" placeholder="Informe o Código de Rastreamento">
<button type="submit" class="bg-[#D9C549] font-bold p-2 text-sm rounded-sm">Consultar Rastreamento</button>
</form>


@if(isset($error))
        <p>{{ $error }}</p>
    @elseif(isset($events))
        <ul>
            @foreach($events as $event)
                <li>{{ $event['description'] }} - {{ $event['date'] }} - {{ $event['location'] }}</li>
            @endforeach
        </ul>
    @else
        <p>Nenhuma informação de rastreamento disponível.</p>
    @endif

<div class=" text-center font-medium text-[#595959]">
    <small>Depois de realizar a compra, você tem </br> apenas 10 horas para cancelar o pedido.</small>
</div>

<div id="container"></div>



<script>
document.querySelectorAll('.cancel-button').forEach(button => {
    button.addEventListener('click', function() {
        var pedidoId = this.getAttribute('data-pedido-id');
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
                                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Deseja mesmo cancelar a compra?</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">Após cancelar a compra, o vendedor tem até 24 horas para extornar o dinheiro.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <form action="/pedido/${pedidoId}" method="GET">
                                <a class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm text-gray-900 hover:bg-red-500 sm:ml-3 sm:w-auto" href="/pedido/${pedidoId}" onclick="event.preventDefault(); this.closest('form').submit();">Continuar</a>
                            </form>
                            <a class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" href="{{ route('portal') }}">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        `;
        
        // Inserir o HTML do modal dentro do elemento container
        document.getElementById("container").innerHTML = modalHtml;
    });
});
</script>

@endsection