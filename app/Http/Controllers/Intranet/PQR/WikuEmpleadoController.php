<?php

namespace App\Http\Controllers\Intranet\PQR;

use App\Http\Controllers\Controller;
use App\Models\PQR\WikuArgumento;
use App\Models\PQR\WikuDoctrina;
use App\Models\PQR\WikuDocument;
use App\Models\PQR\WikuJurisprudencia;
use App\Models\PQR\WikuNorma;
use Illuminate\Http\Request;

class WikuEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
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
}
