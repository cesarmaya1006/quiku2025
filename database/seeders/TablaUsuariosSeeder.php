<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');


        $usuario1 = User::create([
            'name' => 'Cesar Maya',
            'email' => 'cesarmaya1006@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Administrador Sistema');
        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'Daniel Lopez',
            'email' => 'dlopez@mgl.com',
            'password' => bcrypt('123456789')
        ])->syncRoles(['Administrador']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'alejandro Gomez',
            'email' => 'agomez@mgl.com',
            'password' => bcrypt('123456789')
        ])->syncRoles(['Administrador']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

        $usuario2 = User::create([
            'name' => 'Cesar Maya',
            'email' => 'cesarmaya1007@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Super Administrador');

        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +

        $usuario3 = User::create([
            'name' => 'Cesar Maya',
            'email' => 'cesarmaya1008@gmail.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Administrador');

        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        $identificacion = 10000001;
        $telefono_celu = 3126549898;
        $direccion = 1;
        //------------------------------------------------------
        $usuario4 = User::create([
            'name' => 'Carlos Perez',
            'email' => 'usuario1@gmail.com',
            'password' => bcrypt('clave')
        ])->syncRoles('Usuario');

        DB::table('usuariotemp')->insert([
            'tipo_persona' => 2,
            'tipo_documentos_id' => 1,
            'identificacion' => $identificacion,
            'email' => 'usuario1@gmail.com',
            'estado' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('personas')->insert([
            'id' => $usuario4->id,
            'tipo_documentos_id' => 1,
            'identificacion' => $identificacion,
            'nombre1' => 'Carlos',
            'nombre2' => 'Jose',
            'apellido1' => 'Perez',
            'apellido2' => 'Jimenez',
            'telefono_celu' => $telefono_celu,
            'direccion' => 'Calle de prueba ' . $direccion,
            'pais_id' => 44,
            'municipio_id' => 149,
            'nacionalidad' => 'Colombiano',
            'grado_educacion' => 'Superior',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1995-11-05',
            'grupo_etnico' => '1',
            'discapacidad' => '0',
            'email' => 'usuario1@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        // + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + + +
        $empleados = [
            ['id' => 15, 'cargo_id' => 2, 'sede_id' => 1, 'identificacion' => '90000991', 'nombre1' => 'Adel', 'nombre2' => '', 'apellido1' => 'Mahomud', 'apellido2' => '', 'telefono_celu' => '3509876532', 'direccion' => 'Calle de prueba 13', 'genero' => 'Masculino', 'fecha_nacimiento' => '29342', 'email' => 'empleado15@gmail.com', 'url' => '1639338864-firma.png', 'extension' => 'png', 'peso' => 2.46],
            ['id' => 16, 'cargo_id' => 2, 'sede_id' => 1, 'identificacion' => '90000992', 'nombre1' => 'Alejandra', 'nombre2' => '', 'apellido1' => 'Bances', 'apellido2' => '', 'telefono_celu' => '3509876533', 'direccion' => 'Calle de prueba 13', 'genero' => 'Femenino', 'fecha_nacimiento' => '29343', 'email' => 'empleado16@gmail.com', 'url' => '1639338864-firma.png', 'extension' => 'png', 'peso' => 2.46],
            ['id' => 17, 'cargo_id' => 2, 'sede_id' => 1, 'identificacion' => '90000993', 'nombre1' => 'Alejandra', 'nombre2' => '', 'apellido1' => 'Carranza', 'apellido2' => '', 'telefono_celu' => '3509876534', 'direccion' => 'Calle de prueba 13', 'genero' => 'Femenino', 'fecha_nacimiento' => '29344', 'email' => 'empleado17@gmail.com', 'url' => '1639338864-firma.png', 'extension' => 'png', 'peso' => 2.46],

        ];

        //------------------------------------------------------
        $i = 0;
        foreach ($empleados as $empleado) {
            $i++;
            if ($i < 31) {
                $identificacion++;
                $telefono_celu++;
                $direccion++;
                $usuarioEmpl = User::create([
                    'name' => $empleado['nombre1'] . ' ' . $empleado['apellido1'],
                    'email' => 'empleado'. $i.'@gmail.com',
                    'password' => bcrypt('clave')
                ])->syncRoles('Funcionario');

                DB::table('empleados')->insert([
                    'id' => $usuarioEmpl->id,
                    'tipo_documentos_id' => 1,
                    'cargo_id' => rand(2, 7),
                    'sede_id' => rand(2, 3),
                    'identificacion' => $identificacion,
                    'nombre1' => $empleado['nombre1'],
                    'nombre2' => $empleado['nombre2'],
                    'apellido1' => $empleado['apellido1'],
                    'telefono_celu' => $telefono_celu,
                    'direccion' => 'Calle de prueba ' .$direccion,
                    'genero' => $empleado['genero'],
                    'fecha_nacimiento' => $this->randomDate('1970-01-01','2001-12-31'),
                    'email' => 'empleado'. $i.'@gmail.com',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
        //------------------------------------------------------
    }

    public function randomDate($start_date, $end_date)
    {
        // Convert to timetamps
        $min = strtotime($start_date);
        $max = strtotime($end_date);

        // Generate random number using above bounds
        $val = rand($min, $max);

        // Convert back to desired date format
        return date('Y-m-d', $val);
    }
}
