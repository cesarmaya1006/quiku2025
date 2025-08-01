<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RelacionHecho extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'relacion_respuesta_hechos';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tutela()
    {
        return $this->belongsTo(AutoAdmisorio::class, 'auto_admisorio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function hecho()
    {
        return $this->belongsTo(HechosTutela::class, 'hecho_tutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function respuesta()
    {
        return $this->belongsTo(RespuestaHechos::class, 'respuesta_hechos_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
