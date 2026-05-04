<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Solicitudes de intercambio</h1>
            <div class="bg-white shadow rounded-lg p-6">

                <!-- Tabla de solicitudes de intercambio -->
                <table class="w-full border border-gray-300 text-sm">

                    <!-- Cabecera -->
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Libro</th>
                            <th class="p-2 border">Publicador</th>
                            <th class="p-2 border">Solicitante</th>
                            <th class="p-2 border">Centro</th>
                            <th class="p-2 border">Estado</th>
                            <th class="p-2 border">Fecha solicitud</th>
                            <th class="p-2 border">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($solicitudes as $solicitud)

                            @php
                                // Determinamos el color del estado para evitar lógica dentro del class
                                $colores = [
                                    8 => 'bg-yellow-500', // pendiente
                                    9 => 'bg-orange-500',  // aceptada
                                    11 => 'bg-green-500',   // completada
                                    13 => 'bg-red-500',    // cancelada

                                ];

                                $color = $colores[$solicitud->estado_id] ?? 'bg-red-500';
                            @endphp

                            <tr class="text-center">

                                <!-- Libro -->
                                <td class="p-2 border">
                                    {{ $solicitud->publicacion->centroLibro->libro->titulo ?? 'N/A' }}
                                </td>

                                <!-- Publicador -->
                                <td class="p-2 border">
                                    {{ $solicitud->publicacion->usuario->nombre ?? 'N/A' }}
                                </td>

                                <!-- Solicitante -->
                                <td class="p-2 border">
                                    {{ $solicitud->usuario->nombre ?? 'N/A' }}
                                </td>

                                <!-- Centro -->
                                <td class="p-2 border">
                                    {{ $solicitud->publicacion->centroLibro->centro->nombre_centro ?? 'N/A' }}
                                </td>

                                <!-- Estado -->
                                <td class="p-2 border">
                                    <span class="px-2 py-1 rounded text-white {{ $color }}">
                                        {{ $solicitud->estado->nombre_estado ?? 'Sin estado' }}
                                    </span>
                                </td>

                                <!-- Fecha -->
                                <td class="p-2 border">
                                    {{ $solicitud->created_at->format('d/m/Y h:m') }}
                                </td>

                                <!-- Acciones -->
                                <td class="p-2 border text-center">

                                    <div class="flex justify-center items-center gap-2 flex-wrap">

                                        <!-- Ver -->
                                        <a href="{{ route('admin.solicitudes.show', $solicitud->id) }}"
                                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            Ver
                                        </a>

                                        <!-- Cancelar -->
                                        @if($solicitud->estado_id == 8)
                                            <form method="POST"
                                                action="{{ route('admin.solicitudes.cancelar', $solicitud->id) }}"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')

                                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                                                    onclick="return confirm('¿Cancelar solicitud?')">
                                                    Cancelar
                                                </button>
                                            </form>
                                        @endif

                                        <!-- Finalizar -->
                                        @if($solicitud->estado_id == 9)
                                            <form method="POST"
                                                action="{{ route('admin.solicitudes.finalizar', $solicitud->id) }}"
                                                class="inline">
                                                @csrf
                                                @method('PATCH')

                                                <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600"
                                                    onclick="return confirm('¿Confirmar que el intercambio se ha realizado?')">
                                                    Finalizar
                                                </button>
                                            </form>
                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center">
                                    No hay solicitudes registradas
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $solicitudes->links() }}
                </div>

            </div>
        </div>
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-boton-volver />
        </section>
    </div>

</x-app-layout>
