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

                    Ayuda (FAQs) <img src="{{ asset('build/images/logo.png') }}" alt="Logo" class="h-40 w-auto mx-auto block">
                </h1>

                <p class="text-gray-600 mt-4 leading-relaxed" style="text-justify: distribute">
                    <b>1. ¿Cómo puedo publicar un libro para intercambiar?</b>
                    Para publicar un libro, debes iniciar sesión en la plataforma y pulsar el botón “Publicar libro”. A
                    continuación, completa el formulario con la información del libro y, opcionalmente, una imagen. Una
                    vez guardado, tu publicación será visible para otros usuarios.
                </p>
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-justify: distribute">
                    <b>2. ¿Es obligatorio registrarse para usar la aplicación?</b>
                    Sí, es necesario registrarse para poder publicar libros o solicitar intercambios. Sin embargo, los
                    usuarios no registrados pueden navegar y consultar las publicaciones disponibles.
                </p>
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-justify: distribute">
                    <b>3. ¿Cómo solicito un intercambio de un libro?</b>
                    Dentro de cada publicación encontrarás la opción de solicitar intercambio. Al pulsarla, se enviará
                    una solicitud al propietario del libro, quien podrá aceptarla o rechazarla desde su panel de
                    solicitudes.
                </p>
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-justify: distribute">
                    <b>4. ¿Puedo editar o eliminar una publicación?</b>
                    Sí, cada usuario puede gestionar sus propias publicaciones. Desde la sección “Mis publicaciones”
                    puedes editar la descripción, cambiar la imagen o eliminar el libro si ya no deseas intercambiarlo.
                </p>
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-justify: distribute">
                    <b>5. ¿Qué ocurre cuando aceptan mi solicitud de intercambio?</b>
                    Cuando una solicitud es aceptada, el libro debe depositarse en el AMPA del colegio al que pertenecen
                    ambas partes, adjuntando el id del intercambio. El beneficiario del mismo lo recogera en el mismo lugar,
                    identificándose previamente.
                    La aplicación actúa como intermediaria, pero no gestiona el intercambio físico.
                </p>
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-justify: distribute">
                    <b>6. ¿Cómo puedo contactar con el soporte si tengo un problema?</b>
                    Puedes contactar con nosotros a través de la sección “Contacto” en el pie de página, donde encontrarás un formulario para enviarnos tu consulta o comentario. También puedes escribirnos directamente a nuestro correo
                    <a href="mailto:admin@libre-libro-teca.org">admin@libre-libro-teca.org</a>
                </p>

            </section>

        </div>


    </main>

</x-app-layout>
