<x-app-layout>

    <main class="py-6 md:py-10">

        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-6">

            <!-- MENÚ LATERAL -->
            <aside class="md:col-span-1 bg-white shadow rounded p-4 space-y-3">

                <a href="{{ route('quienes') }}"
                    class="block w-full text-center md:text-left px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Quienes somos
                </a>

                <a href="{{ route('colaboradores') }}"
                    class="block w-full text-center md:text-left px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Colaboradores
                </a>

                <a href="{{ route('compromisos') }}"
                    class="block w-full text-center md:text-left px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Compromisos
                </a>

                <a href="{{ route('publicaciones.index') }}"
                    class="block w-full text-center md:text-left px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Buscador
                </a>

            </aside>

            <!-- CONTENIDO -->
            <section class="md:col-span-3 bg-white shadow rounded p-4 md:p-6">

                <h1 class="text-xl md:text-2xl font-semibold text-[#1E88C8] mb-4 text-center">
                    Programa de intercambio de libros de texto entre familias
                </h1>

                <p class="text-gray-600 leading-relaxed text-center text-sm md:text-base">
                    ¡Bienvenido a <b>Libre-libro-teca</b>! Somos un espacio creado por y para las familias de Gijón con
                    un objetivo claro: hacer que la educación sea más accesible y sostenible.
                </p>

                <!-- IMAGEN RESPONSIVE -->
                <img src="{{ asset('images/logo.png') }}"
                    alt="Logo"
                    class="w-full max-w-xs md:max-w-md mx-auto my-6">

                <p class="text-gray-600 mt-4 leading-relaxed text-center text-sm md:text-base">
                    <b>Libre-libro-teca</b> nace como una red colaborativa y solidaria diseñada para las familias del
                    municipio de Gijón.
                    A través de esta plataforma, los usuarios pueden donar e intercambiar libros de texto escolares de
                    manera totalmente gratuita.
                    Nuestro objetivo es doble: por un lado, suponer un alivio económico real frente a los gastos de la
                    'vuelta al cole' y, por otro, fomentar la economía circular y la sostenibilidad.
                </p>

                <h2 class="text-center text-lg md:text-xl font-semibold mt-6">
                    ¡Únete y participa!
                </h2>

            </section>

        </div>

    </main>

</x-app-layout>
