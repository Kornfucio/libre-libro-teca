<x-app-layout>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjeta -->
            <article class="bg-white shadow rounded-lg p-6">

                <h2 class="text-lg font-semibold mb-4">
                    Crear centro educativo
                </h2>

                <!-- Formulario -->
                <form method="POST" action="{{ route('admin.centros.store') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label>Nombre</label>
                        <input type="text" name="nombre_centro"
                               value="{{ old('nombre_centro') }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- CIF -->
                    <div class="mb-4">
                        <label>CIF</label>
                        <input type="text" name="cif_centro"
                               value="{{ old('cif_centro') }}"
                               class="w-half border p-2 rounded">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-4">
                        <label>Dirección</label>
                        <input type="text" name="direccion"
                               value="{{ old('direccion') }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Localidad -->
                    <div class="mb-4">
                        <label>Localidad</label>
                        <input type="text" name="localidad"
                               value="{{ old('localidad') }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Provincia -->
                    <div class="mb-4">
                        <label>Provincia</label>
                        <input type="text" name="provincia"
                               value="{{ old('provincia') }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-4">
                        <label>Teléfono</label>
                        <input type="text" name="telefono"
                               value="{{ old('telefono') }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email"
                               value="{{ old('email') }}"
                               class="w-full border p-2 rounded">
                    </div>

                    <!-- Estado -->
                    <div class="mb-4">
                        <label>Estado</label>
                        <select name="estado_id" class="w-full border p-2 rounded">
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}">
                                    {{ $estado->nombre_estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-between">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded">
                            Crear
                        </button>

                        <a href="{{ route('admin.centros.index') }}"
                           class="bg-gray-300 px-4 py-2 rounded">
                            Volver
                        </a>
                    </div>

                </form>

            </article>

        </section>
    </main>

</x-app-layout>
