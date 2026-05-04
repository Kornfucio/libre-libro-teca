<x-app-layout>

    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Contenedor principal tipo tarjeta -->
            <article class="bg-white shadow rounded-lg overflow-hidden">

                <!-- Botón para crear un nuevo centro -->
                <div class="p-4 border-b">
                    <a href="{{ route('admin.centros.create') }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nuevo centro
                    </a>
                </div>

                <!-- Tabla de centros -->
                <table class="min-w-full border border-gray-200">

                    <!-- Cabecera de la tabla -->
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Nombre</th>
                            <th class="px-4 py-2 text-left">Estado</th>
                            <th class="px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>

                    <!-- Cuerpo de la tabla -->
                    <tbody>

                        <!-- Recorro todos los centros -->
                        @forelse ($centros as $centro)
                            <tr class="border-t hover:bg-gray-50">

                                <!-- Nombre del centro -->
                                <td class="px-4 py-2">
                                    {{ $centro->nombre_centro ?? '-' }}
                                </td>

                                <!-- Estado del centro -->
                                <td class="px-4 py-2">

                                    <!-- Uso colores según el estado -->
                                    <span class="px-2 py-1 rounded text-white text-sm
                                            @if($centro->estado && $centro->estado->nombre_estado == 'activo') bg-green-500
                                            @elseif($centro->estado && $centro->estado->nombre_estado == 'inactivo') bg-red-500
                                            @else bg-gray-500
                                            @endif
                                        ">
                                        <!-- Si no hay estado, muestro texto por defecto -->
                                        {{ $centro->estado->nombre_estado ?? 'Sin estado' }}
                                    </span>

                                </td>

                                <!-- Acciones disponibles -->
                                <td class="px-4 py-2 space-x-2">

                                    <!-- Enlace para editar el centro -->
                                    <a href="{{ route('admin.centros.edit', $centro->id) }}"
                                        class="text-yellow-600 hover:underline">
                                        Editar
                                    </a>

                                </td>

                            </tr>

                            <!-- Si no hay centros -->
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                                    No hay centros registrados
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

                <!-- Paginación -->
                <div class="p-4">
                    {{ $centros->links() }}
                </div>
            </article>
        </section>
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-boton-volver/>
        </section>
    </main>

</x-app-layout>
