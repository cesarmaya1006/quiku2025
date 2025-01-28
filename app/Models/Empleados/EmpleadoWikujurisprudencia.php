<?php

namespace App\Models\Empleados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmpleadoWikujurisprudencia extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'empleado_wikujurisprudencias';
    protected $guarded = [];
}
