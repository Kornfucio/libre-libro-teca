<x-app-layout>
    <x-slot name="header">
        {{-- Cabecera común para todos los usuarios --}}
        {{-- Se mantiene un único dashboard y se adapta según el rol --}}
        <header class="bg-[#1E88C8] text-white p-4 rounded">
            <h2 class="font-semibold text-xl">
                Panel Libre-libro-teca
            </h2>
        </header>
    </x-slot>

    <div class="py-6 bg-[#F2F2F2]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Bloque de bienvenida --}}
            {{-- Se muestra a cualquier usuario autenticado --}}
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    Bienvenido, {{ Auth::user()->nombre }}
                </h3>
                <p class="text-sm text-gray-600 mt-2">
                    Desde aquí puedes acceder a las funciones principales de la plataforma.
                </p>
            </div>


            {{-- Panel usuario--}}
            {{-- Usuario no admin --}}
            @unless(auth()->user()->isAdmin())

                <div>
                    {{-- Título de sección para organizar mejor el contenido --}}
                    <h3 class="text-md font-semibold text-gray-700 mb-2">
                        Mi actividad
                    </h3>

                    {{-- Uso de grid para organizar las tarjetas --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        {{-- Publicaciones propias --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Mis publicaciones
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Aquí puedes ver y gestionar los libros que has publicado.
                            </p>

                            <a href="{{ route('publicaciones.mias') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                                Acceder
                            </a>
                        </div>

                        {{-- Búsqueda general --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Buscar libros
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Permite consultar los libros disponibles en la plataforma.
                            </p>

                            <a href="{{ route('publicaciones.index') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                                Acceder
                            </a>
                        </div>

                        {{-- Solicitudes de intercambio --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Solicitudes
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Consulta el estado de tus intercambios tanto enviados como recibidos.
                            </p>

                            <a href="{{ route('solicitudes.index') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                                Acceder
                            </a>
                        </div>
                        {{-- Botón para publicar en el propio dashboard --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Publicar libro
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Añade un nuevo libro a la plataforma.
                            </p>

                            <a href="{{ route('publicaciones.create') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                                Acceder
                            </a>
                        </div>
                        {{-- Tablón de anuncios --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Tablón de anuncios
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Consulta los últimos anuncios publicados.
                            </p>

                            <a href="#"
                                class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                                Proximamente
                            </a>
                        </div>
                        {{-- Buzón de mensajes --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold text-gray-800">
                                Buzón de mensajes
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Consulta los mensajes recibidos.
                            </p>

                            <a href="#"
                                class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                                Proximamente
                            </a>
                        </div>

                    </div>
                </div>

            @endunless

            {{-- Panel Administrador --}}

            {{-- Si el usuario es admin, se muestra contenido global de gestión --}}
            @if(auth()->user()->isAdmin())

                {{-- Bloque de estadísticas básicas --}}
                {{-- No se complica, solo contadores simples --}}
                <div>
                    <h3 class="text-md font-semibold text-gray-700 mb-2">
                        Resumen general
                    </h3>
                    <div class="max-w-xs mx-auto">
                        <canvas id="dashboardChart"></canvas>
                    </div>
                    <br>
                    {{-- <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div class="bg-white p-6 rounded shadow text-center">
                            <p class="text-sm text-gray-500">Usuarios</p>
                            <p class="text-2xl font-bold">
                                {{ \App\Models\User::count() }}
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded shadow text-center">
                            <p class="text-sm text-gray-500">Publicaciones</p>
                            <p class="text-2xl font-bold">
                                {{ \App\Models\Publicacion::count() }}
                            </p>
                        </div>

                        <div class="bg-white p-6 rounded shadow text-center">
                            <p class="text-sm text-gray-500">Intercambios</p>
                            <p class="text-2xl font-bold">
                                {{ \App\Models\SolicitudIntercambio::count() }}
                            </p>
                        </div>

                    </div>--}}
                </div>

                {{-- Bloque de administración --}}
                {{-- Aquí se centralizan todas las funcionalidades del admin --}}
                <div>
                    <h3 class="text-md font-semibold text-gray-700 mb-2">
                        Administración
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        {{-- Gestión de usuarios --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold">
                                Usuarios
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Permite bloquear o revisar usuarios.
                            </p>

                            <a href="{{ route('admin.users.index') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#1E88C8] text-white rounded">
                                Acceder
                            </a>
                        </div>

                        {{-- Moderación de publicaciones --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold">
                                Publicaciones
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Control del contenido publicado por los usuarios.
                            </p>

                            <a href="{{ route('admin.publicaciones.index') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#1E88C8] text-white rounded">
                                Acceder
                            </a>
                        </div>

                        {{-- Gestión de intercambios --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold">
                                Intercambios
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Permite revisar y modificar solicitudes.
                            </p>

                            <a href="{{ route('admin.solicitudes.index') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#1E88C8] text-white rounded">
                                Acceder
                            </a>
                        </div>

                        {{-- Centros educativos --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold">
                                Centros
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Alta y mantenimiento de centros escolares.
                            </p>

                            <a href="{{ route('admin.centros.index') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#1E88C8] text-white rounded">
                                Acceder
                            </a>
                        </div>

                        {{-- Libros --}}
                        <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                            <h3 class="text-lg font-semibold">
                                Libros
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Gestión del catálogo común de libros.
                            </p>

                            <a href="{{ route('admin.libros.index') }}"
                                class="inline-block mt-4 px-4 py-2 bg-[#1E88C8] text-white rounded">
                                Acceder
                            </a>
                        </div>

                        {{-- Funcionalidad futura --}}
                        <div class="bg-white shadow rounded-lg p-6 opacity-60">
                            <h3 class="text-lg font-semibold">
                                Carga masiva
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">
                                Importación de datos mediante CSV (pendiente de implementación).
                            </p>

                            <button disabled class="mt-4 px-4 py-2 bg-gray-400 text-white rounded">
                                Próximamente
                            </button>
                        </div>

                    </div>
                </div>

            @endif

        </div>
    </div>
    @push('scripts')
        <script>
            const ctx = document.getElementById('dashboardChart');

            const stats = @json([
                'publicaciones' => $totalPublicaciones ?? 0,
                'usuarios' => $totalUsuarios ?? 0,
                'solicitudes' => $totalSolicitudes ?? 0
            ]);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Publicaciones', 'Usuarios', 'Solicitudes'],
                    datasets: [{
                        label: 'Totales',
                        data: [
                            stats.publicaciones,
                            stats.usuarios,
                            stats.solicitudes
                        ]
                    }]
                }
            });
        </script>
    @endpush
</x-app-layout>
