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

                <h1 class="text-3xl font-bold text-[#1E88C8] mb-6 border-b pb-4">

                    ¿Quienes somos? Las familias detrás de <b>Libre-libro-teca</b>
                </h1>
                <img src="{{ asset('build/images/logo.png') }}" alt="Logo" class="h-80 w-auto mx-auto block">
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-align:center">
                    <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p>
                        Somos un grupo de madres, padres y vecinos de Gijón que, año tras año, nos enfrentábamos al mismo reto en septiembre: el enorme esfuerzo económico que supone la "vuelta al cole" y la frustración de ver cómo libros de texto en perfecto estado quedaban olvidados en una estantería o acababan en el contenedor.
                    </p>
                    <p>
                        De esa necesidad compartida, y de las ganas de ayudarnos mutuamente, nació <strong>Libre-libro-teca</strong>.
                    </p>
                    <p>
                        No somos una empresa ni buscamos ningún tipo de beneficio económico. Somos una red colaborativa que ha decidido utilizar la tecnología para facilitar el contacto entre las familias de nuestro municipio. Creemos firmemente que la educación debe ser un derecho accesible y que el apoyo vecinal es la mejor herramienta para aliviar la carga económica de los hogares.
                    </p>
                </div>

                <h2 class="text-2xl font-semibold text-[#1E88C8] mt-8 mb-4">Nuestra Misión</h2>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Nuestro objetivo es crear un ciclo real de <strong>economía circular</strong> en el entorno educativo de Gijón. Queremos que ningún libro útil se desperdicie y que ninguna familia tenga que hacer malabares financieros para conseguir los materiales escolares básicos de sus hijos.
                </p>

                <h2 class="text-2xl font-semibold text-[#1E88C8] mt-8 mb-4">Nuestros Valores</h2>
                <ul class="list-none space-y-3 text-gray-600 leading-relaxed mb-8">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-orange-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span><strong>Solidaridad:</strong> Fomentamos el intercambio y la donación directa entre familias, sin intermediarios, cuotas ni condiciones.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-orange-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span><strong>Sostenibilidad:</strong> Alargamos la vida útil del material escolar. Evitamos imprimir papel innecesario, reducimos nuestra huella ecológica y educamos a nuestros hijos en la cultura del reciclaje y el cuidado de las cosas.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-orange-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span><strong>Accesibilidad:</strong> Hemos diseñado una plataforma sencilla, libre y 100% gratuita para que
                            cualquier persona en Gijón pueda participar sin barreras tecnológicas.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-orange-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span><strong>Comunidad:</strong> Reforzamos los lazos entre los distintos barrios, las AMPAs y los centros
                            educativos de nuestra ciudad, demostrando que juntos llegamos más lejos.</span>
                    </li>
                </ul>

                <div class="bg-orange-50 border-l-4 border-orange-500 p-4 mt-8 rounded-r text-gray-700 italic">
                    "En Libre-libro-teca, cada libro que cambia de manos es un pequeño alivio para un hogar y un gran paso hacia
                    un modelo de consumo más responsable."
                </div>
                </p>

            </section>

        </div>

    </main>

</x-app-layout>
