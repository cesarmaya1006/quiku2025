<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidacionUsuario;
use App\Models\Config\TipoDocumento;
use App\Models\Empleados\Empleado;
use App\Models\Parametros\Area;
use App\Models\Parametros\Departamento;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::get();
        return view('intranet.sistema.usuarios.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tiposdocu = TipoDocumento::orderBy('id')->get();
        $roles = Role::whereIn('id', [5, 6])->orderBy('id')->pluck('name', 'id')->toArray();
        $areas = Area::get();
        $departamentosTemp = Departamento::get();
        $departamentos = collect([]);
        foreach ($departamentosTemp as $departamento) {
            foreach ($departamento->municipios as $municipio) {
                if ($municipio->sedes->count()) {
                    $departamentos->push($departamento);
                }
            }
        }
        return view('intranet.sistema.usuarios.crear', compact( 'roles', 'tiposdocu','areas','departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidacionUsuario $request)
    {
        $rol = Role::findOrFail(intval($request['rol_id'][0]));
        $usuarioNew = User::create([
            'name' => ucfirst(strtolower($request['nombre1'])) . ' ' . ucfirst(strtolower($request['apellido1'])),
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ])->syncRoles($rol->name);

        $empleadoNew['id'] = $usuarioNew->id;
        $empleadoNew['tipo_documentos_id'] = $request['docutipos_id'];
        $empleadoNew['cargo_id'] = $request['cargo_id'];
        $empleadoNew['sede_id'] = $request['sede_id'];
        $empleadoNew['identificacion'] = $request['identificacion'];
        $empleadoNew['nombre1'] = $request['nombre1'];
        $empleadoNew['nombre2'] = $request['nombre2'];
        $empleadoNew['apellido1'] = $request['apellido1'];
        $empleadoNew['apellido2'] = $request['apellido2'];
        $empleadoNew['telefono_celu'] = $request['telefono_celu'];
        $empleadoNew['direccion'] = $request['direccion'];
        $empleadoNew['genero'] = $request['genero'];
        $empleadoNew['fecha_nacimiento'] = $request['fecha_nacimiento'];
        $empleadoNew['email'] = $request['email'];

        Empleado::create($empleadoNew);
        return redirect('configuracion_sis/usuarios')->with('mensaje', 'Usuario creado con éxito');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tiposdocu = TipoDocumento::orderBy('id')->get();
        $roles = Role::whereIn('id', [4, 5, 6])->orderBy('id')->pluck('name', 'id')->toArray();
        $usuario_edit = User::findOrFail($id);
        return view('intranet.sistema.usuarios.editar', compact('usuario_edit', 'roles', 'tiposdocu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
