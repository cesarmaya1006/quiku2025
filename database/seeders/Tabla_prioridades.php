<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_prioridades extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('prioridades')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $prioridades = [
            'Baja',
            'Normal',
            'Alta',
        ];
        foreach ($prioridades as $key => $value) {
            DB::table('prioridades')->insert([
                'prioridad' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
