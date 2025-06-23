<?php

namespace App\Http\Controllers;


use App\Models\calidad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class practicasCalidadController extends Controller
{
    public function index()
    {
        $calidad = calidad::all();
        return view('practicas.index', compact('calidad'));
    }
    public function crearpractica()
    {
        return view('practicas.calidad.crear');
    }
    public function guardarpractica(Request $request)
    {

        $request->validate([
            'titulo' => 'required|string',

            'fecha' => 'required',
            'hora' => 'required',

        ]);

        $calidad = new calidad;
        $calidad->titulo = $request->input('titulo');
        $calidad->observacion = $request->input('observacion');
        $calidad->fecha = $request->input('fecha');
        $calidad->hora = $request->input('hora');
    
        $calidad->save();

        return redirect()->route('practicas.index');
        
    }
    public function editarpractica(calidad $calidad)
    {
        return view('practicas.calidad.editar', compact('calidad'));
    }
    public function guardarpracticaeditada(Request $request, calidad $calidad)
    {
        $request->validate([
            'titulo' => 'required',

            'fecha',
            'hora'
        ]);
        $calidad->id;
        $calidad->titulo = $request->titulo;
        $calidad->fecha = $request->fecha;
        $calidad->hora = $request->hora;
        $calidad->observacion = $request->observacion;
        $calidad->save();
        return redirect()->route('practicas.index')->with('success', 'actualizada la practica');
    }
    public function eliminarpractica(calidad $calidad)
    {
    $calidad->delete();

    return redirect()->route('practicas.index')->with('success', 'Eliminada la práctica');
    }

}
