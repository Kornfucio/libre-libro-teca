<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         //URL::forceScheme('https'); //Forzar el uso de HTTPS en producción, descomentar esta línea si se despliega en un entorno que requiere HTTPS como Ngrok

        Blade::if('isadmin', function () { //Función personalizada para verificar si el usuario tiene el rol de administrador, utilizada en las vistas para mostrar u ocultar secciones de administración
        return auth()->check() && auth()->user()->isAdmin();
        });

    }
}
