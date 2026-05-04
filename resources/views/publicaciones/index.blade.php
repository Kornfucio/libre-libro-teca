<x-app-layout>
    @php
        // Función auxiliar para comprobar prefijos en rutas de imagen
        $startsWith = fn($text, $prefix) => str_starts_with($text, $prefix);
    @endphp

    <x-slot name="header">
        <header class="flex justify-between items-center">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Libros disponibles
            </h1>
            @auth
                <nav>
                    <!-- Acceso directo a crear nueva publicación -->
                    <a href="{{ route('publicaciones.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Publicar libro
                    </a>
                </nav>
            @endauth
        </header>
    </x-slot>

    <main class="py-6">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <article class="bg-white shadow rounded-lg overflow-hidden">

                <!-- Filtros por etapa, curso y asignatura -->
                <div class="p-4 border-b bg-gray-50">
                    <form method="GET" action="{{ route('publicaciones.index') }}" class="flex gap-2">

                        <!-- Selector de etapa -->
                        <select name="etapa_id" id="etapa" class="border p-2 rounded">
                            <option value="">Todas las etapas</option>
                            @foreach ($etapas as $etapa)
                                <option value="{{ $etapa->id }}"
                                    {{ request('etapa_id') == $etapa->id ? 'selected' : '' }}>
                                    {{ $etapa->nombre_etapa }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Selector de curso, dependiente de la etapa -->
                        <select name="curso_id" id="curso" class="border p-2 rounded">
                            <option value="">Todos los cursos</option>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" data-etapa="{{ $curso->etapa_id }}"
                                    {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nombre_curso }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Selector de asignatura -->
                        <select name="asignatura_id" class="border p-2 rounded">
                            <option value="">Todas las asignaturas</option>
                            @foreach ($asignaturas as $asignatura)
                                <option value="{{ $asignatura->id }}"
                                    {{ request('asignatura_id') == $asignatura->id ? 'selected' : '' }}>
                                    {{ $asignatura->asignatura }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Botón de búsqueda -->
                        <button class="bg-blue-500 text-white px-4 rounded">
                            Buscar
                        </button>

                        <!-- Botón para limpiar filtros -->
                        <a href="{{ route('publicaciones.index') }}"
                            class="bg-gray-300 px-4 rounded flex items-center">
                            Limpiar
                        </a>

                    </form>
                </div>

                <!-- Tabla de publicaciones -->
                <table class="min-w-full border border-gray-200">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Imagen</th>
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Autor</th>
                            <th class="px-4 py-2 text-left">Asignatura</th>
                            <th class="px-4 py-2 text-left">Curso</th>
                            <th class="px-4 py-2 text-left">Etapa</th>
                            <th class="px-4 py-2 text-left">Usuario</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($publicaciones as $publicacion)
                            <tr class="border-t hover:bg-gray-50">

                                <!-- Imagen del libro -->
                                <td class="px-4 py-2">
                                    <img src="{{ $publicacion->imagen
                                        ? (Str::startsWith($publicacion->imagen, 'publicaciones')
                                            ? asset('storage/' . $publicacion->imagen)
                                            : asset($publicacion->imagen))
                                        : asset('images/no-image.png') }}"
                                        class="w-16 h-16 object-cover rounded">
                                </td>

                                <!-- Título -->
                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->titulo ?? '-' }}
                                </td>

                                <!-- Autor -->
                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->autor ?? '-' }}
                                </td>

                                <!-- Asignatura -->
                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->asignatura->asignatura ?? '-' }}
                                </td>

                                <!-- Curso -->
                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->curso->nombre_curso ?? '-' }}
                                </td>

                                <!-- Etapa -->
                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->curso->etapa->nombre_etapa ?? '-' }}
                                </td>

                                <!-- Usuario que publica -->
                                <td class="px-4 py-2">
                                    @auth
                                        {{ $publicacion->usuario->nombre ?? '-' }}
                                    @endauth
                                    @guest
                                        Usuario anónimo
                                    @endguest
                                </td>

                                <!-- Acciones disponibles -->
                                <td class="px-4 py-2">
                                    <div class="flex flex-wrap gap-2">

                                        @auth
                                            <!-- VER -->
                                            <a href="{{ route('publicaciones.show', $publicacion->id) }}"
                                                class="px-2 py-1 text-xs bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                                                Ver
                                            </a>
                                        @endauth

                                        @guest
                                            <a href="{{ route('login') }}"
                                                class="px-2 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                                Inicia sesión
                                            </a>
                                        @endguest

                                        @auth
                                            @if ($publicacion->usuario_id === auth()->id())
                                                <!-- EDITAR -->
                                                <a href="{{ route('publicaciones.edit', $publicacion->id) }}"
                                                    class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200">
                                                    Editar
                                                </a>

                                                <!-- ELIMINAR -->
                                                <form method="POST"
                                                    action="{{ route('publicaciones.destroy', $publicacion->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200"
                                                        onclick="return confirm('¿Eliminar publicación?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @else
                                                @php
                                                    $solicitudUsuario = $publicacion->solicitudes
                                                        ->where('usuario_id', auth()->id())
                                                        ->first();
                                                @endphp

                                                @if (!$solicitudUsuario)
                                                    <!-- SOLICITAR -->
                                                    <form method="POST"
                                                        action="{{ route('solicitudes.store', $publicacion->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded hover:bg-green-200">
                                                            Solicitar
                                                        </button>
                                                    </form>
                                                @elseif($solicitudUsuario->estado_id == 8)
                                                    <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded">
                                                        Pendiente
                                                    </span>
                                                @elseif($solicitudUsuario->estado_id == 9)
                                                    <span class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded">
                                                        Aceptado
                                                    </span>
                                                @elseif($solicitudUsuario->estado_id == 10)
                                                    <form method="POST"
                                                        action="{{ route('solicitudes.store', $publicacion->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200">
                                                            Reintentar
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        @endauth

                                    </div>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                    No hay publicaciones disponibles
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>

            </article>

        </section>

        <br>

        <!-- Botón de vuelta según el tipo de usuario -->
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @auth
                <x-boton-volver />
            @else
                <a href="{{ route('home') }}"
                    class="inline-block px-4 py-2 bg-[#FFC107] text-white rounded hover:opacity-90">
                    Volver
                </a>
            @endauth
        </section>

    </main>
</x-app-layout>
