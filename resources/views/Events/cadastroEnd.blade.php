@extends('layouts.menu')
@section('title', 'SoleStyle')
@section('content')


<div class="flex justify-center items-center w-full mt-10">
    <div class="flex justify-end">
        @if(session('msg'))
        <div class="alert border border-success alert-warning alert-dismissible fade show bg-[#3F3F3F] w-72 h-14 mr-2" role="alert">
            <p class="text-white">{{ session('msg') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       @endif
    </div>
    <form class="max-w-md w-full" action="{{route('cadastrar.endereco')}}" method="POST">
        @csrf
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="nome" name="nome" placeholder="Nome completo">
        </div>
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="telefone" name="telefone" placeholder="Telefone">
        </div>
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="cep" name="cep" placeholder="CEP" onblur="buscarEndereco()">
        </div>
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="estado" name="estado" placeholder="Estado" readonly>
        </div>
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="cidade" name="cidade" placeholder="Cidade" readonly>
        </div>
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="rua" name="rua" placeholder="Rua">
        </div>
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="bairro" name="bairro" placeholder="bairro">
        </div>
        <div class="mb-4">
            <input class="text-[#676767] p-2 rounded-sm w-full" type="text" id="numero" name="numero" placeholder="Numero">
        </div>

        <button class="w-full bg-[#D9C549] p-2 rounded-sm" type="submit">Cadastrar endereço</button>
    </form>
</div>


<script>
    function buscarEndereco() {
        var cep = document.getElementById('cep').value.replace(/\D/g, '');
        if (cep !== "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                var script = document.createElement('script');
                script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=preencherEndereco';
                document.body.appendChild(script);
            } else {
                alert("Formato de CEP inválido.");
            }
        }
    }

    function preencherEndereco(conteudo) {
        if (!("erro" in conteudo)) {
            document.getElementById('estado').value = conteudo.uf;
            document.getElementById('cidade').value = conteudo.localidade;
            document.getElementById('rua').value = conteudo.logradouro;
        } else {
            alert("CEP não encontrado.");
        }
    }
</script>

@endsection