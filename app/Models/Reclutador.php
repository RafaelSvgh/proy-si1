<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reclutador extends Model
{
    protected $fillable = [
        'departamento',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
