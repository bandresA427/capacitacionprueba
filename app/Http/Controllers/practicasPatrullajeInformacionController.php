<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\patrullaje;
use App\Models\patrullajeinformacion;
use App\Models\User;

class practicasPatrullajeInformacionController extends Controller
{
    public function index(patrullaje $patrullaje, patrullajeinformacion $patrullajeinformacion)
    {
            $patrullajeinformacion = patrullajeinformacion::all();
            $usuarios = User::all();
            return view('practicas.informacion.patrullaje.index', compact('patrullaje', 'patrullajeinformacion', 'usuarios'));
    }

    public function cargar( patrullaje $patrullaje, patrullajeinformacion $patrullajeinformacion)
    {
        $usuarios = User::all();
        return view('practicas.cargar', compact('usuarios','patrullaje', 'patrullajeinformacion',));
    }
    public function cargaMasiva(Request $request ,patrullaje $patrullaje)
    {
        
        $practica = [];
        foreach ($request->participante as $key => $participanteId) {
            $tiempos = $request->tiempo[$key];
            $promedio = array_sum($tiempos) / count($tiempos) ;

            $practica[] = [
                'Hidpatrullaje' => $request->Hidpatrullaje ,
                'participante' => $participanteId,
                'tiemposrecorrido' => json_encode($tiempos),
                'resultado' => $promedio,
                'disciplina' => $request->disciplina,
                'cumplimiento' => $request->cumplimiento,
            ];
        }

        patrullajeinformacion::insert($practica);

        return redirect()->route('practicas.index' );

        }

        
    public function editar($id, patrullaje $patrullaje, patrullajeinformacion $patrullajeinformacion) 
    {
        {
            $practica = patrullajeinformacion::findOrFail($id);
            $usuarios = User::all();
            $tiempos = json_decode($practica->tiempos);
        
            return view('practicas.edit', compact('practica', 'usuarios', 'tiempos'));
        }
    }
    public function update(Request $request, $id,  patrullajeinformacion $patrullajeinformacion)
    {
        $patrullajeinformacion = patrullajeinformacion::findOrFail($id);
        $patrullajeinformacion->participante = $request->input('participante');
        $patrullajeinformacion->resultado = $request->input('resultado');
        $patrullajeinformacion->save();
    
        return redirect()->route('practicas.index' );
    }
    public function delete(patrullajeinformacion $patrullajeinformacion)
    {
        $patrullajeinformacion->delete();
    
        return redirect()->route('practicas.informacion.index')->with('success', 'Eliminada la práctica');

    }

}
