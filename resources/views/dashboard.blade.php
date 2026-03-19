<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de usuario
        </h2>
    </x-slot>

       <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Mis publicaciones</h3>
                    <p class="text-sm text-gray-600">Gestiona los libros que has publicado.</p>
                    <a href="{{ route('publicaciones.index') }}"
                       class="text-blue-600 mt-2 inline-block">
                       Ver publicaciones
                    </a>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Buscar libros</h3>
                    <p class="text-sm text-gray-600">Explora los libros publicados por otros usuarios.</p>
                    <a href="{{ route('publicaciones.index') }}"
                       class="text-blue-600 mt-2 inline-block">
                       Buscar
                    </a>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-semibold">Solicitudes</h3>
                    <p class="text-sm text-gray-600">Revisa las solicitudes de intercambio.</p>
                    <a href="#"
                       class="text-blue-600 mt-2 inline-block">
                       Ver solicitudes
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
