<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_TipoPersona extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('tipo_persona')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        $tipos = [
            ['tipo' => 'Persona Natural'],
            ['tipo' => 'Persona Jurídica'],
        ];
        foreach ($tipos as $key => $value) {
            DB::table('tipo_persona')->insert([
                'tipo' => $value['tipo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
