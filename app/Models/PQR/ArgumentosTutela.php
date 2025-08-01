<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ArgumentosTutela extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'argumentos_tutela';
    protected $guarded = [];
   //----------------------------------------------------------------------------------
   public function tutela()
   {
       return $this->belongsTo(AutoAdmisorio::class, 'auto_admisorio_id', 'id');
   }
   //----------------------------------------------------------------------------------
}
