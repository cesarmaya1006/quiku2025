<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_AsignancionEstados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('asignancion_estados')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

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
            DB::table('asignancion_estados')->insert([
                'estado' => $value['estado'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
