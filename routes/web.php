<?php

use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Config\MenuController;
use App\Http\Controllers\Config\MenuRolController;
use App\Http\Controllers\Config\PermisoController;
use App\Http\Controllers\Config\PermisoRolController;
use App\Http\Controllers\Config\RolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Extranet\ExtranetPageController;
use App\Http\Controllers\Intranet\Email\EmailController;
use App\Http\Controllers\Funcionarios\FuncionarioController;
use App\Http\Controllers\Funcionarios\PQRController;
use App\Http\Controllers\Intranet\IntranetPageController;
use App\Http\Controllers\Usuarios\ClienteController;
use App\Http\Controllers\Parametros\AreaController;
use App\Http\Controllers\Parametros\CargoController;
use App\Http\Controllers\Parametros\MunicipioController;
use App\Http\Controllers\Parametros\NivelController;
use App\Http\Controllers\Parametros\SedeController;
use App\Http\Middleware\Administrador;
use App\Http\Middleware\AdminSistema;

Route::controller(ExtranetPageController::class)->group(function () {
    Route::get('/', 'index')->name('extranet.index');

    Route::get('/solicitar_password', [ExtranetPageController::class, 'solicitar_password'])->name('extranet.solicitar_password');
    Route::post('/cambiar_password', [ExtranetPageController::class, 'cambiar_password'])->name('extranet.cambiar_password');
    Route::get('/preguntas_frecuentes', [ExtranetPageController::class, 'preguntas_frecuentes'])->name('extranet.preguntas_frecuentes');
    Route::get('/index3', [ExtranetPageController::class, 'index_3'])->name('extranet.index_3');
    Route::get('/registro_ini', [ExtranetPageController::class, 'registro_ini'])->name('extranet.registro_ini');
    Route::post('/registro_ini-guardar', [ExtranetPageController::class, 'registro_ini_guardar'])->name('extranet.registro_ini-guardar');
    Route::get('/registro_ext/{id}/{cc}/{tipo}', [ExtranetPageController::class, 'registro_ext'])->name('extranet.registro_ext');
    Route::get('/registro_conf', [ExtranetPageController::class, 'registro_conf'])->name('extranet.registro_conf');
    Route::get('/parametros', [ExtranetPageController::class, 'parametros'])->name('extranet.parametros');
    Route::post('/parametros-guardar', [ExtranetPageController::class, 'parametros_guardar'])->name('extranet.parametros-guardar');
    Route::post('/registropj-guardar', [ExtranetPageController::class, 'registropj_guardar'])->name('extranet.registropj-guardar');
    Route::post('/registrorep-guardar', [ExtranetPageController::class, 'registrorep_guardar'])->name('extranet.registrorep-guardar');
    Route::post('/registropn-guardar', [ExtranetPageController::class, 'registropn_guardar'])->name('extranet.registropn-guardar');
    Route::get('/registro_pj', [ExtranetPageController::class, 'registro_pj'])->name('extranet.registro_pj');
    Route::get('/registro_rep/{id}', [ExtranetPageController::class, 'registro_rep'])->name('extranet.registro_rep');
    Route::get('/registro_pn', [ExtranetPageController::class, 'registro_pn'])->name('extranet.registro_pn');
    Route::get('/cargar_municipios', [ExtranetPageController::class, 'cargar_municipios'])->name('extranet.cargar_municipios');
    Route::get('/cargar_sedes', [ExtranetPageController::class, 'cargar_sedes'])->name('extranet.cargar_sedes');
    Route::post('/cargar_tipo_documentos', [ExtranetPageController::class, 'cargar_tipo_documentos'])->name('extranet.cargar_tipo_documentos');
    Route::get('/registro_final_pn', [ExtranetPageController::class, 'registro_final_pn'])->name('extranet.registro_final_pn');
    Route::get('/pruebamail', [ExtranetPageController::class, 'pruebamail'])->name('extranet.pruebamail');




    Route::get('/registro', 'registro')->name('extranet.registro');
    Route::get('/loginapp', 'loginapp')->name('extranet.loginapp');
    Route::post('/register', 'register')->name('extranet.store');
});


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [IntranetPageController::class, 'dashboard'])->name('dashboard');
    //------------------------------------------------------------------------------------------

    Route::get('/cargar_municipios', [ExtranetPageController::class, 'cargar_municipios'])->name('cargar_municipios');
    Route::get('/cargar_sedes', [ExtranetPageController::class, 'cargar_sedes'])->name('cargar_sedes');
    Route::post('/cargar_tipo_documentos', [ExtranetPageController::class, 'cargar_tipo_documentos'])->name('cargar_tipo_documentos');
    Route::get('/registro_final_pn', [ExtranetPageController::class, 'registro_final_pn'])->name('registro_final_pn');
    Route::get('/pruebamail', [ExtranetPageController::class, 'pruebamail'])->name('pruebamail');

    //--------------------------------------------------------------------------------------------------------------
    Route::prefix('configuracion_sis')->middleware(AdminSistema::class)->group(function () {
        Route::controller(MenuController::class)->prefix('menu')->group(function () {
            Route::get('', 'index')->name('menu.index');
            Route::get('crear', 'create')->name('menu.create');
            Route::get('editar/{id}', 'edit')->name('menu.edit');
            Route::post('guardar', 'store')->name('menu.store');
            Route::put('actualizar/{id}', 'update')->name('menu.update');
            Route::get('eliminar/{id}', 'destroy')->name('menu.destroy');
            Route::get('guardar-orden', 'guardarOrden')->name('menu.ordenar');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Roles
        Route::controller(RolController::class)->prefix('rol')->group(function () {
            Route::get('', 'index')->name('rol.index');
            Route::get('crear', 'create')->name('rol.create');
            Route::get('editar/{id}', 'edit')->name('rol.edit');
            Route::post('guardar', 'store')->name('rol.store');
            Route::put('actualizar/{id}', 'update')->name('rol.update');
            Route::delete('eliminar/{id}', 'destroy')->name('rol.destroy');
        });
        // ----------------------------------------------------------------------------------------
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(MenuRolController::class)->prefix('menu_rol')->group(function () {
            Route::get('', 'index')->name('menu.rol.index');
            Route::post('guardar', 'store')->name('menu.rol.store');
        });
        // ------------------------------------------------------------------------------------
        // Ruta Administrador del Permisos Roles
        Route::controller(PermisoController::class)->prefix('permiso_rutas')->group(function () {
            Route::get('', 'index')->name('permiso_rutas.index');
        });
        /* Ruta Administrador del Sistema Menu Rol*/
        Route::controller(PermisoRolController::class)->prefix('_permiso-rol')->group(function () {
            Route::get('', 'index')->name('permisos_rol.index');
            Route::post('guardar', 'store')->name('permisos_rol.store');
            Route::get('excepciones/{permission_id}/{role_id}', 'excepciones')->name('permisos_rol.excepciones');
            Route::post('guardar_excepciones', 'store_excepciones')->name('permisos_rol.store_excepciones');
        });
        // ----------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------
        // Ruta Administrador del Sistema Usuarios
        Route::controller(UsuarioController::class)->prefix('usuarios')->group(function () {
            Route::get('', 'index')->name('usuario.index');
            Route::get('crear', 'create')->name('usuario.create');
            Route::get('editar/{id}', 'edit')->name('usuario.edit');
            Route::post('guardar', 'store')->name('usuario.store');
            Route::put('actualizar/{id}', 'update')->name('usuario.update');
            Route::delete('eliminar/{id}', 'destroy')->name('usuario.destroy');
            Route::put('activar/{id}', 'activar')->name('usuario.activar');
            // *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--* *--*
        });
        // ----------------------------------------------------------------------------------------
        // ------------------------------------------------------------------------------------
    });
    //--------------------------------------------------------------------------------------------------------------
    Route::prefix('parametros')->middleware(Administrador::class)->group(function () {
        // ----------------------------------------------------------------------------------------
        // Ruta Municipios
        Route::controller(MunicipioController::class)->prefix('municipios')->group(function () {
            Route::get('getMunicipiosByDpto', 'getMunicipiosByDpto')->name('municipio.getMunicipiosByDpto');
        });
        // ----------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------
        // Ruta Sedes
        Route::controller(SedeController::class)->prefix('sedes')->group(function () {
            Route::get('getSedesByMunicipios', 'getSedesByMunicipios')->name('sede.getSedesByMunicipios');
        });
        // ----------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------
        // Ruta Sedes
        Route::controller(AreaController::class)->prefix('areas')->group(function () {});
        // ----------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------
        // Ruta Sedes
        Route::controller(NivelController::class)->prefix('niveles')->group(function () {
            Route::get('getNivelesByArea', 'getNivelesByArea')->name('nivel.getNivelesByArea');
        });
        // ----------------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------------
        // Ruta Sedes
        Route::controller(CargoController::class)->prefix('cargos')->group(function () {
            Route::get('getCargosByNivel', 'getCargosByNivel')->name('cargo.getCargosByNivel');
        });
        // ----------------------------------------------------------------------------------------
    });
    //--------------------------------------------------------------------------------------------------------------
    Route::prefix('usuario')->group(function () {
        Route::controller(ClienteController::class)->group(function () {
            Route::get('listado', 'index')->name('usuario-index');
            Route::get('generar', 'generar')->name('usuario-generar');
            Route::post('generar', 'direccion')->name('usuario-generar_direccion');
            //-------------------------------------------------------------------------------------------------
            Route::get('generarPQR/{id}', 'generarPQR')->name('usuario-generarPQR');
            Route::post('generarPQR', 'generarPQR_guardar')->name('usuario-generarPQR-guardar');
            Route::get('generarPQR-motivos/{id}', 'generarPQR_motivos')->name('usuario-generarPQR_motivos');
            Route::post('generarPQR-motivos', 'generarPQR_motivos_guardar')->name('usuario-generarPQR_motivos-guardar');
            Route::get('cargar_submotivos', 'cargar_submotivos')->name('cargar_submotivos');
            Route::get('cargar_productos', 'cargar_productos')->name('cargar_productos');
            Route::get('cargar_marcas', 'cargar_marcas')->name('cargar_marcas');
            Route::get('cargar_referencias', 'cargar_referencias')->name('cargar_referencias');
            //-------------------------------------------------------------------------------------------------
            Route::get('generarConceptoUOpinion', 'generarConceptoUOpinion')->name('usuario-generarConceptoUOpinion');
            Route::post('generarConceptoUOpinion', 'generarConceptoUOpinion_guardar')->name('usuario-generarConceptoUOpinion-guardar');
            Route::get('listado/gestionarConceptoUOpinion/{id}', 'gestionar_conceptoUOpinion')->name('usuario-gestionarConceptoUOpinion');
            //-------------------------------------------------------------------------------------------------
            Route::get('generarFelicitacion', 'generarFelicitacion')->name('usuario-generarFelicitacion');
            Route::post('generarFelicitacion', 'generarFelicitacion_guardar')->name('usuario-generarFelicitacion-guardar');
            Route::get('listado/gestionarFelicitaciones/{id}', 'gestionar_felicitaciones')->name('usuario-gestionarFelicitacion');
            //-------------------------------------------------------------------------------------------------
            Route::get('gererarDenuncia', 'gererarDenuncia')->name('usuario-gererarDenuncia');
            Route::post('gererarDenuncia', 'gererarDenuncia_guardar')->name('usuario-gererarDenuncia-guardar');
            Route::get('listado/gestionarReporte/{id}', 'gestionar_reporteDeIrregularidad')->name('usuario-gestionarReporte');
            //-------------------------------------------------------------------------------------------------
            Route::get('generarSolicitudDatos', 'generarSolicitudDatos')->name('usuario-generarSolicitudDatos');
            Route::post('generarSolicitudDatos', 'generarSolicitudDatos_guardar')->name('usuario-generarSolicitudDatos-guardar');
            Route::get('listado/gestionarSolicitudDatos/{id}', 'gestionar_solicitudDatos')->name('usuario-gestionarSolicitudDatos');
            //-------------------------------------------------------------------------------------------------
            Route::get('generarSolicitudDocumentos', 'generarSolicitudDocumentos')->name('usuario-generarSolicitudDocumentos');
            Route::post('generarSolicitudDocumentos', 'generarSolicitudDocumentos_guardar')->name('usuario-generarSolicitudDocumentos-guardar');
            Route::get('listado/gestionarSolicitudDocInfo/{id}', 'gestionar_solicitudDocInfo')->name('usuario-gestionarSolicitudDocInfo');
            //-------------------------------------------------------------------------------------------------
            Route::get('generarSugerencia', 'generarSugerencia')->name('usuario-generarSugerencia');
            Route::post('generarSugerencia', 'generarSugerencia_guardar')->name('usuario-generarSugerencia-guardar');
            Route::get('listado/gestionarSugerencia/{id}', 'gestionar_sugerencia')->name('usuario-gestionarsugerencia');
            //-------------------------------------------------------------------------------------------------
            Route::get('actualizar-datos', 'actualizar_datos')->name('usuario-actualizar_datos');
            Route::post('actualizar-datos', 'actualizar')->name('usuario-actualizar');
            //-------------------------------------------------------------------------------------------------
            Route::get('cambiar-password', 'cambiar_password')->name('usuario_cambiar_password');
            //-------------------------------------------------------------------------------------------------
            Route::get('crear-usuario', 'crear_usuario')->name('usuario_crear_usuario');
            //-------------------------------------------------------------------------------------------------
            Route::get('consulta-politicas', 'consulta_politicas')->name('usuario_consulta_politicas');
            //-------------------------------------------------------------------------------------------------
            Route::get('ayuda', 'ayuda')->name('usuario_ayuda');
            //-------------------------------------------------------------------------------------------------
            Route::get('download/{id_tipo_pqr}/{id_pqr}', 'download')->name('download');
            //-------------------------------------------------------------------------------------------------
            Route::get('listado/gestionarPQR/{id}', 'gestionar_PQR')->name('usuario-gestionarPQR');

        });
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        Route::controller(PQRController::class)->group(function () {
            Route::post('recurso', 'recurso_guardar')->name('recurso_guardar');
            Route::post('recurso_anexos', 'recurso_anexos_guardar')->name('recurso_anexos_guardar');
            Route::post('pqr_estado_recurso', 'pqr_estado_recurso_guardar')->name('pqr_estado_recurso_guardar');
            Route::post('aclaracion_usuario', 'aclaracion_usuario_guardar')->name('aclaracion_usuario_guardar');
            Route::post('aclaracion_anexos_usuario', 'aclaracion_anexos_usuario_guardar')->name('aclaracion_anexos_usuario_guardar');
            //-------------------------------------------------------------------------------------------------


        });

        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    });
    //--------------------------------------------------------------------------------------------------------------
    Route::controller(ClienteController::class)->group(function () {
        //-------------------------------------------------------------------------------------------------
        Route::get('download/{id_tipo_pqr}/{id_pqr}', 'download')->name('download');
        //-------------------------------------------------------------------------------------------------
    });
    //--------------------------------------------------------------------------------------------------------------
    Route::prefix('funcionario')->group(function(){
        Route::controller(PQRController::class)->group(function(){
            Route::get('gestion_pqr', 'gestion_pqr')->name('gestion_pqr');
            Route::post('asignacion', 'asignacion_guardar')->name('asignacion_guardar');
            Route::post('historial', 'historial_guardar')->name('historial_guardar');
        //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            Route::post('respuesta_recurso_guardar', 'respuesta_recurso_guardar')->name('respuesta_recurso_guardar');
            Route::post('respuesta_recurso_actualizar', 'respuesta_recurso_actualizar')->name('respuesta_recurso_actualizar');
            Route::post('respuesta_recurso_anexos', 'respuesta_recurso_anexos_guardar')->name('respuesta_recurso_anexos_guardar');
            Route::post('asignacion_asignador', 'asignacion_asignador_guardar')->name('asignacion_asignador_guardar');
            Route::post('historial', 'historial_guardar')->name('historial_guardar');
            Route::post('historial_tarea', 'historial_tarea_guardar')->name('historial_tarea_guardar');
            Route::post('historial_resuelve', 'historial_resuelve_guardar')->name('historial_resuelve_guardar');
            Route::post('historial_resuelve_recurso', 'historial_resuelve_recurso_guardar')->name('historial_resuelve_recurso_guardar');
            Route::post('historial_resuelve_eliminar', 'historial_resuelve_eliminar')->name('historial_resuelve_eliminar');
            Route::post('historial_resuelve_recurso_eliminar', 'historial_resuelve_recurso_eliminar')->name('historial_resuelve_recurso_eliminar');
            Route::post('historial_resuelve_editar', 'historial_resuelve_editar')->name('historial_resuelve_editar');
            Route::post('historial_resuelve_recurso_editar', 'historial_resuelve_recurso_editar')->name('historial_resuelve_recurso_editar');
            Route::post('resuelve_orden', 'resuelve_orden_guardar')->name('resuelve_orden_guardar');
            Route::post('resuelve_orden_recurso', 'resuelve_orden_recurso_guardar')->name('resuelve_orden_recurso_guardar');
            Route::post('historial_peticion', 'historial_peticion_guardar')->name('historial_peticion_guardar');
            Route::post('asignacion_tarea', 'asignacion_tarea_guardar')->name('asignacion_tarea_guardar');
            Route::post('asignacion_peticion', 'asignacion_peticion_guardar')->name('asignacion_peticion_guardar');
            Route::post('prioridad', 'prioridad_guardar')->name('prioridad_guardar');
            Route::post('estado', 'estado_guardar')->name('estado_guardar');
            Route::post('aclaracion', 'aclaracion_guardar')->name('aclaracion_guardar');
            Route::post('prorroga', 'prorroga_guardar')->name('prorroga_guardar');
            Route::post('respuesta', 'respuesta_guardar')->name('respuesta_guardar');
            Route::post('respuesta_anexo', 'respuesta_anexo_guardar')->name('respuesta_anexo_guardar');
            Route::post('plazo_recurso', 'plazo_recurso_guardar')->name('plazo_recurso_guardar');
            Route::get('cargar_tareas', 'cargar_tareas')->name('cargar_tareas');
            Route::get('cargar_cargos', 'cargar_cargos')->name('cargar_cargos');
            Route::get('cargar_funcionarios', 'cargar_funcionarios')->name('cargar_funcionarios');
            Route::post('pqr_anexo', 'pqr_anexo_guardar')->name('pqr_anexo_guardar');
            Route::get('respuestaPQR/{id}', 'respuestaPQR')->name('respuestaPQR');
            Route::get('respuestaPQRRecurso/{id}/{tipo_recurso}', 'respuestaPQRRecurso')->name('respuestaPQRRecurso');
            Route::get('descarga_respuestaPQR/{id}', 'descarga_respuestaPQR')->name('descarga_respuestaPQR');
            Route::get('usuario_descarga_respuestaPQR/{id}', 'usuario_descarga_respuestaPQR')->name('usuario_descarga_respuestaPQR');
            Route::post('cambiar_estado_tareas', 'cambiar_estado_tareas_guardar')->name('cambiar_estado_tareas_guardar');
            Route::get('cambiar-password-asistido/{id}', 'cambiar_password_asistido')->name('funcionario_cambiar_password_asistido');
        });
    });
    //--------------------------------------------------------------------------------------------------------------
    Route::prefix('admin')->group(function(){
        Route::controller(FuncionarioController::class)->group(function(){
            Route::get('gestion', 'gestion')->name('tutela-gestion');
            Route::get('index/gestionarAsignacion/{id}', 'gestionar_asignacion')->name('funcionario-gestionar-asignacion');
            Route::get('index/gestionarAsignacion/{id}', 'gestionar_asignacion')->name('funcionario-gestionar-asignacion');
            Route::get('index/gestionarAsignacionAsignador/{id}', 'gestionar_asignacion_asignador')->name('funcionario-gestionar-asignacion-asignador');
            Route::get('index/gestionarAsignacionSupervisa/{id}', 'gestionar_asignacion_supervisa')->name('funcionario-gestionar-asignacion-supervisa');
            Route::get('index/gestionarAsignacionProyecta/{id}', 'gestionar_asignacion_proyecta')->name('funcionario-gestionar-asignacion-proyecta');
            Route::get('index/gestionarAsignacionRevisa/{id}', 'gestionar_asignacion_revisa')->name('funcionario-gestionar-asignacion-revisa');
            Route::get('index/gestionarAsignacionAprueba/{id}', 'gestionar_asignacion_aprueba')->name('funcionario-gestionar-asignacion-aprueba');
            Route::get('index/gestionarAsignacionRevisaAprueba/{id}', 'gestionar_asignacion_revisa_aprueba')->name('funcionario-gestionar-asignacion-revisa-aprueba');
            Route::get('index/gestionarAsignacionRadica/{id}', 'gestionar_asignacion_radica')->name('funcionario-gestionar-asignacion-radica');
            Route::get('registro', 'registro')->name('funcionario-registro');
            Route::get('listado', 'listado')->name('tutela-listado');
            Route::get('gestion', 'gestion')->name('tutela-gestion');
            Route::get('gestionar_asignacion_tutela/{id}', 'gestionar_asignacion_tutela')->name('gestionar_asignacion_tutela');
        });

    });

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    //Descarga de pdf
    //Route::get('gestion_pqr', [EmailController::class, 'gestion_pqr'])->name('gestion_pqr');
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
});
