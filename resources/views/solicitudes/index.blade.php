<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Solicitudes
        </h1>
    </x-slot>

    <main class="py-6">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Resumen de solicitudes aceptadas -->
            @if($aceptadasCount > 0)
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded text-center">
                    Tienes {{ $aceptadasCount }} solicitudes aceptadas
                </div>
            @endif

            <!-- Bloque de solicitudes enviadas por el usuario -->
            <article class="bg-white shadow rounded-lg overflow-hidden">

                <header class="bg-gray-100 px-4 py-2 flex justify-between items-center">
                    <h2 class="font-semibold text-lg">Mis solicitudes</h2>

                    @if($aceptadasCount > 0)
                        <span class="bg-green-500 text-white px-2 py-1 rounded-full text-sm">
                            {{ $aceptadasCount }}
                        </span>
                    @endif
                </header>

                <!-- Pestañas para separar solicitudes enviadas por estado -->
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

                <!-- Contenido de solicitudes pendientes -->
                <div id="pendientes" class="tab-content p-4">
                    @forelse($pendientes as $solicitud)
                        <div class="border-b py-2 flex justify-between items-center">

                            <div>
                                <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>
                                <span class="text-yellow-600 font-semibold ml-2">Pendiente</span>
                            </div>

                            <a href="{{ route('publicaciones.show', $solicitud->publicacion) }}"
                               class="text-blue-600 hover:underline">
                                Ver detalles
                            </a>

                        </div>
                    @empty
                        <p class="text-gray-500">No hay solicitudes pendientes</p>
                    @endforelse
                </div>

                <!-- Contenido de solicitudes aceptadas -->
                <div id="aceptadas" class="tab-content p-4 hidden">
                    @forelse($aceptadas as $solicitud)
                        <div class="bg-green-50 p-2 mb-2 rounded flex justify-between">

                            <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>

                            <a href="{{ route('publicaciones.show', $solicitud->publicacion) }}"
                               class="text-blue-600 hover:underline">
                                Ver detalles
                            </a>

                        </div>
                    @empty
                        <p class="text-gray-500">No hay solicitudes aceptadas</p>
                    @endforelse
                </div>

                <!-- Contenido de solicitudes rechazadas -->
                <div id="rechazadas" class="tab-content p-4 hidden">
                    @forelse($rechazadas as $solicitud)
                        <div class="bg-red-50 p-2 mb-2 rounded flex justify-between">

                            <div>
                                <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>
                                <span class="text-red-600 ml-2 font-semibold">Rechazada</span>
                            </div>

                            <a href="{{ route('publicaciones.show', $solicitud->publicacion) }}"
                               class="text-blue-600 hover:underline">
                                Ver detalles
                            </a>

                        </div>
                    @empty
                        <p class="text-gray-500">No hay solicitudes rechazadas</p>
                    @endforelse
                </div>

            </article>

            <!-- Bloque de solicitudes recibidas -->
            <article class="bg-white shadow rounded-lg overflow-hidden">

                <header class="bg-gray-100 px-4 py-2">
                    <h2 class="font-semibold text-lg">Solicitudes recibidas</h2>
                </header>

                <!-- Pestañas para separar pendientes e histórico -->
                <div class="flex gap-4 px-4 pt-4 border-b">
                    <button onclick="mostrarTabRecibidas('rec-pendientes')" class="tab-btn">
                        Pendientes ({{ $recibidas->total() }})
                    </button>
                    <button onclick="mostrarTabRecibidas('rec-historico')" class="tab-btn">
                        Histórico ({{ $recibidasHistorico->total() }})
                    </button>
                </div>

                <!-- Solicitudes recibidas pendientes -->
                <div id="rec-pendientes" class="tab-content-rec p-4">

                    @forelse ($recibidas as $solicitud)

                        <div class="border-b py-3 flex justify-between items-center">

                            <div>
                                <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>

                                <div class="text-sm text-gray-600">
                                    {{ $solicitud->usuario->nombre }}
                                </div>
                            </div>

                            <!-- Acciones disponibles solo para pendientes -->
                            <div class="flex gap-4">

                                <form method="POST" action="{{ route('solicitudes.aceptar', $solicitud->id) }}">
                                    @csrf
                                    <button class="text-green-600 hover:underline font-semibold">
                                        Aceptar
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('solicitudes.rechazar', $solicitud->id) }}">
                                    @csrf
                                    <button class="text-red-600 hover:underline font-semibold">
                                        Rechazar
                                    </button>
                                </form>

                            </div>

                        </div>

                    @empty
                        <p class="text-gray-500">No tienes solicitudes pendientes</p>
                    @endforelse

                    <!-- Navegación de páginas -->
                    <div class="mt-4">
                        {{ $recibidas->links() }}
                    </div>

                </div>

                <!-- Histórico de solicitudes recibidas -->
                <div id="rec-historico" class="tab-content-rec p-4 hidden">

                    @forelse ($recibidasHistorico as $solicitud)

                        <div class="border-b py-3 flex justify-between items-center">

                            <div>
                                <strong>{{ $solicitud->publicacion->centroLibro->libro->titulo }}</strong>

                                <div class="text-sm text-gray-600">
                                    {{ $solicitud->usuario->nombre }}
                                </div>
                            </div>

                            <!-- Solo se muestra el estado, sin acciones -->
                            <div>
                                @if($solicitud->estado_id == 9)
                                    <span class="text-green-600 font-semibold">Aceptada</span>
                                @else
                                    <span class="text-red-600 font-semibold">Rechazada</span>
                                @endif
                            </div>

                        </div>

                    @empty
                        <p class="text-gray-500">No hay histórico</p>
                    @endforelse

                    <!-- Navegación de páginas -->
                    <div class="mt-4">
                        {{ $recibidasHistorico->links() }}
                    </div>

                </div>

            </article>

        </section>

        <br>

        <!-- Botón de vuelta al dashboard -->
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('dashboard') }}"
                   class="inline-block px-4 py-2 bg-[#FFC107] text-white rounded hover:opacity-90">
                    Volver
                </a>
            </div>
        </section>
    </main>

    <!-- Script para cambiar entre pestañas -->
    <script>
        function mostrarTab(tab) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(tab).classList.remove('hidden');
        }

        function mostrarTabRecibidas(tab) {
            document.querySelectorAll('.tab-content-rec').forEach(el => el.classList.add('hidden'));
            document.getElementById(tab).classList.remove('hidden');
        }
    </script>
</x-app-layout>
