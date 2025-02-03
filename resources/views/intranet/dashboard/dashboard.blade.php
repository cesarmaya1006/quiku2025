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
    <div class="container-fluid">
        @can('dashboard.AdministradorSistema') @include('intranet.index.adminsistema') @endcan
        @can('dashboard.Administrador') @include('intranet.index.admin') @endcan
        @can('dashboard.Funcionario') @include('intranet.index.funcionarios') @endcan
        @can('dashboard.Usuario') @include('intranet.index.usuarios') @endcan
        @can('dashboard.Analitica') @include('intranet.index.analitica') @endcan
        @can('dashboard.Wiku') @include('intranet.index.wiku') @endcan
    </div>
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('script_pagina')
@endsection
