<x-app-layout>
    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('publicaciones.create') }}"
                    class="inline-block px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                    + Publicar libro
                </a>
            </div>
            <h1 class="font-semibold text-xl">Mis publicaciones</h1>

            <article class="bg-white shadow rounded-lg overflow-hidden">

                <table class="min-w-full border border-gray-200">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Autor</th>
                            <th class="px-4 py-2 text-left">Asignatura</th>
                            <th class="px-4 py-2 text-left">Curso</th>
                            <th class="px-4 py-2 text-left">Estado</th>
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

                                <td class="px-4 py-2">
                                    @if($publicacion->estado_id == 3)
                                        <span class="text-green-600 font-semibold">Publicada</span>
                                    @elseif($publicacion->estado_id == 12)
                                        <span class="text-red-600 font-semibold">Eliminada</span>
                                    @elseif($publicacion->estado_id == 4)
                                        <span class="text-gray-600 font-semibold">Intercambiada</span>
                                    @elseif($publicacion->estado_id == 8)
                                        <span class="text-orange-600 font-semibold">Pendiente</span>
                                    @elseif($publicacion->estado_id == 9)
                                        <span class="text-green-600 font-semibold">Aceptada</span>
                                    @elseif($publicacion->estado_id == 3)
                                        <span class="text-yellow-600 font-semibold">Despublicado</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex flex-wrap gap-2">

                                        <!-- VER -->
                                        <a href="{{ route('publicaciones.show', ['id' => $publicacion->id, 'from' => 'mias']) }}"
                                            class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                            Ver
                                        </a>

                                        <!-- EDITAR -->
                                        <a href="{{ route('publicaciones.edit', $publicacion->id) }}"
                                            class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">
                                            Editar
                                        </a>

                                        <!-- ELIMINAR -->
                                        <form method="POST" action="{{ route('publicaciones.destroy', $publicacion->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600 transition"
                                                onclick="return confirm('¿Eliminar publicación?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
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
            <x-boton-volver />
        </section>
    </main>
</x-app-layout>
