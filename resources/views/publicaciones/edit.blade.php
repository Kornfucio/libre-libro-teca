<x-app-layout>
    <x-slot name="header">
        <h2>Editar publicación</h2>
    </x-slot>

    <form method="POST" action="{{ route('publicaciones.update', $publicacion->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Descripción</label>
            <textarea name="descripcion">{{ $publicacion->descripcion }}</textarea>
        </div>

        <button type="submit">Actualizar</button>
    </form>
</x-app-layout>

