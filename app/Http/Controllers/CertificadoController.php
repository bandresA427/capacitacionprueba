<?php

namespace App\Http\Controllers;

use App\Models\User;
use Mpdf\Mpdf;

class CertificadoController extends Controller
{
    public function generar($usuarioId)
{
    $user = User::findOrFail($usuarioId);
    $fecha = date('d-m-Y');

    $mpdfSettings = [
        'mode' => 'utf-8',
        'format' => 'A4',
        'orientation' => 'L',
        'margin_left' => 20,
        'margin_right' => 20,
        'margin_top' => 40,
        'margin_bottom' => 20,
        'margin_header' => 10,
        'margin_footer' => 10,
    ];

    $mpdf = new Mpdf($mpdfSettings);

    $html = $this->getHtmlTemplate($user, $fecha);

    $mpdf->WriteHTML($html);
    $mpdf->Output('certificado.pdf', 'D');
}


    private function getHtmlTemplate(User $user, string $fecha): string
{
    return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Culminación de Capacitación</title>

    <style>
       .cabecera {color: #FFFFFF; font-weight: bold; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; }
       .menu {
            font-size: 13px;
            font-weight: bold;
            text-decoration: none;
            color: #333333;
        }
       .normal {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000080;
            text-decoration: none;
        }
       .style5 {color: #000066}
       .style7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #000000; text-decoration: none; }
       .style8 {font-size: 11px}

        
       .header img {
            width: 400px; 
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .container {
            text-align: center;
        }

        .subtitulo {
            margin-top: 20px;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="header">
            <img src="../public/header.gif" alt="Header Image">
            <h1>Certificado</h1>
            <h2 class="subtitulo">De Culminación del Curso de Capacitación de Tejeduría</h2>
        </div>
        <div class="contenido">
            <p class="texto-centro">ESTE CERTIFICADO ES OTORGADO A:</p>
            <h1 class="texto-centro">{$user->name}</h1>
            <h3 class="texto-izquierda">Por su destacada participación en la capacitación para el personal cumpliendo de manera eficaz con los objetivos, mostrando capacidad y conocimiento de los procesos realizados dentro de la empresa, culminando el curso en la fecha {$fecha}.</h3>
        </div>
        <div class="firma">
            <br>
            <p class="texto-centro">Firma</p>
        </div>
        <p class="texto-centro">Fecha</p>
        <p class="texto-centro">{$fecha}</p>
    </div>
</body>
</html>
HTML;
    }
}