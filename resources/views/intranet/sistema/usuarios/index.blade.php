@extends('intranet.layout.app')

@section('css_pagina')
@endsection

@section('tituloPagina')
    <i class="fas fa-check-square mr-3" aria-hidden="true"></i> Parametros - Usuarios
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">Usuarios</li>
@endsection

@section('titulo_card')
    Listado de Usuarios
@endsection

@section('botones_card')
    <a href="{{ route('usuario.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end">
        <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>
        Nuevo Registro
    </a>
@endsection

@section('cuerpoPagina')
    @can('usuario.index')
        @foreach ($roles->whereIn('name', ['Funcionario', 'Usuario']) as $rol)
            @if ($rol->users->count())
                <div class="row d-flex justify-content-around">
                    <div class="col-12 mt-3 mb-2">
                        <h3>{{ $rol->name }}</h3>
                    </div>
                    <div class="col-12 col-md-11 table-responsive">
                        <table class="table table-striped table-hover table-sm tabla_data_table tabla-borrando display">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center text-dark" scope="col">Id</th>
                                    <th class="text-center text-dark" scope="col">Usuario</th>
                                    <th class="text-center text-dark" scope="col">N. Identificacion</th>
                                    <th class="text-center text-dark" scope="col">Nombres y Apellidos</th>
                                    <th class="text-center text-dark" scope="col">Email</th>
                                    <th class="text-center text-dark" scope="col">Telefono</th>
                                    <th class="text-center text-dark" scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rol->users as $usuario)
                                    <tr>
                                        <td class="text-center">{{ $usuario->id }}</td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $rol->name == 'Funcionario'? $usuario->empleado->tipos_docu->abreb_id . '  ' . $usuario->empleado->identificacion: $usuario->persona->tipos_docu->abreb_id . '  ' . $usuario->persona->identificacion }}</td>
                                        <td>{{ $rol->name == 'Funcionario'? $usuario->empleado->nombre1 . ' ' . $usuario->empleado->nombre2 . ' ' . $usuario->empleado->apellido1 . ' ' . $usuario->empleado->apellido2: $usuario->persona->nombre1 . ' ' . $usuario->persona->nombre2 . ' ' . $usuario->persona->apellido1 . ' ' . $usuario->persona->apellido2 }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $rol->name == 'Funcionario'? $usuario->empleado->telefono_celu : $usuario->persona->telefono_celu }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('usuario.edit', ['id' => $usuario->id]) }}"
                                                class="btn-accion-tabla tooltipsC" title="Editar este registro">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('usuario.destroy', ['id' => $usuario->id]) }}"
                                                class="d-inline form-eliminar" method="POST">
                                                @csrf @method('delete')
                                                <button type="submit" class="btn-accion-tabla eliminar tooltipsC"
                                                    title="Eliminar este registro">
                                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        @endforeach
    @else
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="alert alert-warning alert-dismissible mini_sombra">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sin Acceso!</h5>
                    <p style="text-align: justify">Su usuario no tiene permisos de acceso para esta vista, Comuniquese con el
                        administrador del sistema.</p>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('script_pagina')
    @include('intranet.layout.dataTableNew')
    <script src="{{ asset('js/intranet/general/datatablesini.js') }}"></script>
    <script src="{{ asset('js/intranet/regionales/usuario/index.js') }}"></script>
@endsection
