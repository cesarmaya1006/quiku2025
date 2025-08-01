<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Sedes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('sedes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        DB::table('sedes')->insert([
            'municipio_id' => 149,
            'nombre' => 'Sede Norte',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('sedes')->insert([
            'municipio_id' => 149,
            'nombre' => 'Sede Centro',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('sedes')->insert([
            'municipio_id' => 149,
            'nombre' => 'Sede Sur',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
