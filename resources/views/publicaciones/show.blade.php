<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Detalle del libro</h2>
    </x-slot>

    <main class="py-6">


        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

            <!-- IMAGEN -->
            <div class="mb-4">
                @if ($publicacion->imagen)
                            <!-- Si la imagen es una ruta de almacenamiento, usar asset('storage/'), si es una URL completa, usarla directamente -->
                            <img src="{{ Str::startsWith($publicacion->imagen, 'publicaciones')
                    ? asset('storage/' . $publicacion->imagen)
                    : asset($publicacion->imagen) }}" class="w-48 h-48 object-cover rounded">
                @else
                    <img src="{{ asset('images/no-image.jpg') }}" class="w-48 h-48 object-cover rounded">
                @endif
            </div>

            <!-- INFO LIBRO -->
            <h2 class="text-2xl font-bold mb-2">
                {{ $publicacion->centroLibro->libro->titulo }}
            </h2>

            <p><strong>Autor:</strong> {{ $publicacion->centroLibro->libro->autor }}</p>
            <p><strong>Curso:</strong> {{ $publicacion->centroLibro->libro->curso->nombre_curso }}</p>
            <p><strong>Asignatura:</strong> {{ $publicacion->centroLibro->libro->asignatura->asignatura }}</p>

            <!-- DESCRIPCIÓN -->
            <div class="mt-4">
                <p><strong>Descripción:</strong></p>
                <p>{{ $publicacion->descripcion }}</p>
            </div>

            <!-- USUARIO -->
            <div class="mt-4">
                <p><strong>Publicado por:</strong> {{ $publicacion->usuario->nombre }}</p>
            </div>

            <!-- BOTONES -->
            <div class="mt-6 flex gap-4">

                <x-boton-volver :ruta="route('publicaciones.mias')" />

                @auth
                    @if($publicacion->usuario_id != auth()->id())

                        @if(!$solicitudUsuario)
                            <form method="POST" action="{{ route('solicitudes.store', $publicacion->id) }}">
                                @csrf
                                <button class="inline-block px-4 py-2 bg-orange-500 text-white rounded hover:opacity-90">
                                    Solicitar intercambio
                                </button>
                            </form>

                        @elseif($solicitudUsuario->estado === 8)
                            <span class="px-4 py-2 bg-yellow-400 text-white rounded">
                                Solicitud pendiente
                            </span>

                        @elseif($solicitudUsuario->estado === 9)
                            <span class="px-4 py-2 bg-green-500 text-white rounded">
                                Intercambio ya aceptado
                            </span>

                        @elseif($solicitudUsuario->estado === 10)
                            <form method="POST" action="{{ route('solicitudes.store', $publicacion->id) }}">
                                @csrf
                                <button class="inline-block px-4 py-2 bg-red-500 text-white rounded hover:opacity-90">
                                    Volver a solicitar
                                </button>
                            </form>
                        @endif

                    @endif
                @endauth

            </div>
            <br>
        </div>
    </main>
</x-app-layout>
