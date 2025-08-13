@extends('intranet.layout.app')
@section('cssPagina')
<link rel="stylesheet" href="{{ asset('css/intranet/dashboard/index.css') }}">
@endsection
@section('phpPagina')
    @if (session('rol_principal_id') != 7 && session('rol_principal_id') == 8)
        @php
            $prq_p_num = $pqrs->where('tipo_pqr_id', 1)->count();
            $prq_p_num_rad_sin = $pqrs->where('tipo_pqr_id', 1)->where('estado', 'Radicada, sin iniciar tramite')->count();
            $prq_p_num_rad_ges = $pqrs->where('tipo_pqr_id', 1)->where('estado', 'En tramite')->count();
            $prq_p_num_rad_ven = $pqrs->where('tipo_pqr_id', 1)->where('estado', 'Vencida')->count();

            $prq_q_num = $pqrs->where('tipo_pqr_id', 2)->count();
            $prq_q_num_rad_sin = $pqrs->where('tipo_pqr_id', 2)->where('estado', 'Radicada, sin iniciar tramite')->count();
            $prq_q_num_rad_ges = $pqrs->where('tipo_pqr_id', 2)->where('estado', 'En tramite')->count();
            $prq_q_num_rad_ven = $pqrs->where('tipo_pqr_id', 2)->where('estado', 'Vencida')->count();

            $prq_r_num = $pqrs->where('tipo_pqr_id', 3)->count();
            $prq_r_num_rad_sin = $pqrs->where('tipo_pqr_id', 3)->where('estado', 'Radicada, sin iniciar tramite')->count();
            $prq_r_num_rad_ges = $pqrs->where('tipo_pqr_id', 3)->where('estado', 'En tramite')->count();
            $prq_r_num_rad_ven = $pqrs->where('tipo_pqr_id', 3)->where('estado', 'Vencida')->count();

            $conceptos_num = $pqrs->count();
            $concepto_rad_sin = $pqrs->where('estado', 'Radicada, sin iniciar tramite')->count();
            $concepto_rad_ges = $pqrs->where('estado', 'En tramite')->count();
            $concepto_rad_ven = $pqrs->where('estado', 'Vencida')->count();

            $solicitudes_datos_num = $pqrs->count();
            $solicitudes_datos_sin = $pqrs->where('estado', 'Radicada, sin iniciar tramite')->count();
            $solicitudes_datos_ges = $pqrs->where('estado', 'En tramite')->count();
            $solicitudes_datos_ven = $pqrs->where('estado', 'Vencida')->count();

            $denuncias_num = $pqrs->count();
            $felicitacionesnum = $pqrs->count();
            $solicitudes_docnum = $pqrs->count();
            $sugerencias_num = $pqrs->count();
        @endphp
    @endif
@endsection
@section('tituloPagina')
    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
@endsection
@section('botones_card')

@endsection
@section('cuerpoPagina')
    @if (session('rol_principal_id') == 7)
        @include('intranet.dashboard.analitica')
    @else
        @if (session('rol_principal_id') == 8)
            @include('intranet.dashboard.wiku')
        @else
            @include('intranet.dashboard.index')
        @endif
    @endif
@endsection
@section('footer_card')

@endsection
@section('modales')

@endsection
@section('scriptPagina')
    <script src="{{ asset('adminlte3/plugins/chart.js/Chart.min.js') }}"></script>
@endsection
