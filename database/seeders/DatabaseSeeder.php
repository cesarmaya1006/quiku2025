<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            Tabla_DocuTipos::class,
            Tabla_Roles::class,
            Tabla_MenuSeeder::class,
            Tabla_Pais::class,
            Tabla_Departamento::class,
            Tabla_Municipio::class,
            Tabla_Sedes::class,
            Tabla_Parametros::class,
            Tabla_Areas::class,
            Tabla_Niveles::class,
            Tabla_Cargos::class,
            Tabla_TiposReposicion::class,
            Tabla_AreasInfluencia::class,

        ]);
    }
}
