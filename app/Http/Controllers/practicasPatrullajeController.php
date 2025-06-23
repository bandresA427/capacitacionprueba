<?php

namespace App\Http\Controllers;

use App\Models\patrullaje;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class practicasPatrullajeController extends Controller
{

    public function crearpractica()
    {
        return view('practicas.patrullaje.crear');
    }
    public function guardarpractica(Request $request)
    {

        $request->validate([
            'titulo' => 'required|string',

            'fecha' => 'required',
            'hora' => 'required',

        ]);

        $patrullaje = new patrullaje;
        $patrullaje->titulo = $request->input('titulo');
        $patrullaje->observacion = $request->input('observacion');
        $patrullaje->fecha = $request->input('fecha');
        $patrullaje->hora = $request->input('hora');
    
        $patrullaje->save();

        return redirect()->route('practicas.index');
        
    }
    public function editarpractica(patrullaje $patrullaje)
    {
        return view('practicas.calidad.editar', compact('patrullaje'));
    }
    public function guardarpracticaeditada(Request $request, patrullaje $patrullaje)
    {
        $request->validate([
            'titulo' => 'required',
    
            'fecha',
            'hora'
        ]);
        $patrullaje->id;
        $patrullaje->titulo = $request->titulo;
        $patrullaje->fecha = $request->fecha;
        $patrullaje->hora = $request->hora;
        $patrullaje->observacion = $request->observacion;
        $patrullaje->save();
        return redirect()->route('practicas.index')->with('success', 'actualizada la practica');
    }
    public function eliminarpractica(patrullaje $patrullaje)
{
    $patrullaje->delete();

    return redirect()->route('practicas.index')->with('success', 'Eliminada la práctica');
}

}
