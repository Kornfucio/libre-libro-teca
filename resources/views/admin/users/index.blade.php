<x-app-layout>
    <x-slot>
        <main class="py-6">

            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Usuarios registrados
                </h1>
                <article class="bg-white shadow rounded-lg overflow-hidden">

                    <!-- Filtros por rol, estado y centro -->
                    <div class="p-4 border-b bg-gray-50">
                        <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-2">

                            <!-- Selector de rol-->
                            <select name="rol" class="border p-2 rounded">
                                <option value="">Todos los roles</option>
                                <option value="usuario" {{ request('rol') == 'usuario' ? 'selected' : '' }}>Usuario
                                </option>
                                <option value="admin" {{ request('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>

                            <!-- Selector de centro -->
                            <select name="centro_id" class="border p-2 rounded">
                                <option value="">Todos los centros</option>
                                @foreach ($centros as $centro)
                                    <option value="{{ $centro->id }}" {{ request('centro_id') == $centro->id ? 'selected' : '' }}>
                                        {{ $centro->nombre_centro }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Selector de estado-->
                            <select name="asignatura_id" class="border p-2 rounded">
                                <option value="">Todo los estados</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}" {{ request('users.estado_id') == $estado->id ? 'selected' : '' }}>
                                        {{ $estado->nombre_estado }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Botón de búsqueda -->
                            <button class="bg-blue-500 text-white px-4 rounded">
                                Buscar
                            </button>

                            <!-- Botón para limpiar filtros -->
                            <a href="{{ route('admin.users.index') }}"
                                class="bg-gray-300 px-4 rounded flex items-center">
                                Limpiar
                            </a>

                        </form>
                    </div>

                    <!-- Tabla de usuarios -->
                    <table class="min-w-full border border-gray-200">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Telefono</th>
                                <th class="px-4 py-2 text-left">Rol</th>
                                <th class="px-4 py-2 text-left">Centro</th>
                                <th class="px-4 py-2 text-left">Estado</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($usuarios as $usuario)
                                <tr class="border-t hover:bg-gray-50">
                                    <!--Nombre -->
                                    <td class="px-4 py-2">
                                        {{ $usuario->nombre ?? '-' }}
                                    </td>

                                    <!-- Email -->
                                    <td class="px-4 py-2">
                                        {{ $usuario->email ?? '-' }}
                                    </td>

                                    <!-- Telefono -->
                                    <td class="px-4 py-2">
                                        {{ $usuario->telefono ?? '-' }}
                                    </td>

                                    <!-- Rol -->
                                    <td class="px-4 py-2">
                                        {{ $usuario->rol ?? '-' }}
                                    </td>

                                    <!-- Centro -->
                                    <td class="px-4 py-2">
                                        {{ $usuario->centro->nombre_centro ?? '-' }}
                                    </td>

                                    <!-- Estado -->
                                    <td class="px-4 py-2">
                                        {{ $usuario->estado->nombre_estado ?? '-' }}
                                    </td>

                                    <!-- Acciones -->
                                    <td class="px-4 py-2 space-x-2">
                                        <!-- Ver detalle -->
                                        <a href="{{ route('admin.users.show', $usuario->id) }}"
                                            class="text-blue-600 hover:underline">
                                            Ver
                                        </a>

                                        <!-- Editar -->
                                        <a href="{{ route('admin.users.edit', $usuario->id) }}"
                                            class="text-green-600 hover:underline">
                                            Editar
                                        </a>
                                        <!-- Bloquear -->
                                        <form action="{{ route('admin.users.block', $usuario->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-yellow-600 hover:underline">
                                                Bloquear
                                            </button>
                                        </form>

                                        <!-- Eliminar -->
                                        <form action="{{ route('admin.users.destroy', $usuario->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline"
                                                onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-2 text-center">No hay usuarios registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </article>
                <div class="mt-4">
                    {{ $usuarios->links() }}
                </div>
            </section>
            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-boton-volver />
            </section>

        </main>

    </x-slot>
</x-app-layout>
