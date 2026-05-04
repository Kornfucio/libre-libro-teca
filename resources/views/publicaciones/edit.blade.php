<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Editar publicación
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Editar publicación</h1>
            <form method="POST" action="{{ route('publicaciones.update', $publicacion->id) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="from" value="{{ request('from') }}">
                @method('PUT')

                <!-- IMAGEN ACTUAL -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen actual
                    </label>

                    @if ($publicacion->imagen)
                        <img src="{{ asset('storage/' . $publicacion->imagen) }}"
                            class="w-40 h-40 object-cover rounded mb-2">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" class="w-40 h-40 object-cover rounded mb-2">
                    @endif
                </div>

                <!-- NUEVA IMAGEN -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Cambiar imagen
                    </label>

                    <input type="file" name="imagen" class="w-full border rounded-lg p-2 bg-white">

                    <p class="text-sm text-gray-500 mt-1">
                        (Opcional: solo si quieres cambiarla)
                    </p>
                </div>

                <!-- DESCRIPCIÓN -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Descripción
                    </label>

                    <textarea name="descripcion" rows="4"
                        class="w-full border rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-orange-400">{{ $publicacion->descripcion }}</textarea>

                    @error('descripcion')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- BOTONES -->
                <div class="flex justify-start gap-3 mt-6">

                    <x-boton-volver :ruta="route('publicaciones.mias')" />

                    <button type="submit"
                        class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">
                        Actualizar publicación
                    </button>

                </div>

            </form>

        </div>
    </div>
</x-app-layout>
