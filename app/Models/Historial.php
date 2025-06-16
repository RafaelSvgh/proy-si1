<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $fillable = [
        'ciudad',
        'descripcion',
        'empresa',
        'puesto',
        'fecha_inicio',
        'fecha_fin',
        'pais',
        'modalidad',
        'candidato_id',
    ];

    public function candidato(){
        return $this->belongsTo(Candidato::class);
    }
}
