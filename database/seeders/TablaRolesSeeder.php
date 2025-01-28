<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TablaRolesSeeder extends Seeder
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
        // =======================================================================================================
        Permission::create(['name' => 'dashboard'])->syncRoles([$rol1, $rol2, $rol3, $rol4, $rol5, $rol6, $rol7, $rol8]);
        Permission::create(['name' => 'dashboard.AdministradorSistema'])->syncRoles([$rol1]);
        Permission::create(['name' => 'dashboard.SuperAdministrador'])->syncRoles([$rol1]);
        Permission::create(['name' => 'dashboard.Administrador'])->syncRoles([$rol1,$rol3]);
        Permission::create(['name' => 'dashboard.Coordinador'])->syncRoles([$rol1,$rol4]);
        Permission::create(['name' => 'dashboard.Funcionario'])->syncRoles([$rol1,$rol5]);
        Permission::create(['name' => 'dashboard.Usuario'])->syncRoles([$rol1,$rol6]);
        Permission::create(['name' => 'dashboard.Analitica'])->syncRoles([$rol1,$rol7]);
        Permission::create(['name' => 'dashboard.Wiku'])->syncRoles([$rol1,$rol8]);
        // ===================================================================================
        //Areas
        Permission::create(['name' => 'area.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'area.destroy'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
        // =======================================================================================================
        //Usuarios
        Permission::create(['name' => 'usuario.index'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuario.create'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuario.edit'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuario.store'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuario.update'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuario.destroy'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuario.activar'])->syncRoles([$rol1, $rol2]);
        Permission::create(['name' => 'usuario.getUsuariosRegional'])->syncRoles([$rol1, $rol2]);
        // =======================================================================================================
    }
}
