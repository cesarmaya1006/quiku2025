<?php

namespace App\Models\Empleados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmpleadoWikunorma extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'empleado_wikunormas';
    protected $guarded = [];
}
