<x-app-layout>
    <x-slot name="header">
        <header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Solicitudes
            </h1>
        </header>
    </x-slot>

    <main class="py-6">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- MENSAJES -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <!-- RESUMEN -->
            @if($aceptadasCount > 0)
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
                    Tienes {{ $aceptadasCount }} solicitudes aceptadas
                </div>
            @endif

            <!-- SOLICITUDES ENVIADAS -->
            <article class="bg-white shadow rounded-lg overflow-hidden">

                <header class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                    <h2 class="font-semibold text-lg">Mis solicitudes</h2>

                    @if($aceptadasCount > 0)
                        <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm">
                            {{ $aceptadasCount }}
                        </span>
                    @endif
                </header>

                <!-- PESTAÑAS -->
                <div class="flex gap-4 px-4 pt-4 border-b">
                    <button onclick="mostrarTab('pendientes')" class="tab-btn">
                        Pendientes ({{ $pendientes->count() }})
                    </button>
                    <button onclick="mostrarTab('aceptadas')" class="tab-btn">
                        Aceptadas ({{ $aceptadas->count() }})
                    </button>
                    <button onclick="mostrarTab('rechazadas')" class="tab-btn">
                        Rechazadas ({{ $rechazadas->count() }})
                    </button>
                </div>

                <!-- PENDIENTES -->
                <div id="pendientes" class="tab-content p-4">
                    @forelse($pendientes as $solicitud)
                        <div class="border-b py-2 p-2 mb-2 rounded flex justify-between items-center">

                            <div class="flex items-center gap-2">
                                <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>
                                <span class="text-yellow-600">Pendiente</span>
                            </div>

                            <a href="{{ route('publicaciones.show', $solicitud->publicacion->id) }}"
                                class="text-blue-600 hover:underline">
                                Ver detalles
                            </a>

                        </div>

                    @empty
                        <p class="text-gray-500">No hay solicitudes pendientes</p>
                    @endforelse
                </div>

                <!-- ACEPTADAS -->
                <div id="aceptadas" class="tab-content p-4 hidden">
                    @forelse($aceptadas as $solicitud)
                        <div class="bg-green-50 p-2 mb-2 rounded flex justify-between items-center">
                            <span>
                                <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>
                            </span>

                            <a href="{{ route('publicaciones.show', $solicitud->publicacion->id) }}"
                                class="text-blue-600 hover:underline">
                                Ver detalles
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-500">No hay solicitudes aceptadas</p>
                    @endforelse
                </div>

                <!-- RECHAZADAS -->
                <div id="rechazadas" class="tab-content p-4 hidden">
                    @forelse($rechazadas as $solicitud)
                        <div class="bg-red-50 p-2 mb-2 rounded">
                            <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>
                            <span class="text-red-600 ml-2">Rechazada</span>
                        </div>
                    @empty
                        <p class="text-gray-500">No hay solicitudes rechazadas</p>
                    @endforelse
                </div>

            </article>

            <!-- SOLICITUDES RECIBIDAS -->
            <article class="bg-white shadow rounded-lg overflow-hidden">
                <header class="bg-gray-100 px-4 py-2">
                    <h2 class="font-semibold text-lg">Solicitudes recibidas</h2>
                </header>

                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Libro</th>
                            <th class="px-4 py-2 text-left">Solicitante</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($recibidas as $solicitud)
                            @php
                                $estado = strtolower($solicitud->estado->nombre ?? 'pendiente');
                            @endphp

                            <tr class="border-t hover:bg-gray-50">

                                <td class="px-4 py-2">
                                    {{ $solicitud->publicacion->centroLibro->libro->titulo ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $solicitud->usuario->nombre ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ ucfirst($estado) }}
                                </td>

                                <td class="px-4 py-2 space-x-2">

                                    @if($estado == 'pendiente')

                                        <form method="POST" action="{{ route('solicitudes.aceptar', $solicitud->id) }}"
                                            class="inline">
                                            @csrf
                                            <button class="text-green-600 hover:underline">
                                                Aceptar
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('solicitudes.rechazar', $solicitud->id) }}"
                                            class="inline">
                                            @csrf
                                            <button class="text-red-600 hover:underline">
                                                Rechazar
                                            </button>
                                        </form>

                                    @else
                                        <span class="text-gray-500">Sin acciones</span>
                                    @endif

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                    No tienes solicitudes recibidas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </article>

        </section>

        <br>

        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('dashboard') }}"
                    class="inline-block px-4 py-2 bg-[#FFC107] text-white rounded hover:opacity-90">
                    Volver
                </a>
            </div>
        </section>
    </main>

    <script> <!-- Script para manejar las pestañas con los distintos estados de las solicitudes -->
        function mostrarTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(tab).classList.remove('hidden');
        }
    </script>
</x-app-layout>
