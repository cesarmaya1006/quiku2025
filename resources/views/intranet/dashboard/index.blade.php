<div class="container-fluid">
    @if (session('rol_principal_id') == 6)
        @include('intranet.dashboard.index_usuarios')
    @endif
    @if (session('rol_principal_id') == 5)
        @include('intranet.dashboard.index_funcionarios')
    @endif
    @if (session('rol_principal_id') == 1)
        @include('intranet.dashboard.adminsistema')
    @endif
    @if (session('rol_principal_id') == 3)
        @include('intranet.dashboard.indexadmin')
    @endif
    @if (session('rol_principal_id') == 7)
        @include('intranet.dashboard.analiticaindex')
    @endif
</div>
