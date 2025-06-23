<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\CapacitacionModulo;
use App\Models\Respuesta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index()
    {
        $evaluaciones = Evaluacion::all();
        $modulos = CapacitacionModulo::all();
        return view('evaluaciones.index', compact('evaluaciones','modulos'));
    }

    public function create()
    {
       
        return view('evaluaciones.create');
    }

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'titulo' => 'required|string',
            'preguntas' => 'required|array',
            'nivel' => 'required',

        ]);

        $evaluacion = new Evaluacion;
        $evaluacion->titulo = $data['titulo'];
        $evaluacion->preguntas = json_encode($data['preguntas']);
        $evaluacion->nivel = $data['nivel'];
        $evaluacion->save();



        return redirect()->route('evaluaciones.index')->with('success', 'La evaluación se ha creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluacion $evaluacion)
    {
        $preguntas = json_decode($evaluacion->preguntas, true);
        $shuffledPreguntas = $preguntas; // Create a copy of the original array
        shuffle($shuffledPreguntas); // Shuffle the copy
        array_splice($shuffledPreguntas, 10); 
        


        return view('evaluaciones.show', compact('evaluacion', 'shuffledPreguntas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluacion $evaluacion)
    {
        $preguntas = json_decode($evaluacion->preguntas, true);
        return view('evaluaciones.edit', compact('evaluacion', 'preguntas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluacion $evaluacion)
    {
         $request->validate([
            'titulo' => 'required|string',
            'preguntas' => 'required|array',
            'nivel' => 'required',

        ]);
        
        $evaluacion->titulo = $request->titulo;
        $evaluacion->nivel = $request->nivel;
        $evaluacion->preguntas = json_encode($request['preguntas']);
        $evaluacion->save();
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación eliminada');
    }
    public function Resultados($idEvaluacion)
    {
         // Obtener ID del usuario en sesión
         $idUsuario = Auth::user()->name;
        $resultados = DB::table('respuestas')
        ->where('evaluacion_id', $idEvaluacion )
        ->where('usuario_id', $idUsuario)
        ->get();

        $puntaje = DB::table('respuestas')
        ->where('evaluacion_id' , $idEvaluacion)
        ->where('usuario_id', $idUsuario)
        ->max('puntaje');


        return view('evaluaciones.resultados', compact( 'resultados' , 'puntaje'));
    }

}
