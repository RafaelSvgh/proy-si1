<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class CandidatoOferta extends Model
    {
        protected $fillable = [
            'estado',
            'fecha_postulacion',
            'oferta_id',
            'candidato_id',
        ];

        public function oferta(){
            return $this->belongsTo(Oferta::class);
        }

        public function candidato(){
            return $this->belongsTo(Candidato::class);
        }
    }
