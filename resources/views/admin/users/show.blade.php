<x-app-layout>

    <!-- Fondo general gris claro -->
    <main class="py-6 bg-[#F2F2F2] min-h-screen">
        <section class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <!-- Tarjeta principal donde muestro toda la info -->
            <article class="bg-white shadow-lg rounded-xl overflow-hidden">

                <!-- Parte superior tipo "perfil" -->
                <!-- He oscurecido el gradiente para que el texto blanco se vea bien -->
                <div class="bg-gray-100 p-6">
                    <h2 class="text-2xl font-bold text-gray-900">
                        {{ $user->nombre ?? 'Sin nombre' }}
                    </h2>
                    <p class="text-lg text-gray-700">
                        {{ $user->email ?? 'Sin email' }}
                    </p>
                </div>

                <!-- Contenido con los datos -->
                <div class="p-6 space-y-4">

                    <!-- Rol del usuario -->
                    <!-- Uso colores distintos si es admin o usuario normal -->
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-medium text-gray-600">Rol</span>
                        <span class="px-3 py-1 text-sm rounded-full text-white
                            {{ $user->rol == 'admin' ? 'bg-blue-600' : 'bg-gray-500' }}">
                            {{ ucfirst($user->rol) }}
                        </span>
                    </div>

                    <!-- Centro educativo -->
                    <!-- Uso optional() por si el usuario no tiene centro asignado -->
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-medium text-gray-600">Centro educativo</span>
                        <span class="text-gray-800">
                            {{ optional($user->centro)->nombre_centro ?? '-' }}
                        </span>
                    </div>

                    <!-- Estado del usuario -->
                    <!-- Controlo null para evitar errores -->
                    <div class="flex justify-between items-center border-b pb-2">
                        <span class="font-medium text-gray-600">Estado</span>
                        <span class="text-gray-800">
                            {{ optional($user->estado)->nombre_estado ?? '-' }}
                        </span>
                    </div>

                    <!-- Fecha de registro -->
                    <!-- Uso operador ?-> para evitar error si viene null -->
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-600">Fecha de registro</span>
                        <span class="text-gray-800">
                            {{ $user->created_at?->format('d/m/Y') ?? '-' }}
                        </span>
                    </div>

                </div>

            </article>
        </section>
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-boton-volver :ruta="route('admin.users.index')" />
        </section>
    </main>

</x-app-layout>
