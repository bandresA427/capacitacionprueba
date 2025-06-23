<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluacion;
use app\Models\User;
use App\Models\Respuesta;

class CalificacionesController extends Controller
{

    public function index()
    {
        $evaluaciones = Evaluacion::all();
        return view('calificaciones.index', compact('evaluaciones'));
    }

    public function show($evaluacionId)
    {
        $evaluacion = Evaluacion::find($evaluacionId);
        $respuestas = Respuesta::where('evaluacion_id', $evaluacionId)->with('usuario')->get();
        $mejorPuntajePorUsuario = $respuestas->groupBy('usuario_id')->max('puntaje');

        return view('calificaciones.show', compact('evaluacion', 'respuestas', 'mejorPuntajePorUsuario'));
    }

    public function aprobarReprobar($evaluacionId, $usuarioId, $decision)
    {
        $usuario = User::find($usuarioId);
        $nivelActual = $usuario->nivel;

        if ($decision === 'aprobar') {
            $usuario->nivel = $nivelActual + 1;
        } else {
            $usuario->nivel = max($nivelActual - 1, 0);
        }

        $usuario->save();

        return redirect()->route('calificaciones.show', $evaluacionId);
    }
}