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

    <header class="bg-[#41abee] text-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <a href="{{ route('home') }}" class="flex items-center space-x-3 hover:opacity-80 transition">
                <img src="{{ asset('build/images/logo.png') }}" alt="Logo" class="h-28 w-auto">
                <img src="{{ asset('build/images/texto.png') }}" alt="texto" class="h-20 w-auto">
            </a>

            <nav class="space-x-4 text-sm">

                @guest
                    <!-- NO AUTENTICADO -->
                    <a href="{{ route('login') }}"
                        class="px-20 py-3 text-lg font-bold bg-yellow-400 text-[#1E88C8] rounded-full hover:bg-yellow-500 transition-all shadow-md">
                        Inicia sesión
                    </a>
                    <br>
                    <br>
                    <h6>¿Aún no eres usuario?<a href="{{ route('register') }}"><u style="color: red">Date de alta
                                aquí</u></a></h6>
                @endguest


                @auth
                    <!-- AUTENTICADO -->
                    @auth
                        <span class="font-semibold text-white">
                            👤 {{ Auth::user()->name }}
                        </span>
                    @endauth
                    <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                    <a href="{{ route('publicaciones.index') }}" class="hover:underline">Libros</a>
                    <a href="{{ route('solicitudes.index') }}" class="hover:underline">Solicitudes</a>

                    <!-- Usuario + logout -->
                    <span class="ml-4">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button class="ml-2 underline">
                            Salir
                        </button>
                    </form>
                @endauth

            </nav>

        </div>
    </header>

    <main class="flex-grow py-6">

        <div class="max-w-7xl mx-auto px-6 mb-4">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-2">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-2 rounded mb-2">
                    {{ session('error') }}
                </div>
            @endif

        </div>

        {{ $slot }}

    </main>

    <footer class="bg-gray-100 text-orange-500 mt-auto">
        <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-4xl text-center">
         <a href="{{ route('contacto') }}" class="hover:underline">Contacto</a> · <a href="{{ route('ayuda') }}" class="hover:underline">Ayuda</a> · <a href="{{ route('aviso-legal') }}" class="hover:underline">Aviso Legal</a>
        <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-center">
            <br>
            © {{ date('Y') }} Libre-Libro-Teca · Proyecto DAW · Sergio González Perancho
        </div>
        </div>
        </footer>
    </footer>

</body>

</html>
