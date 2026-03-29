<x-app-layout>
    <x-slot name="header">
        <header class="bg-[#1E88C8] text-white p-4 rounded">
            <h1 class="font-semibold text-xl">
                Mis publicaciones
            </h1>
        </header>
    </x-slot>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('publicaciones.create') }}"
                    class="inline-block px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                    + Publicar libro
                </a>
            </div>

            <article class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full border border-gray-200">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Autor</th>
                            <th class="px-4 py-2 text-left">Asignatura</th>
                            <th class="px-4 py-2 text-left">Curso</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($publicaciones as $publicacion)
                            <tr class="border-t hover:bg-gray-50">

                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->titulo ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->autor ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->asignatura->asignatura ?? '-' }}
                                </td>

                                <td class="px-4 py-2">
                                    {{ $publicacion->centroLibro->libro->curso->numero ?? '-' }}
                                </td>

                                <td class="px-4 py-2 space-x-2">

                                    <!-- VER -->
                                    <a href="{{ route('publicaciones.show', $publicacion->id) }}"
                                        class="px-2 py-1 bg-blue-500 text-white rounded">
                                        Ver
                                    </a>

                                    <!-- EDITAR -->
                                    <a href="{{ route('publicaciones.edit', $publicacion->id) }}"
                                        class="px-2 py-1 bg-yellow-500 text-white rounded">
                                        Editar
                                    </a>

                                    <!-- ELIMINAR -->
                                    <form method="POST" action="{{ route('publicaciones.destroy', $publicacion->id) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-2 py-1 bg-red-500 text-white rounded"
                                            onclick="return confirm('¿Eliminar publicación?')">
                                            Eliminar
                                        </button>
                                    </form>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                    No tienes publicaciones
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
