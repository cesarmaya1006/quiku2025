<?php

namespace App\Models\Tutela;

use App\Models\Config\TipoDocumento;
use App\Models\PQR\TipoPersona;
use App\Models\Tutela\TipoAccion;
use App\Models\Tutela\AutoAdmisorio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->belongsTo(TipoDocumento::class, 'tipo_documentos_id_accion', 'id');
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
