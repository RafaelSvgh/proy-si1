<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conocimiento extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
