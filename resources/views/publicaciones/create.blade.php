<x-app-layout>
    <x-slot name="header">
        <header class="bg-[#1E88C8] text-white p-4 rounded">
            <h1 class="font-semibold text-xl">
                Publicar libro
            </h1>
        </header>
    </x-slot>

    <main class="py-6 bg-[#F2F2F2]">
        <section class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <article class="bg-white shadow rounded-lg p-6">

                <form method="POST" action="{{ route('publicaciones.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- LIBRO -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Libro
                        </label>

                        <select name="centro_libro_id"
                                class="w-full border-gray-300 rounded focus:ring-[#1E88C8] focus:border-[#1E88C8]"
                                required>
                            @foreach ($centroLibros as $cl)
                                <option value="{{ $cl->id }}"
                                    {{ old('centro_libro_id') == $cl->id ? 'selected' : '' }}>
                                    {{ $cl->libro->titulo }}
                                </option>
                            @endforeach
                        </select>

                        @error('centro_libro_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- DESCRIPCIÓN -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción
                        </label>

                        <textarea name="descripcion"
                                  class="w-full border-gray-300 rounded focus:ring-[#1E88C8] focus:border-[#1E88C8]"
                                  rows="4">{{ old('descripcion') }}</textarea>

                        @error('descripcion')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- IMAGEN -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Imagen (opcional)
                        </label>

                        <input type="file" name="imagen" id="imagenInput"
                               class="w-full border-gray-300 rounded">

                        <div class="mt-4">
                            <img id="previewImagen"
                                 src="{{ asset('images/no-image.png') }}"
                                 class="w-40 h-40 object-cover rounded border">
                        </div>

                        @error('imagen')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- DISCLAIMER -->
                    <div class="mb-6 bg-gray-50 p-4 rounded border">
                        <label class="flex items-start space-x-2">
                            <input type="checkbox" name="condiciones" id="condiciones"
                                   class="mt-1"
                                   required>

                            <span class="text-sm text-gray-700">
                                Declaro que la información proporcionada es veraz y acepto las condiciones de uso de la plataforma <strong>LibreLibroTeca</strong>, comprometiéndome a respetar sus normas de funcionamiento, incluyendo la correcta descripción del material, el uso responsable del sistema de intercambio y el respeto hacia otros usuarios. Asimismo, entiendo que el incumplimiento de estas condiciones podrá conllevar la retirada de la publicación o la suspensión de mi cuenta.
                            </span>
                        </label>

                        @error('condiciones')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- BOTONES -->
                    <div class="flex justify-between items-center">

                        <!-- VOLVER -->
                        <a href="{{ route('publicaciones.index') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded hover:opacity-90">
                            ← Volver
                        </a>

                        <!-- PUBLICAR -->
                        <button type="submit" id="btnSubmit"
                                class="px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90 disabled:opacity-50"
                                disabled>
                            Publicar
                        </button>

                    </div>

                </form>

            </article>

        </section>
    </main>

    <!-- SCRIPT PREVIEW DE LA IMAGEN + CHECK DE ACEPTACIÓN DE CONDICIONES -->
    <script>
        // Preview imagen
        document.getElementById('imagenInput').addEventListener('change', function (event) {
            const [file] = event.target.files;
            if (file) {
                document.getElementById('previewImagen').src = URL.createObjectURL(file);
            }
        });

        // Activar botón solo si acepta condiciones
        const checkbox = document.getElementById('condiciones');
        const btn = document.getElementById('btnSubmit');

        checkbox.addEventListener('change', function () {
            btn.disabled = !this.checked;
        });
    </script>
</x-app-layout>
