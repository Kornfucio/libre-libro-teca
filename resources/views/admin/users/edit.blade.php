<x-app-layout>
    <main class="py-6 bg-[#F2F2F2]">
        <section class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-semibold text-xl">
                Editar usuario
            </h1>

            <!-- Contenedor principal del formulario -->
            <article class="bg-white shadow rounded-lg p-6">

                <!-- Formulario que envía los datos al método update -->
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT') <!-- Laravel no soporta PUT directamente, así que se simula -->

                    <!-- Campo nombre -->
                    <div>
                        <label class="block font-semibold">Nombre</label>
                        <!-- Uso old() para mantener el valor si hay error de validación -->
                        <input type="text" name="nombre" value="{{ old('nombre', $user->nombre) }}"
                            class="w-full border p-2 rounded">
                    </div>

                    <!-- Campo email -->
                    <div>
                        <label class="block font-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full border p-2 rounded">
                    </div>

                    <!-- Selector de rol (solo admin o usuario) -->
                    <div>
                        <label class="block font-semibold">Rol</label>
                        <select name="rol" class="w-full border p-2 rounded">
                            <option value="usuario" {{ $user->rol == 'usuario' ? 'selected' : '' }}>Usuario</option>
                            <option value="admin" {{ $user->rol == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <!-- Selector de centro educativo -->
                    <div>
                        <label class="block font-semibold">Centro educativo</label>
                        <select name="centro_id" class="w-full border p-2 rounded">
                            <option value="">-- Selecciona centro --</option>

                            <!-- Recorro todos los centros para mostrarlos -->
                            @foreach ($centros as $centro)
                                <option value="{{ $centro->id }}" {{ $user->centro_id == $centro->id ? 'selected' : '' }}>
                                    {{ $centro->nombre_centro }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Selector de estado del usuario -->
                    <div>
                        <label class="block font-semibold">Estado</label>
                        <select name="estado_id" class="w-full border p-2 rounded">

                            <!-- Solo muestro los estados que decidí permitir -->
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}" {{ $user->estado_id == $estado->id ? 'selected' : '' }}>
                                    {{ $estado->nombre_estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex gap-2 mt-4">

                        <!-- Botón para guardar cambios -->
                        <button type="submit" class="bg-red-600 text-white  px-4 py-2 rounded">
                            Guardar cambios
                        </button>
                        <!-- Volver sin guardar -->
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Cancelar
                        </a>
                    </div>

                </form>

            </article>
        </section>
    </main>
</x-app-layout>
