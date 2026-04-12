<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Libre-Libro-Teca') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#F2F2F2] min-h-screen flex flex-col">

    <!-- HEADER -->
    <header class="bg-[#41abee] text-white shadow">
        <div class="w-full px-4 py-4">

            <div class="flex flex-row flex-wrap justify-between items-center gap-4">

                <!-- LOGO -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 justify-center md:justify-start">
                    <img src="{{ asset('images/logo.png') }}" class="h-16 md:h-20 lg:h-24 w-auto">
                    <img src="{{ asset('images/texto.png') }}" class="h-10 md:h-14 lg:h-16 w-auto">
                </a>

                <!-- NAV -->
                <nav class="flex justify-center md:justify-end">

                    @guest
                        <div class="flex flex-col md:flex-row items-center gap-3 md:gap-6 text-center md:text-right">

                            <a href="{{ route('login') }}"
                                class="inline-block px-6 py-3 text-lg font-bold bg-yellow-400 text-[#1E88C8] rounded-full hover:bg-yellow-500 transition shadow-md">
                                Inicia sesión
                            </a>

                            <span class="text-sm">
                                ¿Aún no eres usuario?
                                <a href="{{ route('register') }}" class="underline text-red-500">
                                    Date de alta aquí
                                </a>
                            </span>

                        </div>
                    @endguest

                    @auth
                        <div class="flex flex-col md:flex-row items-center gap-4">

                            <div class="flex gap-4">
                                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                                <a href="{{ route('publicaciones.index') }}" class="hover:underline">Libros</a>
                                <a href="{{ route('solicitudes.index') }}" class="hover:underline">Solicitudes</a>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="font-semibold">
                                    👤 {{ Auth::user()->nombre }}
                                </span>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="underline hover:opacity-80">
                                        Salir
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endauth

                </nav>

            </div>

        </div>
    </header>

    <!-- MAIN -->
    <main class="flex-grow py-6 w-full">

        <!-- CONTENIDO PRINCIPAL -->
        {{ $slot }}

    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-100 text-orange-500 mt-auto">
        <div class="w-full px-4 py-4 text-sm text-center">

            <div class="flex flex-row flex-wrap justify-center gap-4">
                <a href="{{ route('contacto') }}" class="hover:underline">Contacto</a>
                <a href="{{ route('ayuda') }}" class="hover:underline">Ayuda</a>
                <a href="{{ route('aviso-legal') }}" class="hover:underline">Aviso Legal</a>
            </div>

            <div class="mt-3">
                © {{ date('Y') }} Libre-Libro-Teca · Proyecto DAW · Sergio González Perancho
            </div>

        </div>
    </footer>

    <!-- TOAST DE MENSAJES -->
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 3000)"
        x-transition
        class="fixed top-5 right-5 z-50"
    >

        @if(session('success'))
            <div class="bg-green-500 text-white px-6 py-3 rounded shadow-lg mb-2 flex items-center justify-between gap-4">
                <span>{{ session('success') }}</span>
                <button @click="show = false">✖</button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white px-6 py-3 rounded shadow-lg mb-2 flex items-center justify-between gap-4">
                <span>{{ session('error') }}</span>
                <button @click="show = false">✖</button>
            </div>
        @endif

    </div>

</body>

</html>
