<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use App\Models\Config\Municipio;
use App\Models\Empresa\Sede;
use App\Models\PQR\Marca;
use App\Models\PQR\Producto;
use App\Models\PQR\Referencia;
use App\Models\PQR\SubMotivo;
use Illuminate\Http\Request;

class ExtraPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cargar_municipios(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['id'];
            return Municipio::where('departamento_id', $id)->orderBy('municipio')->get();
        }
    }

    public function cargar_sedes(Request $request)
    {
        if ($request->ajax()) {
            $id = $request['id'];
            return Sede::where('municipio_id', $id)->orderBy('nombre')->get();
        }
    }

    public function cargar_productos(Request $request){
        if ($request->ajax()) {
            $id = $request['id'];
            return response()->json(['productos' => Producto::where('categoria_id',$id)->get()]);
        } else {
            abort(404);
        }
    }

    public function cargar_marcas(Request $request){
        if ($request->ajax()) {
            $id = $request['id'];
            return response()->json(['marcas' => Marca::where('producto_id',$id)->get()]);
        } else {
            abort(404);
        }
    }

    public function cargar_referencias(Request $request){
        if ($request->ajax()) {
            $id = $request['id'];
            return response()->json(['referencias' => Referencia::where('marca_id',$id)->get()]);
        } else {
            abort(404);
        }
    }
    public function cargar_submotivos(Request $request)
    {
        if ($request->ajax()) {
            $id = $_GET['id'];
            return SubMotivo::where('motivo_id', $id)->get();
        }
    }

}
