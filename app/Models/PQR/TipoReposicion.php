<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoReposicion extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'tipo_reposicion';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'tipo_reposicion_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function recursosresuelve()
    {
        return $this->hasMany(ResuelveRecurso::class, 'tipo_reposicion_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
