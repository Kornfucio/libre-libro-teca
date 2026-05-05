<?php

namespace Database\Seeders;

use App\Models\CentroEducativo;
use Illuminate\Database\Seeder;
use App\Models\Estado;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TestDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Estado::create(['id' => 1, 'nombre_estado' => 'activo']);
        CentroEducativo::create(['id' => 1, 'nombre_centro' => 'centro test', 'cif_centro' => '12345678A', 'direccion' => 'Calle Test, 123', 'localidad' => 'Localidad Test', 'provincia' => 'Provincia Test', 'telefono' => '123456789', 'email' => 'centrotest@example.com', 'estado_id' => 1]);
    }
}
