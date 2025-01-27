<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_TiposReposicion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('tipo_reposicion')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $tipos = [
            ['tipo' => 'Aclaración y/o corrección', 'tiempos' => 10],
            ['tipo' => 'Reposición', 'tiempos' => 10],
            ['tipo' => 'Apelación', 'tiempos' => 10],
            ['tipo' => 'Reposición y apelación', 'tiempos' => 20],
        ];
        foreach ($tipos as $key => $value) {
            DB::table('tipo_reposicion')->insert([
                'tipo' => $value['tipo'],
                'tiempos' => $value['tiempos'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
