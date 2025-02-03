<?php

namespace App\Http\Controllers\Intranet\Admin;

use App\Http\Controllers\Controller;
use App\Models\Productos\Categoria;
use App\Models\Productos\Marca;
use App\Models\Productos\Producto;
use App\Models\Productos\Referencia;
use Illuminate\Http\Request;

class ReferenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referencias = Referencia::get();
        return view('intranet.parametros.referencias.index', compact('referencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crear()
    {
        $categorias = Categoria::get();
        return view('intranet.parametros.referencias.crear', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        Referencia::create($request->all());
        return redirect('admin/referencias-index')->with('mensaje', 'Reférencia creada con exito');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $categorias = Categoria::get();
        $referencia = Referencia::findOrFail($id);
        $marcas = Marca::where('producto_id',$referencia->marca->producto_id)->get();
        $productos = Producto::where('categoria_id',$referencia->marca->producto->categoria_id)->get();
        return view('intranet.parametros.referencias.editar', compact('referencia','productos','categorias','marcas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
        Referencia::findOrFail($id)->update($request->all());
        return redirect('admin/referencias-index')->with('mensaje', 'Referencia actualizada con exito');
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
