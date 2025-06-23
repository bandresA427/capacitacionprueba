<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reportes.index');
    }

    public function usuarios()
    {
        $usuariosPorNivel = DB::select('SELECT nivel, COUNT(*) AS usuarios_por_nivel FROM users GROUP BY nivel');
        $usuariosPorNivel2 = DB::select('SELECT nivel, name FROM users ORDER BY nivel');

        return view('reportes.usuarios', compact('usuariosPorNivel', 'usuariosPorNivel2'));
    }

    public function evaluaciones()
    {
        $evaluacionesPorUsuario = DB::select('SELECT name, nivel from users ORDER BY nivel');
        
        return view('reportes.evaluaciones', compact('evaluacionesPorUsuario'));
    }

    public function culminados()
    {
        $usuariosCulminados = DB::select('SELECT COUNT(*) AS usuarios_culminados FROM users WHERE nivel = 7');
        $usuariosCompletosId = DB::select('SELECT cedula, name FROM users WHERE nivel = 7 ');

        return view('reportes.culminados', compact('usuariosCulminados', 'usuariosCompletosId'));
    }

    public function modulos()
    {
        $moduloCompletado = DB::select('SELECT COUNT(*) AS modulo_completado FROM capacitacion_modulos');
    }

    public function generarReporte()
    {
        // Consultar datos
        $usuariosRegistrados = DB::select('SELECT id FROM users');
        $modulosTotales = DB::select('SELECT id FROM capacitacion_modulos');
        $modulosConNivel = DB::select('SELECT titulo, modulo FROM capacitacion_modulos');
        $usuariosPorNivel = DB::select('SELECT nivel, COUNT(*) AS usuarios_nivel FROM users GROUP BY nivel');
        $evaluacionesConNivel = DB::select('SELECT titulo, nivel FROM evaluacions');
        $usuariosCompletos = DB::selectOne('SELECT COUNT(*) AS usuarios_completos FROM users WHERE nivel = 7');
        $usuariosCompletosId = DB::select('SELECT cedula, name FROM users WHERE nivel = 7 ');

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
            <p>Usuarios registrados: ' . count($usuariosRegistrados) . '</p>
            <p>Módulos totales: ' . count($modulosTotales) . '</p>

            <h2>Módulos</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Módulo</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($modulosConNivel as $modulo) {
            $html .= '<tr>
                        <td>' . $modulo->titulo . '</td>
                        <td>' . $modulo->modulo . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>

            <h2>Participantes por Módulo</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Participantes</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($usuariosPorNivel as $nivel) {
            $html .= '<tr>
                        <td>' . $nivel->nivel . '</td>
                        <td>' . $nivel->usuarios_nivel . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>

            <h2>Evaluaciones por Módulo</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Módulo</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($evaluacionesConNivel as $evaluacion) {
            $html .= '<tr>
                        <td>' . $evaluacion->titulo . '</td>
                        <td>' . $evaluacion->nivel . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>

            <h2>Participantes que Completaron Todos los Módulos</h2>
            <p>' . $usuariosCompletos->usuarios_completos . '</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre y Apellido</th>
                        <th>Cédula</th>
                    </tr>
                </thead>
                <tbody>';
        foreach($usuariosCompletosId as $usuariosId) {
            $html .= '<tr>
                        <td>' . $usuariosId->name . '</td>
                        <td>' . $usuariosId->cedula . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>
        </div>';

        $mpdf->WriteHTML($html);
        $mpdf->Output('reporte.pdf', 'D');
    }

    public function generarReporteUsuarios()
    {
        $usuariosRegistrados = DB::select('SELECT id FROM users');
        $usuariosPorNivel = DB::select('SELECT nivel, COUNT(*) AS usuarios_nivel FROM users GROUP BY nivel');
        $usuariosPorNivel2 = DB::select('SELECT nivel, name FROM users ORDER BY nivel');

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
            <p>Participantes registrados: ' . count($usuariosRegistrados) . '</p>

            <h2>Participantes por Módulo</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Módulo</th>
                        <th>Participantes</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($usuariosPorNivel as $nivel) {
            $html .= '<tr>
                        <td>' . $nivel->nivel . '</td>
                        <td>' . $nivel->usuarios_nivel . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>

        <h2>Listado de Participantes por Módulo</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Módulo</th>
                    <th>Participantes</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($usuariosPorNivel2 as $nivel) {
            $html .= '<tr>
                        <td>' . $nivel->nivel . '</td>
                        <td>' . $nivel->name . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>
        </div>';

        $mpdf->WriteHTML($html);
        $mpdf->Output('reporteUsuario.pdf', 'D');
    }

    public function generarReporteEvaluaciones()
    {
        $modulosTotales = DB::select('SELECT id FROM capacitacion_modulos');
        $modulosConNivel = DB::select('SELECT titulo, modulo FROM capacitacion_modulos');
        $evaluacionescompletadas = DB::select('SELECT name, nivel FROM users ORDER BY nivel');
        
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
            <p>Módulos totales: ' . count($modulosTotales) . '</p>

            <h2>Módulos</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Módulo</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($modulosConNivel as $modulo) {
            $html .= '<tr>
                        <td>' . $modulo->titulo . '</td>
                        <td>' . $modulo->modulo . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>

        <h2>Evaluaciones Completadas</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Módulo</th>
                    <th>Evaluaciones Completadas</th>
                </tr>
            </thead>
            <tbody>';
        foreach ($evaluacionescompletadas as $evaluaciones) {
            $html .= '<tr>
                        <td>' . $evaluaciones->name . '</td>
                        <td>' . $evaluaciones->nivel . '</td>
                        <td>' . ($evaluaciones->nivel - 1) . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>
        </div>';

        $mpdf->WriteHTML($html);
        $mpdf->Output('reporteEvaluaciones.pdf', 'D');
    }

    public function generarReporteCulminados()
    {
        $usuariosCompletos = DB::selectOne('SELECT COUNT(*) AS usuarios_completos FROM users WHERE nivel = 7');
        $usuariosCompletosId = DB::select('SELECT cedula, name FROM users WHERE nivel = 7 ');
        
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
            <h1 class="text-center">Reporte de participantes que culminaron la capacitación</h1>
            <p class="text-center">Fechas del reporte: ' . date('d:m:y h:i:s A') . '</p>
<p class="text-center">Solicitado por: '.Auth::user()->name.'</p>

            <h2>Participantes que Completaron Todos los Módulos</h2>
            <p>' . $usuariosCompletos->usuarios_completos . '</p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre y Apellido</th>
                        <th>Cédula</th>
                    </tr>
                </thead>
                <tbody>';
        foreach($usuariosCompletosId as $usuariosId) {
            $html .= '<tr>
                        <td>' . $usuariosId->name . '</td>
                        <td>' . $usuariosId->cedula . '</td>
                    </tr>';
        }
        $html .= '</tbody></table>
        </div>';

        $mpdf->WriteHTML($html);
        $mpdf->Output('reporteCulminados.pdf', 'D');
    }
}


?>