<?php

namespace App\Models\PQR;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class EmpleadoWikuargumento extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'empleado_wikuargumentos';
    protected $guarded = [];
    //----------------------------------------------------------------------------------
    public function argumento()
    {
        return $this->belongsTo(WikuArgumento::class, 'wikuargumento_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function temaEspecifico()
    {
        return $this->belongsTo(WikuTemaEspecifico::class, 'wikutemaespecifico_id', 'id');
    }
    //----------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------
    public function autorInst()
    {
        return $this->belongsTo(WikuAutorInst::class, 'wikuautorinstitu_id', 'id');
    }
    //----------------------------------------------------------------------------------
    public function autor()
    {
        return $this->belongsTo(WikuAutor::class, 'wikuautores_id', 'id');
    }
    //----------------------------------------------------------------------------------
}
