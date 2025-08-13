<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_TareasTutela extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('tareas_tutela')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $tipos = [
            ['tarea' => 'SUPERVISA'],
            ['tarea' => 'PROYECTA'],
            ['tarea' => 'REVISA'],
            ['tarea' => 'APRUEBA'],
            ['tarea' => 'RADICA']
        ];
        foreach ($tipos as $key => $value) {
            DB::table('tareas_tutela')->insert([
                'tarea' => $value['tarea'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
