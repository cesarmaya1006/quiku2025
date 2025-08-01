<?php

namespace App\Models\PQR;

use App\Models\Personas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UnidadNegocio extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'unidad_negocio';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tutelas()
    {
        return $this->hasMany(AutoAdmisorio::class, 'unidad_negocio_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
