<?php

namespace App\Http\Controllers;


use App\Models\comportamiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class practicasComportamientoController extends Controller
{
    public function index()
    {
        $comportamiento = comportamiento::all();
        return view('practicas.index', compact('comportamiento'));
    }
    public function crearpractica()
    {
        return view('practicas.comportamiento.crear');
    }
    public function guardarpractica(Request $request)
    {

        $request->validate([
            'titulo' => 'required|string',

            'fecha' => 'required',
            'hora' => 'required',

        ]);

        $comportamiento = new comportamiento;
        $comportamiento->titulo = $request->input('titulo');
        $comportamiento->observacion = $request->input('observacion');
        $comportamiento->fecha = $request->input('fecha');
        $comportamiento->hora = $request->input('hora');
    
        $comportamiento->save();

        return redirect()->route('practicas.index');
        
    }
    public function editarpractica(comportamiento $comportamiento)
    {
        return view('practicas.comportamiento.editar', compact('comportamiento'));
    }
    public function guardarpracticaeditada(Request $request, comportamiento $comportamiento)
    {
        $request->validate([
            'titulo' => 'required',

            'fecha',
            'hora'
        ]);
        $comportamiento->id;
        $comportamiento->titulo = $request->titulo;
        $comportamiento->fecha = $request->fecha;
        $comportamiento->hora = $request->hora;
        $comportamiento->observacion = $request->observacion;
        $comportamiento->save();
        return redirect()->route('practicas.index')->with('success', 'actualizada la practica');
    }
    public function eliminarpractica(comportamiento $comportamiento)
    {
    $comportamiento->delete();

    return redirect()->route('practicas.index')->with('success', 'Eliminada la práctica');
    }

}
