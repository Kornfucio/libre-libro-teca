<x-app-layout>
    <x-slot name="header">
        <header class="bg-[#1E88C8] text-white p-4 rounded">
            <h2 class="font-semibold text-xl">
                Panel de usuario Libre-libro-teca
            </h2>
        </header>
    </x-slot>

    <div class="py-6 bg-[#F2F2F2]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- 📚 MIS PUBLICACIONES -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800">Mis publicaciones</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Gestiona los libros que has publicado.
                    </p>

                    <a href="{{ route('publicaciones.mias') }}"
                       class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                       Ver publicaciones
                    </a>
                </div>

                <!-- 🔍 BUSCAR LIBROS -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800">Buscar libros</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Explora los libros publicados por otros usuarios.
                    </p>

                    <a href="{{ route('publicaciones.index') }}"
                       class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                       Buscar
                    </a>
                </div>

                <!-- 🔄 SOLICITUDES -->
                <div class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800">Solicitudes</h3>
                    <p class="text-sm text-gray-600 mt-2">
                        Revisa las solicitudes de intercambio.
                    </p>

                    <a href="{{ route('solicitudes.index') }}"
                       class="inline-block mt-4 px-4 py-2 bg-[#FF7A00] text-white rounded hover:opacity-90">
                       Ver solicitudes
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
