<?php

namespace App\Models\PQR;

use App\Models\Personas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PretensionesTutela extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'pretensiones_tutela';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tutela()
    {
        return $this->belongsTo(AutoAdmisorio::class, 'auto_admisorio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function historialPretensiones()
    {
        return $this->hasMany(HistorialPretension::class, 'pretensiones_tutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function estadopretension()
    {
        return $this->belongsTo(AsignacionEstados::class, 'estado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function relacionesPretensiones()
    {
        return $this->hasMany(RelacionPretension::class, 'pretension_tutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
