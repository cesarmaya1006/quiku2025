<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Fechas\FechasController;
use App\Models\Config\Departamento;
use App\Models\PQR\Categoria;
use App\Models\PQR\PQR;
use App\Models\PQR\Servicio;
use App\Models\PQR\tipoPQR;
use App\Http\Requests\ValidarPqr;
use App\Models\Empresa\Empresa;
use App\Models\Personas\Empleado;
use App\Models\Personas\Persona;
use App\Models\PQR\Anexo;
use App\Models\PQR\AsignacionParticular;
use App\Models\PQR\Hecho;
use App\Models\PQR\Peticion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ClienteController extends Controller
{
    public function generar()
    {
        $tipoPQR = tipoPQR::all();
        return view('intranet.usuarios.crear', compact('tipoPQR'));
    }

    public function generarPQR_motivos_guardar(Request $request)
    {
        $cantidadPeticiones = $request['cantidadmotivos'];
        $documentos = $request->allFiles();
        $contadorAnexos = 0;
        $contadorHechos = 0;
        $iteradorAnexos = 0;
        $iteradorHechos = 0;
        for ($i = 0; $i < $cantidadPeticiones; $i++) {
            $nuevaPQRPeticion['pqr_id'] = $request['pqr_id'];
            $nuevaPQRPeticion['motivo_sub_id'] = $request['motivo_sub_id' . $i];
            $nuevaPQRPeticion['otro'] = $request['otro' . $i];
            $nuevaPQRPeticion['justificacion'] = $request['justificacion' . $i];
            $contadorAnexos += $request['cantidadAnexosMotivo' . $i];
            $contadorHechos += $request['cantidadHechosMotivo' . $i];
            $peticion = Peticion::create($nuevaPQRPeticion);
            for ($j = $iteradorAnexos; $j < $contadorAnexos; $j++) {
                if ($request->hasFile("documentos$j")) {
                    $ruta = Config::get('constantes.folder_doc_pqr');
                    $ruta = trim($ruta);
                    $doc_subido = $documentos["documentos$j"];
                    $tamaño = $doc_subido->getSize();
                    if ($tamaño > 0) {
                        $tamaño = $tamaño / 1000;
                    }
                    $nombre_doc = time() . '-' . utf8_encode(utf8_decode($doc_subido->getClientOriginalName()));
                    $nuevo_documento['peticion_id'] = $peticion->id;
                    $nuevo_documento['titulo'] = $request["titulo$j"];
                    if ($request["descripcion$j"]) {
                        $nuevo_documento['descripcion'] = $request["descripcion$j"];
                    } else {
                        $nuevo_documento['descripcion'] = '';
                    }
                    $nuevo_documento['extension'] = $doc_subido->getClientOriginalExtension();
                    $nuevo_documento['peso'] = $tamaño;
                    $nuevo_documento['url'] = $nombre_doc;
                    $doc_subido->move($ruta, $nombre_doc);
                    Anexo::create($nuevo_documento);
                }
            }
            for ($k = $iteradorHechos; $k < $contadorHechos; $k++) {
                $nuevosHechos['peticion_id'] = $peticion->id;
                $nuevosHechos['hecho'] = $request['hecho' . $k];
                Hecho::create($nuevosHechos);
            }
            $iteradorAnexos += $request['cantidadAnexosMotivo' . $i];
            $iteradorHechos += $request['cantidadHechosMotivo' . $i];
        }
        $idPQR =  $request['pqr_id'];
        $pqr = PQR::findOrFail($idPQR);
        if($pqr->estado_creacion == 0){
            $tipo_pqr = tipoPQR::findOrFail($pqr['tipo_pqr_id']);
            $diasLimite = $tipo_pqr['tiempos'];
            $diaGeneracion = date("Y-m-d");
            $respuestaDias = FechasController::festivos($diasLimite, $diaGeneracion);
            $actualizarPQR['fecha_generacion'] = date("Y-m-d H:i:s");
            $actualizarPQR['fecha_radicado'] = date("Y-m-d", strtotime(date("Y-m-d") . "+ 1 days"));
            $actualizarPQR["estado_creacion"] = 1;
            $actualizarPQR['estadospqr_id'] = 1;
            $actualizarPQR['tiempo_limite'] = $respuestaDias;
            $actualizarPQR['radicado'] = $tipo_pqr->sigla . '-' . date('Y') . '-' . $pqr->id;
            PQR::findOrFail($idPQR)->update($actualizarPQR);
        }
        $Actualizadopqr = PQR::findOrFail($idPQR);
        if ($pqr->persona_id != null) {
            $email = $pqr->persona->email;
        } else {
            $email = $pqr->empresa->email;
        }
        $id_pqr = $pqr->id;
        $this->asigacion_automatica($id_pqr);
        if ($email) {
            //Mail::to($email)->send(new PQR_Radicada($id_pqr));
        }
        return redirect('/dashboard/usuarios/generar')->with('id', $idPQR)->with('pqr_tipo', $Actualizadopqr->tipo_pqr_id)->with('radicado', $Actualizadopqr->radicado)->with('fecha_radicado', $Actualizadopqr->created_at);
    }
    public function generarPQR($id)
    {
        $usuario = User::findOrFail(session('id_usuario'));
        $tipo_pqr = tipoPQR::findOrFail($id);
        $departamentos = Departamento::get();
        $categorias = Categoria::get();
        $servicios = Servicio::all();
        return view('intranet.usuarios.crearPQR', compact('usuario', 'tipo_pqr', 'departamentos', 'categorias', 'servicios'));
    }
    public function generarPQR_guardar(ValidarPqr $request)
    {
        $usuario = User::findOrFail(session('id_usuario'));
        if ($usuario->persona) {
            $nuevaPQR['persona_id'] = $usuario->id;
            $validarInsert = PQR::where('persona_id', $usuario->id)->get();
        } else {
            $nuevaPQR['empresa_id'] = $usuario->id;
            $validarInsert = PQR::where('empresa_id', $usuario->id)->get();
        }
        if($validarInsert->count()){
            $insert = false;
            $ultimoInsert = PQR::findOrFail($validarInsert[$validarInsert->count() - 1]->id);
            $fechaActual = strtotime(date("Y-m-d H:i:s"));
            $fechaUltimoInsert = strtotime($ultimoInsert['created_at']);
            $fechaUltimoInsert = strtotime ('+ 2 minute' , $fechaUltimoInsert);
            if($fechaUltimoInsert < $fechaActual){
                $insert = true;
            }
        }else{
            $insert = true;
        }
        if ($insert) {
            $nuevaPQR['tipo_pqr_id'] = $request['tipo_pqr_id'];
            $nuevaPQR['adquisicion'] = $request['adquisicion'];
            $nuevaPQR['sede_id'] = $request['sede_id'];
            $nuevaPQR['tipo'] = $request['tipo'];
            $nuevaPQR['referencia_id'] = $request['referencia_id'];
            $nuevaPQR['factura'] = $request['factura'];
            $nuevaPQR['fecha_factura'] = $request['fecha_factura'];
            if (isset($request['servicio_id'])) {
                $nuevaPQR['servicio_id'] = $request['servicio_id'];
            }
            $pqr = PQR::create($nuevaPQR);

            $pqr = PQR::findOrFail($pqr->id);

            return redirect('/dashboard/usuarios/generarPQR-motivos/' . $pqr->id);
        }
    }

    public function generarPQR_motivos($id)
    {
        $pqr = PQR::findOrFail($id);
        return view('intranet.usuarios.crearPQRMotivos', compact('pqr'));
    }

    public function asigacion_automatica($id)
    {
        $resp = '';
        $pqr = PQR::findOrFail($id);
        $asignaciones = AsignacionParticular::where('tipo', 'Permanente')->get();
        // **************************************************************************************************** */
        $resp = '';
        $respuesta['no_null'] = 0;
        $respuesta['asignacion_id'] = 0;
        foreach ($asignaciones as $asignacion) {
            $resp .= '      id Asignacion = ' . $asignacion->id . '***';
            $coincidencia = 0;
            $no_null = 0;
            if ($asignacion->tipo_pqr_id != null) {
                $no_null++;
                $resp .= 'tipo pqr:';
                if ($asignacion->tipo_pqr_id == $pqr->tipo_pqr_id) {
                    $coincidencia++;
                    $resp .= 'tipo pqr';
                }
            }
            $resp .= ',';
            if ($pqr->tipo != null) {
                if ($asignacion->prodserv != null) {
                    $no_null++;
                    $resp .= 'producto serv:';
                    if ($asignacion->prodserv == $pqr->tipo) {
                        $coincidencia++;
                        $resp .= 'producto serv';
                    }
                }
            }
            $resp .= ',';

            if ($asignacion->motivo_id != null) {
                $no_null++;
                $resp .= 'motivo:';
                if ($pqr->peticiones->count() > 0) {
                    foreach ($pqr->peticiones as $peticion) {
                        if ($peticion->motivo_sub_id != null) {
                            if ($asignacion->motivo_id == $peticion->motivo->motivo_id) {
                                $coincidencia++;
                                $resp .= 'motivo';
                            }
                        }
                    }
                }
            }
            $resp .= ',';
            if ($asignacion->motivo_sub_id != null) {
                $no_null++;
                $resp .= 'sub motivo:';
                if ($pqr->peticiones->count() > 0) {
                    foreach ($pqr->peticiones as $peticion) {
                        if ($peticion->motivo_sub_id != null) {
                            if ($asignacion->motivo_sub_id == $peticion->motivo_sub_id) {
                                $coincidencia++;
                                $resp .= 'sub motivo';
                            }
                        }
                    }
                }
            }
            $resp .= ',';

            if ($pqr->servicio_id != null) {
                if ($asignacion->servicio_id != null) {
                    $no_null++;
                    $resp .= 'servicio:';
                    if ($asignacion->servicio_id == $pqr->servicio_id) {
                        $coincidencia++;
                        $resp .= 'servicio';
                    }
                }
            }
            $resp .= ',';
            if ($pqr->referencia_id != null) {
                if ($asignacion->categoria_id != null) {
                    $no_null++;
                    $resp .= 'categoria:';
                    if ($asignacion->categoria_id == $pqr->referencia->marca->producto->categoria_id) {
                        $coincidencia++;
                        $resp .= 'categoria';
                    }
                }
                $resp .= ',';
                if ($asignacion->producto_id != null) {
                    $no_null++;
                    $resp .= 'producto:';
                    if ($asignacion->producto_id == $pqr->referencia->marca->producto_id) {
                        $coincidencia++;
                        $resp .= 'producto';
                    }
                }
                $resp .= ',';
                if ($asignacion->marca_id != null) {
                    $no_null++;
                    $resp .= 'marca:';
                    if ($asignacion->marca_id == $pqr->referencia->marca_id) {
                        $coincidencia++;
                        $resp .= 'marca';
                    }
                }
                $resp .= ',';
                if ($asignacion->referencia_id != null) {
                    $no_null++;
                    $resp .= 'referencia:';
                    if ($asignacion->referencia_id == $pqr->referencia_id) {
                        $coincidencia++;
                        $resp .= 'referencia';
                    }
                }
                $resp .= ',';
            }
            if ($asignacion->adquisicion != null) {
                $no_null++;
                $resp .= 'adquisicion:';
                if ($pqr->adquisicion != null) {
                    if ($asignacion->adquisicion == $pqr->adquisicion) {
                        $coincidencia++;
                        $resp .= 'adquisicion';
                    }
                }
            }
            $resp .= ',';
            if ($asignacion->palabra1 != null) {
                $no_null++;
                $encontrada = 0;
                foreach ($pqr->peticiones as $peticion) {
                    if ($encontrada === 0) {
                        $pos = strpos($peticion->justificacion, $asignacion->palabra1);
                        if ($pos !== false) {
                            $encontrada++;
                            $coincidencia++;
                        }
                    }
                    if ($encontrada === 0) {
                        foreach ($peticion->hechos as $hecho) {
                            if ($encontrada === 0) {
                                $pos = strpos($hecho->hecho, $asignacion->palabra1);
                                if ($pos !== false) {
                                    $encontrada++;
                                    $coincidencia++;
                                }
                            }
                        }
                    }
                }
            }
            if ($asignacion->palabra2 != null) {
                $no_null++;
                $encontrada = 0;
                foreach ($pqr->peticiones as $peticion) {
                    if ($encontrada === 0) {
                        $pos = strpos($peticion->justificacion, $asignacion->palabra2);
                        if ($pos !== false) {
                            $encontrada++;
                            $coincidencia++;
                        }
                    }
                    if ($encontrada === 0) {
                        foreach ($peticion->hechos as $hecho) {
                            if ($encontrada === 0) {
                                $pos = strpos($hecho->hecho, $asignacion->palabra2);
                                if ($pos !== false) {
                                    $encontrada++;
                                    $coincidencia++;
                                }
                            }
                        }
                    }
                }
            }
            if ($asignacion->palabra3 != null) {
                $no_null++;
                $encontrada = 0;
                foreach ($pqr->peticiones as $peticion) {
                    if ($encontrada === 0) {
                        $pos = strpos($peticion->justificacion, $asignacion->palabra3);
                        if ($pos !== false) {
                            $encontrada++;
                            $coincidencia++;
                        }
                    }
                    if ($encontrada === 0) {
                        foreach ($peticion->hechos as $hecho) {
                            if ($encontrada === 0) {
                                $pos = strpos($hecho->hecho, $asignacion->palabra3);
                                if ($pos !== false) {
                                    $encontrada++;
                                    $coincidencia++;
                                }
                            }
                        }
                    }
                }
            }
            if ($asignacion->palabra4 != null) {
                $no_null++;
                $encontrada = 0;
                foreach ($pqr->peticiones as $peticion) {
                    if ($encontrada === 0) {
                        $pos = strpos($peticion->justificacion, $asignacion->palabra4);
                        if ($pos !== false) {
                            $encontrada++;
                            $coincidencia++;
                        }
                    }
                    if ($encontrada === 0) {
                        foreach ($peticion->hechos as $hecho) {
                            if ($encontrada === 0) {
                                $pos = strpos($hecho->hecho, $asignacion->palabra4);
                                if ($pos !== false) {
                                    $encontrada++;
                                    $coincidencia++;
                                }
                            }
                        }
                    }
                }
            }
            $resp .= '  ------ salto ---  ';
            if ($no_null > 0 && $coincidencia > 0) {
                $resp .= 'no null->' . $no_null . '-coincidencia->' . $coincidencia . '   -   Asignacion->' . $asignacion->id . '   -   ';
                if ($coincidencia === $no_null) {
                    if ($no_null > $respuesta['no_null']) {
                        $respuesta['no_null'] = $no_null;
                        $respuesta['asignacion_id'] = $asignacion->id;
                    }
                }
            }
        }
        if ($respuesta['asignacion_id']) {
            $asignacion_final = AsignacionParticular::findOrFail($respuesta['asignacion_id']);
            if ($pqr->sede_id != null) {
                if ($pqr->sede_id == $asignacion_final->sede_id) {
                    $empleados = Empleado::where('estado', 1)->where('cargo_id', $asignacion_final->cargo_id)->where('sede_id', $asignacion_final->sede_id)->get();
                } else {
                    if ($pqr->persona_id != null) {
                        $persona = Persona::findOrfail($pqr->persona_id);
                        foreach ($persona->municipio->departamento->sedes as $sede) {
                            $sede_id = $sede->id;
                        }
                        $empleados = Empleado::where('estado', 1)->where('cargo_id', $asignacion_final->cargo_id)->where('sede_id', $sede_id)->get();
                    } else {
                        $empresa = Empresa::findOrfail($pqr->empresa_id);
                        foreach ($empresa->municipio->departamento->sedes as $sede) {
                            $sede_id = $sede->id;
                        }
                        $empleados = Empleado::where('estado', 1)->where('cargo_id', $asignacion_final->cargo_id)->where('sede_id', $sede_id)->get();
                    }
                }
            } else {
                if ($pqr->persona_id != null) {
                    $persona = Persona::findOrfail($pqr->persona_id);
                    foreach ($persona->municipio->departamento->sedes as $sede) {
                        $sede_id = $sede->id;
                    }
                    $empleados = Empleado::where('estado', 1)->where('cargo_id', $asignacion_final->cargo_id)->where('sede_id', $sede_id)->get();
                } else {
                    $empresa = Empresa::findOrfail($pqr->empresa_id);
                    foreach ($empresa->municipio->departamento->sedes as $sede) {
                        $sede_id = $sede->id;
                    }
                    $empleados = Empleado::where('estado', 1)->where('cargo_id', $asignacion_final->cargo_id)->where('sede_id', $sede_id)->get();
                }
            }
            $max_pqr = 0;
            foreach ($empleados as $empleado) {
                $empleados_sel_max[] = ['cant' => $empleado->pqrs->count(), 'id' => $empleado->id];
            }
            $empleado_final = min($empleados_sel_max);
            $pqr_act['empleado_id'] = $empleado_final['id'];
            $pqr->update($pqr_act);
        }
        // **************************************************************************************************** */

    }
}
