<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $fillable = ['pregunta', 'tipo', 'respuesta_correcta','respuesta_correcta-r','opciones','respuestas_correctas', 'opciones-m'];

    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
}