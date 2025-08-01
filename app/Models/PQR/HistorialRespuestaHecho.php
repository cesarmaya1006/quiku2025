<?php

namespace App\Models\PQR;

use App\Models\Personas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HistorialRespuestaHecho extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'historial_respuesta_hecho';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function respuesta()
    {
        return $this->belongsTo(RespuestaHechos::class, 'respuesta_hecho_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
