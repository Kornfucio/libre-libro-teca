<x-app-layout>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjeta principal -->
            <article class="bg-white shadow rounded-lg p-6">

                <!-- Cabecera -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">
                        Catálogo de libros
                    </h2>
                </div>
                <div class="flex justify-start mb-4">
                    <!-- Botón crear -->
                    <a href="{{ route('admin.libros.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nuevo libro
                    </a>
                </div>

                <!-- Mensaje de éxito -->
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tabla -->
                <table class="w-full border border-gray-300 text-sm">

                    <!-- Cabecera tabla -->
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3 border">Título</th>
                            <th class="p-3 border">Autor</th>
                            <th class="p-3 border">Curso</th>
                            <th class="p-3 border">Asignatura</th>
                            <th class="p-3 border">Estado</th>
                            <th class="p-3 border">Acciones</th>
                        </tr>
                    </thead>

                    <!-- Cuerpo -->
                    <tbody>
                        @forelse($libros as $libro)
                            <tr class="text-center">

                                <!-- Título -->
                                <td class="p-3 border">
                                    {{ $libro->titulo }}
                                </td>

                                <!-- Autor -->
                                <td class="p-3 border">
                                    {{ $libro->autor ?? '—' }}
                                </td>

                                <!-- Curso -->
                                <td class="p-3 border">
                                    {{ $libro->curso->nombre_curso ?? '—' }}
                                </td>

                                <!-- Asignatura -->
                                <td class="p-3 border">
                                    {{ $libro->asignatura->asignatura ?? '—' }}
                                </td>

                                <!-- Estado -->
                                <td class="p-3 border">
                                    @if($libro->estado_id == 1)
                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">
                                            Activo
                                        </span>
                                    @else
                                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <!-- Acciones -->
                                <td class="p-3 border space-x-2">
                                <div class="flex flex-col gap-2 items-center">

                                     <div class="flex gap-2"></div>
                                    <!-- VER -->
                                    <a href="{{ route('admin.libros.show', $libro->id) }}"
                                        class="px-3 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                        Ver
                                    </a>

                                    <!-- EDITAR -->
                                    <a href="{{ route('admin.libros.edit', $libro->id) }}"
                                        class="px-3 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                        Editar
                                    </a>

                                    <!-- ASIGNAR -->
                                    @if($libro->estado_id == 1)
                                        <a href="{{ route('admin.libros.asignar', $libro->id) }}"
                                            class="px-3 py-1 text-xs bg-green-500 text-white rounded hover:bg-green-600 transition">
                                            Asignar
                                        </a>
                                    @endif

                                    <!-- DESACTIVAR -->
                                    @if($libro->estado_id == 1)
                                        <form method="POST" action="{{ route('admin.libros.destroy', $libro->id) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-3 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600 transition"
                                                onclick="return confirm('¿Desactivar libro?')">
                                                Desactivar
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-xs">Inactivo</span>
                                    @endif
                                    </div>
                                </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">
                                    No hay libros registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

                <!-- Paginación -->
                <div class="mt-4">
                    {{ $libros->links() }}
                </div>

            </article>

        </section>
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-boton-volver />
        </section>
    </main>

</x-app-layout>
