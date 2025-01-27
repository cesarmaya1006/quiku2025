@extends('intranet.layout.app')
@section('css_pagina')

@endsection
@section('tituloPagina')
    <i class="fa fa-home" aria-hidden="true"></i> Dashboard
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard v1</li>
@endsection
@section('cuerpoPagina')
<div class="row" >
    <div class="col-12-">
        <h3>{{session('id_usuario')}}</h3>
    </div>
</div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scripts_pagina')

@endsection
