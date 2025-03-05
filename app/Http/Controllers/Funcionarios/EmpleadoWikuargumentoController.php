<?php

namespace App\Http\Controllers\Funcionarios;

use App\Http\Controllers\Controller;
use App\Models\Empleados\EmpleadoWikuargumento;
use App\Models\Wiku\WikuArea;
use App\Models\Wiku\WikuArgumento;
use App\Models\Wiku\WikuAutor;
use App\Models\Wiku\WikuAutorInst;
use App\Models\Wiku\WikuTemaEspecifico;
use Illuminate\Http\Request;

class EmpleadoWikuargumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear($id)
    {
        $temasEspecifico = WikuTemaEspecifico::all();
        $areas = WikuArea::all();
        $autoresInst = WikuAutorInst::all();
        $autores = WikuAutor::all();
        return view('intranet.funcionarios.pqr.wiku_empleado.argumentos.crear', compact('id','temasEspecifico','areas','autoresInst','autores'));
    }
    public function guardar(Request $request, $id)
    {
        $request['empleado_id'] = session('id_usuario');
        unset($request['autortipo']);
        EmpleadoWikuargumento::create($request->all());
        return redirect('admin/index/gestionarAsignacionColaboracion/'.$id)->with('mensaje', 'Argumento creado con exito, Estara dispobible cuando el administrador del sistema lo apruebe.');
    }
    public function editar($id, $id_arg)
    {
        $argumento = WikuArgumento::findOrFail($id_arg);
        $areas = WikuArea::all();
        $temasEspecifico = WikuTemaEspecifico::all();
        $autoresInst = WikuAutorInst::all();
        $autores = WikuAutor::all();
        return view('intranet.funcionarios.pqr.wiku_empleado.argumentos.editar', compact('argumento', 'id', 'id_arg','areas','autoresInst','autores','temasEspecifico'));
    }
    public function actualizar(Request $request, $id, $id_arg)
    {
        unset($request['autortipo']);
        $request['empleado_id'] = session('id_usuario');
        $request['wikuargumento_id'] = $id_arg;
        EmpleadoWikuargumento::create($request->all());
        return redirect('admin/index/gestionarAsignacionColaboracion/'.$id)->with('mensaje', 'Argumento editado con exito, la actualización estara dispobible cuando el administrador del sistema lo apruebe.');
    }

    public function cambios($id){
        $argumento = WikuArgumento::findOrFail($id);
        return view('intranet.parametros.wiku.argumentos.cambios', compact('argumento'));
    }
    public function cambios_aceptar(Request $request, $id){
        //dd($request->toArray());
        $argumento = WikuArgumento::findOrFail($id);
        $id_cambio = $argumento->cambios->where('wikuargumento_id',$argumento->id)->last()->id;
        $argumento_cambio = EmpleadoWikuargumento::findOrFail($id_cambio);
        if ($request['aceptacion']=='si') {
            $argumento_new['observacion']=$argumento_cambio->observacion . ' - ' . $request['edicion'];
            $argumento_new['fecha']=$argumento_cambio->fecha;
            $argumento_new['wikuautorinstitu_id']=$argumento_cambio->wikuautorinstitu_id ;
            $argumento_new['wikuautores_id']=$argumento_cambio->wikuautores_id ;
            $argumento_new['texto']=$argumento_cambio->texto;
            $argumento_new['descripcion']=$argumento_cambio->descripcion;
            $argumento_new['wikutemaespecifico_id']=$argumento_cambio->wikutemaespecifico_id ;
            $argumento_new['destacado']=$argumento_cambio->destacado;
            $argumento_new['publico']=$argumento_cambio->publico;
            $argumento_new['observacion']=$argumento_cambio->observacion;
            //$argumento_new['estado']=$argumento_cambio->observacion;

            $argumento_cambio_new['respuesta']=$request['edicion'];
            $argumento_cambio_new['estado']=$request['edicion'];

            WikuArgumento::findOrFail($id)->update($argumento_new);
            EmpleadoWikuargumento::findOrFail($id_cambio)->update($argumento_cambio_new);
            return redirect('admin/funcionario/wiku/index')->with('mensaje', 'Argumento editado con éxito.');

        } else {
            return redirect('admin/funcionario/wiku/index')->with('mensaje', 'Se rechazo la edición');
        }

        $argumento = WikuArgumento::findOrFail($id);
        return view('intranet.parametros.wiku.argumentos.cambios', compact('argumento'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
