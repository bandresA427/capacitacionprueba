<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calidad;
use App\Models\calidadinformacion;
use App\Models\User;

class practicasCalidadInformacionController extends Controller
{
    public function index(calidad $calidad, calidadinformacion $calidadinformacion)
    {
            $calidadinformacion = calidadinformacion::all();
            $usuarios = User::all();
            return view('practicas.informacion.calidad.index', compact('calidad', 'calidadinformacion', 'usuarios'));
    }

    public function cargar( calidad $calidad, calidadinformacion $calidadinformacion)
    {
        $usuarios = User::all();
        return view('practicas.cargar', compact('usuarios','calidad', 'calidadinformacion',));
    }
    public function cargaMasiva(Request $request ,calidad $calidad)
    {
        
        $practica = [];
        foreach ($request->participante as $key => $participanteId) {
            $correctivas = $request->correctiva[$key];
            $promedio = array_sum($correctivas) ;
            if($promedio >=3){
                $resultado="Buena";
            }
            else{
                $resultado="Deficiente";
            };

            $practica[] = [
                'Hidcalidad' => $request->Hidcalidad ,
                'participante' => $participanteId,
                'identificarD' => $request->identificarD,
                'identificarC' => $request->identificarC,
                'correctiva' => json_encode($correctivas),
                'resultado' => $resultado,
            ];
        }

        calidadinformacion::insert($practica);

        return redirect()->route('practicas.index' );

        }

        
    public function editar($id, calidad $calidad, calidadinformacion $calidadinformacion) 
    {
        {
            $practica = calidadinformacion::findOrFail($id);
            $usuarios = User::all();
            $tiempos = json_decode($practica->tiempos);
        
            return view('practicas.edit', compact('practica', 'usuarios', 'tiempos'));
        }
    }
    public function update(Request $request, $id,  calidadinformacion $calidadinformacion)
    {
        $calidadinformacion = calidadinformacion::findOrFail($id);
        $calidadinformacion->participante = $request->input('participante');
        $calidadinformacion->resultado = $request->input('resultado');
        $calidadinformacion->save();
    
        return redirect()->route('practicas.index' );
    }
    public function delete(calidadinformacion $calidadinformacion)
    {
        $calidadinformacion->delete();
    
        return redirect()->route('practicas.informacion.index')->with('success', 'Eliminada la práctica');

    }

}
