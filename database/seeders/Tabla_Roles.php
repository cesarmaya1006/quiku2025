<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Tabla_Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $rol1 = Role::create(['name' => 'Administrador Sistema']);
        $rol2 = Role::create(['name' => 'Super Administrador']);
        $rol3 = Role::create(['name' => 'Administrador']);
        $rol4 = Role::create(['name' => 'Coordinador']);
        $rol5 = Role::create(['name' => 'Funcionario']);
        $rol6 = Role::create(['name' => 'Usuario']);
        $rol7 = Role::create(['name' => 'Analitica']);
        $rol8 = Role::create(['name' => 'Wiku']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$rol1, $rol2, $rol3, $rol4,$rol5,$rol6,$rol7,$rol8]);
    }
}
