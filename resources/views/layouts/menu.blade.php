<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-[#181818]">
    <header class="shadow-lg bg-[#D9C549]">
        <nav class="flex justify-between pt-4 p-4">
            <div>
               <a href="{{Route('voltar.product')}}"><img width="80" src="img/logo.png" alt=""></a> 
            </div>
            <div class="pt-6">
                <a href="{{Route('menuLateral')}}"><img src="img/menu-hamburguer.png" alt="menu-lateral"></a>
            </div>
        </nav>
        <div class="flex items-center justify-center pb-3">
            <input class="rounded-lg p-2 bg-[#3F3F3F]" type="text" placeholder="O que você procura?">
            <img class="bg-[#3F3F3F] rounded-md ml-2 p-1" width="40" src="img/lupa (1).png" alt="">
        </div>
    </header>

    <!-- Header section end -->
    @yield('content')

</body>
</html>