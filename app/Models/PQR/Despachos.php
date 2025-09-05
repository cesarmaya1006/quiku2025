<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Despachos extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'despachos';
    protected $guarded = [];
}
