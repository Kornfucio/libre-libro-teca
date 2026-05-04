<x-app-layout>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <article class="bg-white shadow rounded-lg p-6">

                <!-- Título -->
                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    Asignar centros al libro
                </h2>

                <!-- Información del libro -->
                <div class="mb-6 p-4 bg-gray-100 rounded">
                    <p><strong>Título:</strong> {{ $libro->titulo }}</p>
                    <p><strong>Autor:</strong> {{ $libro->autor ?? '—' }}</p>
                    <p><strong>Curso:</strong> {{ $libro->curso->nombre_curso ?? '—' }}</p>
                    <p><strong>Asignatura</strong> {{ $libro->asignatura->asignatura ?? '-' }}</p>
                </div>

                <!-- Validación de errores -->
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulario -->
                <form method="POST" action="{{ route('admin.libros.guardarAsignacion', $libro->id) }}">
                    @csrf

                    <!-- Listado de centros -->
                    <div class="mb-6">

                        <p class="font-semibold mb-2">Selecciona los centros:</p>

                        <div class="grid grid-cols-2 gap-2">

                            @foreach($centros as $centro)
                                <label class="flex items-center space-x-2 bg-gray-50 p-2 rounded hover:bg-gray-100">

                                    <!-- Checkbox -->
                                    <input type="checkbox"
                                           name="centros[]"
                                           value="{{ $centro->id }}"


                                           @if($libro->centros->contains($centro->id)) checked @endif
                                    >

                                    <!-- Nombre del centro -->
                                    <span>{{ $centro->nombre_centro }}</span>

                                </label>
                            @endforeach

                        </div>

                    </div>

                    <!-- Botones -->
                    <div class="flex justify-between">

                        <!-- Volver -->
                        <a href="{{ route('admin.libros.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                            ← Volver
                        </a>

                        <!-- Guardar -->
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Guardar asignaciones
                        </button>

                    </div>

                </form>

            </article>

        </section>
    </main>

</x-app-layout>
