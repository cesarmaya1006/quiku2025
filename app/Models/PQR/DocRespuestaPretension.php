<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DocRespuestaPretension extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'docrespuesta_pretensiones';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function respuesta()
    {
        return $this->belongsTo(RespuestaPretensiones::class, 'respuesta_pretensiones_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
