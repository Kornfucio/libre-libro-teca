<x-app-layout>

    <main class="py-10">

        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-6" style="justify-content: center">

            <!-- MENÚ LATERAL -->
            <aside class="md:col-span-1 bg-white shadow rounded p-4 space-y-3">

                <a href="{{ route('quienes') }}"
                    class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Quienes somos
                </a>

                <a href="{{ route('colaboradores') }}"
                    class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Colaboradores
                </a>

                <a href="{{ route('compromisos') }}"
                    class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Compromisos
                </a>

                <a href="#" class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Buscador
                </a>

            </aside>

            <!-- CONTENIDO -->
            <section class="md:col-span-3 bg-white shadow rounded p-6">

                <h1 class="text-3xl font-bold text-[#1E88C8] mb-6 border-b pb-4">
                    Nuestros Compromisos: Un pacto con las familias
                </h1>

                <p class="text-gray-600 leading-relaxed mb-8">
                    Cuando creamos <strong>Libre-libro-teca</strong>, no solo queríamos lanzar una página web para intercambiar libros. Queríamos establecer un espacio seguro, ético y confiable para todas las familias de Gijón. Por eso, nuestra actividad se rige estrictamente por los siguientes cinco compromisos irrenunciables:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-3">
                            <svg class="w-8 h-8 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                            <h3 class="text-lg font-bold text-[#1E88C8]">Gratuidad Total</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Nuestra plataforma es y será siempre 100% gratuita. No hay cuotas ocultas, ni comisiones, ni modelos premium. El intercambio de libros no debe tener barreras económicas.
                        </p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-3">
                            <svg class="w-8 h-8 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            <h3 class="text-lg font-bold text-[#1E88C8]">Privacidad y Seguridad</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Protegemos los datos de las familias con el máximo rigor. Solo compartimos la información estrictamente necesaria entre los usuarios que acuerdan un intercambio, garantizando un entorno seguro.
                        </p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-3">
                            <svg class="w-8 h-8 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <h3 class="text-lg font-bold text-[#1E88C8]">Transparencia Absoluta</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            No somos una empresa encubierta ni recopilamos datos para venderlos a terceros. Somos un proyecto vecinal sin ánimo de lucro, con las reglas claras y visibles para todos.
                        </p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-100 hover:shadow-md transition-shadow">
                        <div class="flex items-center mb-3">
                            <svg class="w-8 h-8 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <h3 class="text-lg font-bold text-[#1E88C8]">Sostenibilidad Activa</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Promovemos la economía circular para reducir el impacto medioambiental. Cada libro reutilizado es un árbol menos talado y un paso más hacia una ciudad comprometida con el planeta.
                        </p>
                    </div>

                </div>

                <div class="bg-blue-50 border-l-4 border-[#1E88C8] p-5 mt-8 rounded-r">
                    <h4 class="font-bold text-[#1E88C8] mb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                        Compromiso extra: La Escucha
                    </h4>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Este proyecto está vivo. Nos comprometemos a mantener un canal de comunicación abierto con los usuarios, las AMPAs y los colegios de Gijón para escuchar sugerencias y mejorar continuamente la plataforma según vuestras necesidades.
                    </p>
                </div>

            </section>

        </div>

    </main>

</x-app-layout>
