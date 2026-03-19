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
    </form>
</x-app-layout>

