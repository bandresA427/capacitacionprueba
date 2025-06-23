<?php

namespace App\Http\Controllers;

use App\Models\CapacitacionArticulo;
use App\Models\CapacitacionModulo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;


class CapacitacionArticuloController extends Controller
{
    public function index(CapacitacionModulo $modulo)
    {
        $articulos = $modulo->articulos;
        return view('capacitacion.modulos.articulos.index', compact('modulo', 'articulos'));
    }

    public function create(CapacitacionModulo $modulo)
    {
        return view('capacitacion.modulos.articulos.create', compact('modulo'));
    }

    public function store(Request $request, CapacitacionModulo $modulo)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'visto' => 'required',
        ]);



        $articulo = new CapacitacionArticulo;
        $articulo->titulo = $request->titulo;
        $articulo->contenido = $request->contenido;
        $articulo->visto = $request->visto;


        $articulo = $modulo->articulos()->create($request->all());
        return redirect()->route('capacitacion.modulos.articulos.index', $modulo);
    }
    public function show(CapacitacionModulo $modulo, CapacitacionArticulo $articulos, Request $request)
    {  $origen = $request->isMethod('post') ? ($request->has('ingresar') ? 'ingresar' : 'siguiente') : null;
        return view('capacitacion.modulos.articulos.show', compact('modulo', 'articulos'));
    }

    public function destroy(CapacitacionArticulo $articulo)
    {
        $articulo->delete();

        return redirect()->route('capacitacion.modulos.articulos.index', compact('articulos'))->with('success', ' eliminado exitosamente.');
    }

    public function nextArticle($modulo, $articulo)
    {
        $moduloObject = CapacitacionModulo::find($modulo);
        if (!$moduloObject) {
            // handle error, modulo not found
        }

        $nextArticle = CapacitacionArticulo::where('capacitacion_modulo_id', $moduloObject->id)
            ->where('id', '>', $articulo)
            ->min('id');

        return redirect()->route('capacitacion.modulos.articulos.show', [$moduloObject, $nextArticle]);
    }
}
