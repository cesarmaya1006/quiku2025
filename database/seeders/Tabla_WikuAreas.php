<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_WikuAreas extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('wikuareas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $tipos = [
            ['area' => 'Area 1'],
            ['area' => 'Area 2'],
            ['area' => 'Area 3'],
            ['area' => 'Area 4'],
            ['area' => 'Area 5']
        ];
        foreach ($tipos as $key => $value) {
            DB::table('wikuareas')->insert([
                'area' => $value['area'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
