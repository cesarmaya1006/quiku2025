<?php

namespace App\Http\Controllers\Intranet\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empleados\Empleado;
use App\Models\PQR\Estado;
use App\Models\PQR\Motivo;
use App\Models\PQR\PQR;
use App\Models\PQR\SubMotivo;
use App\Models\PQR\tipoPQR;
use App\Models\Productos\Categoria;
use App\Models\Servicios\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnaliticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $bgColor =['bg-primary','bg-secondary','bg-success','bg-warning','bg-info',];
        $tipospqr = tipoPQR::get();
        $cont = 0;
        foreach ($tipospqr as $tipopqr) {
            if ($tipopqr->pqrs->count()) {
                $data[] =['y'=>$tipopqr->pqrs->count(),'label'=> $tipopqr->tipo];
            }
            $tipopqr['bg_color'] = $bgColor[$cont];
            if ($cont===4) {
                $cont =0;
            }else{
                $cont++;
            }
        }
        $pqr_mes= PQR::get();
        $cant_enero =0;
        $cant_febrero =0;
        $cant_marzo =0;
        $cant_abril =0;
        $cant_mayo =0;
        $cant_junio =0;
        $cant_julio =0;
        $cant_agosto =0;
        $cant_septiembre =0;
        $cant_octubre =0;
        $cant_noviembre =0;
        $cant_diciembreo =0;
        foreach ($pqr_mes as $pqr) {
            switch (date("m", strtotime($pqr->fecha_generacion))) {
                case '1':
                    $cant_enero++;
                    break;
                case '2':
                    $cant_febrero++;
                    break;
                case '3':
                    $cant_marzo++;
                    break;
                case '4':
                    $cant_abril++;
                    break;
                case '5':
                    $cant_mayo++;
                    break;
                case '6':
                    $cant_junio++;
                    break;
                case '7':
                    $cant_julio++;
                    break;
                case '8':
                    $cant_agosto++;
                    break;
                case '9':
                    $cant_septiembre++;
                    break;
                case '10':
                    $cant_octubre++;
                    break;
                case '11':
                    $cant_noviembre++;
                    break;
                default:
                    $cant_diciembreo++;
                    break;
            }
        }
        $data_mes = [
            ['y'=>$cant_enero,'label'=> $meses[0]],
            ['y'=>$cant_febrero,'label'=> $meses[1]],
            ['y'=>$cant_marzo,'label'=> $meses[2]],
            ['y'=>$cant_abril,'label'=> $meses[3]],
            ['y'=>$cant_mayo,'label'=> $meses[4]],
            ['y'=>$cant_junio,'label'=> $meses[5]],
            ['y'=>$cant_julio,'label'=> $meses[6]],
            ['y'=>$cant_agosto,'label'=> $meses[7]],
            ['y'=>$cant_septiembre,'label'=> $meses[8]],
            ['y'=>$cant_octubre,'label'=> $meses[9]],
            ['y'=>$cant_noviembre,'label'=> $meses[10]],
            ['y'=>$cant_diciembreo,'label'=> $meses[11]],

        ];
        $data = $data_mes;
        return view('intranet.funcionarios.analitica.index',compact('tipospqr','data','data_mes'));
    }
    public function index2()
    {
        $tiempomedio = [];
        $tipos_pqr = tipoPQR::get();
        $categorias = Categoria::get();
        $servicios = Servicio::get();
        $dias = 1;
        $primeraPqr = PQR::first();
        $ultimaPqr = PQR::latest('fecha_radicado')->first();
        $fechaannoini = Carbon::parse($primeraPqr->fecha_radicado);
        $annoini = $fechaannoini->year;

        $fechaannofin = Carbon::parse($ultimaPqr->fecha_radicado);
        $annofin = $fechaannofin->year;
        foreach ($tipos_pqr as $tipoPqr) {
            $pqrs = PQR::where('tipo_pqr_id', $tipoPqr->id)->get();
            $cantidadDias = [];
            foreach ($pqrs as $pqr) {
                $fechaAntigua  = Carbon::parse($pqr->fecha_radicado);
                $fechaReciente = Carbon::parse($pqr->fecha_respuesta);
                $cantidadDias[] = $fechaAntigua->diffInDays($fechaReciente);
            }
            $mediadias = collect($cantidadDias);
            if ($mediadias->median() > 0) {
                $tiempomedio[] = ['y' => $mediadias->median(), 'label' => $tipoPqr->tipo];
            } else {
                $tiempomedio[] = ['y' => 0, 'label' => $tipoPqr->tipo];
            }
        }
        return view('intranet.funcionarios.analitica.index', compact(
            'tipos_pqr',
            'categorias',
            'servicios',
            'tiempomedio',
            'annoini',
            'annofin'
        ));
    }

    public function cantidad(){
        $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $tipos_pqr = tipoPQR::get();
        $categorias = Categoria::get();
        $servicios = Servicio::get();
        $primeraPqr = PQR::first();
        $ultimaPqr = PQR::latest('fecha_generacion')->first();
        $fechaannoini = Carbon::parse($primeraPqr->fecha_generacion);
        $annoini = $fechaannoini->year;
        $fechaannofin = Carbon::parse($ultimaPqr->fecha_radicado);
        $annofin = $fechaannofin->year;
        $empleados = Empleado::get();

        return view('intranet.funcionarios.analitica.cantidad', compact(
            'tipos_pqr',
            'categorias',
            'servicios',
            'annoini',
            'annofin',
            'meses',
            'empleados'
        ));

    }

    public function cantidad_2()
    {
        $tipos_pqr = tipoPQR::get();
        $categorias = Categoria::get();
        $servicios = Servicio::get();
        $primeraPqr = PQR::first();
        $ultimaPqr = PQR::latest('fecha_radicado')->first();
        $fechaannoini = Carbon::parse($primeraPqr->fecha_radicado);
        $annoini = $fechaannoini->year;
        $fechaannofin = Carbon::parse($ultimaPqr->fecha_radicado);
        $annofin = $fechaannofin->year;
        return view('intranet.funcionarios.analitica.analiticacantidad', compact(
            'tipos_pqr',
            'categorias',
            'servicios',
            'annoini',
            'annofin'
        ));
    }
    public function tipoPQR(Request $request)
    {
        $meses = array(
            1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        );
        if ($request->ajax()) {
            $medianas = [];
            $respuesta = [];
            $annoBusqueda = $request['annoBusqueda'];
            $annoFin  = date("Y");
            $tiposPqr = tipoPQR::get();
            for ($i = $annoBusqueda; $i <= $annoFin; $i++) {
                for ($j = 1; $j <= 12; $j++) {
                    if ($request['busqueda'] == 'tipopqr_id') {
                        $motivos = Motivo::where('tipo_pqr_id', $request['id'])->get();
                        foreach ($motivos as $motivo) {
                            $pqrs = PQR::where('tipo_pqr_id', $request['id'])
                                ->whereYear('fecha_radicado', date("Y", $i))
                                ->whereMonth('fecha_radicado', date("m", $j))
                                ->get();
                            $cantidadDias = [];
                            if ($pqrs->count() > 0) {
                                foreach ($pqrs as $pqr) {
                                    $fechaAntigua  = Carbon::parse($pqr->fecha_radicado);
                                    $fechaReciente = Carbon::parse($pqr->fecha_respuesta);
                                    $cantidadDias[] = $fechaAntigua->diffInDays($fechaReciente);
                                }
                                $mediadias = collect($cantidadDias);
                                $medianas[] = ['anno' => $i, 'mes' => $j, 'tipo_pqr_id' => $motivo->id, 'tipo' => $motivo->tipo, 'mediana' => $mediadias->median()];
                            } else {
                                $medianas[] = ['anno' => $i, 'mes' => $j, 'tipo_pqr_id' => $motivo->id, 'tipo' => $motivo->tipo, 'mediana' => '0'];
                            }
                        }
                    }
                }
            }
            foreach ($motivos as $motivo) {
                $dataPoints = [];
                for ($i = $annoBusqueda; $i <= $annoFin; $i++) {
                    for ($j = 1; $j <= 12; $j++) {
                        foreach ($medianas as $item) {
                            if ($motivo->id == $item['tipo_pqr_id'] && $i == $item['anno'] && $j == $item['mes']) {
                                $dataPoints[] = ['x' => $j, 'y' => rand(1, 50)];
                            }
                        }
                    }
                }
                $respuesta[] = [
                    'type' => $_REQUEST['tipo_grafico'],
                    'name' => $motivo->motivo,
                    'markerSize' => 5,
                    'showInLegend' => true,
                    'dataPoints' => $dataPoints
                ];
            }

            /*if ($request['busqueda'] == 'tipopqr') {
                $tiposPqr = tipoPQR::get();
                foreach ($tiposPqr as $tipoPqr) {
                    $pqrs = PQR::where('tipo_pqr_id', $tipoPqr->id)
                        ->whereYear('fecha_radicado', '>=', date("Y", $fechaini))
                        ->whereYear('fecha_radicado', '<=', date("Y", $fechafin))
                        ->whereMonth('fecha_radicado', '>=', date("m", $fechaini))
                        ->whereMonth('fecha_radicado', '<=', date("m", $fechafin))
                        ->get();
                    $cantidadDias = [];
                    foreach ($pqrs as $pqr) {
                        $fechaAntigua  = Carbon::parse($pqr->fecha_radicado);
                        $fechaReciente = Carbon::parse($pqr->fecha_respuesta);
                        $cantidadDias[] = $fechaAntigua->diffInDays($fechaReciente);
                    }
                    $mediadias = collect($cantidadDias);
                    if ($mediadias->median() > 0) {
                        $tiempomedio[] = [
                            'type' => 'area',
                            'name' => $tipoPqr->tipo,
                            'markerSize' => 5,
                            'showInLegend' => true,
                            'xValueFormatString' => 'MMMM',
                            'dataPoints' => array(
                                array('x' => Carbon::parse(date("Y", $fechaini), date("m", $fechaini)), 'y' => $mediadias->median()),
                            )
                        ];
                    } else {
                        $tiempomedio[] = [
                            'type' => 'area',
                            'name' => $tipoPqr->tipo,
                            'markerSize' => 5,
                            'showInLegend' => true,
                            'xValueFormatString' => 'MMMM',
                            'dataPoints' => array(
                                array('x' => Carbon::parse(date("Y", $fechaini), date("m", $fechaini)), 'y' => rand(1, 50)),
                            )
                        ];
                    }
                }
            } else if ($request['busqueda'] == 'motivos') {
                $motivos = Motivo::get();
                foreach ($motivos as $motivo) {

                    $pqrs = PQR::whereYear('fecha_radicado', '>=', date("Y", $fechaini))
                        ->whereYear('fecha_radicado', '<=', date("Y", $fechafin))
                        ->whereMonth('fecha_radicado', '>=', date("m", $fechaini))
                        ->whereMonth('fecha_radicado', '<=', date("m", $fechafin))
                        ->with('peticiones')->whereHas('peticiones.motivo', function ($q) use ($motivo) {
                            $q->where('motivo_id', $motivo->id);
                        })->get();


                    $cantidadDias = [];
                    foreach ($pqrs as $pqr) {

                        $fechaAntigua  = Carbon::parse($pqr->fecha_radicado);
                        $fechaReciente = Carbon::parse($pqr->fecha_respuesta);
                        $cantidadDias[] = $fechaAntigua->diffInDays($fechaReciente);
                    }
                    $mediadias = collect($cantidadDias);
                    if ($mediadias->median() > 0) {
                        $tiempomedio[] = ['y' => $mediadias->median(), 'label' => $motivo->motivo];
                    } else {
                        $tiempomedio[] = ['y' => rand(10, 30), 'label' => $motivo->motivo];
                    }
                }
            } else if ($request['busqueda'] == 'tipopqr_id') {
                $motivos = Motivo::where('tipo_pqr_id', $request['id'])->get();
                foreach ($motivos as $motivo) {
                    $pqrs = PQR::where('tipo_pqr_id', $request['id'])
                        ->whereYear('fecha_radicado', '>=', date("Y", $fechaini))
                        ->whereYear('fecha_radicado', '<=', date("Y", $fechafin))
                        ->whereMonth('fecha_radicado', '>=', date("m", $fechaini))
                        ->whereMonth('fecha_radicado', '<=', date("m", $fechafin))
                        ->get();
                    $cantidadDias = [];
                    foreach ($pqrs as $pqr) {
                        $fechaAntigua  = Carbon::parse($pqr->fecha_radicado);
                        $fechaReciente = Carbon::parse($pqr->fecha_respuesta);
                        $cantidadDias[] = $fechaAntigua->diffInDays($fechaReciente);
                    }
                    $mediadias = collect($cantidadDias);
                    if ($mediadias->median() > 0) {
                        $tiempomedio[] = ['label' => $motivo->motivo, 'y' => $mediadias->median(), 'legendText' => $motivo->motivo];
                    } else {
                        $tiempomedio[] = ['label' => $motivo->motivo, 'y' => rand(10, 30), 'legendText' => $motivo->motivo];
                    }
                }
            } else if ($request['busqueda'] == 'motivo_id') {
                $submotivos = SubMotivo::where('motivo_id', $request['id'])->get();
                foreach ($submotivos as $submotivo) {
                    $motivo = Motivo::findOrFail($request['id']);
                    $pqrs = PQR::whereYear('fecha_radicado', '>=', date("Y", $fechaini))
                        ->whereYear('fecha_radicado', '<=', date("Y", $fechafin))
                        ->whereMonth('fecha_radicado', '>=', date("m", $fechaini))
                        ->whereMonth('fecha_radicado', '<=', date("m", $fechafin))
                        ->with('peticiones')->whereHas('peticiones.motivo', function ($q) use ($motivo) {
                            $q->where('motivo_id', $motivo->id);
                        })->get();
                    $cantidadDias = [];
                    foreach ($pqrs as $pqr) {
                        $fechaAntigua  = Carbon::parse($pqr->fecha_radicado);
                        $fechaReciente = Carbon::parse($pqr->fecha_respuesta);
                        $cantidadDias[] = $fechaAntigua->diffInDays($fechaReciente);
                    }
                    $mediadias = collect($cantidadDias);
                    if ($mediadias->median() > 0) {
                        $tiempomedio[] = ['label' => $submotivo->sub_motivo, 'y' => $mediadias->median(), 'legendText' => $submotivo->sub_motivo];
                    } else {
                        $tiempomedio[] = ['label' => $submotivo->sub_motivo, 'y' => rand(10, 30), 'legendText' => $submotivo->sub_motivo];
                    }
                }
            }*/
            return response()->json(
                $respuesta,
                200,
                ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE
            );
        }
    }
    public function cantidad_cargar(Request $request)
    {
        $meses = array(
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        );
        if ($request->ajax()) {

            $cantidad = [];
            $respuesta = [];
            $annoBusqueda = $request['annoBusqueda'];
            $annoFin  = date("Y");
            $tiposPqr = tipoPQR::get();
            for ($i = $annoBusqueda; $i <= $annoFin; $i++) {
                for ($j = 1; $j <= 12; $j++) {
                    if ($request['busqueda'] == 'tipopqr_id') {
                        $motivos = Motivo::where('tipo_pqr_id', $request['id'])->get();
                        foreach ($motivos as $motivo) {
                            $pqrs = PQR::where('tipo_pqr_id', $request['id'])
                                ->whereYear('fecha_radicado', date("Y", $i))
                                ->whereMonth('fecha_radicado', date("m", $j))
                                ->get();
                            $cantidadDias = [];
                            if ($pqrs->count() > 0) {
                                $cantidad_pqr = 0;
                                foreach ($pqrs as $pqr) {
                                    foreach ($pqr->peticiones as $peticion) {
                                        if ($peticion->motivo->motivo_id == $motivo->id) {
                                            $cantidad_pqr++;
                                        }
                                    }
                                }
                                $cantidad[] = ['anno' => $i, 'mes' => $j, 'tipo_pqr_id' => $motivo->id, 'tipo' => $motivo->tipo, 'cantidad' => $cantidad_pqr];
                            } else {
                                $cantidad[] = ['anno' => $i, 'mes' => $j, 'tipo_pqr_id' => $motivo->id, 'tipo' => $motivo->tipo, 'cantidad' => 0];
                            }
                        }
                    }
                }
            }
            if ($_REQUEST['tipo_grafico'] == 'pie') {
                foreach ($motivos as $motivo) {
                    $dataPoints = [];
                    for ($i = $annoBusqueda; $i <= $annoFin; $i++) {
                        for ($j = 1; $j <= 12; $j++) {
                            foreach ($cantidad as $item) {
                                if ($motivo->id == $item['tipo_pqr_id'] && $i == $item['anno'] && $j == $item['mes']) {
                                    $dataPoints[] = ['y' => rand(1, 50), 'name' => $meses[$j - 1]];
                                }
                            }
                        }
                    }
                    $respuesta[] = [
                        'motivo' => $motivo->motivo,
                        'type' => "pie",
                        'showInLegend' => true,
                        'indexLabel' => "{name}",
                        'toolTipContent' => "<b>{name}</b>: \${y} (#percent%)",
                        'legendText' => "{name} (#percent%)",
                        'indexLabelPlacement' => "inside",
                        'dataPoints' => $dataPoints
                    ];
                }
            } else {
                foreach ($motivos as $motivo) {
                    $dataPoints = [];
                    for ($i = $annoBusqueda; $i <= $annoFin; $i++) {
                        for ($j = 1; $j <= 12; $j++) {
                            foreach ($cantidad as $item) {
                                if ($motivo->id == $item['tipo_pqr_id'] && $i == $item['anno'] && $j == $item['mes']) {
                                    $dataPoints[] = ['x' => $j, 'y' => rand(1, 50)];
                                }
                            }
                        }
                    }
                    $respuesta[] = [
                        'type' => $_REQUEST['tipo_grafico'],
                        'name' => $motivo->motivo,
                        'markerSize' => 5,
                        'showInLegend' => true,
                        'dataPoints' => $dataPoints
                    ];
                }
            }
        }
        return response()->json(
            $respuesta,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
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

    public function cargar_graficos(Request $request){
        //dd($request->all());
        if ($request->ajax()) {
            $meses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            $esp_rango = $request['esp_rango'];
            $anno_busqueda = $request['anno_busqueda'];
            $cant_enero =0;
            $cant_febrero =0;
            $cant_marzo =0;
            $cant_abril =0;
            $cant_mayo =0;
            $cant_junio =0;
            $cant_julio =0;
            $cant_agosto =0;
            $cant_septiembre =0;
            $cant_octubre =0;
            $cant_noviembre =0;
            $cant_diciembreo =0;
            switch ($esp_rango) {
                case '1':
                    $tipo_p_q_r_id = $request['tipo_p_q_r_id'];
                    $motivo_id = $request['motivo_id'];
                    $motivo_sub_id = $request['motivo_sub_id'];
                    $cant_enero =0;
                    $cant_febrero =0;
                    $cant_marzo =0;
                    $cant_abril =0;
                    $cant_mayo =0;
                    $cant_junio =0;
                    $cant_julio =0;
                    $cant_agosto =0;
                    $cant_septiembre =0;
                    $cant_octubre =0;
                    $cant_noviembre =0;
                    $cant_diciembreo =0;
                    if ($motivo_sub_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->whereHas('peticiones', function ($p) use ($motivo_sub_id) {
                            $p->where('motivo_sub_id', $motivo_sub_id);
                        })->get();
                    }elseif ($motivo_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->whereHas('peticiones', function ($p) use ($motivo_id) {
                            $p->whereHas('motivo', function ($q) use ($motivo_id) {
                                $q->where('motivo_id', $motivo_id);
                            });
                        })->get();
                    }elseif ($tipo_p_q_r_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->whereHas('peticiones', function ($p) use ($tipo_p_q_r_id) {
                            $p->whereHas('motivo', function ($q) use ($tipo_p_q_r_id) {
                                $q->whereHas('motivo', function ($r) use ($tipo_p_q_r_id) {
                                    $r->where('tipo_pqr_id', $tipo_p_q_r_id);
                                });
                            });
                        })->get();
                    }
                    foreach ($pqr_s as $pqr) {
                        switch (date("m", strtotime($pqr->fecha_generacion))) {
                            case '1':
                                $cant_enero++;
                                break;
                            case '2':
                                $cant_febrero++;
                                break;
                            case '3':
                                $cant_marzo++;
                                break;
                            case '4':
                                $cant_abril++;
                                break;
                            case '5':
                                $cant_mayo++;
                                break;
                            case '6':
                                $cant_junio++;
                                break;
                            case '7':
                                $cant_julio++;
                                break;
                            case '8':
                                $cant_agosto++;
                                break;
                            case '9':
                                $cant_septiembre++;
                                break;
                            case '10':
                                $cant_octubre++;
                                break;
                            case '11':
                                $cant_noviembre++;
                                break;
                            default:
                                $cant_diciembreo++;
                                break;
                        }
                    }
                    $data_mes = [
                        ['y'=>$cant_enero,'label'=> $meses[0]],
                        ['y'=>$cant_febrero,'label'=> $meses[1]],
                        ['y'=>$cant_marzo,'label'=> $meses[2]],
                        ['y'=>$cant_abril,'label'=> $meses[3]],
                        ['y'=>$cant_mayo,'label'=> $meses[4]],
                        ['y'=>$cant_junio,'label'=> $meses[5]],
                        ['y'=>$cant_julio,'label'=> $meses[6]],
                        ['y'=>$cant_agosto,'label'=> $meses[7]],
                        ['y'=>$cant_septiembre,'label'=> $meses[8]],
                        ['y'=>$cant_octubre,'label'=> $meses[9]],
                        ['y'=>$cant_noviembre,'label'=> $meses[10]],
                        ['y'=>$cant_diciembreo,'label'=> $meses[11]]

                    ];
                    return response()->json(['data_mes' => $data_mes]);
                    break;
                case '2':
                    $categoria_id = $request['categoria_id'];
                    $producto_id = $request['producto_id'];
                    $marca_id = $request['marca_id'];
                    $referencia_id = $request['referencia_id'];
                    $cant_enero =0;
                    $cant_febrero =0;
                    $cant_marzo =0;
                    $cant_abril =0;
                    $cant_mayo =0;
                    $cant_junio =0;
                    $cant_julio =0;
                    $cant_agosto =0;
                    $cant_septiembre =0;
                    $cant_octubre =0;
                    $cant_noviembre =0;
                    $cant_diciembreo =0;
                    if ($referencia_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->where('referencia_id',$referencia_id)->get();
                    }elseif ($marca_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->whereHas('referencia', function ($p) use ($marca_id) {
                            $p->where('marca_id', $marca_id);
                        })->get();
                    }elseif ($producto_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->whereHas('referencia', function ($p) use ($producto_id) {
                            $p->whereHas('marca', function ($q) use ($producto_id) {
                                $q->where('producto_id', $producto_id);
                            });
                        })->get();
                    }elseif ($categoria_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->whereHas('referencia', function ($p) use ($categoria_id) {
                            $p->whereHas('marca', function ($q) use ($categoria_id) {
                                $q->whereHas('producto', function ($r) use ($categoria_id) {
                                    $r->where('categoria_id', $categoria_id);
                                });
                            });
                        })->get();
                    }
                    //dd($pqr_s->toArray());
                    foreach ($pqr_s as $pqr) {
                        switch (date("m", strtotime($pqr->fecha_generacion))) {
                            case '1':
                                $cant_enero++;
                                break;
                            case '2':
                                $cant_febrero++;
                                break;
                            case '3':
                                $cant_marzo++;
                                break;
                            case '4':
                                $cant_abril++;
                                break;
                            case '5':
                                $cant_mayo++;
                                break;
                            case '6':
                                $cant_junio++;
                                break;
                            case '7':
                                $cant_julio++;
                                break;
                            case '8':
                                $cant_agosto++;
                                break;
                            case '9':
                                $cant_septiembre++;
                                break;
                            case '10':
                                $cant_octubre++;
                                break;
                            case '11':
                                $cant_noviembre++;
                                break;
                            default:
                                $cant_diciembreo++;
                                break;
                        }
                    }
                    $data_mes = [
                        ['y'=>$cant_enero,'label'=> $meses[0]],
                        ['y'=>$cant_febrero,'label'=> $meses[1]],
                        ['y'=>$cant_marzo,'label'=> $meses[2]],
                        ['y'=>$cant_abril,'label'=> $meses[3]],
                        ['y'=>$cant_mayo,'label'=> $meses[4]],
                        ['y'=>$cant_junio,'label'=> $meses[5]],
                        ['y'=>$cant_julio,'label'=> $meses[6]],
                        ['y'=>$cant_agosto,'label'=> $meses[7]],
                        ['y'=>$cant_septiembre,'label'=> $meses[8]],
                        ['y'=>$cant_octubre,'label'=> $meses[9]],
                        ['y'=>$cant_noviembre,'label'=> $meses[10]],
                        ['y'=>$cant_diciembreo,'label'=> $meses[11]]

                    ];
                    return response()->json(['data_mes' => $data_mes]);
                    break;
                case '3':
                    $empleado_id = $request['empleado_id'];
                    $cant_enero =0;
                    $cant_febrero =0;
                    $cant_marzo =0;
                    $cant_abril =0;
                    $cant_mayo =0;
                    $cant_junio =0;
                    $cant_julio =0;
                    $cant_agosto =0;
                    $cant_septiembre =0;
                    $cant_octubre =0;
                    $cant_noviembre =0;
                    $cant_diciembreo =0;
                    if ($empleado_id != null) {
                        $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->where('empleado_id',$empleado_id)->get();
                    }
                    //dd($pqr_s->toArray());
                    foreach ($pqr_s as $pqr) {
                        switch (date("m", strtotime($pqr->fecha_generacion))) {
                            case '1':
                                $cant_enero++;
                                break;
                            case '2':
                                $cant_febrero++;
                                break;
                            case '3':
                                $cant_marzo++;
                                break;
                            case '4':
                                $cant_abril++;
                                break;
                            case '5':
                                $cant_mayo++;
                                break;
                            case '6':
                                $cant_junio++;
                                break;
                            case '7':
                                $cant_julio++;
                                break;
                            case '8':
                                $cant_agosto++;
                                break;
                            case '9':
                                $cant_septiembre++;
                                break;
                            case '10':
                                $cant_octubre++;
                                break;
                            case '11':
                                $cant_noviembre++;
                                break;
                            default:
                                $cant_diciembreo++;
                                break;
                        }
                    }
                    $data_mes = [
                        ['y'=>$cant_enero,'label'=> $meses[0]],
                        ['y'=>$cant_febrero,'label'=> $meses[1]],
                        ['y'=>$cant_marzo,'label'=> $meses[2]],
                        ['y'=>$cant_abril,'label'=> $meses[3]],
                        ['y'=>$cant_mayo,'label'=> $meses[4]],
                        ['y'=>$cant_junio,'label'=> $meses[5]],
                        ['y'=>$cant_julio,'label'=> $meses[6]],
                        ['y'=>$cant_agosto,'label'=> $meses[7]],
                        ['y'=>$cant_septiembre,'label'=> $meses[8]],
                        ['y'=>$cant_octubre,'label'=> $meses[9]],
                        ['y'=>$cant_noviembre,'label'=> $meses[10]],
                        ['y'=>$cant_diciembreo,'label'=> $meses[11]]

                    ];
                    return response()->json(['data_mes' => $data_mes]);
                    break;
                case '4':
                    $tipo_p_q_r_id = $request['tipo_p_q_r_id'];
                    $motivo_id = $request['motivo_id'];
                    $motivo_sub_id = $request['motivo_sub_id'];
                    $categoria_id = $request['categoria_id'];
                    $producto_id = $request['producto_id'];
                    $marca_id = $request['marca_id'];
                    $referencia_id = $request['referencia_id'];

                    if ($motivo_sub_id != null) {
                        if ($referencia_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->where('referencia_id',$referencia_id)
                                        ->whereHas('peticiones', function ($p) use ($motivo_sub_id) {
                                            $p->where('motivo_sub_id', $motivo_sub_id);
                                        })->get();
                        }elseif ($marca_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($marca_id) {
                                            $p->where('marca_id', $marca_id);
                                        })
                                        ->whereHas('peticiones', function ($p) use ($motivo_sub_id) {
                                            $p->where('motivo_sub_id', $motivo_sub_id);
                                        })->get();
                        }elseif ($producto_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($producto_id) {
                                            $p->whereHas('marca', function ($q) use ($producto_id) {
                                                $q->where('producto_id', $producto_id);
                                            });
                                        })
                                        ->whereHas('peticiones', function ($p) use ($motivo_sub_id) {
                                            $p->where('motivo_sub_id', $motivo_sub_id);
                                        })->get();
                        }elseif ($categoria_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($categoria_id) {
                                            $p->whereHas('marca', function ($q) use ($categoria_id) {
                                                $q->whereHas('producto', function ($r) use ($categoria_id) {
                                                    $r->where('categoria_id', $categoria_id);
                                                });
                                            });
                                        })
                                        ->whereHas('peticiones', function ($p) use ($motivo_sub_id) {
                                            $p->where('motivo_sub_id', $motivo_sub_id);
                                        })->get();
                        }
                    }elseif ($motivo_id != null) {
                        if ($referencia_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->where('referencia_id',$referencia_id)
                                        ->whereHas('peticiones', function ($p) use ($motivo_id) {
                                            $p->whereHas('motivo', function ($q) use ($motivo_id) {
                                                $q->where('motivo_id', $motivo_id);
                                            });
                                        })->get();
                        }elseif ($marca_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($marca_id) {
                                            $p->where('marca_id', $marca_id);
                                        })
                                        ->whereHas('peticiones', function ($p) use ($motivo_id) {
                                            $p->whereHas('motivo', function ($q) use ($motivo_id) {
                                                $q->where('motivo_id', $motivo_id);
                                            });
                                        })->get();
                        }elseif ($producto_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($producto_id) {
                                            $p->whereHas('marca', function ($q) use ($producto_id) {
                                                $q->where('producto_id', $producto_id);
                                            });
                                        })
                                        ->whereHas('peticiones', function ($p) use ($motivo_id) {
                                            $p->whereHas('motivo', function ($q) use ($motivo_id) {
                                                $q->where('motivo_id', $motivo_id);
                                            });
                                        })->get();
                        }elseif ($categoria_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($categoria_id) {
                                            $p->whereHas('marca', function ($q) use ($categoria_id) {
                                                $q->whereHas('producto', function ($r) use ($categoria_id) {
                                                    $r->where('categoria_id', $categoria_id);
                                                });
                                            });
                                        })
                                        ->whereHas('peticiones', function ($p) use ($motivo_id) {
                                            $p->whereHas('motivo', function ($q) use ($motivo_id) {
                                                $q->where('motivo_id', $motivo_id);
                                            });
                                        })->get();
                        }
                    }elseif ($tipo_p_q_r_id != null) {
                        if ($referencia_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->where('referencia_id',$referencia_id)
                                        ->whereHas('peticiones', function ($p) use ($tipo_p_q_r_id) {
                                            $p->whereHas('motivo', function ($q) use ($tipo_p_q_r_id) {
                                                $q->whereHas('motivo', function ($r) use ($tipo_p_q_r_id) {
                                                    $r->where('tipo_pqr_id', $tipo_p_q_r_id);
                                                });
                                            });
                                        })->get();
                        }elseif ($marca_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($marca_id) {
                                            $p->where('marca_id', $marca_id);
                                        })
                                        ->whereHas('peticiones', function ($p) use ($tipo_p_q_r_id) {
                                            $p->whereHas('motivo', function ($q) use ($tipo_p_q_r_id) {
                                                $q->whereHas('motivo', function ($r) use ($tipo_p_q_r_id) {
                                                    $r->where('tipo_pqr_id', $tipo_p_q_r_id);
                                                });
                                            });
                                        })->get();
                        }elseif ($producto_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($producto_id) {
                                            $p->whereHas('marca', function ($q) use ($producto_id) {
                                                $q->where('producto_id', $producto_id);
                                            });
                                        })
                                        ->whereHas('peticiones', function ($p) use ($tipo_p_q_r_id) {
                                            $p->whereHas('motivo', function ($q) use ($tipo_p_q_r_id) {
                                                $q->whereHas('motivo', function ($r) use ($tipo_p_q_r_id) {
                                                    $r->where('tipo_pqr_id', $tipo_p_q_r_id);
                                                });
                                            });
                                        })->get();
                        }elseif ($categoria_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->whereHas('referencia', function ($p) use ($categoria_id) {
                                            $p->whereHas('marca', function ($q) use ($categoria_id) {
                                                $q->whereHas('producto', function ($r) use ($categoria_id) {
                                                    $r->where('categoria_id', $categoria_id);
                                                });
                                            });
                                        })
                                        ->whereHas('peticiones', function ($p) use ($tipo_p_q_r_id) {
                                            $p->whereHas('motivo', function ($q) use ($tipo_p_q_r_id) {
                                                $q->whereHas('motivo', function ($r) use ($tipo_p_q_r_id) {
                                                    $r->where('tipo_pqr_id', $tipo_p_q_r_id);
                                                });
                                            });
                                        })->get();
                        }
                    }
                    //dd($pqr_s->toArray());
                    foreach ($pqr_s as $pqr) {
                        switch (date("m", strtotime($pqr->fecha_generacion))) {
                            case '1':
                                $cant_enero++;
                                break;
                            case '2':
                                $cant_febrero++;
                                break;
                            case '3':
                                $cant_marzo++;
                                break;
                            case '4':
                                $cant_abril++;
                                break;
                            case '5':
                                $cant_mayo++;
                                break;
                            case '6':
                                $cant_junio++;
                                break;
                            case '7':
                                $cant_julio++;
                                break;
                            case '8':
                                $cant_agosto++;
                                break;
                            case '9':
                                $cant_septiembre++;
                                break;
                            case '10':
                                $cant_octubre++;
                                break;
                            case '11':
                                $cant_noviembre++;
                                break;
                            default:
                                $cant_diciembreo++;
                                break;
                        }
                    }
                    $data_mes = [
                        ['y'=>$cant_enero,'label'=> $meses[0]],
                        ['y'=>$cant_febrero,'label'=> $meses[1]],
                        ['y'=>$cant_marzo,'label'=> $meses[2]],
                        ['y'=>$cant_abril,'label'=> $meses[3]],
                        ['y'=>$cant_mayo,'label'=> $meses[4]],
                        ['y'=>$cant_junio,'label'=> $meses[5]],
                        ['y'=>$cant_julio,'label'=> $meses[6]],
                        ['y'=>$cant_agosto,'label'=> $meses[7]],
                        ['y'=>$cant_septiembre,'label'=> $meses[8]],
                        ['y'=>$cant_octubre,'label'=> $meses[9]],
                        ['y'=>$cant_noviembre,'label'=> $meses[10]],
                        ['y'=>$cant_diciembreo,'label'=> $meses[11]]

                    ];
                    return response()->json(['data_mes' => $data_mes]);
                    break;
                case '5':
                    $tipo_p_q_r_id = $request['tipo_p_q_r_id'];
                    $motivo_id = $request['motivo_id'];
                    $motivo_sub_id = $request['motivo_sub_id'];
                    $empleado_id = $request['empleado_id'];
                    if ($empleado_id != null) {
                        if ($motivo_sub_id != null) {
                            $pqr_s = PQR::
                                whereYear('fecha_generacion', $anno_busqueda)
                                ->where('empleado_id',$empleado_id)
                                ->whereHas('peticiones', function ($p) use ($motivo_sub_id) {
                                    $p->where('motivo_sub_id', $motivo_sub_id);
                                })->get();
                        }elseif ($motivo_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->where('empleado_id',$empleado_id)
                                        ->whereHas('peticiones', function ($p) use ($motivo_id) {
                                            $p->whereHas('motivo', function ($q) use ($motivo_id) {
                                                $q->where('motivo_id', $motivo_id);
                                            });
                                        })->get();
                        }elseif ($tipo_p_q_r_id != null) {
                            $pqr_s = PQR::
                                        whereYear('fecha_generacion', $anno_busqueda)
                                        ->where('empleado_id',$empleado_id)
                                        ->whereHas('peticiones', function ($p) use ($tipo_p_q_r_id) {
                                            $p->whereHas('motivo', function ($q) use ($tipo_p_q_r_id) {
                                                $q->whereHas('motivo', function ($r) use ($tipo_p_q_r_id) {
                                                    $r->where('tipo_pqr_id', $tipo_p_q_r_id);
                                                });
                                            });
                                        })->get();
                        }
                    }
                    foreach ($pqr_s as $pqr) {
                        switch (date("m", strtotime($pqr->fecha_generacion))) {
                            case '1':
                                $cant_enero++;
                                break;
                            case '2':
                                $cant_febrero++;
                                break;
                            case '3':
                                $cant_marzo++;
                                break;
                            case '4':
                                $cant_abril++;
                                break;
                            case '5':
                                $cant_mayo++;
                                break;
                            case '6':
                                $cant_junio++;
                                break;
                            case '7':
                                $cant_julio++;
                                break;
                            case '8':
                                $cant_agosto++;
                                break;
                            case '9':
                                $cant_septiembre++;
                                break;
                            case '10':
                                $cant_octubre++;
                                break;
                            case '11':
                                $cant_noviembre++;
                                break;
                            default:
                                $cant_diciembreo++;
                                break;
                        }
                    }
                    $data_mes = [
                        ['y'=>$cant_enero,'label'=> $meses[0]],
                        ['y'=>$cant_febrero,'label'=> $meses[1]],
                        ['y'=>$cant_marzo,'label'=> $meses[2]],
                        ['y'=>$cant_abril,'label'=> $meses[3]],
                        ['y'=>$cant_mayo,'label'=> $meses[4]],
                        ['y'=>$cant_junio,'label'=> $meses[5]],
                        ['y'=>$cant_julio,'label'=> $meses[6]],
                        ['y'=>$cant_agosto,'label'=> $meses[7]],
                        ['y'=>$cant_septiembre,'label'=> $meses[8]],
                        ['y'=>$cant_octubre,'label'=> $meses[9]],
                        ['y'=>$cant_noviembre,'label'=> $meses[10]],
                        ['y'=>$cant_diciembreo,'label'=> $meses[11]]

                    ];
                    return response()->json(['data_mes' => $data_mes]);

                    break;
                case '6':
                    $empleado_id = $request['empleado_id'];
                    $categoria_id = $request['categoria_id'];
                    $producto_id = $request['producto_id'];
                    $marca_id = $request['marca_id'];
                    $referencia_id = $request['referencia_id'];
                    if ($empleado_id != null) {
                        if ($referencia_id != null) {
                            $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)
                            ->where('empleado_id',$empleado_id)
                            ->where('referencia_id',$referencia_id)->get();
                        }elseif ($marca_id != null) {
                            $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)
                            ->where('empleado_id',$empleado_id)
                            ->whereHas('referencia', function ($p) use ($marca_id) {
                                $p->where('marca_id', $marca_id);
                            })->get();
                        }elseif ($producto_id != null) {
                            $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)
                            ->where('empleado_id',$empleado_id)
                            ->whereHas('referencia', function ($p) use ($producto_id) {
                                $p->whereHas('marca', function ($q) use ($producto_id) {
                                    $q->where('producto_id', $producto_id);
                                });
                            })->get();
                        }elseif ($categoria_id != null) {
                            $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)
                            ->where('empleado_id',$empleado_id)
                            ->whereHas('referencia', function ($p) use ($categoria_id) {
                                $p->whereHas('marca', function ($q) use ($categoria_id) {
                                    $q->whereHas('producto', function ($r) use ($categoria_id) {
                                        $r->where('categoria_id', $categoria_id);
                                    });
                                });
                            })->get();
                        }
                    }
                    //dd($pqr_s->toArray());
                    foreach ($pqr_s as $pqr) {
                        switch (date("m", strtotime($pqr->fecha_generacion))) {
                            case '1':
                                $cant_enero++;
                                break;
                            case '2':
                                $cant_febrero++;
                                break;
                            case '3':
                                $cant_marzo++;
                                break;
                            case '4':
                                $cant_abril++;
                                break;
                            case '5':
                                $cant_mayo++;
                                break;
                            case '6':
                                $cant_junio++;
                                break;
                            case '7':
                                $cant_julio++;
                                break;
                            case '8':
                                $cant_agosto++;
                                break;
                            case '9':
                                $cant_septiembre++;
                                break;
                            case '10':
                                $cant_octubre++;
                                break;
                            case '11':
                                $cant_noviembre++;
                                break;
                            default:
                                $cant_diciembreo++;
                                break;
                        }
                    }
                    $data_mes = [
                        ['y'=>$cant_enero,'label'=> $meses[0]],
                        ['y'=>$cant_febrero,'label'=> $meses[1]],
                        ['y'=>$cant_marzo,'label'=> $meses[2]],
                        ['y'=>$cant_abril,'label'=> $meses[3]],
                        ['y'=>$cant_mayo,'label'=> $meses[4]],
                        ['y'=>$cant_junio,'label'=> $meses[5]],
                        ['y'=>$cant_julio,'label'=> $meses[6]],
                        ['y'=>$cant_agosto,'label'=> $meses[7]],
                        ['y'=>$cant_septiembre,'label'=> $meses[8]],
                        ['y'=>$cant_octubre,'label'=> $meses[9]],
                        ['y'=>$cant_noviembre,'label'=> $meses[10]],
                        ['y'=>$cant_diciembreo,'label'=> $meses[11]]

                    ];
                    return response()->json(['data_mes' => $data_mes]);
                    break;
                case '7':
                    $empleado_id = $request['empleado_id'];
                    if ($empleado_id != null) {
                        $estados = Estado::whereHas('pqrs', function ($q) use ($anno_busqueda,$empleado_id) {
                            $q->whereYear('fecha_generacion', $anno_busqueda)->where('empleado_id',$empleado_id);
                        })->get();
                    }
                    foreach ($estados as $estado) {
                        $data_mes[]= ['y'=>$estado->pqrs->count(),'label'=> $estado->estado_funcionario];
                    }
                    //dd($pqr_s->toArray());

                    return response()->json(['data_mes' => $data_mes]);
                    break;
                case '8':
                    $empleado_id = $request['empleado_id'];
                    if ($empleado_id != null) {
                        $prom_meses =[];
                        for ($i=1; $i < 13; $i++) {
                            $pqr_s = PQR::whereYear('fecha_generacion', $anno_busqueda)->whereMonth('fecha_radicado',$i)->where('empleado_id',$empleado_id)->get();
                            foreach ($pqr_s as $pqr) {
                                $formatted_dt1=Carbon::parse($pqr->fecha_radicado);
                                $formatted_dt2=Carbon::parse($pqr->fecha_respuesta);
                                $pqr['cantidadDias'] =$formatted_dt1->diffInDays($formatted_dt2);
                            }
                            if ($pqr_s->avg('cantidadDias') != null) {
                                $prom_meses[]= round($pqr_s->avg('cantidadDias'));
                            }else{
                                $prom_meses[]= 0;
                            }

                        }

                    }
                    $data_mes = [
                        ['y'=>$prom_meses[0],'label'=> $meses[0]],
                        ['y'=>$prom_meses[1],'label'=> $meses[1]],
                        ['y'=>$prom_meses[2],'label'=> $meses[2]],
                        ['y'=>$prom_meses[3],'label'=> $meses[3]],
                        ['y'=>$prom_meses[4],'label'=> $meses[4]],
                        ['y'=>$prom_meses[5],'label'=> $meses[5]],
                        ['y'=>$prom_meses[6],'label'=> $meses[6]],
                        ['y'=>$prom_meses[7],'label'=> $meses[7]],
                        ['y'=>$prom_meses[8],'label'=> $meses[8]],
                        ['y'=>$prom_meses[9],'label'=> $meses[9]],
                        ['y'=>$prom_meses[10],'label'=> $meses[10]],
                        ['y'=>$prom_meses[11],'label'=> $meses[11]]

                    ];
                    return response()->json(['data_mes' => $data_mes]);
                    break;
                default:
                    # code...
                    break;
            }
            //=======================================================================================================================
        } else {
            abort(404);
        }
    }
}
