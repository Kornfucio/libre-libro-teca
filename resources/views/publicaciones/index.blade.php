<x-app-layout>
    @php
        $startsWith = fn($text, $prefix) => str_starts_with($text, $prefix);
    @endphp

    <x-slot name="header">
        <header class="flex justify-between items-center">
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Libros disponibles
            </h1>

            <nav>
                <a href="{{ route('publicaciones.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    + Publicar libro
                </a>
            </nav>
        </header>
    </x-slot>

    <main class="py-6">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <article class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full border border-gray-200">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Imagen</th>
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Autor</th>
                            <th class="px-4 py-2 text-left">Asignatura</th>
                            <th class="px-4 py-2 text-left">Curso</th>
                            <th class="px-4 py-2 text-left">Usuario</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($publicaciones as $publicacion)
                                            <tr class="border-t hover:bg-gray-50">

                                                <!-- IMAGEN -->
                                                <td class="px-4 py-2">
                                                    <img src="{{ $publicacion->imagen
                            ? (Str::startsWith($publicacion->imagen, 'publicaciones')
                                ? asset('storage/' . $publicacion->imagen)
                                : asset($publicacion->imagen))
                            : asset('images/no-image.png') }}" class="w-16 h-16 object-cover rounded"
                                                        alt="Imagen libro">
                                                </td>

                                                <!-- TÍTULO -->
                                                <td class="px-4 py-2">
                                                    {{ $publicacion->centroLibro->libro->titulo ?? '-' }}
                                                </td>

                                                <!-- AUTOR -->
                                                <td class="px-4 py-2">
                                                    {{ $publicacion->centroLibro->libro->autor ?? '-' }}
                                                </td>

                                                <!-- ASIGNATURA -->
                                                <td class="px-4 py-2">
                                                    {{ $publicacion->centroLibro->libro->asignatura->asignatura ?? '-' }}
                                                </td>

                                                <!-- CURSO -->
                                                <td class="px-4 py-2">
                                                    {{ $publicacion->centroLibro->libro->curso->numero ?? '-' }}
                                                </td>

                                                <!-- USUARIO -->
                                                <td class="px-4 py-2">
                                                    {{ $publicacion->usuario->nombre ?? '-' }}
                                                </td>

                                                <!-- ACCIONES -->
                                                <td class="px-4 py-2 space-x-2">

                                                    <!-- Ver -->
                                                    <a href="{{ route('publicaciones.show', $publicacion->id) }}"
                                                        class="text-blue-600 hover:underline">
                                                        Ver
                                                    </a>

                                                    @auth
                                                        @if($publicacion->usuario_id == auth()->id())

                                                            <!-- Editar -->
                                                            <a href="{{ route('publicaciones.edit', $publicacion->id) }}"
                                                                class="text-yellow-600 hover:underline">
                                                                Editar
                                                            </a>

                                                            <!-- Eliminar -->
                                                            <form method="POST" action="{{ route('publicaciones.destroy', $publicacion->id) }}"
                                                                class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-600 hover:underline"
                                                                    onclick="return confirm('¿Seguro que quieres eliminar esta publicación?')">
                                                                    Eliminar
                                                                </button>
                                                            </form>

                                                        @else

                                                            <!-- SOLICITAR -->
                                                            <form method="POST" action="{{ route('solicitudes.store', $publicacion->id) }}"
                                                                class="inline">
                                                                @csrf
                                                                <button type="submit" class="text-green-600 hover:underline">
                                                                    Solicitar
                                                                </button>
                                                            </form>

                                                        @endif
                                                    @endauth

                                                </td>
                                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-500">
                                    No hay publicaciones disponibles
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
