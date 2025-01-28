<?php

namespace App\Models\Personas;

use App\Models\Admin\Usuario;
use App\Models\Config\TipoDocumento;
use App\Models\Parametros\Municipio as ParametrosMunicipio;
use App\Models\Parametros\Pais as ParametrosPais;
use App\Models\PQR\PQR;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Persona extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'personas';
    protected $guarded = [];

    public function tipos_docu()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documentos_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function usuario()
    {
        return $this->hasOne(Usuario::class, 'id');
    }
    //----------------------------------------------------------------------------------
    public function pqrs()
    {
        return $this->hasMany(PQR::class, 'persona_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function pais()
    {
        return $this->belongsTo(ParametrosPais::class, 'pais_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function municipio()
    {
        return $this->belongsTo(ParametrosMunicipio::class, 'municipio_id', 'id');
    }
}
