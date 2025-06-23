<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluacion_id',
        'usuario_id',
        'pregunta_id',
        'respuesta',
        'correcta',
    ];
    
    public function evaluacion()
    {
        return $this->belongsTo(Evaluacion::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
