<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapacitacionArticulo extends Model
{
    protected $fillable = ['titulo', 'contenido', 'visto'];



    public function modulo()
    {
        return $this->belongsTo(CapacitacionModulo::class);
    }
    
}
