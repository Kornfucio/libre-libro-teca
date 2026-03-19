<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes_intercambio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacion_id')
                    ->constrained('publicaciones');

            $table->foreignId('usuario_id')
                    ->constrained('users');

            $table->text('mensaje')->nullable();

            $table->foreignId('estado_id')->constrained('estados');

            $table->timestamp('fecha_solicitud');

            $table->timestamp('fecha_respuesta')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_intercambio');
    }
};
