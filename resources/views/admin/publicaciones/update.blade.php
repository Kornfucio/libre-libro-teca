<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar publicación
        </h2>
    </x-slot>

    <main class="py-6">
        <section class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6 space-y-6">

            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulario -->
            <form action="{{ route('admin.publicaciones.update', $publicacion->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- DESCRIPCIÓN -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Descripción
                    </label>

                    <!-- Aquí el admin puede corregir textos inapropiados -->
                    <textarea
                        name="descripcion"
                        rows="5"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200"
                    >{{ old('descripcion', $publicacion->descripcion) }}</textarea>
                </div>

                <!-- ESTADO -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Estado
                    </label>

                    <select
                        name="estado_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                    >
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}"
                                {{ $publicacion->estado_id == $estado->id ? 'selected' : '' }}>
                                {{ $estado->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- IMAGEN ACTUAL -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Imagen actual
                    </label>

                    @if($publicacion->imagen)
                        <img
                            src="{{ asset('storage/' . $publicacion->imagen) }}"
                            alt="Imagen publicación"
                            class="w-40 h-auto rounded shadow"
                        >
                    @else
                        <p class="text-gray-500">No hay imagen</p>
                    @endif
                </div>

                <!-- NUEVA IMAGEN -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Cambiar imagen
                    </label>

                    <input
                        type="file"
                        name="imagen"
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                    >
                </div>

                <!-- BOTONES -->
                <div class="flex justify-between items-center pt-4">

                    <a href="{{ route('admin.publicaciones.index') }}"
                       class="text-gray-600 hover:underline">
                        Volver
                    </a>

                    <button
                        type="submit"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    >
                        Guardar cambios
                    </button>

                </div>

            </form>

        </section>
    </main>
</x-app-layout>
