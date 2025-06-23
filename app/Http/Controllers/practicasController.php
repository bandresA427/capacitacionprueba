<?php

namespace App\Http\Controllers;

use App\Models\practicas;
use App\Models\calidad;
use App\Models\operaciones;
use App\Models\patrullaje;
use App\Models\comportamiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Auth;

class practicasController extends Controller
{
    public function index()
    {
        $practicas = practicas::all();
        $calidad = calidad::all();
        $comportamiento = comportamiento::all();
        $patrullaje = patrullaje::all();
        $operaciones = operaciones::all();
        return view('practicas.index', compact('practicas', 'calidad', 'comportamiento', 'patrullaje', 'operaciones'));
    }
    public function crearpractica()
    {
        return view('practicas.crear');
    }
    public function guardarpractica(Request $request)
    {

        $request->validate([
            'titulo' => 'required|string',
            'descripcion' => 'required',
            'fecha' => 'required',
            'hora' => 'required',

        ]);

        $practicas = new practicas;
        $practicas->titulo = $request->input('titulo');
        $practicas->descripcion = $request->input('descripcion');
        $practicas->fecha = $request->input('fecha');
        $practicas->hora = $request->input('hora');
    
        $practicas->save();

        return redirect()->route('practicas.index');
        
    }
    public function editarpractica(practicas $practicas)
    {
        return view('practicas.editar', compact('practicas'));
    }
    public function guardarpracticaeditada(Request $request, practicas $practicas)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'required',
            'fecha',
            'hora'
        ]);
        $practicas->id;
        $practicas->titulo = $request->titulo;
        $practicas->fecha = $request->fecha;
        $practicas->hora = $request->hora;
        $practicas->descripcion = $request->descripcion;
        $practicas->save();
        return redirect()->route('practicas.index')->with('success', 'actualizada la practica');
    }
    public function eliminarpractica(practicas $practicas)
{
    $practicas->delete();

    return redirect()->route('practicas.index')->with('success', 'Eliminada la práctica');
}

    public function imprimir() 
    {
                // Consultar datos
                $usuariospracticas = DB::select('SELECT * FROM practicas');
                $usuarios = DB::select('SELECT * from users');
        
                // Generar PDF
                $mpdf = new Mpdf();
                $css = "
                body { font-family: Arial, sans-serif; }
                .container { width: 100%; margin: 0 auto; }
                .text-center { text-align: center; }
                .table { width: 100%; border-collapse: collapse; margin-bottom: 1rem; }
                .table th, .table td { border: 1px solid #dee2e6; padding: 0.75rem; vertical-align: top; }
                .table thead th { vertical-align: bottom; border-bottom: 2px solid #dee2e6; }
                .table-bordered { border: 1px solid #dee2e6; }
            ";
                $html = '
                <style>' . $css . '</style>
                <div class="container">
                    <img src="vendor/adminlte/dist/img/jentexbannercert.jpg" class="mx-auto d-block">
                    <h1 class="text-center">Reporte de Capacitación</h1>
                    <p class="text-center">Fechas del reporte: ' . date('d:m:y h:i:s A') . '</p>
        <p class="text-center">Solicitado por: '.Auth::user()->name.'</p>
        
                    <h2>Participantes dentro del moduo de practicas y sus resultados:</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nro. de Control</th>
                                <th>Participante</th>
                                <th>Tiempos (en Seg)</th>
                                <th>Resultados</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($usuariospracticas as $usuarios_practicas) {
                    $html .= '<tr>
                                <td>' . $usuarios_practicas->numero_control . '</td>';
                                  foreach($usuarios as $usuario){
                            if($usuarios_practicas->participante_id == $usuario->id)
                            $html .= '<td> '.$usuario->name.'</td>';
                }
                            $html .= '<td>'.$usuarios_practicas->tiempos.'</td>
                                    <td>'.$usuarios_practicas->resultado.' Segundos</td>
                            </tr>';
                }

                $html .= '</tbody></table>
                </div>';
        
                $mpdf->WriteHTML($html);
                $mpdf->Output('reporteDePractica.pdf', 'D');
            
    }
}
