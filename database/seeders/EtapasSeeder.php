<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtapasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('etapas')->insert([
            ['nombre_etapa' => 'infantil'],
            ['nombre_etapa' => 'primaria'],
            ['nombre_etapa' => 'secundaria'],
            ['nombre_etapa' => 'bachiller']
        ]);
    }
}
