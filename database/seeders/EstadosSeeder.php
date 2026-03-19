<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estados')->insert([
            ['nombre_estado' => 'activo'],
            ['nombre_estado' => 'inactivo'],
            ['nombre_estado' => 'publicado'],
            ['nombre_estado' => 'bloqueado'],
            ['nombre_estado' => 'despublicado']
        ]);
    }
    }
?>
