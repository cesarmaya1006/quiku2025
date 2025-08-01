<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Cargos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('cargos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================

        $niveles = [
            ['nivel_id' => '1', 'cargo' => 'Asignador PQR'],
            ['nivel_id' => '1', 'cargo' => 'Funcionario'],
            ['nivel_id' => '1', 'cargo' => 'Director'],
            ['nivel_id' => '1', 'cargo' => 'Directora'],
            ['nivel_id' => '1', 'cargo' => 'Abogado'],
            ['nivel_id' => '1', 'cargo' => 'Abogada'],
            ['nivel_id' => '1', 'cargo' => 'Supervisor'],


        ];
        foreach ($niveles as $key => $value) {
            DB::table('cargos')->insert([
                'nivel_id' => $value['nivel_id'],
                'cargo' => $value['cargo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
