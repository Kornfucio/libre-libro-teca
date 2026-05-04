<x-app-layout>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjeta principal -->
            <article class="bg-white shadow rounded-lg p-6">

                <!-- Título -->
                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    Detalle del libro
                </h2>

                <!-- Datos del libro -->
                <div class="mb-6 bg-gray-100 p-4 rounded space-y-2">

                    <p><strong>Título:</strong> {{ $libro->titulo }}</p>
                    <p><strong>Autor:</strong> {{ $libro->autor ?? '—' }}</p>
                    <p><strong>ISBN:</strong> {{ $libro->ISBN ?? '—' }}</p>
                    <p><strong>Curso:</strong> {{ $libro->curso->nombre_curso ?? '—' }}</p>
                    <p><strong>Asignatura:</strong> {{ $libro->asignatura->asignatura ?? '—' }}</p>
                    <p><strong>Editorial:</strong> {{ $libro->editorial ?? '—' }}</p>

                    <!-- Estado -->
                    <p>
                        <strong>Estado:</strong>
                        @if($libro->estado_id == 1)
                            <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                Activo
                            </span>
                        @else
                            <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                                Inactivo
                            </span>
                        @endif
                    </p>

                </div>

                <!-- Asignaciones a centros -->
                <h3 class="text-lg font-semibold text-gray-700 mb-3">
                    Centros asignados
                </h3>

                <table class="w-full border border-gray-300 text-sm mb-6">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border">Centro</th>
                            <th class="p-3 border">Estado del centro</th>
                            <th class="p-3 border">Año académico</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($asignaciones as $asignacion)
                            <tr class="text-center">

                                <!-- Nombre del centro -->
                                <td class="p-3 border">
                                    {{ $asignacion->centro->nombre_centro ?? '—' }}
                                </td>

                                <!-- Estado del centro -->
                                <td class="p-3 border">
                                    @if(optional($asignacion->centro)->estado_id == 1)
                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                            Activo
                                        </span>
                                    @else
                                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <!-- Año académico -->
                                <td class="p-3 border">
                                    {{ $asignacion->anyo_academico ?? '—' }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-4 text-center text-gray-500">
                                    Este libro no está asignado a ningún centro
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                <!-- Acciones -->
                <div class="flex justify-between">

                    <!-- Volver -->
                    <a href="{{ route('admin.libros.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        ← Volver
                    </a>

                    <!-- Botones acción -->
                    <div class="space-x-2">

                        <!-- Editar -->
                        <a href="{{ route('admin.libros.edit', $libro->id) }}"
                           class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Editar
                        </a>

                        <!-- Asignar centros -->
                        @if($libro->estado_id == 1)
                            <a href="{{ route('admin.libros.asignar', $libro->id) }}"
                               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Asignar centros
                            </a>
                        @endif

                    </div>

                </div>

            </article>

        </section>
    </main>

</x-app-layout>
