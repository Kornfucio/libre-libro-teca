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

                <h1 class="text-2xl font-semibold text-[#1E88C8] mb-4" style="text-align:center">

                    Aviso legal <img src="{{ asset('build/images/logo.png') }}" alt="Logo" class="h-40 w-auto mx-auto block">
                </h1>

                <p class="text-gray-600 mt-4 leading-relaxed" style="text-justify: distribute">
                    <p class="text-justify">
                    La información contenida en este sitio web es de carácter informativo y no vinculante. Los usuarios deben leer y aceptar los términos y condiciones de uso antes de acceder a los servicios ofrecidos.
                    <br>

                    <br>
                    <b>Libre-Libro-Teca</b> no se hace responsable de la veracidad, exactitud o integridad de la información proporcionada por los usuarios en sus publicaciones. Los usuarios son responsables de garantizar que el contenido que comparten cumple con las leyes aplicables y no infringe los derechos de terceros.
                    <br>

                    <br>
                    <b>Libre-Libro-Teca</b> se reserva el derecho de eliminar cualquier publicación que considere inapropiada, ofensiva o que viole los términos de uso, sin previo aviso. El uso de este sitio web implica la aceptación de esta política de aviso legal. Si no estás de acuerdo con estos términos, por favor, no utilices este sitio web.
                    <br>

                    <br>
                    <b>Política de privacidad:</b> Libre-Libro-Teca se compromete a proteger la privacidad de los usuarios. La información personal recopilada se utilizará únicamente para los fines establecidos en la plataforma y no se compartirá con terceros sin el consentimiento explícito del usuario, salvo que sea requerido por ley.  Los usuarios tienen derecho a acceder, rectificar y eliminar su información personal en cualquier momento a través de su perfil de usuario. Para más detalles sobre cómo manejamos la información personal, por favor, consulta nuestra Política de Privacidad.
                    <br>

                    <br>
                    <b>Derecho de acceso, rectificación y eliminación:</b> Los usuarios tienen derecho a acceder, rectificar y eliminar su información personal en cualquier momento a través de su perfil de usuario. Para ejercer estos derechos, los usuarios pueden iniciar sesión en su cuenta y realizar los cambios necesarios o ponerse en contacto con el equipo de soporte a través de la sección de contacto.
                </p>
                </p>

            </section>

        </div>


    </main>

</x-app-layout>
