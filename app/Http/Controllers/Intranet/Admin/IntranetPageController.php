<?php

namespace App\Http\Controllers\Intranet\Admin;

use App\Http\Controllers\Controller;
use App\Models\Personas\Empleado;
use App\Models\PQR\AsignacionTarea;
use App\Models\PQR\Estado;
use App\Models\PQR\Peticion;
use App\Models\PQR\PQR;
use App\Models\PQR\tipoPQR;
use App\Models\PQR\WikuArgumento;
use App\Models\PQR\WikuDoctrina;
use App\Models\PQR\WikuDocument;
use App\Models\PQR\WikuJurisprudencia;
use App\Models\PQR\WikuNorma;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class IntranetPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $tipoPQR = tipoPQR::all();
        $usuario = User::findOrFail(session('id_usuario'));
        $tareas = AsignacionTarea::where('empleado_id', $usuario->id)->get();
        if (session('rol_principal_id') == 6) {
            if ($usuario->persona->count() > 0) {
                $pqrs = PQR::where('persona_id', session('id_usuario'))->get();
            } else {
                foreach ($usuario->representante->empresas as $empresa) {
                    $pqrs = PQR::where('empresa_id', session('id_usuario'))->get();
                }
            }
        } elseif (session('rol_principal_id') == 5) {
            if ($usuario->empleado->cargo->id == 1) {
                $pqrs = PQR::all();
                $pqrs = $pqrs->where("estado_creacion", 1);
            } else {
                $pqrs = PQR::where('empleado_id', $usuario->id)->get();
            }
        } elseif (session('rol_principal_id') == 4) {
            $pqrs = PQR::where('empleado_id', session('id_usuario'))->get();
        } elseif (session('rol_principal_id') == 1) {
            $pqrs = PQR::get();
        } elseif (session('rol_principal_id') == 3) {
            $pqrs = PQR::get();
        } else {
            $pqrs = PQR::get();
        }
        $peticiones = Peticion::where('empleado_id', session('id_usuario'))->where('estado_id', '<', 11)->get();
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
        $empleados_find = Empleado::get();
        foreach ($empleados_find as $empleado) {
            $empleado['cantidad'] = $empleado->pqrs->whereNotIn('estadospqr_id', [6, 9, 10])->count();
        }
        $empleados = $empleados_find->sortBy('cantidad')->reverse()->take(10);
        foreach ($empleados as $empleado) {
            $dataPoints[] = ['y' => $empleado->cantidad, 'label' => $empleado->nombre1 . ' ' . $empleado->apellido1];
        }
        $roles = Role::get();
        foreach ($roles as $role) {
            // Contar usuarios con el rol actual
            $count = User::role($role->name)->count();
            $role['cantUsers'] = $count;
        }

        if (session('rol_principal_id') == 7) {
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            $bgColor = ['bg-primary', 'bg-secondary', 'bg-success', 'bg-warning', 'bg-info',];
            $tipospqr = tipoPQR::get();
            $cont = 0;
            foreach ($tipospqr as $tipopqr) {
                if ($tipopqr->pqrs->count()) {
                    $data[] = ['y' => $tipopqr->pqrs->count(), 'label' => $tipopqr->tipo];
                }
                $tipopqr['bg_color'] = $bgColor[$cont];
                if ($cont === 4) {
                    $cont = 0;
                } else {
                    $cont++;
                }
            }
            $pqr_mes = PQR::get();
            $cant_enero = 0;
            $cant_febrero = 0;
            $cant_marzo = 0;
            $cant_abril = 0;
            $cant_mayo = 0;
            $cant_junio = 0;
            $cant_julio = 0;
            $cant_agosto = 0;
            $cant_septiembre = 0;
            $cant_octubre = 0;
            $cant_noviembre = 0;
            $cant_diciembreo = 0;
            foreach ($pqr_mes as $pqr) {
                switch (date("m", strtotime($pqr->fecha_generacion))) {
                    case '1':
                        $cant_enero++;
                        break;
                    case '2':
                        $cant_febrero++;
                        break;
                    case '3':
                        $cant_marzo++;
                        break;
                    case '4':
                        $cant_abril++;
                        break;
                    case '5':
                        $cant_mayo++;
                        break;
                    case '6':
                        $cant_junio++;
                        break;
                    case '7':
                        $cant_julio++;
                        break;
                    case '8':
                        $cant_agosto++;
                        break;
                    case '9':
                        $cant_septiembre++;
                        break;
                    case '10':
                        $cant_octubre++;
                        break;
                    case '11':
                        $cant_noviembre++;
                        break;
                    default:
                        $cant_diciembreo++;
                        break;
                }
            }
            $data_mes = [
                ['y' => $cant_enero, 'label' => $meses[0]],
                ['y' => $cant_febrero, 'label' => $meses[1]],
                ['y' => $cant_marzo, 'label' => $meses[2]],
                ['y' => $cant_abril, 'label' => $meses[3]],
                ['y' => $cant_mayo, 'label' => $meses[4]],
                ['y' => $cant_junio, 'label' => $meses[5]],
                ['y' => $cant_julio, 'label' => $meses[6]],
                ['y' => $cant_agosto, 'label' => $meses[7]],
                ['y' => $cant_septiembre, 'label' => $meses[8]],
                ['y' => $cant_octubre, 'label' => $meses[9]],
                ['y' => $cant_noviembre, 'label' => $meses[10]],
                ['y' => $cant_diciembreo, 'label' => $meses[11]],

            ];
            $data = $data_mes;
            return view('intranet.dashboard.dashboard', compact('tipospqr', 'data', 'data_mes'));
        } elseif (session('rol_principal_id') == 8) {
            $fuentes = WikuDocument::all();
            $normas = WikuNorma::all();
            $argumentos = WikuArgumento::with('autorInst', 'autor')->get();
            $jurisprudencias = WikuJurisprudencia::all();
            $doctrinas = WikuDoctrina::all();
            return view('intranet.dashboard.dashboard', compact('normas', 'fuentes', 'argumentos', 'jurisprudencias', 'doctrinas'));
        } else {
            return view('intranet.dashboard.dashboard', compact('pqrs', 'usuario', 'tipoPQR', 'tareas', 'peticiones', 'estadospqr', 'empleados', 'dataPoints', 'roles'));
        }
        // --*-- --*-- --*-- --*-- --*-- --*-- --*-- --*-- --*-- --*-- --*-- --*-- --*--
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
}
