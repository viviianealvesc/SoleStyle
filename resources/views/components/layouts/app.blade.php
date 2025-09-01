<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js']) 

        @livewireStyles
    </head>
    <body>
            <!-- Navbar -->
    <header class="p-4 bg-indigo-600 text-white">
        <h1 class="text-lg font-bold">Meu Sistema</h1>
    </header>

    <!-- Conteúdo -->
    <main class="container mx-auto p-6">
        {{ $slot }}
    </main>

    @livewireScripts
    </body>
</html>
