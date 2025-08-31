<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Config\ExtraPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Extranet\ExtranetController;
use App\Http\Controllers\Intranet\Admin\IntranetPageController;
use App\Http\Controllers\Intranet\Admin\UsuarioController;
use App\Http\Controllers\Intranet\PQR\FuncionarioController;
use App\Http\Controllers\PQR\PQRController;
use App\Http\Middleware\Administrador;
use App\Http\Middleware\AdminSistema;
use App\Http\Middleware\Funcionario;
use App\Http\Middleware\Usuario;

Route::controller(ExtranetController::class)->group(function () {
    Route::get('/', 'index')->name('extranet.index');
    Route::get('/correo', 'correo')->name('extranet.correo');
    Route::get('/registro_ini', 'registro_ini')->name('extranet.registro_ini');
    Route::get('/solicitar_password', 'solicitar_password')->name('extranet.solicitar_password');
    Route::get('/registro_ini_guardar', 'registro_ini_guardar')->name('extranet.registro_ini_guardar');
});

Route::prefix('dashboard')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/', [IntranetPageController::class, 'dashboard'])->name('dashboard');
    //===================================================================================================
    Route::controller(ExtraPageController::class)->group(function () {
        Route::get('cargar_municipios', 'cargar_municipios')->name('cargar_municipios');
        Route::get('cargar_sedes', 'cargar_sedes')->name('cargar_sedes');
        Route::get('cargar_productos', 'cargar_productos')->name('cargar_productos');
        Route::get('cargar_marcas', 'cargar_marcas')->name('cargar_marcas');
        Route::get('cargar_referencias', 'cargar_referencias')->name('cargar_referencias');
        Route::get('cargar_submotivos', 'cargar_submotivos')->name('cargar_submotivos');
    });
    //===================================================================================================
    Route::prefix('configuracion_sis')->middleware(Administrador::class)->group(function () {
        // ----------------------------------------------------------------------------------------
        Route::controller(UsuarioController::class)->prefix('usuarios')->group(function () {
            Route::get('', 'index')->name('admin.usuario.index');
            Route::get('crear', 'create')->name('admin.usuario.create');
            Route::get('editar/{id}', 'edit')->name('admin.usuario.edit');
            Route::post('guardar', 'store')->name('admin.usuario.store');
            Route::put('actualizar/{id}', 'update')->name('admin.usuario.update');
            Route::get('eliminar/{id}', 'destroy')->name('admin.usuario.destroy');
        });
        // ----------------------------------------------------------------------------------------
    });
    //===================================================================================================
    Route::middleware(Usuario::class)->prefix('usuarios')->group(function () {
        // ----------------------------------------------------------------------------------------
        Route::controller(ClienteController::class)->group(function () {
            Route::get('listado', 'index')->name('usuario.index');
            Route::get('generar', 'generar')->name('usuario.generar');
            Route::post('generar', 'direccion')->name('usuario.generar_direccion');
            Route::get('generarPQR/{id}', 'generarPQR')->name('usuario.generarPQR');
            Route::post('generarPQR', 'generarPQR_guardar')->name('usuario.generarPQR-guardar');
            Route::get('generarPQR-motivos/{id}', 'generarPQR_motivos')->name('usuario.generarPQR_motivos');
            Route::post('generarPQR-motivos', 'generarPQR_motivos_guardar')->name('usuario.generarPQR_motivos-guardar');



            Route::get('listado/gestionarPQR/{id}', 'gestionar_PQR')->name('usuario.gestionarPQR');
            Route::get('generarConceptoUOpinion', 'generarConceptoUOpinion')->name('usuario.generarConceptoUOpinion');
            Route::post('generarConceptoUOpinion', 'generarConceptoUOpinion_guardar')->name('usuario.generarConceptoUOpinion-guardar');
            Route::get('listado/gestionarConceptoUOpinion/{id}', 'gestionar_conceptoUOpinion')->name('usuario.gestionarConceptoUOpinion');
            Route::get('generarFelicitacion', 'generarFelicitacion')->name('usuario.generarFelicitacion');
            Route::post('generarFelicitacion', 'generarFelicitacion_guardar')->name('usuario.generarFelicitacion-guardar');
            Route::get('listado/gestionarFelicitaciones/{id}', 'gestionar_felicitaciones')->name('usuario.gestionarFelicitacion');
            Route::get('gererarDenuncia', 'gererarDenuncia')->name('usuario.gererarDenuncia');
            Route::post('gererarDenuncia', 'gererarDenuncia_guardar')->name('usuario.gererarDenuncia-guardar');
            Route::get('listado/gestionarReporte/{id}', 'gestionar_reporteDeIrregularidad')->name('usuario.gestionarReporte');
            Route::get('generarSolicitudDatos', 'generarSolicitudDatos')->name('usuario.generarSolicitudDatos');
            Route::post('generarSolicitudDatos', 'generarSolicitudDatos_guardar')->name('usuario.generarSolicitudDatos-guardar');
            Route::get('listado/gestionarSolicitudDatos/{id}', 'gestionar_solicitudDatos')->name('usuario.gestionarSolicitudDatos');
            Route::get('generarSolicitudDocumentos', 'generarSolicitudDocumentos')->name('usuario.generarSolicitudDocumentos');
            Route::post('generarSolicitudDocumentos', 'generarSolicitudDocumentos_guardar')->name('usuario.generarSolicitudDocumentos-guardar');
            Route::get('listado/gestionarSolicitudDocInfo/{id}', 'gestionar_solicitudDocInfo')->name('usuario.gestionarSolicitudDocInfo');
            Route::get('generarSugerencia', 'generarSugerencia')->name('usuario.generarSugerencia');
            Route::post('generarSugerencia', 'generarSugerencia_guardar')->name('usuario.generarSugerencia-guardar');
            Route::get('listado/gestionarSugerencia/{id}', 'gestionar_sugerencia')->name('usuario.gestionarsugerencia');
            Route::get('actualizar-datos', 'actualizar_datos')->name('usuario.actualizar_datos');
            Route::post('actualizar-datos', 'actualizar')->name('usuario.actualizar');
            Route::get('cambiar-password', 'cambiar_password')->name('usuario_cambiar_password');
            Route::get('crear-usuario', 'crear_usuario')->name('usuario_crear_usuario');
            Route::get('consulta-politicas', 'consulta_politicas')->name('usuario_consulta_politicas');
            Route::get('ayuda', 'ayuda')->name('usuario_ayuda');
        });
        Route::controller(PQRController::class)->group(function () {
            Route::post('listado/gestionarPQR', 'gestionar_guardar_usuario')->name('usuario_gestionar_pqr_guardar');
            Route::post('recurso', 'recurso_guardar')->name('recurso_guardar');
            Route::post('recurso_anexos', 'recurso_anexos_guardar')->name('recurso_anexos_guardar');
            Route::post('pqr_estado_recurso', 'pqr_estado_recurso_guardar')->name('pqr_estado_recurso_guardar');
            Route::post('aclaracion_usuario', 'aclaracion_usuario_guardar')->name('aclaracion_usuario_guardar');
            Route::post('aclaracion_anexos_usuario', 'aclaracion_anexos_usuario_guardar')->name('aclaracion_anexos_usuario_guardar');
        });
        // ----------------------------------------------------------------------------------------

        // ----------------------------------------------------------------------------------------
    });
    //===================================================================================================
    Route::middleware(Funcionario::class)->prefix('funcionario')->group(function () {
        Route::controller(PQRController::class)->group(function () {
            Route::get('gestion_pqr', 'gestion_pqr')->name('gestion_pqr');
            Route::post('asignacion', 'asignacion_guardar')->name('asignacion_guardar');
            Route::get('cargar_tareas', 'cargar_tareas')->name('cargar_tareas');
            Route::get('cargar_cargos', 'cargar_cargos')->name('cargar_cargos');
            Route::get('cargar_funcionarios', 'cargar_funcionarios')->name('cargar_funcionarios');
            Route::post('asignacion_tarea', 'asignacion_tarea_guardar')->name('asignacion_tarea_guardar');
            Route::post('historial_tarea', 'historial_tarea_guardar')->name('historial_tarea_guardar');
            Route::post('historial', 'historial_guardar')->name('historial_guardar');
        });
        // ----------------------------------------------------------------------------------------
        Route::controller(FuncionarioController::class)->group(function () {
            Route::post('gestion', 'gestion')->name('tutela-gestion');
            Route::get('gestionarAsignacion/{id}', 'gestionar_asignacion')->name('funcionario-gestionar-asignacion');
            Route::get('gestionarAsignacionAsignador/{id}', 'gestionar_asignacion_asignador')->name('funcionario-gestionar-asignacion-asignador');
            Route::get('gestionarAsignacionSupervisa/{id}', 'gestionar_asignacion_supervisa')->name('funcionario-gestionar-asignacion-supervisa');
            Route::get('gestionarAsignacionProyecta/{id}', 'gestionar_asignacion_proyecta')->name('funcionario-gestionar-asignacion-proyecta');
            Route::get('gestionarAsignacionRevisa/{id}', 'gestionar_asignacion_revisa')->name('funcionario-gestionar-asignacion-revisa');
            Route::get('gestionarAsignacionAprueba/{id}', 'gestionar_asignacion_aprueba')->name('funcionario-gestionar-asignacion-aprueba');
            Route::get('gestionarAsignacionRevisaAprueba/{id}', 'gestionar_asignacion_revisa_aprueba')->name('funcionario-gestionar-asignacion-revisa-aprueba');
            Route::get('gestionarAsignacionRadica/{id}', 'gestionar_asignacion_radica')->name('funcionario-gestionar-asignacion-radica');

        });
    });
    //===================================================================================================
});

//Route::get('/', function () {return view('welcome');});

/*Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});*/
