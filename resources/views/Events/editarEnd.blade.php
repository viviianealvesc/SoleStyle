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


</head>
<body class="bg-[#181818] m-3">
    <div class="flex">
        <a href="/fechar">
            <img class="mx-3 pt-2 w-[30px] rounded-full" src="{{asset('/img/desfazer.png')}}" alt="">
        </a>
        <p class="font-semibold pt-2 text-white">Editar Endereço</p>
    </div>
    <div class="flex justify-end">
        @if(session('msg'))
        <div class="alert border border-success alert-warning alert-dismissible fade show bg-[#3F3F3F] w-80 h-14 mr-2" role="alert">
            <p class="text-white">{{ session('msg') }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
       @endif
    </div>
<div class="flex justify-center items-center w-full mt-3 ">

    <form class="max-w-md m-3 w-full" action="{{route('atualizar.endereco', $enderecos->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <input class="bg-[#3F3F3F] rounded-md p-2 w-full outline-none focus:outline-amber-300 text-white" type="text" id="nome" name="nome" value="{{$enderecos->nome}}" autofocus>
        </div>
        <div class="mb-4">
            <input class="bg-[#3F3F3F] rounded-md p-2 w-full outline-none focus:outline-amber-300 text-white" type="text" id="telefone" name="telefone" value="{{$enderecos->telefone}}">
        </div>
        <div class="mb-4">
            <input class="bg-[#3F3F3F] rounded-md p-2 w-full outline-none focus:outline-amber-300 text-white" type="text" id="cep" name="cep" value="{{$enderecos->cep}}" onblur="buscarEndereco()">
        </div>
        <div class="mb-4">
            <input class="bg-[#3F3F3F] rounded-md p-2 w-full outline-none focus:outline-amber-300 text-white" type="text" id="estado" name="estado" value="{{$enderecos->estado}}" readonly>
        </div>
        <div class="mb-4">
            <input class="bg-[#3F3F3F] rounded-md p-2 w-full outline-none focus:outline-amber-300 text-white" type="text" id="cidade" name="cidade" value="{{$enderecos->cidade}}" readonly>
        </div>
        <div class="mb-4">
            <input class="bg-[#3F3F3F] rounded-md p-2 w-full outline-none focus:outline-amber-300 text-white" type="text" id="rua" name="rua" value="{{$enderecos->rua}}">
        </div>
        <div class="mb-4">
            <input class="bg-[#3F3F3F] rounded-md p-2 w-full outline-none focus:outline-amber-300 text-white" type="text" id="bairro" name="bairro" value="{{$enderecos->bairro}}">
        </div>
        <div class="mb-4">
            <input class="bg-[#3F3F3F] p-2 rounded-md w-full outline-none focus:outline-amber-300 text-white" type="text" id="numero" name="numero" value="{{$enderecos->numero}}">
        </div>

        <button class="w-full bg-[#D9C549] p-2 rounded-sm " type="submit">Editar endereço</button>
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

    
 </body>

</html>