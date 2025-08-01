<?php

namespace App\Models\Admin;

use App\Models\Personas\Empleado;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tipo_Docu extends Model
{
    use HasFactory, Notifiable;

    protected $table = "docutipos";
    protected $guarded = ['id'];
    //----------------------------------------------------------------------------------
    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'docutipos_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
