<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comportamiento;
use App\Models\comportamientoinformacion;
use App\Models\User;

class practicasComportamientoInformacionController extends Controller
{
    public function index(comportamiento $comportamiento, comportamientoinformacion $comportamientoinformacion)
    {
            $comportamientoinformacion = comportamientoinformacion::all();
            $usuarios = User::all();
            return view('practicas.informacion.comportamiento.index', compact('comportamiento', 'comportamientoinformacion', 'usuarios'));
    }

    public function cargar( comportamiento $comportamiento, comportamientoinformacion $comportamientoinformacion)
    {
        $usuarios = User::all();
        return view('practicas.cargar', compact('usuarios','comportamiento', 'comportamientoinformacion',));
    }
    public function cargaMasiva(Request $request ,comportamiento $comportamiento)
    {
        
        $practica = [];
        foreach ($request->participante as $key => $participanteId) {
            $semana = $request->tiempo[$key];
            $semana2 = $request->tiempo2[$key];
            $semana3 = $request->tiempo3[$key];
            $promedio = array_sum($semana) + array_sum($semana2) +array_sum($semana3);

            $practica[] = [
                'Hidcomportamiento' => $request->Hidcomportamiento,
                'participante' => $participanteId,
                'semana' => json_encode($semana),
                'semana2' => json_encode($semana2),
                'semana3' => json_encode($semana2),
                'resultado' => $promedio,
                
            ];
        }

        comportamientoinformacion::insert($practica);

        return redirect()->route('practicas.index' );

        }

        
    public function editar($id, comportamiento $comportamiento, comportamientoinformacion $comportamientoinformacion) 
    {
        {
            $practica = comportamientoinformacion::findOrFail($id);
            $usuarios = User::all();
            $semana = json_decode($practica->semana);
        
            return view('practicas.edit', compact('practica', 'usuarios', 'semana'));
        }
    }
    public function update(Request $request, $id,  comportamientoinformacion $comportamientoinformacion)
    {
        $comportamientoinformacion = comportamientoinformacion::findOrFail($id);
        $comportamientoinformacion->participante = $request->input('participante');
        $comportamientoinformacion->resultado = $request->input('resultado');
        $comportamientoinformacion->save();
    
        return redirect()->route('practicas.index' );
    }
    public function delete(comportamientoinformacion $comportamientoinformacion)
    {
        $comportamientoinformacion->delete();
    
        return redirect()->route('practicas.informacion.index')->with('success', 'Eliminada la práctica');

    }

}
