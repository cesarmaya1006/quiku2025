<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_AreasInfluencia extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('area_influencia')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================

        for ($i = 1; $i <= 33; $i++) {
            DB::table('area_influencia')->insert([
                'sede_id' => '1',
                'departamento_id' => $i,
            ]);
        }
    }
}
