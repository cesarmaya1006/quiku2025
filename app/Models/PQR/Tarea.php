<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tarea extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tareas_tutela';
    protected $guarded = [];

    //----------------------------------------------------------------------------------
    public function tareas()
    {
        return $this->hasMany(AsignacionTarea::class, 'tareas_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tareashistorial()
    {
        return $this->hasMany(HistorialTareas::class, 'tareas_tutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function tareaTutelaRespuestas()
    {
        return $this->hasMany(TutelaRespuesta::class, 'tareas_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
