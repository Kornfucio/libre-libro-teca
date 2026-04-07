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

                <a href="{{ route('publicaciones.index') }}"
                    class="block px-4 py-2 border rounded bg-orange-500 text-white hover:bg-orange-600">
                    Buscador
                </a>

            </aside>

            <!-- CONTENIDO -->
            <section class="md:col-span-3 bg-white shadow rounded p-6">

                <h1 class="text-3xl font-bold text-[#1E88C8] mb-6 border-b pb-4">

                    Contacta con nosotros
                    <img src="{{ asset('build/images/logo.png') }}" alt="Logo" class="h-40 w-auto mx-auto block">
                </h1>
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-align:center">
                    Si tienes alguna pregunta, sugerencia o simplemente quieres ponerte en contacto con nosotros, no
                    dudes en enviarnos un mensaje. Estamos aquí para ayudarte y escuchar tus comentarios. Puedes
                    utilizar el siguiente formulario para enviarnos tu consulta, o si lo prefieres, puedes escribirnos
                    directamente a nuestro correo electrónico <a
                        href="mailto:admin@libre-libro-teca.org">admin@libre-libro-teca.org</a>
                </p>
                <form class="mt-6 space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Mensaje</label>
                        <textarea id="message" name="message" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500"></textarea>
                    </div>
                    <div>
                        <select id="subject" name="subject"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500"
                            required>
                            <option value="">Selecciona un asunto</option>
                            <option value="general">Consulta general</option>
                            <option value="sugerencia">Sugerencia</option>
                            <option value="problema">Reportar un problema</option>
                        </select>
                    </div>
                    <button type="submit" onclick="mostrarMensaje()"
                        class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600">Enviar</button>

                    <a href="{{ route('home') }}"
                        class="inline-block px-4 py-2 bg-[#FFC107] text-white rounded hover:opacity-90">
                        Volver
                    </a>
                </form>
                <div id="msg" style="display:none" class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    El mensaje ha sido enviado, te responderemos a la mayor brevedad posible.
                </div>
                <div id="msgerr" style="display:none" class="text-red-800 p-4 rounded mb-4">
                    Por favor, ingresa un asunto para tu mensaje.
                </div>
            </section>
            <script>
                function mostrarMensaje() {
                    const form = document.getElementById('contactForm');

                    // Si el formulario no es válido, deja que HTML muestre errores
                    if (!form.checkValidity()) {
                        form.reportValidity(); // muestra mensajes nativos
                        return;
                    }

                    //Mostrar mensaje de éxito
                    document.getElementById('msg').style.display = 'block';

                    // Ocultar mensaje de error por si acaso
                    const err = document.getElementById('msgerr');
                    if (err) err.style.display = 'none';

                    // Limpiar formulario
                    form.reset();
                }
            </script>
        </div>

    </main>

</x-app-layout>
