<?php

namespace Database\Seeders;

use App\Models\Personas\UsuarioTemp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tabla_Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('usuariotemp')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('representantes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('personas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('empleados')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $empleados =[
            ['id'=>15,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000991','nombre1' => 'Adel', 'nombre2' => '','apellido1' => 'Mahomud','apellido2' => '','telefono_celu' => '3509876532', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29342', 'email' => 'empleado15@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>16,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000992','nombre1' => 'Alejandra', 'nombre2' => '','apellido1' => 'Bances','apellido2' => '','telefono_celu' => '3509876533', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29343', 'email' => 'empleado16@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>17,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000993','nombre1' => 'Alejandra', 'nombre2' => '','apellido1' => 'Carranza','apellido2' => '','telefono_celu' => '3509876534', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29344', 'email' => 'empleado17@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>18,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000994','nombre1' => 'Alejandra', 'nombre2' => '','apellido1' => 'Guzman','apellido2' => '','telefono_celu' => '3509876535', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29345', 'email' => 'empleado18@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>19,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000995','nombre1' => 'Alejandra', 'nombre2' => '','apellido1' => 'Jimenez','apellido2' => '','telefono_celu' => '3509876536', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29346', 'email' => 'empleado19@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>20,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000996','nombre1' => 'Alejandra', 'nombre2' => '','apellido1' => 'Saenz','apellido2' => '','telefono_celu' => '3509876537', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29347', 'email' => 'empleado20@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>21,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000997','nombre1' => 'Alejandra', 'nombre2' => '','apellido1' => 'Trujillo','apellido2' => '','telefono_celu' => '3509876538', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29348', 'email' => 'empleado21@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>22,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000998','nombre1' => 'Ana', 'nombre2' => '','apellido1' => 'Guerra','apellido2' => '','telefono_celu' => '3509876539', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29349', 'email' => 'empleado22@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>23,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90000999','nombre1' => 'Andrea', 'nombre2' => '','apellido1' => 'Bejarano','apellido2' => '','telefono_celu' => '3509876540', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29350', 'email' => 'empleado23@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>24,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001000','nombre1' => 'Andres', 'nombre2' => '','apellido1' => 'Buitrago','apellido2' => '','telefono_celu' => '3509876541', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29351', 'email' => 'empleado24@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>25,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001001','nombre1' => 'Andres', 'nombre2' => '','apellido1' => 'Melo','apellido2' => '','telefono_celu' => '3509876542', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29352', 'email' => 'empleado25@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>26,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001002','nombre1' => 'Andres', 'nombre2' => '','apellido1' => 'Rubiano','apellido2' => '','telefono_celu' => '3509876543', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29353', 'email' => 'empleado26@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>27,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001003','nombre1' => 'Andres', 'nombre2' => '','apellido1' => 'Zarote','apellido2' => '','telefono_celu' => '3509876544', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29354', 'email' => 'empleado27@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>28,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001004','nombre1' => 'Angel', 'nombre2' => '','apellido1' => 'Medina','apellido2' => '','telefono_celu' => '3509876545', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29355', 'email' => 'empleado28@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>29,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001005','nombre1' => 'Angela', 'nombre2' => '','apellido1' => 'Hernandez','apellido2' => '','telefono_celu' => '3509876546', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29356', 'email' => 'empleado29@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>30,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001006','nombre1' => 'Angelica', 'nombre2' => '','apellido1' => 'Herran','apellido2' => '','telefono_celu' => '3509876547', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29357', 'email' => 'empleado30@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>31,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001007','nombre1' => 'Angelica', 'nombre2' => '','apellido1' => 'Tello','apellido2' => '','telefono_celu' => '3509876548', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29358', 'email' => 'empleado31@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>32,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001008','nombre1' => 'Angie', 'nombre2' => '','apellido1' => 'Cruz','apellido2' => '','telefono_celu' => '3509876549', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29359', 'email' => 'empleado32@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>33,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001009','nombre1' => 'Astrid', 'nombre2' => '','apellido1' => 'Rodriguez','apellido2' => '','telefono_celu' => '3509876550', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29360', 'email' => 'empleado33@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>34,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001010','nombre1' => 'Brandon', 'nombre2' => '','apellido1' => 'Lara','apellido2' => '','telefono_celu' => '3509876551', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29361', 'email' => 'empleado34@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>35,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001011','nombre1' => 'Brayan', 'nombre2' => '','apellido1' => 'Salazar','apellido2' => '','telefono_celu' => '3509876552', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29362', 'email' => 'empleado35@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>36,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001012','nombre1' => 'Camilo', 'nombre2' => '','apellido1' => 'Berdugo','apellido2' => '','telefono_celu' => '3509876553', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29363', 'email' => 'empleado36@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>37,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001013','nombre1' => 'Camilo', 'nombre2' => '','apellido1' => 'Bornachera','apellido2' => '','telefono_celu' => '3509876554', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29364', 'email' => 'empleado37@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>38,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001014','nombre1' => 'Camilo', 'nombre2' => '','apellido1' => 'Ramirez','apellido2' => '','telefono_celu' => '3509876555', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29365', 'email' => 'empleado38@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>39,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001015','nombre1' => 'Carlos', 'nombre2' => '','apellido1' => 'Barrero','apellido2' => '','telefono_celu' => '3509876556', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29366', 'email' => 'empleado39@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>40,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001016','nombre1' => 'Carlos', 'nombre2' => '','apellido1' => 'Rojas','apellido2' => '','telefono_celu' => '3509876557', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29367', 'email' => 'empleado40@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>41,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001017','nombre1' => 'Carlos', 'nombre2' => '','apellido1' => 'Serna','apellido2' => '','telefono_celu' => '3509876558', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29368', 'email' => 'empleado41@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>42,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001018','nombre1' => 'Carlos', 'nombre2' => '','apellido1' => 'Turriago','apellido2' => '','telefono_celu' => '3509876559', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29369', 'email' => 'empleado42@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>43,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001019','nombre1' => 'Caterin', 'nombre2' => '','apellido1' => 'Velasquez','apellido2' => '','telefono_celu' => '3509876560', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29370', 'email' => 'empleado43@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>44,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001020','nombre1' => 'Cristian', 'nombre2' => '','apellido1' => 'Martinez','apellido2' => '','telefono_celu' => '3509876561', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29371', 'email' => 'empleado44@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>45,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001021','nombre1' => 'Cristina', 'nombre2' => '','apellido1' => 'Martinez','apellido2' => '','telefono_celu' => '3509876562', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29372', 'email' => 'empleado45@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>46,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001022','nombre1' => 'Dahize', 'nombre2' => '','apellido1' => 'Almanza','apellido2' => '','telefono_celu' => '3509876563', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29373', 'email' => 'empleado46@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>47,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001023','nombre1' => 'Daniel', 'nombre2' => '','apellido1' => 'Alexis','apellido2' => 'Becerra','telefono_celu' => '3509876564', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29374', 'email' => 'empleado47@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>48,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001024','nombre1' => 'Daniela', 'nombre2' => '','apellido1' => 'Jimenez','apellido2' => '','telefono_celu' => '3509876565', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29375', 'email' => 'empleado48@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>49,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001025','nombre1' => 'Daniela', 'nombre2' => '','apellido1' => 'Mejia','apellido2' => '','telefono_celu' => '3509876566', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29376', 'email' => 'empleado49@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>50,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001026','nombre1' => 'Dasuly', 'nombre2' => '','apellido1' => 'Giraldo','apellido2' => '','telefono_celu' => '3509876567', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29377', 'email' => 'empleado50@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>51,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001027','nombre1' => 'Diana', 'nombre2' => '','apellido1' => 'Cardozo','apellido2' => '','telefono_celu' => '3509876568', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29378', 'email' => 'empleado51@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>52,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001028','nombre1' => 'Didier', 'nombre2' => '','apellido1' => 'Castillo','apellido2' => '','telefono_celu' => '3509876569', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29379', 'email' => 'empleado52@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>53,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001029','nombre1' => 'Diego', 'nombre2' => '','apellido1' => 'Caro','apellido2' => '','telefono_celu' => '3509876570', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29380', 'email' => 'empleado53@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>54,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001030','nombre1' => 'Dixon', 'nombre2' => '','apellido1' => 'Anato','apellido2' => '','telefono_celu' => '3509876571', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29381', 'email' => 'empleado54@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>55,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001031','nombre1' => 'Edna', 'nombre2' => '','apellido1' => 'Alarcon','apellido2' => '','telefono_celu' => '3509876572', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29382', 'email' => 'empleado55@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>56,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001032','nombre1' => 'Eliana', 'nombre2' => '','apellido1' => 'Robayo','apellido2' => '','telefono_celu' => '3509876573', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29383', 'email' => 'empleado56@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>57,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001033','nombre1' => 'Erick', 'nombre2' => '','apellido1' => 'Vacca','apellido2' => '','telefono_celu' => '3509876574', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29384', 'email' => 'empleado57@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>58,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001034','nombre1' => 'Estefani', 'nombre2' => '','apellido1' => 'Canelones','apellido2' => '','telefono_celu' => '3509876575', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29385', 'email' => 'empleado58@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>59,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001035','nombre1' => 'Fernanda', 'nombre2' => '','apellido1' => 'Martinez','apellido2' => '','telefono_celu' => '3509876576', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29386', 'email' => 'empleado59@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>60,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001036','nombre1' => 'Fernando', 'nombre2' => '','apellido1' => 'Trujillo','apellido2' => '','telefono_celu' => '3509876577', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29387', 'email' => 'empleado60@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>61,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001037','nombre1' => 'Gabriel', 'nombre2' => '','apellido1' => 'Romero','apellido2' => '','telefono_celu' => '3509876578', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29388', 'email' => 'empleado61@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>62,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001038','nombre1' => 'Geraldine', 'nombre2' => '','apellido1' => 'Martinez','apellido2' => '','telefono_celu' => '3509876579', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29389', 'email' => 'empleado62@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>63,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001039','nombre1' => 'Gina', 'nombre2' => '','apellido1' => 'Pedraza','apellido2' => '','telefono_celu' => '3509876580', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29390', 'email' => 'empleado63@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>64,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001040','nombre1' => 'Hailyn', 'nombre2' => '','apellido1' => 'Rodriguez','apellido2' => '','telefono_celu' => '3509876581', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29391', 'email' => 'empleado64@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>65,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001041','nombre1' => 'Harold', 'nombre2' => '','apellido1' => 'Yepes','apellido2' => '','telefono_celu' => '3509876582', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29392', 'email' => 'empleado65@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>66,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001042','nombre1' => 'Hernando', 'nombre2' => '','apellido1' => 'Rios','apellido2' => '','telefono_celu' => '3509876583', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29393', 'email' => 'empleado66@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>67,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001043','nombre1' => 'Indira', 'nombre2' => '','apellido1' => 'Sauliz','apellido2' => '','telefono_celu' => '3509876584', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29394', 'email' => 'empleado67@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>68,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001044','nombre1' => 'Ivan', 'nombre2' => '','apellido1' => 'Jerez','apellido2' => '','telefono_celu' => '3509876585', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29395', 'email' => 'empleado68@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>69,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001045','nombre1' => 'Ivan', 'nombre2' => '','apellido1' => 'Murcia','apellido2' => '','telefono_celu' => '3509876586', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29396', 'email' => 'empleado69@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>70,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001046','nombre1' => 'Jaime', 'nombre2' => '','apellido1' => 'Guevara','apellido2' => '','telefono_celu' => '3509876587', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29397', 'email' => 'empleado70@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>71,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001047','nombre1' => 'Jairo', 'nombre2' => '','apellido1' => 'Rodriguez','apellido2' => '','telefono_celu' => '3509876588', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29398', 'email' => 'empleado71@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>72,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001048','nombre1' => 'Jairo', 'nombre2' => '','apellido1' => 'Vanegas','apellido2' => '','telefono_celu' => '3509876589', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29399', 'email' => 'empleado72@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>73,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001049','nombre1' => 'jefferson', 'nombre2' => '','apellido1' => 'jimenez','apellido2' => '','telefono_celu' => '3509876590', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29400', 'email' => 'empleado73@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>74,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001050','nombre1' => 'Jeison', 'nombre2' => '','apellido1' => 'Ariza','apellido2' => '','telefono_celu' => '3509876591', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29401', 'email' => 'empleado74@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>75,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001051','nombre1' => 'Jenny', 'nombre2' => '','apellido1' => 'Niño','apellido2' => '','telefono_celu' => '3509876592', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29402', 'email' => 'empleado75@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>76,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001052','nombre1' => 'Jessica', 'nombre2' => '','apellido1' => 'Basallo','apellido2' => '','telefono_celu' => '3509876593', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29403', 'email' => 'empleado76@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>77,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001053','nombre1' => 'Jessica', 'nombre2' => '','apellido1' => 'Gaitan','apellido2' => '','telefono_celu' => '3509876594', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29404', 'email' => 'empleado77@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>78,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001054','nombre1' => 'Jhoan', 'nombre2' => '','apellido1' => 'Montealegre','apellido2' => '','telefono_celu' => '3509876595', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29405', 'email' => 'empleado78@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>79,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001055','nombre1' => 'Jhonatan', 'nombre2' => '','apellido1' => 'Martinez','apellido2' => '','telefono_celu' => '3509876596', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29406', 'email' => 'empleado79@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>80,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001056','nombre1' => 'Johanna', 'nombre2' => '','apellido1' => 'Moreno','apellido2' => '','telefono_celu' => '3509876597', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29407', 'email' => 'empleado80@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>81,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001057','nombre1' => 'Johanna', 'nombre2' => '','apellido1' => 'Russi','apellido2' => '','telefono_celu' => '3509876598', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29408', 'email' => 'empleado81@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>82,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001058','nombre1' => 'John', 'nombre2' => '','apellido1' => 'Calderon','apellido2' => '','telefono_celu' => '3509876599', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29409', 'email' => 'empleado82@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>83,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001059','nombre1' => 'John', 'nombre2' => '','apellido1' => 'Rueda','apellido2' => '','telefono_celu' => '3509876600', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29410', 'email' => 'empleado83@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>84,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001060','nombre1' => 'Jorge', 'nombre2' => '','apellido1' => 'Mogollon','apellido2' => '','telefono_celu' => '3509876601', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29411', 'email' => 'empleado84@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>85,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001061','nombre1' => 'Jose', 'nombre2' => '','apellido1' => 'Alexander','apellido2' => '','telefono_celu' => '3509876602', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29412', 'email' => 'empleado85@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>86,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001062','nombre1' => 'Jose', 'nombre2' => '','apellido1' => 'Garcia','apellido2' => '','telefono_celu' => '3509876603', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29413', 'email' => 'empleado86@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>87,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001063','nombre1' => 'Jose', 'nombre2' => '','apellido1' => 'Lopez','apellido2' => '','telefono_celu' => '3509876604', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29414', 'email' => 'empleado87@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>88,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001064','nombre1' => 'Jose', 'nombre2' => '','apellido1' => 'Mario','apellido2' => 'Rivera','telefono_celu' => '3509876605', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29415', 'email' => 'empleado88@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>89,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001065','nombre1' => 'Juan', 'nombre2' => '','apellido1' => 'Carlos','apellido2' => '','telefono_celu' => '3509876606', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29416', 'email' => 'empleado89@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>90,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001066','nombre1' => 'Juan', 'nombre2' => '','apellido1' => 'Jose','apellido2' => '','telefono_celu' => '3509876607', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29417', 'email' => 'empleado90@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>91,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001067','nombre1' => 'Julieth', 'nombre2' => '','apellido1' => 'Valencia','apellido2' => '','telefono_celu' => '3509876608', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29418', 'email' => 'empleado91@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>92,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001068','nombre1' => 'July', 'nombre2' => '','apellido1' => 'Gordillo','apellido2' => '','telefono_celu' => '3509876609', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29419', 'email' => 'empleado92@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>93,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001069','nombre1' => 'Justin', 'nombre2' => '','apellido1' => 'Diaz','apellido2' => '','telefono_celu' => '3509876610', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29420', 'email' => 'empleado93@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>94,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001070','nombre1' => 'Justine', 'nombre2' => '','apellido1' => 'Pulido','apellido2' => '','telefono_celu' => '3509876611', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29421', 'email' => 'empleado94@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>95,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001071','nombre1' => 'Karen', 'nombre2' => '','apellido1' => 'Ardila','apellido2' => '','telefono_celu' => '3509876612', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29422', 'email' => 'empleado95@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>96,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001072','nombre1' => 'Karin', 'nombre2' => '','apellido1' => 'Fuenmayor','apellido2' => '','telefono_celu' => '3509876613', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29423', 'email' => 'empleado96@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>97,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001073','nombre1' => 'Katherine', 'nombre2' => '','apellido1' => 'Amanda','apellido2' => 'Araujo','telefono_celu' => '3509876614', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29424', 'email' => 'empleado97@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>98,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001074','nombre1' => 'Katherine', 'nombre2' => '','apellido1' => 'Medina','apellido2' => '','telefono_celu' => '3509876615', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29425', 'email' => 'empleado98@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>99,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001075','nombre1' => 'Kevin', 'nombre2' => '','apellido1' => 'Guerrero','apellido2' => '','telefono_celu' => '3509876616', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29426', 'email' => 'empleado99@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>100,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001076','nombre1' => 'Kevin', 'nombre2' => '','apellido1' => 'Marquez','apellido2' => '','telefono_celu' => '3509876617', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29427', 'email' => 'empleado100@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>101,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001077','nombre1' => 'Kimberly', 'nombre2' => '','apellido1' => 'Zambrano','apellido2' => '','telefono_celu' => '3509876618', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29428', 'email' => 'empleado101@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>102,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001078','nombre1' => 'Laura', 'nombre2' => '','apellido1' => 'Izquierdo','apellido2' => '','telefono_celu' => '3509876619', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29429', 'email' => 'empleado102@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>103,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001079','nombre1' => 'Laura', 'nombre2' => '','apellido1' => 'Moreno','apellido2' => '','telefono_celu' => '3509876620', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29430', 'email' => 'empleado103@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>104,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001080','nombre1' => 'Leidy', 'nombre2' => '','apellido1' => 'Bolivar','apellido2' => '','telefono_celu' => '3509876621', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29431', 'email' => 'empleado104@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>105,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001081','nombre1' => 'Leidy', 'nombre2' => '','apellido1' => 'Leon','apellido2' => '','telefono_celu' => '3509876622', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29432', 'email' => 'empleado105@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>106,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001082','nombre1' => 'Leonardo', 'nombre2' => '','apellido1' => 'Chaves','apellido2' => '','telefono_celu' => '3509876623', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29433', 'email' => 'empleado106@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>107,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001083','nombre1' => 'Claudia', 'nombre2' => '','apellido1' => 'Aldana','apellido2' => '','telefono_celu' => '3509876624', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29434', 'email' => 'empleado107@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>108,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001084','nombre1' => 'Luis', 'nombre2' => '','apellido1' => 'Bejarano','apellido2' => '','telefono_celu' => '3509876625', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29435', 'email' => 'empleado108@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>109,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001085','nombre1' => 'Luis', 'nombre2' => '','apellido1' => 'Hernandez','apellido2' => '','telefono_celu' => '3509876626', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29436', 'email' => 'empleado109@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>110,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001086','nombre1' => 'Luis', 'nombre2' => '','apellido1' => 'Pacheco','apellido2' => '','telefono_celu' => '3509876627', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29437', 'email' => 'empleado110@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>111,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001087','nombre1' => 'Luis', 'nombre2' => '','apellido1' => 'Samaca','apellido2' => '','telefono_celu' => '3509876628', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29438', 'email' => 'empleado111@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>112,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001088','nombre1' => 'Luis', 'nombre2' => '','apellido1' => 'Venegas','apellido2' => '','telefono_celu' => '3509876629', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29439', 'email' => 'empleado112@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>113,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001089','nombre1' => 'Luz', 'nombre2' => '','apellido1' => 'Hernandez','apellido2' => '','telefono_celu' => '3509876630', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29440', 'email' => 'empleado113@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>114,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001090','nombre1' => 'Marcela', 'nombre2' => '','apellido1' => 'Beltran','apellido2' => '','telefono_celu' => '3509876631', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29441', 'email' => 'empleado114@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>115,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001091','nombre1' => 'Maria', 'nombre2' => '','apellido1' => 'Bargallo','apellido2' => '','telefono_celu' => '3509876632', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29442', 'email' => 'empleado115@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>116,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001092','nombre1' => 'Maria', 'nombre2' => '','apellido1' => 'Velez','apellido2' => '','telefono_celu' => '3509876633', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29443', 'email' => 'empleado116@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>117,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001093','nombre1' => 'Michael', 'nombre2' => '','apellido1' => 'Santa','apellido2' => '','telefono_celu' => '3509876634', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29444', 'email' => 'empleado117@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>118,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001094','nombre1' => 'Monica', 'nombre2' => '','apellido1' => 'Parra','apellido2' => '','telefono_celu' => '3509876635', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29445', 'email' => 'empleado118@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>119,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001095','nombre1' => 'Nanlel', 'nombre2' => '','apellido1' => 'Gonzalez','apellido2' => '','telefono_celu' => '3509876636', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29446', 'email' => 'empleado119@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>120,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001096','nombre1' => 'Nathalia', 'nombre2' => '','apellido1' => 'Montenegro','apellido2' => '','telefono_celu' => '3509876637', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29447', 'email' => 'empleado120@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>121,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001097','nombre1' => 'Nelson', 'nombre2' => '','apellido1' => 'Barrera','apellido2' => '','telefono_celu' => '3509876638', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29448', 'email' => 'empleado121@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>122,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001098','nombre1' => 'Nestor', 'nombre2' => '','apellido1' => 'Cambindo','apellido2' => '','telefono_celu' => '3509876639', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29449', 'email' => 'empleado122@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>123,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001099','nombre1' => 'Nicol', 'nombre2' => '','apellido1' => 'Franco','apellido2' => '','telefono_celu' => '3509876640', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29450', 'email' => 'empleado123@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>124,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001100','nombre1' => 'Oscar', 'nombre2' => '','apellido1' => 'Infante','apellido2' => '','telefono_celu' => '3509876641', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29451', 'email' => 'empleado124@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>125,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001101','nombre1' => 'Oscar', 'nombre2' => '','apellido1' => 'Sosa','apellido2' => '','telefono_celu' => '3509876642', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29452', 'email' => 'empleado125@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>126,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001102','nombre1' => 'Oscar', 'nombre2' => '','apellido1' => 'Velazquez','apellido2' => '','telefono_celu' => '3509876643', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29453', 'email' => 'empleado126@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>127,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001103','nombre1' => 'Oswaldo', 'nombre2' => '','apellido1' => 'Paez','apellido2' => '','telefono_celu' => '3509876644', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29454', 'email' => 'empleado127@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>128,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001104','nombre1' => 'Paola', 'nombre2' => '','apellido1' => 'Barbosa','apellido2' => '','telefono_celu' => '3509876645', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29455', 'email' => 'empleado128@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>129,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001105','nombre1' => 'Paula', 'nombre2' => '','apellido1' => 'Garzon','apellido2' => '','telefono_celu' => '3509876646', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29456', 'email' => 'empleado129@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>130,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001106','nombre1' => 'Paula', 'nombre2' => '','apellido1' => 'Rendon','apellido2' => '','telefono_celu' => '3509876647', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29457', 'email' => 'empleado130@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>131,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001107','nombre1' => 'Richard', 'nombre2' => '','apellido1' => 'Valderrama','apellido2' => '','telefono_celu' => '3509876648', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29458', 'email' => 'empleado131@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>132,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001108','nombre1' => 'Sandra', 'nombre2' => '','apellido1' => 'Molano','apellido2' => '','telefono_celu' => '3509876649', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29459', 'email' => 'empleado132@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>133,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001109','nombre1' => 'Sandra', 'nombre2' => '','apellido1' => 'Quiñonez','apellido2' => '','telefono_celu' => '3509876650', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29460', 'email' => 'empleado133@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>134,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001110','nombre1' => 'Sneider', 'nombre2' => '','apellido1' => 'Cortes','apellido2' => '','telefono_celu' => '3509876651', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29461', 'email' => 'empleado134@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>135,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001111','nombre1' => 'Stefania', 'nombre2' => '','apellido1' => 'Piedrahita','apellido2' => '','telefono_celu' => '3509876652', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29462', 'email' => 'empleado135@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>136,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001112','nombre1' => 'Steven', 'nombre2' => '','apellido1' => 'Robledo','apellido2' => '','telefono_celu' => '3509876653', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29463', 'email' => 'empleado136@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>137,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001113','nombre1' => 'Tatiana', 'nombre2' => '','apellido1' => 'Oyola','apellido2' => '','telefono_celu' => '3509876654', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29464', 'email' => 'empleado137@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>138,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001114','nombre1' => 'Tatiana', 'nombre2' => '','apellido1' => 'Rodriguez','apellido2' => '','telefono_celu' => '3509876655', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29465', 'email' => 'empleado138@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>139,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001115','nombre1' => 'Valeria', 'nombre2' => '','apellido1' => 'Garcia','apellido2' => '','telefono_celu' => '3509876656', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29466', 'email' => 'empleado139@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>140,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001116','nombre1' => 'Valeria', 'nombre2' => '','apellido1' => 'Gnecco','apellido2' => '','telefono_celu' => '3509876657', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29467', 'email' => 'empleado140@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>141,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001117','nombre1' => 'Vilmary', 'nombre2' => '','apellido1' => 'Lopez','apellido2' => '','telefono_celu' => '3509876658', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29468', 'email' => 'empleado141@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>142,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001118','nombre1' => 'Viviana', 'nombre2' => '','apellido1' => 'Vanegas','apellido2' => '','telefono_celu' => '3509876659', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29469', 'email' => 'empleado142@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>143,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001119','nombre1' => 'Wilfer', 'nombre2' => '','apellido1' => 'Beltran','apellido2' => '','telefono_celu' => '3509876660', 'direccion' => 'Calle de prueba 13','genero' => 'Masculino','fecha_nacimiento' => '29470', 'email' => 'empleado143@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>144,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001120','nombre1' => 'Yina', 'nombre2' => '','apellido1' => 'Ruiz','apellido2' => '','telefono_celu' => '3509876661', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29471', 'email' => 'empleado144@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],
            ['id'=>145,'cargo_id' => 2,'sede_id' => 1, 'identificacion' => '90001121','nombre1' => 'Yulieth', 'nombre2' => '','apellido1' => 'Parra','apellido2' => '','telefono_celu' => '3509876662', 'direccion' => 'Calle de prueba 13','genero' => 'Femenino','fecha_nacimiento' => '29472', 'email' => 'empleado145@gmail.com','url' => '1639338864-firma.png','extension' => 'png','peso' => 2.46],

        ];
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario1 = User::create([
            'name' => 'adminsis',
            'email' => 'adminsis@mgl.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Administrador Sistema','Super Administrador','Administrador','Coordinador','Funcionario','Usuario','Analitica','Wiku');
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'admin',
            'email' => 'admin@mgl.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Administrador');
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario3 = User::create([
            'name' => 'usuario',
            'email' => 'usuario@mgl.com',
            'password' => bcrypt('123456789')
        ])->syncRoles('Usuario');
        $usuarioTemp = UsuarioTemp::create([
            'tipo_persona' => 2,
            'docutipos_id' => 1,
            'identificacion' => '10000001',
            'email' => 'usuario@gmail.com',
            'estado' => 2,
        ]);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --

        //------------------------------------------------------
        DB::table('usuariotemp')->insert([
            'tipo_persona' => 2,
            'docutipos_id' => 1,
            'identificacion' => '10000001',
            'email' => 'usuario@gmail.com',
            'estado' => 2,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('personas')->insert([
            'id' => 3,
            'docutipos_id' => 1,
            'identificacion' => '10000001',
            'nombre1' => 'Carlos',
            'nombre2' => 'Jose',
            'apellido1' => 'Perez',
            'apellido2' => 'Jimenez',
            'telefono_celu' => '3126549898',
            'direccion' => 'Calle de prueba 1',
            'telefono_celu' => '3126549898',
            'pais_id' => 44,
            'municipio_id' => 149,
            'nacionalidad' => 'Colombiano',
            'grado_educacion' => 'Superior',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1995-11-05',
            'grupo_etnico' => '1',
            'discapacidad' => '0',
            'email' => 'quiku2021@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'asignador',
            'password' => bcrypt('clave'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 4,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 4,
            'docutipos_id' => 1,
            'cargo_id' => 1,
            'sede_id' => 1,
            'identificacion' => '90000002',
            'nombre1' => 'Predeterminado',
            'nombre2' => '',
            'apellido1' => 'Predeterminado',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'asignador1|@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'empleado',
            'password' => bcrypt('clave'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 5,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 5,
            'docutipos_id' => 1,
            'cargo_id' => 2,
            'sede_id' => 1,
            'identificacion' => '90000101',
            'nombre1' => 'Juan',
            'nombre2' => 'Carlos',
            'apellido1' => 'Rojas',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'empleado11@gmail.com',
            'url' => '1639338864-firma.png',
            'extension' => 'png',
            'peso' => 2.46,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'dlopez',
            'password' => bcrypt('dlopez'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 6,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 6,
            'docutipos_id' => 1,
            'cargo_id' => 3,
            'sede_id' => 1,
            'identificacion' => '90000007',
            'nombre1' => 'Daniel',
            'nombre2' => '',
            'apellido1' => 'López',
            'apellido2' => 'Morales',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo7@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'fgomez',
            'password' => bcrypt('fgomez'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 7,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 7,
            'docutipos_id' => 1,
            'cargo_id' => 3,
            'sede_id' => 1,
            'identificacion' => '90000008',
            'nombre1' => 'Fabio',
            'nombre2' => 'Alejandro',
            'apellido1' => 'Gómez',
            'apellido2' => 'Castaño',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo8@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'earango',
            'password' => bcrypt('earango'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 8,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 8,
            'docutipos_id' => 1,
            'cargo_id' => 3,
            'sede_id' => 1,
            'identificacion' => '90000009',
            'nombre1' => 'Eduardo',
            'nombre2' => 'José',
            'apellido1' => 'Arango',
            'apellido2' => 'Montoya',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo9@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'jmorad',
            'password' => bcrypt('jmorad'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 9,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 9,
            'docutipos_id' => 1,
            'cargo_id' => 4,
            'sede_id' => 1,
            'identificacion' => '90000010',
            'nombre1' => 'Juliana',
            'nombre2' => '',
            'apellido1' => 'Morad',
            'apellido2' => 'Acero',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo10@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'lparra',
            'password' => bcrypt('lparra'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 10,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 10,
            'docutipos_id' => 1,
            'cargo_id' => 6,
            'sede_id' => 1,
            'identificacion' => '90000011',
            'nombre1' => 'Laura',
            'nombre2' => '',
            'apellido1' => 'Cañon',
            'apellido2' => 'Parra',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo11@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'sidarraga',
            'password' => bcrypt('sidarraga'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 11,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 11,
            'docutipos_id' => 1,
            'cargo_id' => 5,
            'sede_id' => 1,
            'identificacion' => '90000012',
            'nombre1' => 'Santiago',
            'nombre2' => '',
            'apellido1' => 'Idárraga',
            'apellido2' => 'Moscoso',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo12@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'fbravo',
            'password' => bcrypt('fbravo'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 12,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 12,
            'docutipos_id' => 1,
            'cargo_id' => 6,
            'sede_id' => 1,
            'identificacion' => '90000013',
            'nombre1' => 'Fanny',
            'nombre2' => 'Vanesa',
            'apellido1' => 'Bravo',
            'apellido2' => 'Sierra',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo13@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        DB::table('usuarios')->insert([
            'usuario' => 'jmedina',
            'password' => bcrypt('jmedina'),
            'camb_password' => '0',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('usuario_rol')->insert([
            'rol_id' => 5,
            'usuario_id' => 13,
            'estado' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('empleados')->insert([
            'id' => 13,
            'docutipos_id' => 1,
            'cargo_id' => 7,
            'sede_id' => 1,
            'identificacion' => '90000014',
            'nombre1' => 'José',
            'nombre2' => 'Gregorio',
            'apellido1' => 'Medina',
            'apellido2' => '',
            'telefono_celu' => '3501112233',
            'direccion' => 'Calle de prueba 13',
            'genero' => 'Masculino',
            'fecha_nacimiento' => '1990-11-05',
            'email' => 'correo14@gmail.com',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        //------------------------------------------------------
        foreach ($empleados as $empleado) {
            //------------------------------------------------------
            DB::table('usuarios')->insert([
                'usuario' => strtolower($empleado['nombre1'].'.'.$empleado['apellido1']),
                'password' => bcrypt($empleado['identificacion']),
                'camb_password' => '0',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);



            //------------------------------------------------------

        }
        foreach ($empleados as $empleado) {
            DB::table('usuario_rol')->insert([
                'rol_id' => 5,
                'usuario_id' => $empleado['id'] - 1,
                'estado' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        foreach ($empleados as $empleado) {
            DB::table('empleados')->insert([
                'id' => $empleado['id']-1,
                'docutipos_id' => 1,
                'cargo_id' => 2,
                'sede_id' => 1,
                'identificacion' => $empleado['identificacion'],
                'nombre1' => $empleado['nombre1'],
                'nombre2' => $empleado['nombre2'],
                'apellido1' => $empleado['apellido1'],
                'telefono_celu' => $empleado['telefono_celu'],
                'direccion' => $empleado['direccion'],
                'genero' => $empleado['genero'],
                'fecha_nacimiento' => $empleado['fecha_nacimiento'],
                'email' => $empleado['email'],
                'url' => '1639338864-firma.png',
                'extension' => 'png',
                'peso' => 2.46,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
