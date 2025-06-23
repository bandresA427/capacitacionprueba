<?php

namespace App\Http\Controllers;

use App\Models\CapacitacionModulo;
use Illuminate\Http\Request;


class CapacitacionModuloController extends Controller
{
    public function index()
    {
        $modulos = CapacitacionModulo::all();
        return view('capacitacion.modulos.index', compact('modulos'));
    }

    public function create()
    {
        return view('capacitacion.modulos.create');
    }

    public function store(Request $request)
    {
        $modulo = CapacitacionModulo::create($request->only([
            'titulo',
            'icono',
            'color',
            'descripcion',
            'modulo',
        ]));
        return redirect()->route('capacitacion.modulos.index');
    }

    public function show(CapacitacionModulo $modulo)
    {

        // Determinar el origen de la solicitud
      

        return view('capacitacion.modulos.show', compact('modulo'));
        
    }
    public function edit(CapacitacionModulo $modulo)
    {
        return view('capacitacion.modulos.edit', compact('modulo'));
        
    }
    public function update(Request $request, CapacitacionModulo $modulo)
    {
        $request->validate([
            'titulo' => 'required',
            'icono' => 'required', 
            'color' => 'required',
            'descripcion' => 'required',
            'modulo' => 'required',
        ]);
        $modulo->id;
        $modulo->titulo = $request->titulo;
        $modulo->icono = $request->icono;
        $modulo->color = $request->color;
        $modulo->descripcion = $request->descripcion;
        $modulo->modulo = $request->modulo;
        $modulo->save();
        return redirect()->route('capacitacion.modulos.index')->with('success', ' actualizado exitosamente.');
    }
    public function destroy(CapacitacionModulo $modulo)
    {
        $modulo->delete();
    
        return redirect()->route('capacitacion.modulos.index')->with('success', ' eliminado exitosamente.');
    }
}