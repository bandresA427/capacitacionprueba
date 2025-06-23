<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $fillable = ['titulo', 'imagen', 'preguntas', 'nivel'];

    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }
}