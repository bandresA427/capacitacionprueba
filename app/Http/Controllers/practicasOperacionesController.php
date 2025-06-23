<?php

namespace App\Http\Controllers;

use App\Models\operaciones;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class practicasOperacionesController extends Controller
{
    public function index()
    {
        $operaciones = operaciones::all();
        return view('practicas.index', compact('operaciones'));
    }
    public function crearpractica()
    {
        return view('practicas.operaciones.crear');
    }
    public function guardarpractica(Request $request)
    {

        $request->validate([
            'titulo' => 'required|string',

            'fecha' => 'required',
            'hora' => 'required',

        ]);

        $operaciones = new operaciones;
        $operaciones->titulo = $request->input('titulo');
        $operaciones->observacion = $request->input('observacion');
        $operaciones->fecha = $request->input('fecha');
        $operaciones->hora = $request->input('hora');
    
        $operaciones->save();

        return redirect()->route('practicas.index');
        
    }
    public function editarpractica(operaciones $operaciones)
    {
        return view('practicas.operaciones.editar', compact('operaciones'));
    }
    public function guardarpracticaeditada(Request $request, operaciones $operaciones)
    {
        $request->validate([
            'titulo' => 'required',

            'fecha',
            'hora'
        ]);
        $operaciones->id;
        $operaciones->titulo = $request->titulo;
        $operaciones->fecha = $request->fecha;
        $operaciones->hora = $request->hora;
        $operaciones->observacion = $request->observacion;
        $operaciones->save();
        return redirect()->route('practicas.index')->with('success', 'actualizada la practica');
    }
    public function eliminarpractica(operaciones $operaciones)
    {
    $operaciones->delete();

    return redirect()->route('practicas.index')->with('success', 'Eliminada la práctica');
    }

}