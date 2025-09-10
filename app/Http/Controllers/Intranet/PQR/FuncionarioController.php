<?php

namespace App\Http\Controllers\Intranet\PQR;

use App\Http\Controllers\Controller;
use App\Models\PQR\AsignacionEstado;
use App\Models\PQR\AsignacionTarea;
use App\Models\PQR\AutoAdmisorio;
use App\Models\PQR\HechosTutela;
use App\Models\PQR\ImpugnacionInterna;
use App\Models\PQR\PQR;
use App\Models\PQR\PretensionesTutela;
use App\Models\PQR\Prioridad;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function gestionar_asignacion_revisa_aprueba($id)
    {
        $estados = AsignacionEstado::all();
        $pqr = PQR::findorFail($id);
        $estadoPrioridad = Prioridad::all();
        return view('intranet.funcionarios.gestion_asignacion_revisa_aprueba', compact('pqr', 'estadoPrioridad', 'estados'));
    }

    public function gestionar_asignacion_proyecta($id)
    {
        $estados = AsignacionEstado::all();
        $pqr = PQR::findorFail($id);
        $estadoPrioridad = Prioridad::all();
        return view('intranet.funcionarios.PQR.gestion_asignacion_proyecta', compact('pqr', 'estadoPrioridad', 'estados'));
    }

    public function gestionar_asignacion($id)
    {
        $estados = AsignacionEstado::all();
        $pqr = PQR::findorFail($id);
        return view('intranet.funcionarios.gestion_asignacion', compact('pqr', 'estados'));
    }
    /**
     * Display a listing of the resource.
     */
    public function gestion()
    {
        $tutelas = AutoAdmisorio::where('empleado_asignado_id', session('id_usuario'))->get();
        $sin_aceptar = AutoAdmisorio::where('empleado_asignado_id', session('id_usuario'))->where('estado_asignacion', 0)->get();
        $aceptadas = AutoAdmisorio::where('empleado_asignado_id', session('id_usuario'))->where('estado_asignacion', 1)->where('estadostutela_id', '!=', 4)->where('estadostutela_id', '!=', 7)->where('estadostutela_id', '!=', 9) ->get();
        $supervisadas = AsignacionTarea::where('empleado_id', session('id_usuario'))->where('tareas_id', 1)->where('estado_id', '<', 11)->get();
        $proyectadas = AsignacionTarea::where('empleado_id', session('id_usuario'))->where('tareas_id', 2)->where('estado_id', '<', 11)->get();
        $revisiones = AsignacionTarea::where('empleado_id', session('id_usuario'))->where('tareas_id', 3)->where('estado_id', '<', 11)->get();
        $aprobadas = AsignacionTarea::where('empleado_id', session('id_usuario'))->where('tareas_id', 4)->where('estado_id', '<', 11)->get();
        $activasAprobar = [];
        foreach ($aprobadas as $key => $value) {
            $validacion = AsignacionTarea::where('auto_admisorio_id', $value->auto_admisorio_id)->where('tareas_id', 2)->where('estado_id', '=', 11)->get();
            if (sizeOf($validacion)) $activasAprobar[] = $value;
        }
        $radicadas = AsignacionTarea::where('tareas_id', 5)->where('estado_id', '<', 11)->get();
        $activasRadicar = [];
        foreach ($radicadas as $key => $value) {
            $validacion = AsignacionTarea::where('auto_admisorio_id', $value->auto_admisorio_id)->where('tareas_id', 4)->where('estado_id', '=', 11)->get();
            if (sizeOf($validacion)) $activasRadicar[] = $value;
        }
        $hechos = HechosTutela::where('empleado_id', session('id_usuario'))->where('estado_id', '!=', 11)->whereHas('tutela', function ($q) {
            $q->where('estadostutela_id', '<', '4');
        })->get();
        $pretensiones = PretensionesTutela::where('empleado_id', session('id_usuario'))->where('estado_id', '!=', 11)->whereHas('tutela', function ($q) {
            $q->where('estadostutela_id', '<', '4');
        })->get();
        $resuelves = ImpugnacionInterna::where('empleado_id', session('id_usuario'))->where('estado_id', '!=', 11)->whereHas('sentenciap', function ($q) {
            $q->whereHas('tutela', function ($p) {
                $p->where('estadostutela_id', '6');
            });
        })->get();
        $cerradas = AutoAdmisorio::where('empleado_asignado_id', session('id_usuario'))->where('estado_asignacion', 1)->where('estadostutela_id', '>=' , 4)->get();
        return view('intranet.funcionarios.tutela.gestion', compact('tutelas', 'sin_aceptar', 'aceptadas', 'supervisadas', 'proyectadas', 'revisiones', 'activasAprobar', 'activasRadicar', 'hechos', 'pretensiones', 'cerradas','resuelves'));
    }
}
