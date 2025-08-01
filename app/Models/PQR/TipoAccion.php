<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoAccion extends Model
{
    use HasFactory, Notifiable;

    protected $table = "tipo_accion";
    protected $guarded = ['id'];
}
