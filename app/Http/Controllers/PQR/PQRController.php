<?php

namespace App\Http\Controllers\PQR;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Fechas\FechasController;
use App\Models\Empresa\Cargo;
use App\Models\Personas\Empleado;
use App\Models\PQR\Aclaracion;
use App\Models\PQR\AsignacionEstado;
use App\Models\PQR\AsignacionTarea;
use App\Models\PQR\Categoria;
use App\Models\PQR\DocRespuesta;
use App\Models\PQR\Estado;
use App\Models\PQR\HistorialAsignacion;
use App\Models\PQR\HistorialPeticion;
use App\Models\PQR\HistorialTarea;
use App\Models\PQR\Peticion;
use App\Models\PQR\PQR;
use App\Models\PQR\PqrAnexo;
use App\Models\PQR\Prioridad;
use App\Models\PQR\Respuesta;
use App\Models\PQR\Resuelve;
use App\Models\PQR\ResuelveRecurso;
use App\Models\PQR\Servicio;
use App\Models\PQR\Tarea;
use App\Models\PQR\tipoPQR;
use App\Models\PQR\WikuArea;
use App\Models\PQR\WikuArgumento;
use App\Models\PQR\WikuDocument;
use App\Models\PQR\WikuNorma;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class PQRController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function plazo_recurso_guardar(Request $request)
    {
        if ($request->ajax()) {
            $plazoRecurso['recurso_dias'] = $request['plazo_recurso'];
            $plazoRecurso['apelacion'] = $request['apelacion'];
            $pqr = PQR::findOrfail($request['idPqr']);
            $nuevoLimite =
                $pqr->tipoPqr->tiempos +
                $pqr['prorroga_dias'] +
                $request['plazo_recurso'];
            $respuestaDias = FechasController::festivos(
                $nuevoLimite,
                $pqr['fecha_generacion']
            );
            $actualizarPqr['tiempo_limite'] = $respuestaDias;
            $respuestaRecurso = PQR::findOrFail($request['idPqr'])->update(
                $actualizarPqr
            );
            $peticiones = Peticion::where('pqr_id', $request['idPqr'])->get();
            foreach ($peticiones as $key => $peticion) {
                Peticion::findOrFail($peticion->id)->update($plazoRecurso);
            }
            return response()->json([
                'mensaje' => 'ok',
                'data' => $respuestaRecurso,
            ]);
        } else {
            abort(404);
        }
    }

    public function historial_resuelve_editar(Request $request)
    {
        if ($request->ajax()) {
            $resuelve['resuelve'] = $request['resuelveNuevo'];
            $respuesta = Resuelve::findOrFail($request['value'])->update(
                $resuelve
            );
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }
    public function resuelve_orden_guardar(Request $request)
    {
        if ($request->ajax()) {
            $resuelve['orden'] = $request['orden'];
            $respuesta = Resuelve::findOrFail($request['id'])->update(
                $resuelve
            );
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }
    public function historial_resuelve_eliminar(Request $request)
    {
        if ($request->ajax()) {
            $resuelve = Resuelve::findOrFail($request['value']);
            $index = $resuelve['orden'];
            $pqr = $resuelve->pqr_id;
            $respuesta = $resuelve->delete();
            $resuelves = Resuelve::where('pqr_id', $pqr)->get();
            foreach ($resuelves as $key => $resuel) {
                if ($index < $resuel['orden']) {
                    $orden['orden'] = $resuel['orden'] - 1;
                }
                Resuelve::findOrFail($resuel->id)->update($orden);
            }
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }
    public function cambiar_estado_tareas_guardar(Request $request)
    {
        if ($request->ajax()) {
            $pqr = PQR::findOrFail($request['idPqr']);
            if (
                $request['tipo_respuesta'] == 2 &&
                $pqr->recurso_apelacion &&
                $request['idTarea'] == 5 &&
                $request['concedeRecursoApelacion'] == 'true'
            ) {
                foreach ($pqr->asignaciontareas as $tarea) {
                    $estadoTarea['estado_id'] = 6;
                    $asignacionTarea = AsignacionTarea::where(
                        'pqr_id',
                        $pqr['id']
                    )
                        ->where('tareas_id', $tarea->tareas_id)
                        ->get();
                    $asignacionTarea[0]->update($estadoTarea);
                }
                $respuesta = 'ok';
            } else {
                if ($request['estado']) {
                    $estado['estado_id'] = $request['estado'];
                    $tarea = $request['idTarea'] - 1;
                } else {
                    $estado['estado_id'] = 11;
                    $tarea = $request['idTarea'];
                }
                $respuesta = AsignacionTarea::where('pqr_id', $request['idPqr'])
                    ->where('tareas_id', $tarea)
                    ->update($estado);
                if ($request['idTarea'] == 5) {
                    AsignacionTarea::where('pqr_id', $request['idPqr'])
                        ->where('tareas_id', 1)
                        ->update($estado);
                }
            }
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }
    public function pqr_anexo_guardar(Request $request)
    {
        if ($request->ajax()) {
            if ($request['idTarea'] == 4) {
                $pqr = PQR::findOrFail($request['idPqr']);
                $tipo_respuesta = $request['tipo_respuesta'];
                // $imagen = public_path('imagenes\sistema\logo_mgl.png');
                // $firma = public_path('documentos\usuarios\\' . $pqr->empleado->url);
                $imagen = asset('imagenes/sistema/logo_mgl.png'); //url_servidor
                $firma = asset('documentos/usuarios/' . $pqr->empleado->url); //url_servidor
                if (
                    $tipo_respuesta == 1 ||
                    $tipo_respuesta == 2 ||
                    $tipo_respuesta == 3
                ) {
                    $resuelves = ResuelveRecurso::where(
                        'pqr_id',
                        $request['idPqr']
                    )
                        ->where('tipo_reposicion_id', $tipo_respuesta)
                        ->orderBy('orden')
                        ->get();
                    $rPdf['respuesta'] = view(
                        'intranet.funcionarios.pqr.respuesta_pqr_recurso',
                        compact(
                            'pqr',
                            'imagen',
                            'resuelves',
                            'firma',
                            'tipo_respuesta'
                        )
                    );
                } else {
                    $resuelves = Resuelve::where('pqr_id', $request['idPqr'])
                        ->orderBy('orden')
                        ->get();
                    $rPdf['respuesta'] = view(
                        'intranet.funcionarios.pqr.respuesta_pqr',
                        compact('pqr', 'imagen', 'resuelves', 'firma')
                    );
                }
                $rPdf['pqr_id'] = $request['idPqr'];
                $rPdf['tipo_respuesta'] = $request['tipo_respuesta'];
                $rPdf['tareas_id'] = $request['idTarea'];
                $rPdf['empleado_id'] = session('id_usuario');
                $rrr = PqrAnexo::create($rPdf);
            }
            $pqr = PQR::findOrfail($request['idPqr']);
            $peticiones = Peticion::where('pqr_id', $pqr->id)->get();
            if (sizeof($peticiones)) {
                $pqr['recurso_dias'] = $peticiones[0]->recurso_dias;
            }
            $pqr_id = $pqr->id;
            if ($pqr->persona_id != null) {
                $email = $pqr->persona->email;
            } elseif ($pqr->empresa_id != null) {
                $email = $pqr->empresa->email;
            }
            /*if ($request['idTarea'] == 4 && $request['apruebaRadica']) {
                if ($email) {
                    Mail::to($email)->send(new RespuestaPQR($pqr_id));
                }
            }*/
            if (
                ($request['idTarea'] == 4 && $request['apruebaRadica']) ||
                $request['idTarea'] == 5
            ) {
                if ($pqr->peticiones->sum('recurso_dias')) {
                    if ($tipo_respuesta == 1) {
                        $pqrEstado['estadospqr_id'] = 9;
                        $fechaActual = date('Y-m-d H:i:s');
                        $respuestaDias = FechasController::festivos(
                            $pqr['recurso_dias'],
                            $fechaActual
                        );
                        $pqrEstado['tiempo_limite'] = $respuestaDias;
                    } elseif ($tipo_respuesta == 2) {
                        if (
                            $pqr->recurso_apelacion &&
                            $request['concedeRecursoApelacion'] == 'true'
                        ) {
                            $pqrEstado['estadospqr_id'] = 8;
                            $fechaActual = date('Y-m-d H:i:s');
                            $respuestaDias = FechasController::festivos(
                                $pqr['recurso_dias'],
                                $fechaActual
                            );
                            $pqrEstado['tiempo_limite'] = $respuestaDias;
                        } else {
                            $pqrEstado['estadospqr_id'] = 10;
                        }
                    } elseif ($tipo_respuesta == 3) {
                        $pqrEstado['estadospqr_id'] = 10;
                    } else {
                        $pqrEstado['estadospqr_id'] = 7;
                    }
                } else {
                    $pqrEstado['estadospqr_id'] = 6;
                    $pqrEstado['fecha_respuesta'] = date('Y-m-d');

                }
                PQR::findOrFail($pqr->id)->update($pqrEstado);
            }
            return response()->json(['mensaje' => 'ok', 'data' => $rPdf]);
        } else {
            abort(404);
        }
    }


    public function descarga_respuestaPQR($id)
    {
        $pqr = PQR::findOrFail($id);
        $resuelves = Resuelve::where('pqr_id', $id)
            ->orderBy('orden')
            ->get();
        // $imagen = public_path('imagenes\sistema\logo_mgl.png');
        $imagen = asset('imagenes/sistema/logo_mgl.png'); //url_servidor

        $firma = '';
        $pdf = FacadePdf::loadView(
            'intranet.funcionarios.pqr.respuesta_pqr',
            compact('pqr', 'imagen', 'resuelves', 'firma')
        );
        return $pdf->download('Respuesta-' . $pqr->radicado . '.pdf');
    }

    public function usuario_descarga_respuestaPQR($id)
    {
        $respuesta = PqrAnexo::findOrFail($id);
        $pqr = $respuesta->pqr;
        $pdf = FacadePdf::loadHTML($respuesta->respuesta);
        return $pdf->download('Respuesta-' . $pqr->radicado . '.pdf');
    }

    public function respuestaPQRRecurso($id, $tipo_recurso)
    {
        $pqr = PQR::findOrFail($id);
        $resuelves = ResuelveRecurso::where('pqr_id', $id)
            ->where('tipo_reposicion_id', $tipo_recurso)
            ->orderBy('orden')
            ->get();
        $tipo_respuesta = $tipo_recurso;
        // $imagen = public_path('imagenes\sistema\logo_mgl.png');
        $imagen = asset('imagenes/sistema/logo_mgl.png'); //url_servidor
        $firma = '';
        return view(
            'intranet.funcionarios.pqr.respuesta_pqr_recurso',
            compact('pqr', 'imagen', 'resuelves', 'firma', 'tipo_respuesta')
        );
    }

    public function respuestaPQR($id)
    {
        $pqr = PQR::findOrFail($id);
        $resuelves = Resuelve::where('pqr_id', $id)
            ->orderBy('orden')
            ->get();
        // $imagen = public_path('imagenes\sistema\logo_mgl.png');
        $imagen = asset('imagenes/sistema/logo_mgl.png'); //url_servidor
        $firma = '';
        return view(
            'intranet.funcionarios.pqr.respuesta_pqr',
            compact('pqr', 'imagen', 'resuelves', 'firma')
        );
    }

    public function historial_resuelve_guardar(Request $request)
    {
        if ($request->ajax()) {
            $resuelves = Resuelve::where('pqr_id', $request['idPqr'])->get();
            $resuelve['orden'] = $resuelves->count() + 1;
            $resuelve['pqr_id'] = $request['idPqr'];
            $resuelve['empleado_id'] = session('id_usuario');
            $resuelve['resuelve'] = $request['mensajeResuelve'];
            $respuesta = Resuelve::create($resuelve);
            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_anexo_guardar(Request $request)
    {
        if ($request->ajax()) {
            $documentos = $request->allFiles();
            if ($request->hasFile('archivo')) {
                $ruta = Config::get('constantes.folder_doc_respuestas');
                $ruta = trim($ruta);
                $doc_subido = $documentos['archivo'];
                $tamaño = $doc_subido->getSize();
                if ($tamaño > 0) {
                    $tamaño = $tamaño / 1000;
                }
                $nombre_doc =
                    time() .
                    '-' .
                    utf8_encode(
                        utf8_decode($doc_subido->getClientOriginalName())
                    );
                $nuevo_documento['respuesta_id'] = $request['respuesta_id'];
                $nuevo_documento['titulo'] = $request['titulo'];
                if ($request['descripcion']) {
                    $nuevo_documento['descripcion'] = $request['descripcion'];
                } else {
                    $nuevo_documento['descripcion'] = '';
                }
                $nuevo_documento[
                    'extension'
                ] = $doc_subido->getClientOriginalExtension();
                $nuevo_documento['peso'] = $tamaño;
                $nuevo_documento['url'] = $nombre_doc;
                $doc_subido->move($ruta, $nombre_doc);
                $respuesta = DocRespuesta::create($nuevo_documento);
            }

            return response()->json(['mensaje' => 'ok', 'data' => $respuesta]);
        } else {
            abort(404);
        }
    }

    public function respuesta_guardar(Request $request)
    {
        if ($request->ajax()) {
            $respuestaValidacion = Respuesta::where(
                'peticion_id',
                $request['id_peticion']
            )->get();
            if (!sizeOf($respuestaValidacion)) {
                $respuesta['peticion_id'] = $request['id_peticion'];
                $respuesta['fecha'] = date('Y-m-d');
                $respuesta['respuesta'] = $request['respuesta'];
                $respuestaPQR = Respuesta::create($respuesta);
                $id_respuesta = $respuestaPQR['id'];
            } else {
                $respuesta['respuesta'] = $request['respuesta'];
                $id_respuesta = $respuestaValidacion[0]['id'];
                $respuestaPQR = Respuesta::findOrFail($id_respuesta)->update(
                    $respuesta
                );
            }
            if ($request['estado']) {
                $nuevoEstado['estado_id'] = $request['estado'];
                Peticion::findOrFail($request['id_peticion'])->update(
                    $nuevoEstado
                );
            }
            return response()->json([
                'mensaje' => 'ok',
                'data' => $id_respuesta,
            ]);
        } else {
            abort(404);
        }
    }

    public function aclaracion_guardar(Request $request)
    {
        if ($request->ajax()) {
            $nuevaAclaracion['peticion_id'] = $request['id_peticion'];
            $nuevaAclaracion['fecha'] = date('Y-m-d');
            $nuevaAclaracion['tipo_solicitud'] = $request['tipoAclaracion'];
            $nuevaAclaracion['aclaracion'] = $request['solicitudAclaracion'];
            $aclaracionNew = Aclaracion::create($nuevaAclaracion);
            $peticion_act = Peticion::findOrfail($request['id_peticion']);
            $pqr = PQR::findOrfail($peticion_act->pqr_id);
            if ($pqr->estadospqr_id <= 5) {
                $pqrEstado['estadospqr_id'] = 5;
                PQR::findOrFail($pqr->id)->update($pqrEstado);
            }
            if ($peticion_act->pqr->persona_id != null) {
                $email = $peticion_act->pqr->persona->email;
            } else {
                $email = $peticion_act->pqr->empresa->email;
            }
            $id_aclaracion = $aclaracionNew->id;
            //if ($email) {Mail::to($email)->send(new AclaracionComplementacion($id_aclaracion));}
            return response()->json([
                'mensaje' => 'ok',
                'data' => $aclaracionNew,
            ]);
        } else {
            abort(404);
        }
    }

    public function gestionar_asignacion_colaboracion($id)
    {
        $pqr = PQR::findOrFail($id);
        $estadoPrioridad = Prioridad::all();
        $estados = AsignacionEstado::all();
        $areas = WikuArea::all();
        $fuentes = WikuDocument::all();
        $tipos_pqr = tipoPQR::get();
        $categorias = Categoria::get();
        $servicios = Servicio::get();
        return view('intranet.funcionarios.pqr.gestion',compact('pqr','estadoPrioridad','estados','areas','fuentes','tipos_pqr','categorias','servicios'));
    }

    public function gestionar_asignacion_colaboracion_wiku(Request $request,$id) {
        if ($request->ajax()) {
            $pqr = PQR::findOrFail($id);
            $peticiones = $pqr->peticiones;
            foreach ($peticiones as $peticion) {
                $motivos[] = $peticion->motivo->motivo->id;
                $subMotivos[] = $peticion->motivo->id;
            }
            $wikuArgumentos = WikuArgumento::with('palabras','criterios','temaEspecifico','temaEspecifico.tema_','temaEspecifico.tema_.area')
                ->whereHas('asociaciones', function ($q) use ($pqr,$motivos,$subMotivos) {
                    $q
                    ->where('tipo_p_q_r_id', $pqr->tipo_pqr_id)->orWhere(function ($a) use ($motivos) {
                        $a->whereIn('motivo_id', $motivos);
                    })
                    ->orWhere(function ($b) use ($subMotivos) {
                        $b->whereIn('motivo_sub_id', $subMotivos);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('categoria_id',$pqr->referencia->marca->producto->categoria_id);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('producto_id',$pqr->referencia->marca->producto_id);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('marca_id', $pqr->referencia->marca_id);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('referencia_id', $pqr->referencia_id);
                    })
                    ->groupBy('wiku_argumento_id');
                })->get();
            $wikuNormas = WikuNorma::with('palabras','criterios','temaEspecifico','temaEspecifico.tema_','temaEspecifico.tema_.area','documento')
                ->whereHas('asociaciones', function ($q) use ($pqr,$motivos,$subMotivos) {
                    $q->where('tipo_p_q_r_id', $pqr->tipo_pqr_id)
                    ->orWhere(function ($a) use ($motivos) {
                        $a->whereIn('motivo_id', $motivos);
                    })
                    ->orWhere(function ($b) use ($subMotivos) {
                        $b->whereIn('motivo_sub_id', $subMotivos);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('categoria_id',$pqr->referencia->marca->producto->categoria_id);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('producto_id',$pqr->referencia->marca->producto_id);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('marca_id', $pqr->referencia->marca_id);
                    })
                    ->orWhere(function ($d) use ($pqr) {
                        $d->where('referencia_id', $pqr->referencia_id);
                    })
                    ->groupBy('wiku_norma_id');
                })->get();
                return response()->json(['normas' => $wikuNormas,'argumentos' => $wikuArgumentos,]);
        } else {
            abort(404);
        }
    }


    public function asignacion_peticion_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionPeticion['empleado_id'] = (int) $request['funcionario'];
            $peticionActualizar = Peticion::findOrFail(
                $request['peticion']
            )->update($asignacionPeticion);
            return response()->json([
                'mensaje' => 'ok',
                'data' => $peticionActualizar,
            ]);
        } else {
            abort(404);
        }
    }

    public function historial_peticion_guardar(Request $request)
    {
        if ($request->ajax()) {
            $asignacionHistorial['pqr_id'] = $request['idPqr'];
            $asignacionHistorial['peticion_id'] = $request['idPeticion'];
            $asignacionHistorial['empleado_id'] = session('id_usuario');
            $asignacionHistorial['historial'] = $request['mensajeHistorial'];
            $historial = HistorialPeticion::create($asignacionHistorial);
            return response()->json(['mensaje' => 'ok', 'data' => $historial]);
        } else {
            abort(404);
        }
    }

    public function estado_guardar(Request $request)
    {
        if ($request->ajax()) {
            $nuevoEstado['estado_id'] = $request['estado'];
            $peticion = Peticion::findOrFail($request['id_peticion'])->update(
                $nuevoEstado
            );
            return response()->json(['mensaje' => 'ok', 'data' => $peticion]);
        } else {
            abort(404);
        }
    }

    public function prorroga_guardar(Request $request)
    {
        if ($request->ajax()) {
            $pqr = PQR::findOrfail($request['idPqr']);
            $validacionProrroga = PQR::findOrFail($request['idPqr']);
            if (isset($request['prorroga'])) {
                if (
                    $validacionProrroga->prorroga == 0 &&
                    $request['plazo_prorroga'] != null &&
                    $request['prorroga_pdf'] != null
                ) {
                    $actualizarPqr['prorroga'] = $request['prorroga'];
                    $actualizarPqr['prorroga_dias'] =
                        $request['plazo_prorroga'];
                    $actualizarPqr['prorroga_pdf'] = $request['prorroga_pdf'];
                    $nuevoLimite =
                        $pqr->tipoPqr->tiempos +
                        $request['plazo_prorroga'] +
                        $request['plazoRecurso'];
                    $respuestaDias = FechasController::festivos(
                        $nuevoLimite,
                        $pqr['fecha_generacion']
                    );
                    $actualizarPqr['tiempo_limite'] = $respuestaDias;
                    if ($pqr['estadospqr_id'] <= 1) {
                        $estado = Estado::findOrFail(2);
                        $actualizarPqr['estadospqr_id'] = $estado['id'];
                    }
                    $respuestaProrroga = PQR::findOrFail(
                        $request['idPqr']
                    )->update($actualizarPqr);
                    //---------------------------------------------------------------------------
                    if ($pqr->persona_id != null) {
                        $email = $pqr->persona->email;
                    } else {
                        $email = $pqr->empresa->email;
                    }
                    $id_pqr = $pqr->id;
                    //if ($email) {Mail::to($email)->send(new Prorroga($id_pqr));}
                    //---------------------------------------------------------------------------
                }
            }
            return response()->json(['mensaje' => 'ok','data' => $respuestaProrroga,]);
        } else {
            abort(404);
        }
    }

    public function prioridad_guardar(Request $request)
    {
        if ($request->ajax()) {
            $prioridad['prioridad_id'] = (int) $request['prioridad'];
            $pqrActualizar = PQR::findOrFail($request['idPqr'])->update(
                $prioridad
            );
            return response()->json([
                'mensaje' => 'ok',
                'data' => $pqrActualizar,
            ]);
        } else {
            abort(404);
        }
    }
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

        return view('intranet.funcionarios.pqr.gestion_pqr',compact(
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
