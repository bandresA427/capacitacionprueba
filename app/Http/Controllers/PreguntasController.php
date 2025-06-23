<?php

namespace App\Http\Controllers;

use App\Models\Pregunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the questions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = Pregunta::all();
        return view('preguntas.index', compact('preguntas'));
    }

    /**
     * Show the form for creating a new question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('preguntas.create');
    }

    /**
     * Store a newly created question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pregunta' => 'required|string|max:255',
            'opcion1' => 'required|string|max:255',
            'opcion2' => 'required|string|max:255',
            'opcion3' => 'required|string|max:255',
            'opcion4' => 'required|string|max:255',
            'respuesta_correcta' => 'required|in:opcion1,opcion2,opcion3,opcion4',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $pregunta = new Pregunta([
            'pregunta' => $request->pregunta,
            'opcion1' => $request->opcion1,
            'opcion2' => $request->opcion2,
            'opcion3' => $request->opcion3,
            'opcion4' => $request->opcion4,
            'respuesta_correcta' => $request->respuesta_correcta,
        ]);

        $pregunta->save();

        return redirect()->route('preguntas.index')->with('success', 'Pregunta creada correctamente.');
    }

    /**
     * Show the form for editing a specified question.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pregunta = Pregunta::findOrFail($id);
        return view('preguntas.edit', compact('pregunta'));
    }

    /**
     * Update the specified question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pregunta' => 'required|string|max:255',
            'opcion1' => 'required|string|max:255',
            'opcion2' => 'required|string|max:255',
            'opcion3' => 'required|string|max:255',
            'opcion4' => 'required|string|max:255',
            'respuesta_correcta' => 'required|in:opcion1,opcion2,opcion3,opcion4',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

       $request[]=[
        $pregunta->pregunta = $request->pregunta;
        $pregunta->opcion1 = $request->opcion1;
        $pregunta->opcion2 = $request->opcion2;
        $pregunta->opcion3 = $request->opcion3;
        $pregunta->opcion4 = $request->opcion4;
        $pregunta->respuesta_correcta = $request->respuesta_correcta;
        $pregunta->save();
       ];
        return redirect()->route('preguntas.index')->with('success', 'Pregunta actualizada correctamente.');
    }
}