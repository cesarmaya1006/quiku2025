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
            Tabla_Usuarios::class,
            Tabla_TipoPQR::class,
            Tabla_prioridades::class,
            Tabla_EstadosPQR::class,
            Tabla_Motivos::class,
            Tabla_SubMotivos::class,
            Tabla_Categorias::class,
            Tabla_Productos::class,
            Tabla_Marcas::class,
            Tabla_Referencias::class,
            Tabla_Servicios::class,
            Tabla_DiasFestivos::class,
            Tabla_Tareas::class,
            Tabla_AsignancionEstados::class,
            Tabla_AsignacionParticularPQR::class,
            Tabla_WikuAreas::class,
            Tabla_WikuTemas::class,
            Tabla_WikuTemasEspecificos::class,
            Tabla_WikuFuente::class,
            Tabla_numeracion::class,
            Tabla_despachos::class,
            Tabla_EstadosTutela::class,
            Tabla_TareasTutela::class,
            Tabla_AsignacionEstadosTutela::class,
            Tabla_TipoPersona::class,
            Tabla_TipoAccion::class,
            Tabla_UnidadNegocio::class,
            Tabla_WikuAutores::class,
            Tabla_WikuPalabras::class,
            Tabla_WikuArgumentos::class,
            Tabla_WikuPalabrasArgumentos::class,
            Tabla_Motivotutelas::class,
            Tabla_Submotivotutelas::class,


        ]);
    }
}
