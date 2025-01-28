<?php

namespace App\Http\Controllers\Parametros;

use App\Http\Controllers\Controller;
use App\Models\Parametros\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    //--------------------------------------------------------------
    // Funciones por Ajax
    public function getMunicipiosByDpto(Request $request){
        if ($request->ajax()) {
            $municipiosTemp = Municipio::where('departamento_id',$_GET['id'])->get();
            $municipios = collect([]);
            foreach ($municipiosTemp as $municipio) {
                if ($municipio->sedes->count()) {
                    $municipios->push($municipio);
                }
            }
            return response()->json(['municipios' => $municipios]);
        } else {
            abort(404);
        }
    }
}
