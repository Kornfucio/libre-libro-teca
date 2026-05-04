<x-app-layout>
    <x-slot>
        <main class="py-6">

            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                    Usuarios registrados
                </h1>
                <article class="bg-white shadow rounded-lg overflow-hidden" p-6>

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
                                    <option value="{{ $centro->id }}"
                                        {{ request('centro_id') == $centro->id ? 'selected' : '' }}>
                                        {{ $centro->nombre_centro }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Selector de estado-->
                            <select name="asignatura_id" class="border p-2 rounded">
                                <option value="">Todo los estados</option>
                                @foreach ($estados as $estado)
                                    <option value="{{ $estado->id }}"
                                        {{ request('users.estado_id') == $estado->id ? 'selected' : '' }}>
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
                                    <td class="px-4 py-2">
                                        <div class="flex items-center gap-2">

                                            <!-- VER -->
                                            <a href="{{ route('admin.users.show', $usuario->id) }}"
                                                class="px-2 py-1 text-xs bg-blue-500 text-white rounded hover:bg-blue-600">
                                                Ver
                                            </a>

                                            <!-- EDITAR -->
                                            <a href="{{ route('admin.users.edit', $usuario->id) }}"
                                                class="px-2 py-1 text-xs bg-yellow-400 text-[#1E88C8] rounded hover:bg-yellow-500">
                                                Editar
                                            </a>

                                            <!-- BLOQUEAR -->
                                            <form action="{{ route('admin.users.block', $usuario->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button
                                                    class="px-2 py-1 text-xs bg-orange-500 text-white rounded hover:bg-orange-600">
                                                    Bloquear
                                                </button>
                                            </form>

                                            <!-- ELIMINAR -->
                                            <form action="{{ route('admin.users.destroy', $usuario->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="px-2 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600"
                                                    onclick="return confirm('¿Eliminar usuario?')">
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-2 text-center">No hay usuarios registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $usuarios->links() }}
                    </div>
                    <br>
                </article>

            </section>
            <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 px-4 pb-4">
                <x-boton-volver :ruta="route('admin.users.index')" />
            </section>

        </main>

    </x-slot>
</x-app-layout>
