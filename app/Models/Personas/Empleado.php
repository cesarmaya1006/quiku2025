<?php

namespace App\Models\Personas;

use App\Models\Admin\Tipo_Docu;
use App\Models\Empresa\Cargo;
use App\Models\Empresa\Empresa;
use App\Models\Empresa\Sede;
use App\Models\PQR\AutoAdmisorio;
use App\Models\PQR\HechosTutela;
use App\Models\PQR\HistorialAsignacion;
use App\Models\PQR\HistorialHecho;
use App\Models\PQR\HistorialPeticion;
use App\Models\PQR\HistorialPretension;
use App\Models\PQR\HistorialRespuestaHecho;
use App\Models\PQR\HistorialRespuestaImpugnacion;
use App\Models\PQR\HistorialRespuestaPretension;
use App\Models\PQR\HistorialTarea;
use App\Models\PQR\HistorialTareas;
use App\Models\PQR\ImpugnacionExterna;
use App\Models\PQR\ImpugnacionInterna;
use App\Models\PQR\ImpugnacionInternaHistorial;
use App\Models\PQR\Peticion;
use App\Models\PQR\PQR;
use App\Models\PQR\PqrAnexo;
use App\Models\PQR\PretensionesTutela;
use App\Models\PQR\RespuestaHechos;
use App\Models\PQR\RespuestaImpugnaciones;
use App\Models\PQR\RespuestaPretensiones;
use App\Models\PQR\Resuelve;
use App\Models\PQR\ResuelveRecurso;
use App\Models\PQR\ResuelveTutela;
use App\Models\PQR\SentenciaPHistorial;
use App\Models\PQR\TutelaRespuesta;
use App\Models\PQR\UnidadNegocio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Empleado extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'empleados';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tipos_docu()
    {
        return $this->belongsTo(Tipo_Docu::class, 'docutipos_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pqrs()
    {
        return $this->hasMany(PQR::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function peticiones()
    {
        return $this->hasMany(Peticion::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historial()
    {
        return $this->hasMany(HistorialAsignacion::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialTareas()
    {
        return $this->hasMany(HistorialTarea::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialTareasTutela()
    {
        return $this->hasMany(HistorialTareas::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialpeticiones()
    {
        return $this->hasMany(HistorialPeticion::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->hasOne(User::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pqranexos()
    {
        return $this->hasMany(PqrAnexo::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function resuelves()
    {
        return $this->hasMany(Resuelve::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function resuelvesTutela()
    {
        return $this->hasMany(ResuelveTutela::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function resuelvesrecurso()
    {
        return $this->hasMany(ResuelveRecurso::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tutelaregistro()
    {
        return $this->hasMany(AutoAdmisorio::class, 'empleado_rigistro_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function unidadNegocio()
    {
        return $this->hasMany(UnidadNegocio::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tutelaasignacion()
    {
        return $this->hasMany(AutoAdmisorio::class, 'empleado_asignado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function respuestasTutela()
    {
        return $this->hasMany(TutelaRespuesta::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function hechosTutela()
    {
        return $this->hasMany(HechosTutela::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pretensionesTutela()
    {
        return $this->hasMany(PretensionesTutela::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialHechosTutela()
    {
        return $this->hasMany(HistorialHecho::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function respuestaHechosTutela()
    {
        return $this->hasMany(RespuestaHechos::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialPretensionesTutela()
    {
        return $this->hasMany(HistorialPretension::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function respuestalPretensionesTutela()
    {
        return $this->hasMany(RespuestaPretensiones::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialRespuestaHechosTutela()
    {
        return $this->hasMany(HistorialRespuestaHecho::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialRespuestaPretensionesTutela()
    {
        return $this->hasMany(HistorialRespuestaPretension::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function impugnacionexterna()
    {
        return $this->hasMany(ImpugnacionExterna::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function sentenciaphistorial()
    {
        return $this->hasMany(SentenciaPHistorial::class, 'empleado_id', 'id');
    }


    //=========
    //----------------------------------------------------------------------------------
    public function historialimpugnacioninterna()
    {
        return $this->hasMany(ImpugnacionInternaHistorial::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialRespuestaImpugnacion()
    {
        return $this->hasMany(HistorialRespuestaImpugnacion::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function impugnacionInterna()
    {
        return $this->hasMany(ImpugnacionInterna::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function respuestasImpugnaciones()
    {
        return $this->hasMany(RespuestaImpugnaciones::class, 'empleado_id', 'id');
    }
}
