<?php

namespace App\Models\PQR;

use App\Models\Admin\Tipo_Docu;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Accions extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'accionante_accionado';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tutela()
    {
        return $this->belongsTo(AutoAdmisorio::class, 'auto_admisorio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipos_docu_accion()
    {
        return $this->belongsTo(Tipo_Docu::class, 'docutipos_id_accion', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipo_accion()
    {
        return $this->belongsTo(TipoAccion::class, 'tipo_accion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tipo_persona()
    {
        return $this->belongsTo(TipoPersona::class, 'tipo_accion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function impugnacionexterna()
    {
        return $this->belongsToMany(ImpugnacionExterna::class, 'impugnacion_externa_accion', 'accionante_accionado_id', 'impugnacion_externa_id');
    }
    //----------------------------------------------------------------------------------
}
