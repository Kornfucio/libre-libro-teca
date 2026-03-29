<x-app-layout>

    <main class="py-10">

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-6" style="justify-content: center">

            <!-- MENÚ LATERAL -->
            <aside class="md:col-span-1 bg-white shadow rounded p-4 space-y-3">

                <a href="{{ route('quienes') }}"
                    class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Quienes somos
                </a>

                <a href="{{ route('colaboradores') }}" class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Colaboradores
                </a>

                <a href="{{ route('compromisos') }}" class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Compromisos
                </a>

                <a href="{{ route('publicaciones.index') }}" class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Buscador
                </a>

            </aside>

            <!-- CONTENIDO -->
            <section class="md:col-span-3 bg-white shadow rounded p-6">

                <h1 class="text-2xl font-semibold text-[#1E88C8] mb-4" style="text-align:center">

                    Programa de intercambio de libros de texto entre familias
                </h1>

                <p class="text-gray-600 leading-relaxed" style="text-align:center">
                    ¡Bienvenido a <b>Libre-libro-teca</b>! Somos un espacio creado por y para las familias de Gijón con
                    un objetivo
                    claro: hacer que la educación sea más accesible y sostenible.
                </p>
                <img src="{{ asset('build/images/logo.png') }}" alt="Logo" class="h-80 w-auto mx-auto block">
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-align:center">
                    <b>Libre-libro-teca</b> nace como una red colaborativa y solidaria diseñada para las familias del
                    municipio de Gijón.
                    A través de esta plataforma, los usuarios pueden donar e intercambiar libros de texto escolares de
                    manera totalmente
                    gratuita. Nuestro objetivo es doble: por un lado, suponer un alivio económico real frente a los
                    gastos de la 'vuelta
                    al cole' y, por otro, fomentar la economía circular y la sostenibilidad. Al darles una segunda vida
                    a los materiales
                    educativos, promovemos un modelo de consumo más responsable y un fuerte sentido de comunidad.

                <h1 style="text-align:center">¡Únete y participa!</h1>
                </p>

            </section>

        </div>

    </main>

</x-app-layout>
