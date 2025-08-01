<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TipoPersona extends Model
{
    use HasFactory, Notifiable;

    protected $table = "tipo_persona";
    protected $guarded = ['id'];
}
