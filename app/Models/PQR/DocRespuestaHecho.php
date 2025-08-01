<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DocRespuestaHecho extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'docrespuesta_hechos';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function respuesta()
    {
        return $this->belongsTo(RespuestaHechos::class, 'respuesta_hechos_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
