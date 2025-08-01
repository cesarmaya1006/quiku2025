<?php

namespace App\Models\PQR;

use App\Models\Personas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ResuelveRecurso extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'resuelves_recurso';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function pqr()
    {
        return $this->belongsTo(PQR::class, 'pqr_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function numeracion()
    {
        return $this->belongsTo(Numeracion::class, 'orden', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tiporeposicion()
    {
        return $this->belongsTo(TipoReposicion::class, 'tipo_reposicion_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
