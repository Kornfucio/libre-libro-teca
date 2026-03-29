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

            <!-- 🔔 MENSAJES -->
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

            <!-- 🔵 SOLICITUDES ENVIADAS -->
            <article class="bg-white shadow rounded-lg overflow-hidden">
                <header class="bg-gray-100 px-4 py-2">
                    <h2 class="font-semibold text-lg">Mis solicitudes</h2>
                </header>

                <table class="min-w-full border border-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Libro</th>
                            <th class="px-4 py-2 text-left">Propietario</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($enviadas as $solicitud)
                            <tr class="border-t hover:bg-gray-50">
                                <td class="px-4 py-2">
                                    {{ $solicitud->publicacion->centroLibro->libro->titulo ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $solicitud->publicacion->usuario->nombre ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    @php
                                        $estado = strtolower($solicitud->estado->nombre ?? 'pendiente');
                                    @endphp

                                    <span class="
                                            px-2 py-1 rounded text-sm font-semibold
                                            @if($estado == 'pendiente') bg-yellow-100 text-yellow-800
                                            @elseif($estado == 'aceptada') bg-green-100 text-green-800
                                            @elseif($estado == 'rechazada') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif
                                        ">
                                        {{ ucfirst($estado) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-gray-500">
                                    No has realizado solicitudes
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </article>

            <!-- 🟣 SOLICITUDES RECIBIDAS -->
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
                            <tr class="border-t hover:bg-gray-50">

                                <td class="px-4 py-2">
                                    {{ $solicitud->publicacion->centroLibro->libro->titulo ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $solicitud->usuario->nombre ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    @php
                                        $estado = strtolower($solicitud->estado->nombre ?? 'pendiente');
                                    @endphp

                                    <span class="
                                            px-2 py-1 rounded text-sm font-semibold
                                            @if($estado == 'pendiente') bg-yellow-100 text-yellow-800
                                            @elseif($estado == 'aceptada') bg-green-100 text-green-800
                                            @elseif($estado == 'rechazada') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800
                                            @endif
                                        ">
                                        {{ ucfirst($estado) }}
                                    </span>
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
</x-app-layout>
