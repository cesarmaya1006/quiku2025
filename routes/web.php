<?php

use App\Http\Controllers\Cliente\ClienteController;
use App\Http\Controllers\Config\ExtraPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Extranet\ExtranetController;
use App\Http\Controllers\Intranet\Admin\IntranetPageController;
use App\Http\Controllers\Intranet\Admin\UsuarioController;
use App\Http\Controllers\Intranet\PQR\AsignacionParticularController;
use App\Http\Controllers\Intranet\PQR\FuncionarioController;
use App\Http\Controllers\Intranet\PQR\TutelaController;
use App\Http\Controllers\Intranet\PQR\WikuController;
use App\Http\Controllers\Intranet\PQR\WikuEmpleadoController;
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
            Route::post('prioridad', 'prioridad_guardar')->name('prioridad_guardar');
            Route::post('prorroga', 'prorroga_guardar')->name('prorroga_guardar');
            Route::post('estado', 'estado_guardar')->name('estado_guardar');
            Route::post('historial_peticion', 'historial_peticion_guardar')->name('historial_peticion_guardar');
            Route::post('asignacion_peticion', 'asignacion_peticion_guardar')->name('asignacion_peticion_guardar');
            Route::get('index/gestionarAsignacionColaboracion/{id}', 'gestionar_asignacion_colaboracion')->name('funcionario-gestionar-asignacion-colaboracion');
            Route::get('index/gestionarAsignacionColaboracion_wiku/{id}', 'gestionar_asignacion_colaboracion_wiku')->name('funcionario-gestionar-asignacion-colaboracion_wiku');
            Route::post('aclaracion', 'aclaracion_guardar')->name('aclaracion_guardar');
            Route::post('respuesta', 'respuesta_guardar')->name('respuesta_guardar');
            Route::post('respuesta_anexo', 'respuesta_anexo_guardar')->name('respuesta_anexo_guardar');
            Route::get('respuestaPQR/{id}', 'respuestaPQR')->name('respuestaPQR');
            Route::get('respuestaPQRRecurso/{id}/{tipo_recurso}', 'respuestaPQRRecurso')->name('respuestaPQRRecurso');
            Route::get('descarga_respuestaPQR/{id}', 'descarga_respuestaPQR')->name('descarga_respuestaPQR');
            Route::get('usuario_descarga_respuestaPQR/{id}', 'usuario_descarga_respuestaPQR')->name('usuario_descarga_respuestaPQR');
            Route::post('pqr_anexo', 'pqr_anexo_guardar')->name('pqr_anexo_guardar');
            Route::post('cambiar_estado_tareas',  'cambiar_estado_tareas_guardar')->name('cambiar_estado_tareas_guardar');
            Route::post('historial_resuelve', 'historial_resuelve_guardar')->name('historial_resuelve_guardar');
            Route::post('historial_resuelve_eliminar', 'historial_resuelve_eliminar')->name('historial_resuelve_eliminar');
            Route::post('resuelve_orden', 'resuelve_orden_guardar')->name('resuelve_orden_guardar');
            Route::post('historial_resuelve_editar', 'historial_resuelve_editar')->name('historial_resuelve_editar');
            Route::post('plazo_recurso', 'plazo_recurso_guardar')->name('plazo_recurso_guardar');
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
        // ----------------------------------------------------------------------------------------
        Route::controller(WikuController::class)->group(function () {
            //Wiku
            Route::get('wiku-index', 'indexWiku')->name('wiku_funcionario-index');
            Route::get('wiku-busqueda_inicial', 'WikuBusquedaInicial')->name('wiku_busqueda_inicial');
            Route::get('wiku-busqueda_basica', 'WikuBusquedaBasica')->name('wiku_busqueda_basica');
            Route::get('wiku-busqueda_avanzadaa', 'WikuBusquedaAvanzada')->name('wiku_busqueda_avanzada');

            Route::get('cargar_normas', 'cargar_normas')->name('cargar_normas');
            Route::get('cargar_salas', 'cargar_salas')->name('cargar_salas');
            Route::get('cargar_subsalas', 'cargar_subsalas')->name('cargar_subsalas');
            //----------------------------------------------------------------------------------------------------
            Route::get('wiku-normas/index', 'indexWikuNormas')->name('wiku_funcionario_norma_index');
            //Doctrinas
            Route::get('wiku_doctrina/crear', 'crear_doctrina')->name('wiku_doctrina-crear');
            Route::post('wiku_doctrina-guardar', 'guardar_doctrina')->name('wiku_doctrina-guardar');
            Route::get('wiku_doctrina/editar/{id}', 'editar_doctrina')->name('wiku_doctrina-editar');
            Route::put('wiku_doctrina-actualizar/{id}', 'actualizar_doctrina')->name('wiku_doctrina-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_doccriterios/index/{id}/{wiku}', 'index_doccriterios')->name('wiku_doccriterios-index');
            Route::get('wiku_doccriterios/crear/{id}/{wiku}', 'crear_doccriterios')->name('wiku_doccriterios-crear');
            Route::post('wiku_doccriterios-guardar/{id}/{wiku}', 'guardar_doccriterios')->name('wiku_doccriterios-guardar');
            Route::get('wiku_doccriterios/editar/{id_criterios}/{id}/{wiku}', 'editar_doccriterios')->name('wiku_doccriterios-editar');
            Route::put('wiku_doccriterios-actualizar/{id_criterios}/{id}/{wiku}', 'actualizar_doccriterios')->name('wiku_doccriterios-actualizar');
            Route::delete('wiku_doccriterios/{id}', 'wiku_doccriterios_eliminar')->name('wiku_doccriterios-eliminar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku/docasociacion/crear/{id}/{wiku}', 'crear_docasociacion')->name('wiku_docasociacion-crear');
            Route::post('wiku/docasociacion-guardar/{id}/{wiku}', 'guardar_docasociacion')->name('wiku_docasociacion-guardar');
            Route::delete('wiku_docasociacion/{id}', 'wiku_docasociacion_eliminar')->name('wiku_docasociacion-eliminar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            //Jurisprudencia
            Route::get('wiku_jurisprudencia/crear', 'crear_jurisprudencia')->name('wiku_jurisprudencia-crear');
            Route::post('wiku_jurisprudencia-guardar', 'guardar_jurisprudencia')->name('wiku_jurisprudencia-guardar');
            Route::get('wiku_jurisprudencia/editar/{id}', 'editar_jurisprudencia')->name('wiku_jurisprudencia-editar');
            Route::put('wiku_jurisprudencia-actualizar/{id}', 'actualizar_jurisprudencia')->name('wiku_jurisprudencia-actualizar');

            // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
            Route::get('wikucargarsalas', 'cargarSalas')->name('wiku-cargarsalas');
            Route::get('wikucargarsubsalas', 'cargarsubsalas')->name('wiku-cargarsubsalas');
            Route::get('wiku_jurisprudencia-cargarente', 'cargarente')->name('wiku_jurisprudencia-cargarente');
            Route::get('wiku_jurisprudencia-cargarsala', 'crearSala')->name('wiku_jurisprudencia-cargarsala');
            Route::get('wiku_jurisprudencia-cargarsubsala', 'crearSubSala')->name('wiku_jurisprudencia-cargarsubsala');
            Route::get('wiku_jurisprudencia-crearmagistrado', 'crearMagistrado')->name('wiku_jurisprudencia-crearmagistrado');
            Route::get('wiku_jurisprudencia-creardemandante', 'crearDemandante')->name('wiku_jurisprudencia-creardemandante');
            Route::get('wiku_jurisprudencia-creardemandado', 'crearDemandado')->name('wiku_jurisprudencia-creardemandado');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku/jurasociacion/crear/{id}/{wiku}', 'crear_jurasociacion')->name('wiku_jurasociacion-crear');
            Route::post('wiku/jurasociacion-guardar/{id}/{wiku}', 'guardar_jurasociacion')->name('wiku_jurasociacion-guardar');
            Route::delete('wiku_jurasociacion/{id}', 'wiku_jurasociacion_eliminar')->name('wiku_jurasociacion-eliminar');
            // ------------------------------------------------------------------------------------
            // ------------------------------------------------------------------------------------
            Route::get('wiku/index', 'index')->name('wiku-index');
            Route::get('wiku/ver', 'ver')->name('wiku-ver');
            Route::get('wikucargarargumentos', 'cargarArgumentos')->name('wiku-cargarargumentos');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_argumento/crear', 'crear_argumento')->name('wiku_argumento-crear');
            Route::post('wiku_argumento-guardar', 'guardar_argumento')->name('wiku_argumento-guardar');
            Route::get('wiku_argumento/editar/{id}', 'editar_argumento')->name('wiku_argumento-editar');
            Route::put('wiku_argumento-actualizar/{id}', 'actualizar_argumento')->name('wiku_argumento-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_argcriterios/index/{id}/{wiku}', 'index_argcriterios')->name('wiku_argcriterios-index');
            Route::get('wiku_argcriterios/crear/{id}/{wiku}', 'crear_argcriterios')->name('wiku_argcriterios-crear');
            Route::post('wiku_argcriterios-guardar/{id}/{wiku}', 'guardar_argcriterios')->name('wiku_argcriterios-guardar');
            Route::get('wiku_argcriterios/editar/{id_criterios}/{id}/{wiku}', 'editar_argcriterios')->name('wiku_argcriterios-editar');
            Route::put('wiku_argcriterios-actualizar/{id_criterios}/{id}/{wiku}', 'actualizar_argcriterios')->name('wiku_argcriterios-actualizar');
            Route::delete('wiku_argcriterios/{id}', 'wiku_argcriterios_eliminar')->name('wiku_argcriterios-eliminar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_argumento-cargarautori', 'cargarautori')->name('wiku_argumento-cargarautori');
            Route::get('wiku_argumento-cargarautor', 'cargarautor')->name('wiku_argumento-cargarautor');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku/argasociacion/crear/{id}/{wiku}', 'crear_argasociacion')->name('wiku_argasociacion-crear');
            Route::post('wiku/argasociacion-guardar/{id}/{wiku}', 'guardar_argasociacion')->name('wiku_argasociacion-guardar');
            Route::delete('wiku_argasociacion/{id}', 'wiku_argasociacion_eliminar')->name('wiku_argasociacion-eliminar');
            //=====================================================================================================================
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .. . . . . . . . . . . . . . . . .
            Route::get('wiku_norma/crear', 'crear_norma')->name('wiku_norma-crear');
            Route::post('wiku_norma-guardar', 'guardar_norma')->name('wiku_norma-guardar');
            Route::get('wiku_norma/editar/{id}', 'editar_norma')->name('wiku_norma-editar');
            Route::put('wiku_norma-actualizar/{id}', 'actualizar_norma')->name('wiku_norma-actualizar');
            Route::get('cargar_temasespec', 'cargar_temasespec')->name('cargar_temasespec');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_temaespecifico/{id}/{wiku}', 'volver_temaespecifico')->name('wiku_volver_temaespecifico');
            Route::get('wiku_temaespecifico/index/{id}/{wiku}', 'index_temaespecifico')->name('wiku_temaespecifico-index');
            Route::get('wiku_temaespecifico/crear/{id}/{wiku}', 'crear_temaespecifico')->name('wiku_temaespecifico-crear');
            Route::post('wiku_temaespecifico-guardar/{id}/{wiku}', 'guardar_temaespecifico')->name('wiku_temaespecifico-guardar');
            Route::get('wiku_temaespecifico/editar/{id_especifico}/{id}/{wiku}', 'editar_temaespecifico')->name('wiku_temaespecifico-editar');
            Route::put('wiku_temaespecifico-actualizar/{id_especifico}/{id}/{wiku}', 'actualizar_temaespecifico')->name('wiku_temaespecifico-actualizar');
            Route::get('cargar_temas', 'cargar_temas')->name('cargar_temas');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_tema/{id}/{wiku}', 'volver_tema')->name('wiku_volver_tema');
            Route::get('wiku_tema/index/{id}/{wiku}', 'index_tema')->name('wiku_tema-index');
            Route::get('wiku_tema/crear/{id}/{wiku}', 'crear_tema')->name('wiku_tema-crear');
            Route::post('wiku_tema-guardar/{id}/{wiku}', 'guardar_tema')->name('wiku_tema-guardar');
            Route::get('wiku_tema/editar/{id_tema}/{id}/{wiku}', 'editar_tema')->name('wiku_tema-editar');
            Route::put('wiku_tema-actualizar/{id_tema}/{id}/{wiku}', 'actualizar_tema')->name('wiku_tema-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_area/{id}/{wiku}', 'volver_area')->name('wiku_volver_area');
            Route::get('wiku_area/index/{id}/{wiku}', 'index_area')->name('wiku_area-index');
            Route::get('wiku_area/crear/{id}/{wiku}', 'crear_area')->name('wiku_area-crear');
            Route::post('wiku_area-guardar/{id}/{wiku}', 'guardar_area')->name('wiku_area-guardar');
            Route::get('wiku_area/editar/{id_area}/{id}/{wiku}', 'editar_area')->name('wiku_area-editar');
            Route::put('wiku_area-actualizar/{id_area}/{id}/{wiku}', 'actualizar_area')->name('wiku_area-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_criterios/{id}/{wiku}', 'wiku_volver_criterios')->name('wiku_volver_criterios');
            Route::get('wiku_criterios/index/{id}/{wiku}', 'index_criterios')->name('wiku_criterios-index');
            Route::get('wiku_criterios/crear/{id}/{wiku}', 'crear_criterios')->name('wiku_criterios-crear');
            Route::post('wiku_criterios-guardar/{id}/{wiku}', 'guardar_criterios')->name('wiku_criterios-guardar');
            Route::get('wiku_criterios/editar/{id_criterios}/{id}/{wiku}', 'editar_criterios')->name('wiku_criterios-editar');
            Route::put('wiku_criterios-actualizar/{id_criterios}/{id}/{wiku}', 'actualizar_criterios')->name('wiku_criterios-actualizar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_palabras/{id}/{wiku}', 'wiku_volver_palabras')->name('wiku_volver_palabras');
            Route::get('wiku_palabras/index/{id}/{wiku}', 'index_palabras')->name('wiku_palabras-index');
            Route::get('wiku_palabras/crear/{id}/{wiku}', 'crear_palabras')->name('wiku_palabras-crear');
            Route::post('wiku_palabras-guardar/{id}/{wiku}', 'guardar_palabras')->name('wiku_palabras-guardar');
            Route::get('wiku_palabras/editar/{id_palabras}/{id}/{wiku}', 'editar_palabras')->name('wiku_palabras-editar');
            Route::put('wiku_palabras-actualizar/{id_palabras}/{id}/{wiku}', 'actualizar_palabras')->name('wiku_palabras-actualizar');
            Route::delete('wiku_palabras/{id}', 'wiku_palabras_eliminar')->name('wiku_palabras-eliminar');
            Route::post('wiku_palabras/adicionar/{id_palabras}/{id}/{wiku}', 'adicionar_palabras')->name('wiku_palabras-adicionar');
            Route::post('wiku_palabras/restar/{id_palabras}/{id}/{wiku}', 'restar_palabras')->name('wiku_palabras-restar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku/index_fuenteN', 'index_fuenteN')->name('wiku-index_fuenteN');
            Route::get('wiku_fuente/crear', 'crear_fuente')->name('wiku_fuenteN-crear');
            Route::post('wiku_fuente-guardar', 'guardar_fuenteN')->name('wiku_fuenteN-guardar');
            //. . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .
            Route::get('wiku_volver_asociacion/{id}/{wiku}', 'wiku_volver_asociacion')->name('wiku_volver_asociacion');
            Route::get('wiku/asociacion/crear/{id}/{wiku}', 'crear_asociacion')->name('wiku_asociacion-crear');
            Route::post('wiku/asociacion-guardar/{id}/{wiku}', 'guardar_asociacion')->name('wiku_asociacion-guardar');
            Route::delete('wiku_asociacion/{id}', 'wiku_asociacion_eliminar')->name('wiku_asociacion-eliminar');
        });
        // ----------------------------------------------------------------------------------------
        Route::controller(AsignacionParticularController::class)->group(function () {
            // ------------------------------------------------------------------------------------
            // Rutas Asignacion particular
            Route::get('asignacion_particular-index', 'index')->name('admin-funcionario-asignacion_particular-index');
            Route::get('asignacion_particular-crear', 'crear')->name('admin-funcionario-asignacion_particular-crear');
            Route::post('asignacion_particular', 'guardar')->name('admin-funcionario-asignacion_particular-guardar');
            // .-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-.-
            Route::get('asignacion_particular-cargar_motivo', 'cargar_motivo')->name('admin-funcionario-asignacion_particular-cargar_motivo');
            Route::get('asignacion_particular-cargar_sub_motivo', 'cargar_sub_motivo')->name('admin-funcionario-asignacion_particular-cargar_sub_motivo');
            Route::get('asignacion_particular-cargar_producto', 'cargar_producto')->name('admin-funcionario-asignacion_particular-cargar_producto');
            Route::get('asignacion_particular-cargar_marca', 'cargar_marca')->name('admin-funcionario-asignacion_particular-cargar_marca');
            Route::get('asignacion_particular-cargar_referencia', 'cargar_referencia')->name('admin-funcionario-asignacion_particular-cargar_referencia');
            Route::get('asignacion_particular-cargar_municipio', 'cargar_municipio')->name('admin-funcionario-asignacion_particular-cargar_municipio');
            Route::get('asignacion_particular-cargar_sede', 'cargar_sede')->name('admin-funcionario-asignacion_particular-cargar_sede');
            Route::get('asignacion_particular-cargar_cargo', 'cargar_cargo')->name('admin-funcionario-asignacion_particular-cargar_cargo');

            // ------------------------------------------------------------------------------------
        });
        // ----------------------------------------------------------------------------------------
        Route::controller(WikuEmpleadoController::class)->group(function () {
            Route::get('gest_wiku_empleado/{id}', 'index')->name('gest_wiku_empleado');
            // ------------------------------------------------------------------------------------
        });
        // ----------------------------------------------------------------------------------------
        Route::controller(TutelaController::class)->group(function () {
            Route::get('listado/tutela/{id}', 'vista_tutela')->name('vista_tutela');
            Route::post('historial', 'historial_tutela_guardar')->name('historial_tutela_guardar');
            Route::post('asignacion', 'asignacion_tutela_guardar')->name('asignacion_tutela_guardar');
            Route::post('historial_tarea_tutela', 'historial_tarea_tutela_guardar')->name('historial_tarea_tutela_guardar');
            Route::get('gestionarAsignacionSupervisaTutela/{id}', 'gestionar_asignacion_supervisa_tutela')->name('gestionar_asignacion_supervisa_tutela');
            Route::get('gestionarAsignacionProyectaTutela/{id}', 'gestionar_asignacion_proyecta_tutela')->name('gestionar_asignacion_proyecta_tutela');
            Route::get('gestionarAsignacionRevisaApruebaTutela/{id}', 'gestionar_asignacion_revisa_aprueba_tutela')->name('gestionar_asignacion_revisa_aprueba_tutela');
            Route::get('gestionarAsignacionRadicaTutela/{id}', 'gestionar_asignacion_radica_tutela')->name('gestionar_asignacion_radica_tutela');
            Route::post('prioridad_tutela_guardar', 'prioridad_tutela_guardar')->name('prioridad_tutela_guardar');
            Route::post('estado_hecho', 'estado_hecho_guardar')->name('estado_hecho_guardar');
            Route::post('estado_pretension', 'estado_pretension_guardar')->name('estado_pretension_guardar');
            Route::post('estado_resuelve', 'estado_resuelve_guardar')->name('estado_resuelve_guardar');
            Route::post('asignacion_hecho', 'asignacion_hecho_guardar')->name('asignacion_hecho_guardar');
            Route::post('asignacion_pretension', 'asignacion_pretension_guardar')->name('asignacion_pretension_guardar');
            Route::post('asignacion_impugnacion', 'asignacion_impugnacion_guardar')->name('asignacion_impugnacion_guardar');

            Route::post('asignacion_resuelve', 'asignacion_resuelve_guardar')->name('asignacion_resuelve_guardar');
            Route::post('historial_hecho', 'historial_hecho_guardar')->name('historial_hecho_guardar');
            Route::post('historial_respuesta_hecho', 'historial_respuesta_hecho_guardar')->name('historial_respuesta_hecho_guardar');
            Route::post('historial_pretension', 'historial_pretension_guardar')->name('historial_pretension_guardar');
            Route::post('historial_respuesta_pretension', 'historial_respuesta_pretension_guardar')->name('historial_respuesta_pretension_guardar');
            Route::post('historial_respuesta_resuelve', 'historial_respuesta_resuelve_guardar')->name('historial_respuesta_resuelve_guardar');
            Route::get('gestionar_tutela/{id}', 'gestionar_tutela')->name('gestionar_tutela');
            Route::post('respuesta_pretension', 'respuesta_pretension_guardar')->name('respuesta_pretension_guardar');
            Route::post('respuesta_resuelve', 'respuesta_resuelve_guardar')->name('respuesta_resuelve_guardar');
            Route::post('respuesta_pretension_editar', 'respuesta_pretension_editar_guardar')->name('respuesta_pretension_editar_guardar');
            Route::post('respuesta_resuelve_editar', 'respuesta_resuelve_editar_guardar')->name('respuesta_resuelve_editar_guardar');
            Route::post('respuesta_hecho', 'respuesta_hecho_guardar')->name('respuesta_hecho_guardar');
            Route::post('respuesta_hecho_editar', 'respuesta_hecho_editar_guardar')->name('respuesta_hecho_editar_guardar');
            Route::post('respuesta_pretension_anexo', 'respuesta_pretension_anexo_guardar')->name('respuesta_pretension_anexo_guardar');
            Route::post('respuesta_resuelve_anexo', 'respuesta_resuelve_anexo_guardar')->name('respuesta_resuelve_anexo_guardar');
            Route::post('respuesta_hecho_anexo', 'respuesta_hecho_anexo_guardar')->name('respuesta_hecho_anexo_guardar');
            Route::post('relacion_respuesta_pretension', 'relacion_respuesta_pretension_guardar')->name('relacion_respuesta_pretension_guardar');
            Route::post('relacion_respuesta_resuelve', 'relacion_respuesta_resuelve_guardar')->name('relacion_respuesta_resuelve_guardar');
            Route::post('relacion_respuesta_hecho', 'relacion_respuesta_hecho_guardar')->name('relacion_respuesta_hecho_guardar');
            Route::post('estado_respuesta_pretension', 'estado_respuesta_pretension_guardar')->name('estado_respuesta_pretension_guardar');
            Route::post('estado_respuesta_resuelve', 'estado_respuesta_resuelve_guardar')->name('estado_respuesta_resuelve_guardar');
            Route::post('estado_respuesta_hecho', 'estado_respuesta_hecho_guardar')->name('estado_respuesta_hecho_guardar');
            Route::post('eliminar_respuesta_hecho', 'eliminar_respuesta_hecho_guardar')->name('eliminar_respuesta_hecho_guardar');
            Route::post('eliminar_respuesta_pretension', 'eliminar_respuesta_pretension_guardar')->name('eliminar_respuesta_pretension_guardar');
            Route::post('eliminar_respuesta_resuelve', 'eliminar_respuesta_resuelve_guardar')->name('eliminar_respuesta_resuelve_guardar');
            Route::get('respuestaTutela/{id}', 'respuesta_tutela')->name('respuesta_tutela');
            Route::get('respuestaSentenciaPrimeraInstancia/{id}', 'respuesta_sentencia_primera_instancia')->name('respuesta_sentencia_primera_instancia');
            Route::post('historial_resuelve_tutela', 'historial_resuelve_tutela_guardar')->name('historial_resuelve_tutela_guardar');
            Route::post('historial_resuelve_tutela_eliminar', 'historial_resuelve_tutela_eliminar')->name('historial_resuelve_tutela_eliminar');
            Route::post('resuelve_orden_tutela', 'resuelve_orden_tutela_guardar')->name('resuelve_orden_tutela_guardar');
            Route::post('tutela_respuesta_guardar', 'tutela_respuesta_guardar')->name('tutela_respuesta_guardar');
            Route::post('historial_resuelve_tutela_editar', 'historial_resuelve_tutela_editar')->name('historial_resuelve_tutela_editar');
            Route::post('cambiar_estado_tutela_tareas', 'cambiar_estado_tareas_tutela_guardar')->name('cambiar_estado_tareas_tutela_guardar');
            Route::get('descarga_respuesta_tutela/{id}', 'descarga_respuesta_tutela')->name('descarga_respuesta_tutela');
            Route::post('cambiosentidoresuelve/{id}', 'cambiosentidoresuelve')->name('cambiosentidoresuelve');
            Route::post('crearimpugnacion/{id}', 'crearimpugnacion')->name('crearimpugnacion');
            Route::post('verificar_sentencia_primera_instancia/{id}', 'verificar_sentencia_primera_instancia')->name('verificar_sentencia_primera_instancia');

            Route::get('/cargar_nombre_despachos', 'cargar_nombre_despachos')->name('cargar_nombre_despachos');
            Route::get('/cargar_ubicacion_despachos', 'cargar_ubicacion_despachos')->name('cargar_ubicacion_despachos');
            Route::post('crear_auto_admisorio', 'crear_auto_admisorio')->name('crear_auto_admisorio');
            Route::post('update_auto_admisorio', 'update_auto_admisorio')->name('update_auto_admisorio');
            Route::post('update_tutela', 'update_tutela')->name('update_tutela');
            Route::post('crear_accion', 'crear_accion')->name('crear_accion');
            Route::post('crear_motivos_tutela', 'crear_motivos_tutela')->name('crear_motivos_tutela');
            Route::post('crear_anexo_tutela', 'crear_anexo_tutela')->name('crear_anexo_tutela');
            Route::get('auto_admisorio_complemento/{id}', 'auto_admisorio_complemento')->name('auto_admisorio_complemento');
            Route::post('crear_hechos_tutela', 'crear_hechos_tutela')->name('crear_hechos_tutela');
            Route::post('crear_pretensiones_tutela', 'crear_pretensiones_tutela')->name('crear_pretensiones_tutela');
            Route::post('crear_argumentos_tutela', 'crear_argumentos_tutela')->name('crear_argumentos_tutela');
            Route::post('crear_pruebas_tutela', 'crear_pruebas_tutela')->name('crear_pruebas_tutela');
            Route::post('asignacion_tarea_tutela', 'asignacion_tarea_tutela_guardar')->name('asignacion_tarea_tutela_guardar');
        });
    });
    //===================================================================================================
});

//Route::get('/', function () {return view('welcome');});

/*Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});*/
