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

    protected $fillablealt = [
        'pregunta',
        'opcion1',
        'opcion2',
        'opcion3',
        'opcion4',
        'respuesta_correcta',

        'pregunta2',
        'opcion1',
        'opcion2',
        'opcion3',
        'opcion4',
        'respuesta_correcta',

        'pregunta3',
        'opcion1',
        'opcion2',
        'opcion3',
        'opcion4',
        'respuesta_correcta',

        'pregunta4',
        'opcion1',
        'opcion2',
        'opcion3',
        'opcion4',
        'respuesta_correcta',

        'pregunta5',
        'opcion1',
        'opcion2',
        'opcion3',
        'opcion4',
        'respuesta_correcta',
    ];

}