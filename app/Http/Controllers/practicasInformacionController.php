<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\practicas;
use App\Models\practicasinformacion;
use App\Models\User;

class practicasInformacionController extends Controller
{
    
    public function index(practicas $practicas, practicasinformacion $practicasinformacion)
    {
            $practicasinformacion = practicasinformacion::all();
            $usuarios = User::all();
            return view('practicas.informacion..index', compact('practicas', 'practicasinformacion', 'usuarios'));
    }

    public function cargar( practicas $practicas, practicasinformacion $practicasinformacion)
    {
        $usuarios = User::all();
        return view('practicas.cargar', compact('usuarios','practicas', 'practicasinformacion',));
    }
    public function cargaMasiva(Request $request ,practicas $practicas)
    {
        
        $practica = [];
        foreach ($request->participante as $key => $participanteId) {
            $tiempos = $request->tiempo[$key];
            $promedio = array_sum($tiempos) / count($tiempos) / 5;

            $practica[] = [
                'participante' => $participanteId,
                'tiempos' => json_encode($tiempos),
                'resultado' => $promedio,
                'Hidpractica' => $request->Hidpractica ,
            ];
        }

        practicasinformacion::insert($practica);

        return redirect()->route('practicas.index' );

        }

        
    public function editar($id, practicas $practicas, practicasinformacion $practicasinformacion) 
    {
        {
            $practica = practicasinformacion::findOrFail($id);
            $usuarios = User::all();
            $tiempos = json_decode($practica->tiempos);
        
            return view('practicas.edit', compact('practica', 'usuarios', 'tiempos'));
        }
    }
    public function update(Request $request, $id,  practicasinformacion $practicasinformacion)
    {
        $practicasinformacion = practicasinformacion::findOrFail($id);
        $practicasinformacion->participante = $request->input('participante');
        $practicasinformacion->resultado = $request->input('resultado');
        $practicasinformacion->save();
    
        return redirect()->route('practicas.index' );
    }
    public function delete(practicasinformacion $practicasinformacion)
    {
        $practicasinformacion->delete();
    
        return redirect()->route('practicas.informacion.index')->with('success', 'Eliminada la práctica');

    }

}
