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
        Schema::create('centros_libro', function (Blueprint $table) {
            $table->id();

            $table->foreignId('centro_id')
                 ->constrained('centros_educativos');

            $table->foreignId('libro_id')
                ->constrained('libros');

            $table->string('anyo_academico');

            $table->unique([
                'centro_id',
                'libro_id',
                'anyo_academico'
                ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centro_libros');
    }
};
