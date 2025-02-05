<?php

namespace Database\Seeders;

use App\Models\Config\Menu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('menus')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('menu_rol')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        $menus = [
            //Menu Inicio
            ['nombre' => 'Inicio', 'menu_id' => null, 'url' => '/dashboard', 'orden' => '1', 'icono' => 'fas fa-home', 'Array_1' => []],
            //Menu configuración 2
            [
                'nombre' => 'Configuración Sistema', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-tools',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Menús', 'menu_id' => '2',  'url' =>  'configuracion_sis/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Roles Usuarios', 'menu_id' => '2',  'url' =>  'configuracion_sis/rol', 'orden' => '2',  'icono' => 'fas fa-user-tag', 'Array_1' => []],
                    //Menu Menu_Roles
                    ['nombre' => 'Menú - Roles', 'menu_id' => '2',  'url' =>  'configuracion_sis/menu_rol', 'orden' => '2',  'icono' => 'fas fa-chalkboard-teacher', 'Array_1' => []],
                    //Menu permisos
                    ['nombre' => 'Permisos', 'menu_id' => '2',  'url' =>  'configuracion_sis/permiso_rutas', 'orden' => '2',  'icono' => 'fas fa-lock', 'Array_1' => []],
                    //Menu permisos-rol
                    ['nombre' => 'Permisos -Rol', 'menu_id' => '2',  'url' =>  'configuracion_sis/_permiso-rol', 'orden' => '2',  'icono' => 'fas fa-user-lock', 'Array_1' => []],
                    //Menu Empresas
                    ['nombre' => 'Usuarios', 'menu_id' => '2',  'url' =>  'configuracion_sis/usuarios', 'orden' => '2',  'icono' => 'fas fa-user-friends', 'Array_1' => []],

                ],
            ],

            //Menu Gestionar
            [
                'nombre' => 'Gestionar', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-chalkboard-teacher',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Listado PQR', 'menu_id' => '2',  'url' =>  'usuario/listado', 'orden' => '1',  'icono' => 'far fa-list-alt', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Generar PQR', 'menu_id' => '2',  'url' =>  'usuario/generar', 'orden' => '2',  'icono' => 'fas fa-plus-square', 'Array_1' => []],

                ],
            ],


            //PARAMETROS
            [
                'nombre' => 'Parametros', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Menu Categorias
                    ['nombre' => 'Categorias', 'menu_id' => '2',  'url' =>  'parametros/admin/categorias', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //Menu Productos
                    ['nombre' => 'Productos', 'menu_id' => '2',  'url' =>  'parametros/admin/productos', 'orden' => '2',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //Menu Marcas
                    ['nombre' => 'Marcas', 'menu_id' => '2',  'url' =>  'parametros/admin/marcas', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //Menu Referencias
                    ['nombre' => 'Referencias', 'menu_id' => '2',  'url' =>  'parametros/admin/referencias', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                ],
            ],


            //TUTELAS
            [
                'nombre' => 'Tutelas', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-chalkboard-teacher',
                'Array_1' => [
                    //TUTELAS Registro
                    ['nombre' => 'Registro', 'menu_id' => '2',  'url' =>  'tutelas/registro', 'orden' => '1',  'icono' => 'fas fa-plus-square', 'Array_1' => []],
                    //TUTELAS Listado
                    ['nombre' => 'Listado', 'menu_id' => '2',  'url' =>  'tutelas/listado', 'orden' => '2',  'icono' => 'far fa-list-alt', 'Array_1' => []],
                    //TUTELAS Gestión
                    ['nombre' => 'Gestión', 'menu_id' => '2',  'url' =>  'tutelas/gestion', 'orden' => '1',  'icono' => 'fas fa-grip-horizontal', 'Array_1' => []],
                    //TUTELAS Consulta
                    ['nombre' => 'Consulta', 'menu_id' => '2',  'url' =>  'tutelas/consulta', 'orden' => '1',  'icono' => 'fas fa-search', 'Array_1' => []],
                ],
            ],


            //PQR
            [
                'nombre' => 'PQR', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-info-circle',
                'Array_1' => [
                    //TUTELAS Listado PQR
                    ['nombre' => 'Listado PQR', 'menu_id' => '2',  'url' =>  'funcionario/listado', 'orden' => '1',  'icono' => 'fas fa-question-circle', 'Array_1' => []],
                    //TUTELAS Listado usuarios
                    ['nombre' => 'Listado usuarios', 'menu_id' => '2',  'url' =>  'funcionario/usuarios-listado', 'orden' => '2',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //TUTELAS Gestionar PQR
                    ['nombre' => 'Gestionar PQR', 'menu_id' => '2',  'url' =>  'funcionario/gestion_pqr', 'orden' => '1',  'icono' => 'fas fa-grip-horizontal', 'Array_1' => []],
                ],
            ],


            //Conf Cuenta Usuario
            [
                'nombre' => 'Conf Cuenta Usuario', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-user-cog',
                'Array_1' => [
                    //TUTELAS Listado PQR
                    ['nombre' => 'Crear usuario asistido', 'menu_id' => '2',  'url' =>  'tutelas/registro', 'orden' => '1',  'icono' => 'fas fa-user-plus', 'Array_1' => []],
                    //TUTELAS Listado usuarios
                    ['nombre' => 'Actualizar datos', 'menu_id' => '2',  'url' =>  'tutelas/listado', 'orden' => '2',  'icono' => 'fas fa-edit', 'Array_1' => []],
                    //TUTELAS Gestionar PQR
                    ['nombre' => 'Cambiar contraseña', 'menu_id' => '2',  'url' =>  'tutelas/consulta', 'orden' => '1',  'icono' => 'fas fa-key', 'Array_1' => []],
                ],
            ],

            //Wiku
            ['nombre' => 'Wiku', 'menu_id' => null, 'url' => 'funcionario/wiku-index', 'orden' => '1', 'icono' => 'fas fa-list-ul', 'Array_1' => []],

            //Analítica
            ['nombre' => 'Analítica', 'menu_id' => null, 'url' => 'analitica', 'orden' => '1', 'icono' => 'fas fa-grip-horizontal', 'Array_1' => []],

            //Wiku Parametros
            ['nombre' => 'Wiku Parametros', 'menu_id' => null, 'url' => 'admin/funcionario/wiku/index', 'orden' => '1', 'icono' => 'fas fa-grip-horizontal', 'Array_1' => []],




            // Otras Opciones
            [
                'nombre' => 'Otras opciones', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-question-circle',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Consulte nuestas políticas de datos', 'menu_id' => '2',  'url' =>  'usuario/consulta-politicas', 'orden' => '1',  'icono' => 'fas fa-question-circle', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Ayuda', 'menu_id' => '2',  'url' =>  'usuario/ayuda', 'orden' => '2',  'icono' => 'fas fa-question-circle', 'Array_1' => []],
                    //Menu menu
                    ['nombre' => 'Actualizar datos', 'menu_id' => '2',  'url' =>  'usuario/actualizar-datos', 'orden' => '1',  'icono' => 'fas fa-edit', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Cambiar contraseña', 'menu_id' => '2',  'url' =>  'usuario/cambiar-password', 'orden' => '2',  'icono' => 'fas fa-key', 'Array_1' => []],

                ],
            ],
        ];
        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        $x = 0;
        foreach ($menus as $menu) {
            $x++;
            $menu_new = Menu::create([
                'menu_id' => $menu['menu_id'],
                'nombre' => utf8_encode(utf8_decode($menu['nombre'])),
                'url' => $menu['url'],
                'orden' => $x,
                'icono' => $menu['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if (count($menu['Array_1']) > 0) {
                $this->sub_menu($menu['Array_1'], $menu_new->id);
            }
        }
        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        $menus = Menu::get();
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        foreach ($menus as $menu) {
            DB::table('menu_rol')->insert(['menu_id' => $menu->id, 'rol_id' => 1,]);
        }
        $menuFuncionarios = $menus->whereIn('id',[1,22,23,24,25,33,34,35,36,37]);
        foreach ($menuFuncionarios as $menu) {
            DB::table('menu_rol')->insert(['menu_id' => $menu->id, 'rol_id' => 5,]);
        }
        $menuUsuarios = $menus->whereIn('id',[1,9,10,11,33,34,35,36,37]);
        foreach ($menuUsuarios as $menu) {
            DB::table('menu_rol')->insert(['menu_id' => $menu->id, 'rol_id' => 6,]);
        }

        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        /*DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 2,]);
        for ($i = 17; $i < 34; $i++) {
            DB::table('menu_rol')->insert(['menu_id' => $i, 'rol_id' => 2,]);
        }*/
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
    }
    // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
    public function sub_menu($Array_1, $x)
    {
        $y = 0;
        foreach ($Array_1 as $sub_menu_array) {
            $y++;
            $sub_menu = Menu::create([
                'menu_id' => $x,
                'nombre' => utf8_encode(utf8_decode($sub_menu_array['nombre'])),
                'url' => $sub_menu_array['url'],
                'orden' => $y,
                'icono' => $sub_menu_array['icono'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
            if (count($sub_menu_array['Array_1']) > 0) {
                $this->sub_menu($sub_menu_array['Array_1'], $sub_menu->id);
            }
        }
    }
}
