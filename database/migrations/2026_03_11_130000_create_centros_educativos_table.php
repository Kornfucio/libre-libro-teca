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
        Schema::create('centros_educativos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_centro');
            $table->string('cif_centro')->unique();
            $table->string('direccion')->nullable();
            $table->string('localidad')->nullable();
            $table->string('provincia')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email');

            $table->foreignId('estado_id')->constrained('estados');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros_educativos');
    }
};
