<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_EstadosTutela extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('estadostutela')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $estados = [
            ['estado_funcionario' => 'Sin radicar'],
            ['estado_funcionario' => 'Radicada'],
            ['estado_funcionario' => 'En trámite'],
            ['estado_funcionario' => 'Cerrado'],
            ['estado_funcionario' => 'Registro Sent 1era Instancia'],
            ['estado_funcionario' => 'Gestion Sent 1era Instancia'],
            ['estado_funcionario' => 'Radicado Sent 1era Instancia'],
            ['estado_funcionario' => 'Registro Sent 2da Instancia'],
            ['estado_funcionario' => 'Tutela Cerrada'],
        ];
        foreach ($estados as $key => $value) {
            DB::table('estadostutela')->insert([
                'estado_funcionario' => $value['estado_funcionario'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }

    }
}
