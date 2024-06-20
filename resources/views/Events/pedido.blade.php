@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')

<div>
    <h1 class="text-[#D9C549]">Dados da compla</h1>

    @foreach ($pedidos as $pedido)
    <div class="flex justify-between my-3 mx-2 p-3 bg-[#3F3F3F] rounded-md flex-wrap ">
        <div class="flex items-center">
            <img class="w-28 rounded-md" src="/img/loja/{{$pedido->product->imagem}}" alt="">
            <div class="m-2">
                <p class="text-white">{{$pedido->endereco->rua}}</p>
                <p class="text-white">Informações: {{$pedido->cor}}, {{$pedido->numeracao}}</p>  
                <p class="bg-[#f0d83a75] p-1 mt-2 text-center rounded-md">{{$pedido->status}}</p>
            </div>
        </div>
        @if(isset($pedido->status) && $pedido->status == 'cancelado')
            <div class="flex justify-end items-center w-full">
                <p class="bg-[#f75a5a] text-white p-2 rounded-md">Cancelado</p>
            </div>
        @else
            <div class="flex justify-end items-center w-full">
                <button id="{{$pedido->id}}" class="bg-[#D9C549] p-2 rounded-md">Cancelar pedido</button>
            </div>
        @endif
        

    </div>
    @endforeach
</div>

<div class=" text-center font-medium text-[#595959]">
    <small>Depois de realizar a compra, você tem </br> apenas 10 horas para cancelar o pedido.</small>
</div>

<div id="container"></div>



<script>
document.getElementById("{{$pedido->id}}").addEventListener("click", function() {
    // HTML do modal
    var modalHtml = `
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
            <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Deseja mesmo cancelar a compra?</h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">Após cancelar a compra, o vendedor tem até 24 horas para extornar o dinheiro.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
         <form action="/pedido/{{$pedido->id}}" method="GET">
            <a class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm text-gray-900 hover:bg-red-500 sm:ml-3 sm:w-auto" href="/pedido/{{$pedido->id}}" onclick="event.preventDefault(); this.closest('form').submit(); ">Continuar</a>
        </form>
       
         <a class=" inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" href="{{ route('portal') }}">Cancelar</a>
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

@endsection