<h1>Libros</h1>

@foreach ($libros as $libro)
    <p>
        {{ $libro->titulo }} -
        {{ $libro->curso->nombre_curso }} -
        {{ $libro->asignatura->asignatura }}
    </p>
@endforeach
