<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\operaciones;
use App\Models\operacionesinformacion;
use App\Models\User;

class practicasOperacionesInformacionController extends Controller
{
    public function index(operaciones $operaciones, operacionesinformacion $operacionesinformacion)
    {
            $operacionesinformacion = operacionesinformacion::all();
            $usuarios = User::all();
            return view('practicas.informacion.operaciones.index', compact('operaciones', 'operacionesinformacion', 'usuarios'));
    }

    public function cargar( operaciones $operaciones, operacionesinformacion $operacionesinformacion)
    {
        $usuarios = User::all();
        return view('practicas.cargar', compact('usuarios','operaciones', 'operacionesinformacion',));
    }
    public function cargaMasiva(Request $request ,operaciones $operaciones)
    {
        
        $practica = [];
        foreach ($request->participante as $key => $participanteId) {
            $tiempos = $request->tiempo[$key];
            $tiempos2 = $request->tiempo2[$key];
            $promedio = array_sum($tiempos) / count($tiempos) ;
            $promedio2 = array_sum($tiempos2) / count($tiempos2); 

            $practica[] = [
                'Hidoperaciones' => $request->Hidoperaciones,
                'participante' => $participanteId,
                'calificacionNS' => $request->calificacionNS,
                'tiempostrama' => json_encode($tiempos),
                'resultadotrama' => $promedio,
                'tiemposurdimbre' => json_encode($tiempos2),
                'resultadourdimbre' => $promedio2,
                'usoherramientas' => $request->usoherramientas,
                'limpiezaOT' => $request->limpiezaOT,
                'sopladoT' => $request->sopladoT,
            ];
        }

        operacionesinformacion::insert($practica);

        return redirect()->route('practicas.index' );

        }

        
    public function editar($id, operaciones $operaciones, operacionesinformacion $operacionesinformacion) 
    {
        {
            $practica = operacionesinformacion::findOrFail($id);
            $usuarios = User::all();
            $tiempos = json_decode($practica->tiempos);
        
            return view('practicas.edit', compact('practica', 'usuarios', 'tiempos'));
        }
    }
    public function update(Request $request, $id,  operacionesinformacion $operacionesinformacion)
    {
        $operacionesinformacion = operacionesinformacion::findOrFail($id);
        $operacionesinformacion->participante = $request->input('participante');
        $operacionesinformacion->resultado = $request->input('resultado');
        $operacionesinformacion->save();
    
        return redirect()->route('practicas.index' );
    }
    public function delete(operacionesinformacion $operacionesinformacion)
    {
        $operacionesinformacion->delete();
    
        return redirect()->route('practicas.informacion.index')->with('success', 'Eliminada la práctica');

    }

}
