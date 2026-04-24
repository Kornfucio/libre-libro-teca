<x-app-layout>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjeta principal -->
            <article class="bg-white shadow rounded-lg p-6">

                <!-- Título -->
                <h2 class="text-lg font-semibold text-gray-800 mb-4">
                    Editar centro educativo
                </h2>

                <!-- Formulario de edición -->
                <form method="POST" action="{{ route('admin.centros.update', $centro->id) }}">
                    @csrf
                    @method('PUT') <!-- Método PUT para actualizar -->

                    <!-- Nombre del centro -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Nombre del centro
                        </label>

                        <input type="text" name="nombre"
                               value="{{ old('nombre', $centro->nombre_centro) }}"
                               class="mt-1 block w-full border rounded p-2">

                        <!-- Error de validación -->
                        @error('nombre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estado del centro -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Estado
                        </label>

                        <select name="estado_id" class="mt-1 block w-full border rounded p-2">

                            <!-- Recorro los estados disponibles -->
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}"
                                    {{ old('estado_id', $centro->estado_id) == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nombre_estado }}
                                </option>
                            @endforeach

                        </select>

                        <!-- Error de validación -->
                        @error('estado_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-between items-center mt-6">

                        <!-- Botón guardar -->
                        <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Guardar cambios
                        </button>

                        <!-- Botón volver -->
                        <a href="{{ route('admin.centros.index') }}"
                           class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                            Volver
                        </a>

                    </div>

                </form>

            </article>

        </section>
    </main>

</x-app-layout>
