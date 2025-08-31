<?php

namespace App\Http\Controllers\PQR;

use App\Http\Controllers\Controller;
use App\Models\Empresa\Cargo;
use App\Models\Personas\Empleado;
use App\Models\PQR\AsignacionTarea;
use App\Models\PQR\HistorialAsignacion;
use App\Models\PQR\HistorialTarea;
use App\Models\PQR\Peticion;
use App\Models\PQR\PQR;
use App\Models\PQR\Tarea;
use App\Models\PQR\tipoPQR;
use App\Models\User;
use Illuminate\Http\Request;

class PQRController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function historial_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['pqr_id'] = $request['idPqr'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeHistorial'];
            $historial = HistorialAsignacion::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function historial_tarea_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['pqr_id'] = $request['idPqr'];
            if ($request['idTarea']) {
                $asignacionHistorial['tareas_id'] = $request['idTarea'];
            }
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeHistorial'];
            $historial = HistorialTarea::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function asignacion_tarea_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionTarea['empleado_id'] = (int) $request['funcionario'];
            $tareas = AsignacionTarea::where('pqr_id', $request['idPqr'])->where('tareas_id', $request['tarea'])->get();
            foreach ($tareas as $tarea) {
                $id = $tarea->id;
            }
            $tareaActualizar = AsignacionTarea::findOrFail($id)->update($asignacionTarea);
            return response()->json([
                'mensaje' => 'ok',
                'data' => $tareaActualizar,
            ]);
        } else {
            abort(404);
        }
    }

    public function cargar_cargos(Request $request)
    {
        if ($request->ajax()) {
            return Cargo::all();
        }
    }

    public function cargar_funcionarios(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['id'];
            return Empleado::where('cargo_id', $id)->get();
        }
    }
    public function cargar_tareas(Request $request)
    {
        if ($request->ajax()) {
            return Tarea::all();
        }
    }

    public function asignacion_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionData['estado_asignacion'] = (int) $request['confirmacionAsignacion'];
            if ($asignacionData['estado_asignacion'] == 0) {
                $asignacionData['empleado_id'] = null;
                $estado = PQR::findOrFail($request['idPqr'])->update(
                    $asignacionData
                );
            } else {
                $asignacionData['estadospqr_id'] = 2;
                $estado = PQR::findOrFail($request['idPqr'])->update($asignacionData);
                $tareas = Tarea::all();
                $validarTareas = AsignacionTarea::where('pqr_id', $request['idPqr'])->get();
                if (!sizeOf($validarTareas)) {
                    foreach ($tareas as $value) {
                        $asignacionTarea['pqr_id'] = $request['idPqr'];
                        $asignacionTarea['empleado_id'] = session('id_usuario');
                        $asignacionTarea['tareas_id'] = $value['id'];
                        $asignacionTarea['estado_id'] = 1;
                        AsignacionTarea::create($asignacionTarea);
                    }
                }
            }
            $asignacionHistorial['pqr_id'] = $request['idPqr'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeAsignacion'];
            $historial = HistorialAsignacion::create($asignacionHistorial);

            $respuesta['estado'] = $estado;
            $respuesta['historial'] = $historial;
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function gestion_pqr()
    {
        $pqrs = PQR::where('empleado_id', session('id_usuario'))->get();
        $sin_aceptar = PQR::where('empleado_id', session('id_usuario'))
            ->where('estado_asignacion', 0)
            ->get();
        $aceptadas = PQR::where('empleado_id', session('id_usuario'))
            ->where('estado_asignacion', 1)
            ->where('estadospqr_id', '!=', 6)
            ->where('estadospqr_id', '!=', 9)
            ->where('estadospqr_id', '!=', 10)
            ->get();
        $supervisadas = AsignacionTarea::where(
            'empleado_id',
            session('id_usuario')
        )
            ->where('tareas_id', 1)
            ->where('estado_id', '<', 11)
            ->get();
        $proyectadas = AsignacionTarea::where(
            'empleado_id',
            session('id_usuario')
        )
            ->where('tareas_id', 2)
            ->where('estado_id', '<', 11)
            ->get();
        $revisiones = AsignacionTarea::where(
            'empleado_id',
            session('id_usuario')
        )
            ->where('tareas_id', 3)
            ->where('estado_id', '<', 11)
            ->get();
        $aprobadas = AsignacionTarea::where(
            'empleado_id',
            session('id_usuario')
        )
            ->where('tareas_id', 4)
            ->where('estado_id', '<', 11)
            ->get();
        $activasAprobar = [];
        foreach ($aprobadas as $key => $value) {
            $validacion = AsignacionTarea::where('pqr_id', $value->pqr_id)
                ->where('tareas_id', 2)
                ->where('estado_id', '=', 11)
                ->get();
            if (sizeOf($validacion)) {
                $activasAprobar[] = $value;
            }
        }
        $radicadas = AsignacionTarea::where('tareas_id', 5)
            ->where('estado_id', '<', 11)
            ->get();
        $activasRadicar = [];
        foreach ($radicadas as $key => $value) {
            $validacion = AsignacionTarea::where('pqr_id', $value->pqr_id)
                ->where('tareas_id', 4)
                ->where('estado_id', '=', 11)
                ->get();
            if (sizeOf($validacion)) {
                $activasRadicar[] = $value;
            }
        }

        $tipoPQR = tipoPQR::all();
        $usuario = User::findOrFail(session('id_usuario'));
        $tareas = AsignacionTarea::where('empleado_id', $usuario->id)->get();
        if (session('rol_id') == 5) {
            if ($usuario->empleado->cargo->id == 1) {
                $pqrs = PQR::all();
                $pqrs = $pqrs->where('estado_creacion', 1);
            } else {
                $pqrs = PQR::where('empleado_id', $usuario->id)->get();
            }
        } else {
            $pqrs = PQR::get();
        }
        $peticiones = Peticion::where('empleado_id', session('id_usuario'))
            ->where('estado_id', '<', 11)
            ->get();

        return view(
            'intranet.funcionarios.pqr.gestion_pqr',
            compact(
                'pqrs',
                'usuario',
                'tipoPQR',
                'tareas',
                'peticiones',
                'sin_aceptar',
                'aceptadas',
                'supervisadas',
                'proyectadas',
                'activasAprobar',
                'activasRadicar'
            )
        );
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
