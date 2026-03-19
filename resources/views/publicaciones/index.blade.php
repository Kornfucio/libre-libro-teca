<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Libros disponibles
        </h2>

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('publicaciones.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                    + Publicar libro
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
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
                            <tr class="border-t">
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
                                    {{ $publicacion->usuario->nombre ?? '-' }}
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('publicaciones.show', $publicacion->id) }}"
                                        class="text-blue-600 hover:underline">
                                        Ver
                                    </a>

                                    @if($publicacion->usuario_id == auth()->id())
                                        <a href="{{ route('publicaciones.edit', $publicacion->id) }}">
                                            Editar
                                        </a>

                                        <form method="POST" action="{{ route('publicaciones.destroy', $publicacion->id) }}"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">
                                    No hay publicaciones disponibles
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
