<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable = [
        'direccion',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
