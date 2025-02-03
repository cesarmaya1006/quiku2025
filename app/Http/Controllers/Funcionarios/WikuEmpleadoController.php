<?php

namespace App\Http\Controllers\Intranet\Funcionarios;

use App\Http\Controllers\Controller;
use App\Models\Wiku\WikuArgumento;
use App\Models\Wiku\WikuDoctrina;
use App\Models\Wiku\WikuDocument;
use App\Models\Wiku\WikuJurisprudencia;
use App\Models\Wiku\WikuNorma;
use Illuminate\Http\Request;

class WikuEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $fuentes = WikuDocument::all();
        $normas = WikuNorma::all();
        $argumentos = WikuArgumento::with('autorInst', 'autor')->get();
        $jurisprudencias = WikuJurisprudencia::all();
        $doctrinas = WikuDoctrina::all();
        return view('intranet.funcionarios.pqr.wiku_empleado.index', compact('normas', 'fuentes', 'argumentos', 'jurisprudencias', 'doctrinas','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
