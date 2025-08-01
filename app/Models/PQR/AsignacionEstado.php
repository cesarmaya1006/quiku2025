<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AsignacionEstado extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'asignancion_estados';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function estados()
    {
       return $this->hasMany(AsignacionTarea::class, 'estado_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function estadospeticion()
    {
       return $this->hasMany(Peticion::class, 'estado_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
