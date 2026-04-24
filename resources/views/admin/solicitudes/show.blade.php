<x-app-layout>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6 space-y-4">

                <!-- Información del libro -->
                <div>
                    <h3 class="font-semibold text-lg">Libro</h3>
                    <p><strong>Título:</strong> {{ $solicitud->publicacion->centroLibro->libro->titulo ?? 'N/A' }}</p>
                </div>

                <!-- Información del publicador -->
                <div>
                    <h3 class="font-semibold text-lg">Usuario publicador</h3>
                    <p><strong>Nombre:</strong> {{ $solicitud->publicacion->usuario->nombre ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $solicitud->publicacion->usuario->email ?? 'N/A' }}</p>
                </div>

                <!-- Información del solicitante -->
                <div>
                    <h3 class="font-semibold text-lg">Usuario solicitante</h3>
                    <p><strong>Nombre:</strong> {{ $solicitud->usuario->nombre ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $solicitud->usuario->email ?? 'N/A' }}</p>
                </div>

                <!-- Centro educativo -->
                <div>
                    <h3 class="font-semibold text-lg">Centro educativo</h3>
                    <p>{{ $solicitud->publicacion->centroLibro->centro->nombre_centro ?? 'N/A' }}</p>
                </div>

                <!-- Estado -->
                <div>
                    <h3 class="font-semibold text-lg">Estado</h3>
                    <span class="px-2 py-1 rounded text-white
                        @if($solicitud->estado_id == 8) bg-yellow-500
                        @elseif($solicitud->estado_id == 9) bg-green-500
                        @else bg-red-500
                        @endif
                    ">
                        {{ $solicitud->estado->nombre_estado ?? 'Sin estado' }}
                    </span>
                </div>

                <!-- Fecha -->
                <div>
                    <h3 class="font-semibold text-lg">Fecha de solicitud</h3>
                    <p>{{ $solicitud->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <!-- Acciones -->
                <div class="pt-4">

                    <!-- Volver -->
                    <a href="{{ route('admin.solicitudes.index') }}"
                       class="px-4 py-2 bg-gray-300 rounded">
                        Volver
                    </a>

                    <!-- Cancelar solo si está pendiente -->
                    @if($solicitud->estado_id == 8)
                        <form method="POST"
                              action="{{ route('admin.solicitudes.cancelar', $solicitud->id) }}"
                              class="inline-block ml-2">
                            @csrf
                            @method('PATCH')

                            <button class="px-4 py-2 bg-red-500 text-white rounded"
                                    onclick="return confirm('¿Cancelar solicitud?')">
                                Cancelar solicitud
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
