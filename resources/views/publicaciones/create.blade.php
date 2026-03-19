<x-app-layout>
    <x-slot name="header">
        <h2>Publicar libro</h2>
    </x-slot>

    <form method="POST" action="{{ route('publicaciones.store') }}">
        @csrf

        <div>
            <label>Libro</label>
            <select name="centro_libro_id" required>
                @foreach ($centroLibros as $cl)
                    <option value="{{ $cl->id }}">
                        {{ $cl->libro->titulo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Descripción</label>
            <textarea name="descripcion"></textarea>
        </div>

        <button type="submit">Publicar</button>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="mb-4">
                    <a href="{{ route('publicaciones.index') }}" class="bg-gray-500 text-white px-3 py-2 rounded">
                        ← Volver
                    </a>
                </div>
    </form>
</x-app-layout>
