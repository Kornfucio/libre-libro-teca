<x-app-layout>
    <div class="mb-4 text-sm text-gray-600 justify-center">
        {{ __('¿Has olvidado tu contraseña? Indicanos tu correo electrónico y te remitiremos un enlace para resetear tu contraseña que te permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="max-w-md mx-auto p-8">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-6">
            <x-primary-button>
                {{ __('Resetear tu contraseña') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>
