<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Respuesta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RespuestaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluacion  $evaluacion
     * @return \Illuminate\Http\Response
     */
    public function index(Evaluacion $evaluacion)
{
    $user = auth()->user();
    $respuestas = $evaluacion->respuestas()
        ->where('usuario_id', $user->id) // Cambiado a $user->id
        ->get()
        ->map(function ($respuesta) use ($evaluacion) {
            $pregunta = $evaluacion->preguntas->find($respuesta->pregunta_id);
            if ($pregunta && isset($pregunta->respuestas)) {
                $respuesta->respuesta = $pregunta->respuestas[$respuesta->respuesta] ?? $respuesta->respuesta;
            }
            return $respuesta;
        });

    return view('respuestas.index', compact('evaluacion', 'respuestas'));
}

public function store(Request $request, Evaluacion $evaluacion)
{

    $request->validate([
        'respuestas' => 'required|array',
    ]);


    $preguntas = json_decode($evaluacion->preguntas, true);
    $puntaje = 0;
    $total = count($preguntas);
    $correcta = true;
    foreach ($preguntas as $pregunta_id => $pregunta) {
        $respuesta = $request->input('respuestas.' . $pregunta_id);

        if ($pregunta['tipo'] === 'respuesta_corta') {
            $correcta = $correcta && strcasecmp($respuesta, $pregunta['respuesta_correcta-r']) === 0;
        } else if ($pregunta['tipo'] === 'seleccion_simple') {
            $correcta = $correcta && $respuesta === $pregunta['respuesta_correcta'];
        } else if ($pregunta['tipo'] === 'seleccion_multiple') {
            $respuesta_json = json_encode($respuesta);
            $correcta = 1;
        }

        $puntaje += $correcta ? 1 : 0;
        $respuestas[] = [
            'evaluacion_id' => $evaluacion->id,
            'usuario_id' => auth()->user()->name,
            'pregunta_id' => $pregunta_id,
            'respuesta' => $respuesta,
            'correcta' => $correcta,
            'puntaje' => $puntaje

        ];
    }



    $porcentaje = round(($puntaje / $total) * 20, 2);
    if ($puntaje === $total) {
        // Subir el nivel del usuario
        $user = User::find($request->user()->id);
        if ($user->nivel < 10) {
            $user->nivel++;
        }
        $user->save();
    }
    Respuesta::insert($respuestas,$puntaje);


    if ($porcentaje == 20) {
        return redirect()->route('evaluaciones.index', $evaluacion)->with('success', '¡Felicidades! Evaluación realizada. Tu puntaje es de ' . $porcentaje . ' puntos.');
    } else {
        return redirect()->route('evaluaciones.index', $evaluacion)->with('warning', 'Evaluación realizada. Tu puntaje es de ' . $porcentaje . ' puntos, pero necesitas 20 puntos para pasar.');
    }
}

}
