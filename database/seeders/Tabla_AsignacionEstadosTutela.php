<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_AsignacionEstadosTutela extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('asignacion_estados_tutela')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $estados = [
            ['estado' => '0'],
            ['estado' => '10'],
            ['estado' => '20'],
            ['estado' => '30'],
            ['estado' => '40'],
            ['estado' => '50'],
            ['estado' => '60'],
            ['estado' => '70'],
            ['estado' => '80'],
            ['estado' => '90'],
            ['estado' => '100']
        ];
        foreach ($estados as $key => $value) {
            DB::table('asignacion_estados_tutela')->insert([
                'estado' => $value['estado'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

    }
}
