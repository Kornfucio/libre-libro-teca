<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Detalle del libro</h2>
    </x-slot>

    <main class="py-6">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">

            <!-- IMAGEN -->
            <div class="mb-4">
                @if ($publicacion->imagen)
                    <img src="{{ asset('storage/' . $publicacion->imagen, 'publicaciones')}}"
                        class="w-48 h-48 object-cover rounded">
                @else
                    <img src="{{ asset('images/no-image.jpg') }}" class="w-48 h-48 object-cover rounded">
                @endif
            </div>

            <!-- INFO LIBRO -->
            <h2 class="text-2xl font-bold mb-2">
                {{ $publicacion->centroLibro->libro->titulo }}
            </h2>

            <p><strong>Autor:</strong> {{ $publicacion->centroLibro->libro->autor }}</p>
            <p><strong>Curso:</strong> {{ $publicacion->centroLibro->libro->curso->numero }}</p>
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

                <a href="{{ route('publicaciones.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                    Volver
                </a>

                @auth
                    @if($publicacion->usuario_id != auth()->id())
                        <form method="POST" action="{{ route('solicitudes.store', $publicacion->id) }}">
                            @csrf
                            <button class="px-4 py-2 bg-green-600 text-white rounded">
                                Solicitar intercambio
                            </button>
                        </form>
                    @endif
                @endauth

            </div>
            <br>
            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4">
                    <a href="{{ route('dashboard') }}"
                        class="inline-block px-4 py-2 bg-[#FFC107] text-white rounded hover:opacity-90">
                        Volver
                    </a>
                </div>
            </section>
        </div>
    </main>
</x-app-layout>
