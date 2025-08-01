<?php

namespace App\Models\PQR;

use App\Models\Config\Municipio;
use App\Models\Empresa\Empresa;
use App\Models\Empresa\Sede;
use App\Models\Personas\Empleado;
use App\Models\Personas\Persona;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PQR extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'pqr';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'servicio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function referencia()
    {
        return $this->belongsTo(Referencia::class, 'referencia_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function peticiones()
    {
        return $this->hasMany(Peticion::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipoPqr()
    {
        return $this->belongsTo(tipoPQR::class, 'tipo_pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estadospqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function prioridad()
    {
        return $this->belongsTo(Prioridad::class, 'prioridad_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialasignacion()
    {
        return $this->hasMany(HistorialAsignacion::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialtareas()
    {
        return $this->hasMany(HistorialTarea::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialpeticiones()
    {
        return $this->hasMany(HistorialPeticion::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function asignaciontareas()
    {
        return $this->hasMany(AsignacionTarea::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function anexos()
    {
        return $this->hasMany(PqrAnexo::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function resuelves()
    {
        return $this->hasMany(Resuelve::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function resuelvesrecursos()
    {
        return $this->hasMany(ResuelveRecurso::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
