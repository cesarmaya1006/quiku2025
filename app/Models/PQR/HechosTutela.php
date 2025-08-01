<?php

namespace App\Models\PQR;

use App\Models\Personas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HechosTutela extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'hechos_tutela';
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
    public function historialHechos()
    {
        return $this->hasMany(HistorialHecho::class, 'hechos_tutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function estadohecho()
    {
        return $this->belongsTo(AsignacionEstados::class, 'estado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function relacionesHechos()
    {
        return $this->hasMany(RelacionHecho::class, 'hecho_tutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
