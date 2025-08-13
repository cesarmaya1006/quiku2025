<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Categorias extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('categorias')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $categorias = [
            'Celulares y Smartphones',
            'Tecnología',
            'Electrodomésticos',
            'Muebles',
            'Dormitorio',
            'Decohogar',
            'Zapatos',
            'Mujer',
            'Accesorios',
            'Belleza',
            'Hombre',
            'Deportes',
            'Infantil',
            'Juguetería',
            'Otras Categoría,',
        ];
        foreach ($categorias as $key => $value) {
            DB::table('categorias')->insert([
                'categoria' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
