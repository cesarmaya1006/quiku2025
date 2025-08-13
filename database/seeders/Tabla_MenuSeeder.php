<?php

namespace Database\Seeders;

use App\Models\Config\Menu;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_MenuSeeder extends Seeder
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
        $menus = [
            //Menu Inicio
            ['nombre' => 'Dashboard', 'menu_id' => null, 'url' => 'dashboard', 'orden' => '1', 'icono' => 'bi bi-speedometer', 'Array_1' => []],
            //Menu configuración 2
            ['nombre' => 'Configuración Sistema', 'menu_id' => null, 'url' => '#', 'orden' => '2', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    //Menu menu
                    ['nombre' => 'Menús', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/menu', 'orden' => '1',  'icono' => 'fas fa-list-ul', 'Array_1' => []],
                    //Menu Roles
                    ['nombre' => 'Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/rol', 'orden' => '2',  'icono' => 'fas fa-users', 'Array_1' => []],
                    //Menu Menu_Roles
                    ['nombre' => 'Menú - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permisos_menus_rol', 'orden' => '2',  'icono' => 'fas fa-chalkboard-teacher', 'Array_1' => []],
                    //Menu permisos
                    ['nombre' => 'Permisos', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permiso_rutas', 'orden' => '2',  'icono' => 'fas fa-check-square', 'Array_1' => []],
                    //Menu permisos-rol
                    ['nombre' => 'Permisos - Roles', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/permisos_rol', 'orden' => '2',  'icono' => 'fas fa-user-shield', 'Array_1' => []],
                    //Menu Usuarios
                    ['nombre' => 'Usuarios', 'menu_id' => '2',  'url' => 'dashboard/configuracion_sis/usuarios', 'orden' => '2',  'icono' => 'fas fa-user-friends', 'Array_1' => []],

                ],
            ],
            ['nombre' => 'Gestionar', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-chalkboard-teacher',
                'Array_1' => [
                    //Menu organigrama
                    ['nombre' => 'Listado PQR', 'menu_id' => '2',  'url' => 'gestionar/listado', 'orden' => '1',  'icono' => 'far fa-list-alt','Array_1' => []],
                    ['nombre' => 'Generar PQR', 'menu_id' => '2',  'url' => 'gestionar/generar', 'orden' => '1',  'icono' => 'fas fa-plus-square','Array_1' => []],
                ],
            ],
            ['nombre' => 'Otras opciones', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-question-circle',
                'Array_1' => [
                    ['nombre' => 'Consulte nuestas políticas de datos', 'menu_id' => '2',  'url' => 'opciones/consulta-politicas', 'orden' => '1',  'icono' => 'fas fa-question-circle','Array_1' => []],
                    ['nombre' => 'Ayuda', 'menu_id' => '2',  'url' => 'opciones/generar', 'orden' => '1',  'icono' => 'fas fa-question-circle','Array_1' => []],
                    ['nombre' => 'Actualizar datos', 'menu_id' => '2',  'url' => 'opciones/actualizar-datos', 'orden' => '1',  'icono' => 'fas fa-edit','Array_1' => []],
                    ['nombre' => 'Cambiar contraseña', 'menu_id' => '2',  'url' => 'opciones/cambiar-password', 'orden' => '1',  'icono' => 'fas fa-key','Array_1' => []],
                ],

            ],
            ['nombre' => 'Parametros', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-cogs',
                'Array_1' => [
                    ['nombre' => 'Categorias', 'menu_id' => '2',  'url' => 'parametros/categorias', 'orden' => '1',  'icono' => 'fas fa-list-ul','Array_1' => []],
                    ['nombre' => 'Productos', 'menu_id' => '2',  'url' => 'parametros/productos', 'orden' => '1',  'icono' => 'fas fa-list-ul','Array_1' => []],
                    ['nombre' => 'Marcas', 'menu_id' => '2',  'url' => 'parametros/marcas', 'orden' => '1',  'icono' => 'fas fa-list-ul','Array_1' => []],
                    ['nombre' => 'Referencias', 'menu_id' => '2',  'url' => 'parametros/referencias', 'orden' => '1',  'icono' => 'fas fa-list-ul','Array_1' => []],
                ],

            ],

            ['nombre' => 'Tutelas', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-gavel',
                'Array_1' => [
                    ['nombre' => 'Registro', 'menu_id' => '2',  'url' => 'tutelas/registro', 'orden' => '1',  'icono' => 'fas fa-plus-square','Array_1' => []],
                    ['nombre' => 'Listado', 'menu_id' => '2',  'url' => 'tutelas/listado', 'orden' => '1',  'icono' => 'far fa-list-alt','Array_1' => []],
                    ['nombre' => 'Gestión', 'menu_id' => '2',  'url' => 'tutelas/gestion', 'orden' => '1',  'icono' => 'fas fa-grip-horizontal','Array_1' => []],
                    ['nombre' => 'Consulta', 'menu_id' => '2',  'url' => 'tutelas/consulta', 'orden' => '1',  'icono' => 'fas fa-search','Array_1' => []],
                ],

            ],


            ['nombre' => 'PQR', 'menu_id' => null, 'url' => '#', 'orden' => '3', 'icono' => 'fas fa-hand-pointer',
                'Array_1' => [
                    ['nombre' => 'Listado PQR', 'menu_id' => '2',  'url' => 'pqr/listado', 'orden' => '1',  'icono' => 'fas fa-question-circle','Array_1' => []],
                    ['nombre' => 'Listado usuarios', 'menu_id' => '2',  'url' => 'pqr/usuarios-listado', 'orden' => '1',  'icono' => 'fas fa-list-ul','Array_1' => []],
                    ['nombre' => 'Gestionar PQR', 'menu_id' => '2',  'url' => 'pqr/gestion_pqr', 'orden' => '1',  'icono' => 'fas fa-grip-horizontal','Array_1' => []],
                ],

            ],


            // Modulo archivo
            ['nombre' => 'Wiku', 'menu_id' => null, 'url' => 'dashboard/archivo-modulo', 'icono' => 'fas fa-list-ul', 'Array_1' => []],
            // Modulo proyectos
            ['nombre' => 'Analítica', 'menu_id' => null, 'url' => 'dashboard/proyectos', 'icono' => 'fas fa-grip-horizontal', 'Array_1' => []],
            // Modulo archivo
            ['nombre' => 'Wiku Parametros', 'menu_id' => null, 'url' => 'dashboard/noticias', 'icono' => 'fas fa-grip-horizontal', 'Array_1' => []],
        ];
        // ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ========== ==========
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
        // -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * -- * --
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 2,]);
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 3,]);
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 4,]);
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 5,]);
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 6,]);
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 7,]);
        DB::table('menu_rol')->insert(['menu_id' => 1, 'rol_id' => 8,]);

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
