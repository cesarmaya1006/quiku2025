<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RelacionPretension extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'relacion_respuesta_pretensiones';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tutela()
    {
        return $this->belongsTo(AutoAdmisorio::class, 'auto_admisorio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pretension()
    {
        return $this->belongsTo(PretensionesTutela::class, 'pretension_tutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function respuesta()
    {
        return $this->belongsTo(RespuestaPretensiones::class, 'respuesta_pretensiones_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
