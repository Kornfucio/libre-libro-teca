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

                    Nuestros Colaboradores: El corazón de Libre-libro-teca
                </h1>
                <img src="{{ asset('build/images/logo.png') }}" alt="Logo" class="h-80 w-auto mx-auto block">
                <p class="text-gray-600 mt-4 leading-relaxed" style="text-align:center">
                    Desde <b>Libre-libro-teca</b> queremos dedicar este espacio para reconocer y agradecer profundamente
                    el esfuerzo de quienes hacen que esta iniciativa sea una realidad. Esta plataforma nació del deseo de
                    ayudar a las familias de Gijón, pero su actividad sería absolutamente imposible sin el apoyo incondicional,
                    la difusión y el trabajo desinteresado de los centros educativos y sus AMPAs.

                    Ellos son el verdadero motor de esta red solidaria. Gracias a su compromiso con la educación pública, la
                    sostenibilidad y la igualdad de oportunidades, logramos que miles de libros de texto lleguen cada año a las
                    manos de los estudiantes que los necesitan. Sin su labor de organización, recogida y comunicación con las
                    familias, Libre-libro-teca no podría existir.

                    A todos ellos: ¡Gracias por hacer posible que la educación sea de todos y para todos!
                    Red de Centros y AMPAs Colaboradoras en Gijón

                    Queremos hacer una mención especial a las Asociaciones de Madres y Padres de Alumnos (AMPAs) y a las
                    direcciones de los siguientes centros educativos de nuestro municipio, que colaboran activamente con
                    nosotros:
                    <br>
                    <br>
                    <ul style="text-align: center">
                    <li>AMPA del IES Jovellanos</li>

                    <li>AMPA "La Laboral" (IES Universidad Laboral)</li>

                    <li>AMPA del IES Rosario Acuña</li>

                    <li>AMPA del CP El Llano</li>

                    <li>AMPA del CP Evaristo Valle</li>

                    <li>AMPA "La Arena" (IES Emilio Alarcos)</li>

                    <li>AMPA del IES Calderón de la Barca</li>

                    <li>AMPA del CP Begoña</li>

                    <li>AMPA del IES Roces</li>

                    <ul>AMPA del CP Rey Pelayo</li>

                    <li>AMPA "Los Fresnos" (IES Piles)</li>

                    <li>AMPA del CP Federico García Lorca</li>
                    </ul>
<br>
(¿Perteneces a un centro educativo o AMPA de Gijón que no está en la lista y queréis sumaros a nuestra red? ¡<a href="mailto:admin@libre-libro-teca.com" style="color:blue">Escríbenos</a> y ayúdanos a seguir creciendo!)

                </p>

            </section>

        </div>

    </main>

</x-app-layout>
