<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        
        <div class="bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            {{-- @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

            <main class="grid grid-cols-12 min-h-screen">
                
                <div class="hidden md:block md:col-span-3 lg:col-span-2 bg-white border-r p-6 shadow-xl">
                    
                    {{-- Usamos un componente Blade para cargar el contenido del menú lateral --}}
                    @auth
                        @include('layouts.sidebar-menu')
                    @endauth
                    
                </div>
            
                <div class="col-span-12 md:col-span-9 lg:col-span-10 p-4 md:p-8">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>