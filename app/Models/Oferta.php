<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    //
    protected $fillable = [
        'cargo',
        'descripcion',
        'estado',
        'fecha_inicio',
        'fecha_fin',
        'modalidad',
        'salario_minimo',
        'salario_maximo',
        'area_id',
        'reclutador_id',
    ];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function reclutador(){
        return $this->belongsTo(Reclutador::class);
    }

    public function candidatoOferta(){
        return $this->hasMany(CandidatoOferta::class);
    }

}
