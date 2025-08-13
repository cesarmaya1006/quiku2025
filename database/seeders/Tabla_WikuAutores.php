<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_WikuAutores extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('wikuautores')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $tipos = [
            ['nombre1' => 'Carlos','apellido1' => 'Rodriguez']
        ];
        foreach ($tipos as $key => $value) {
            DB::table('wikuautores')->insert([
                'nombre1' => $value['nombre1'],
                'apellido1' => $value['apellido1'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

    }
}
