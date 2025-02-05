<?php

namespace App\Http\Controllers\Intranet;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidarPassword;
use App\Models\Empleados\Empleado;
use App\Models\PQR\Estado;
use App\Models\PQR\tipoPQR;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class IntranetPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $roles = Role::get();
        //------------------------------------------------------------
        $tipoPQR = tipoPQR::get();
        //------------------------------------------------------------
        $estadospqr = Estado::get();
        foreach ($estadospqr as $estado) {
            switch ($estado->id) {
                case '1':
                    $estado['bg'] = 'bg-info';
                    break;
                case '2':
                    $estado['bg'] = 'bg-primary';
                    break;
                case '3':
                    $estado['bg'] = 'bg-warning';
                    break;
                case '4':
                    $estado['bg'] = 'bg-danger';
                    break;
                case '5':
                    $estado['bg'] = 'bg-secondary';
                    break;
                case '6':
                    $estado['bg'] = 'bg-success';
                    break;
                case '7':
                    $estado['bg'] = 'bg-info';
                    break;
                case '8':
                    $estado['bg'] = 'bg-primary';
                    break;
                case '9':
                    $estado['bg'] = 'bg-success';
                    break;
                default:
                    $estado['bg'] = 'bg-success';
                    break;
            }
        }
        //------------------------------------------------------------
        $empleados_find = Empleado::get();
        foreach ($empleados_find as $empleado) {
            $empleado['cantidad'] = $empleado->pqrs->whereNotIn('estadospqr_id',[6, 9, 10])->count();
        }
        $empleados = $empleados_find->sortBy('cantidad')->reverse()->take(10);
        foreach ($empleados as $empleado) {
            $dataPoints[] = ['y'=>$empleado->cantidad,'label'=> $empleado->nombre1 . ' ' . $empleado->apellido1];
        }
        //-------------------------------------------------------------
        return view('intranet.dashboard.dashboard',compact('roles','estadospqr','dataPoints','tipoPQR'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
    public function restablecer_password(ValidarPassword $request)
    {
        $nuevoPassword['password'] = bcrypt(utf8_encode($request['password1']));
        $nuevoPassword['camb_password'] = 0;
        Usuario::findOrFail($request['id'])->update($nuevoPassword);
        return redirect('admin/index')->with('mensaje', 'Se cambio la contraseña de manera exitosa en la plataforma');
    }
}
