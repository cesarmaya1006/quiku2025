<?php

namespace App\Models\Parametros;

use App\Models\Empleados\Empleado;
use App\Models\PQR\AsignacionParticular;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sede extends Model
{
    use HasFactory, Notifiable;

    protected $table = "sedes";
    protected $guarded = ['id'];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'sede_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function departamentos()
    {
        return $this->belongsToMany(Departamento::class, 'area_influencia');
    }
    //----------------------------------------------------------------------------------
    public function cargos()
    {
        return $this->belongsToMany(Cargo::class, 'empleados');
    }
    //----------------------------------------------------------------------------------
    public function asignaciones()
    {
        return $this->hasMany(AsignacionParticular::class, 'sede_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
