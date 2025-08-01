<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Estados extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'estadostutela';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function tutelas()
    {
        return $this->hasMany(AutoAdmisorio::class, 'estadostutela_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
