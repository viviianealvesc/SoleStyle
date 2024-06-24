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

    <style>

.custom-container p {
    color: #fff;
}

.custom-container h2{
    color: #D9C549;
}


.custom-container input {
    background-color: #fff; /* Cor de fundo do input */
    color: #333; /* Cor do texto do input */
    border: 1px solid #ccc; /* Cor da borda do input */
    padding: 10px;
    border-radius: 4px;
}

.custom-container label {
    color: #fff; /* Cor do texto do label */
}

.custom-container button {
    background-color: #D9C549; /* Cor de fundo do botão */
    color: #fff; /* Cor do texto do botão */
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.custom-container button:hover {
    background-color: #ecdd80; /* Cor de fundo do botão ao passar o mouse */
}

.negative-margin {
      margin-top: -56px; /* Ajuste conforme necessário */
    }
    </style>

</head>

<body class="bg-[#181818]">
    <div class="relative shadow-lg rounded-lg z-10  bg-[#3F3F3F] dark:bg-gray-800 h-28 rounded-b-3xl">
        <div class="flex">
            <a href="{{route('home')}}">
                <img class="mx-3 pt-2 w-[30px] rounded-full" src="{{asset('/img/desfazer.png')}}" alt="">
            </a>
            <p class="font-semibold pt-2 text-white">Perfil</p>
        </div>
    </div>
       <div class="relative negative-margin z-20 flex justify-center items-center ">
        <img class=" w-20 rounded-full" src="{{asset('/img/doida.jpg')}}" alt="">
    </div>
    <p class="text-center pt-2 text-white">Viviane Alves</p>

    <div class="p-4 mt-[60px] bg-[#3F3F3F] rounded-lg max-w-7xl sm:px-6 lg:px-8 space-y-6 mx-[35px]">
        <div class="max-w-xl custom-container">
            <h2 class="mb-3 font-semibold">Estrelas ganhas por compra</h2>
            <div class="inline-block items-center">
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < $estrelas->count())
                        <!-- Filled Star -->
                        <div class="inline-block items-center">
                            <svg class="w-4 h-4 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                        </div>
                    @else
                        <!-- Empty Star -->
                        <div class="inline-block items-center">
                            <svg class="w-4 h-4 text-[#626262] ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                            </svg>
                        </div>
                    @endif
                @endfor
            </div>
            @if ($estrelas->count() == 5)
                <p class="text-green-600">Você atingiu 5 estrelas!</p>
            @else
                <p class="mt-2">Faltam apenas {{ 5 - $estrelas->count() }} estrelas para você ganhar um cupom de 40% de desconto!</p>
            @endif
        </div>
    </div>

    
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(isset($user->cupons))
            <div class="p-4 sm:p-8 bg-[#3F3F3F] dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl custom-container" >
                    <!-- Exibindo cupons -->
                <h2 class="mb-3 font-semibold">Seus Cupons</h2>
                    @foreach ($user->cupons as $coupon)
                        <div class="mb-2">
                            <p> <span class="font-semibold">{{ $coupon->code }} </span>- {{ $coupon->discount }}% de desconto </p>
                            <span class="text-[#a9a8a8]">Expira em: {{ \Carbon\Carbon::parse($coupon->expiry_date)->format("d/m") }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="p-4 sm:p-8 bg-[#3F3F3F] dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl custom-container" >
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-[#3F3F3F] dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl custom-container">
                    <livewire:profile.update-password-form />
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-[#3F3F3F] dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl custom-container">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
  </body>
</html>