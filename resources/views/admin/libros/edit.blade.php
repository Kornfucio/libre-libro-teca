<x-app-layout>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjeta principal -->
            <article class="bg-white shadow rounded-lg p-6">

                <!-- Título -->
                <h2 class="text-xl font-semibold text-gray-800 mb-6">
                    Editar libro
                </h2>

                <!-- Mostrar errores de validación -->
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
                <form method="POST" action="{{ route('admin.libros.update', $libro->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Campo título -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Título</label>
                        <input type="text" name="titulo"
                               value="{{ old('titulo', $libro->titulo) }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Campo autor -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Autor</label>
                        <input type="text" name="autor"
                               value="{{ old('autor', $libro->autor) }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Campo ISBN -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">ISBN</label>
                        <input type="text" name="isbn"
                               value="{{ old('isbn', $libro->isbn) }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Campo curso -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Curso</label>
                        <select name="curso_id" class="w-full border p-2 rounded">
                            <option value="">Seleccione un curso</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}"
                                    {{ old('curso_id', $libro->curso_id) == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nombre_curso }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo asignatura -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Asignatura</label>
                        <select name="asignatura_id" class="w-full border p-2 rounded">
                            <option value="">Seleccione una asignatura</option>
                            @foreach($asignaturas as $asignatura)
                                <option value="{{ $asignatura->id }}"
                                    {{ old('asignatura_id', $libro->asignatura_id) == $asignatura->id ? 'selected' : '' }}>
                                    {{ $asignatura->asignatura }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo editorial -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Editorial</label>
                        <input type="text" name="editorial"
                               value="{{ old('editorial', $libro->editorial) }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Estado del libro -->
                    <div class="mb-6">
                        <label class="block font-medium mb-1">Estado</label>
                        <select name="estado_id" class="w-full border p-2 rounded">
                            <option value="1" {{ $libro->estado_id == 1 ? 'selected' : '' }}>
                                Activo
                            </option>
                            <option value="2" {{ $libro->estado_id == 2 ? 'selected' : '' }}>
                                Inactivo
                            </option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-between">

                        <!-- Botón volver -->
                        <x-boton-volver />

                        <!-- Botón guardar -->
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Actualizar libro
                        </button>

                    </div>

                </form>

            </article>

        </section>
    </main>

</x-app-layout>
