<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">

        </h2>
    </x-slot>

    <main class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-4">Gestión de publicaciones</h1>
        </div>
        <section class="max-w-7xl mx-auto bg-white shadow rounded-lg p-6">

            <!-- Mensaje éxito -->
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- FILTROS -->
            <form method="GET" action="{{ route('admin.publicaciones.index') }}"
                class="mb-4 flex flex-wrap gap-4 items-end">

                <!-- Filtro por usuario (texto libre) -->
                <div>
                    <label class="block text-sm font-medium">Usuario</label>
                    <input type="text" name="usuario" value="{{ request('usuario') }}" class="border rounded px-2 py-1"
                        placeholder="Buscar usuario">
                </div>

                <!-- Filtro por estado (usando ID correctamente) -->
                <div>
                    <label class="block text-sm font-medium">Estado</label>
                    <select name="estado" class="border rounded px-2 py-1">

                        <option value="">Todos</option>

                        <option value="3" {{ request('estado') == 3 ? 'selected' : '' }}>
                            Publicado
                        </option>

                        <option value="5" {{ request('estado') == 5 ? 'selected' : '' }}>
                            Despublicado
                        </option>

                        <option value="7" {{ request('estado') == 7 ? 'selected' : '' }}>
                            Reservado
                        </option>

                        <option value="6" {{ request('estado') == 6 ? 'selected' : '' }}>
                            Disponible
                        </option>

                        <option value="12" {{ request('estado') == 12 ? 'selected' : '' }}>
                            Eliminada
                        </option>

                    </select>
                </div>

                <!-- Botón buscar -->
                <div class="mt-5">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Buscar
                    </button>
                </div>

                <!-- Limpiar -->
                <div class="mt-5">
                    <a href="{{ route('admin.publicaciones.index') }}"
                        class="bg-gray-300 px-4 py-2 rounded flex items-center">
                        Limpiar
                    </a>
                </div>

            </form>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200">

                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="p-3 border">ID</th>
                            <th class="p-3 border">Usuario</th>
                            <th class="p-3 border">Descripción</th>
                            <th class="p-3 border">Estado</th>
                            <th class="p-3 border">Imagen</th>
                            <th class="p-3 border text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($publicaciones as $publicacion)
                            <tr class="hover:bg-gray-50">

                                <!-- ID -->
                                <td class="p-3 border">
                                    {{ $publicacion->id }}
                                </td>

                                <!-- Usuario -->
                                <td class="p-3 border">
                                    {{ $publicacion->usuario->nombre ?? 'N/A' }}
                                </td>

                                <!-- Descripción -->
                                <td class="p-3 border max-w-xs truncate">
                                    {{ $publicacion->descripcion }}
                                </td>

                                <!-- Estado -->
                                <td class="p-3 border">
                                    <span class="px-2 py-1 rounded text-white text-sm
                                                                            @if($publicacion->estado && $publicacion->estado->nombre_estado == 'publicado') bg-green-500
                                                                             @elseif($publicacion->estado && $publicacion->estado->nombre_estado == 'eliminada') bg-red-500
                                                                            @elseif($publicacion->estado && $publicacion->estado->nombre_estado == 'reservado') bg-yellow-500
                                                                            @elseif($publicacion->estado && $publicacion->estado->nombre_estado == 'despublicado') bg-gray-500
                                                                             @endif
                                                                            ">
                                        {{ $publicacion->estado->nombre_estado ?? 'Sin estado' }}
                                    </span>
                                </td>

                                <!-- Imagen -->
                                <td class="p-3 border">
                                    @if($publicacion->imagen)
                                        <img src="{{ asset('storage/' . $publicacion->imagen) }}"
                                            class="w-16 h-16 object-cover rounded">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}"
                                            class="w-16 h-16 object-cover rounded opacity-50">
                                    @endif
                                </td>

                                <!-- Acciones -->
                                <td class="p-3 border text-center space-x-2">

                                    <!-- Editar -->
                                    <a href="{{ route('admin.publicaciones.edit', $publicacion->id) }}"
                                        class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                        Editar
                                    </a>

                                    <!-- Eliminar (cambio de estado) -->
                                    <form action="{{ route('admin.publicaciones.destroy', $publicacion->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('¿Seguro que quieres eliminar esta publicación?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Eliminar
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4 text-gray-500">
                                    No hay publicaciones
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
                <div class="mt-4">
                    {{ $publicaciones->links() }}
                </div>
            </div>

        </section>
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-boton-volver />
        </section>
    </main>
</x-app-layout>
