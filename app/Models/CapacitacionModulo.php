<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CapacitacionModulo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];//permitir guardar cualquier dato del user

    public function articulos()
    {
        return $this->hasMany(CapacitacionArticulo::class);
    }
   
}
