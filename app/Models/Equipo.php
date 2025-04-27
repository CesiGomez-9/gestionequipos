<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'logo', 'pais', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jugadores()
    {
        return $this->hasMany(Jugador::class);
    }
}

