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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                        ->constrained('users');

            $table->foreignId('centros_libro_id')
                    ->constrained('centros_libro');

            $table->text('descripcion')->nullable();

            $table->foreignId('estado_id')
                    ->constrained('estados');

            $table->timestamp('fecha_publicacion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacions');
    }
};
