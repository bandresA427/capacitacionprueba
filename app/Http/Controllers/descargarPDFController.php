<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Storage;


class descargarPDFController extends Controller
{
    public function descargar() // Allow optional filename
    {   
        $manualPath = storage_path('MANUAL_DE_USUARIO.pdf');

        if (file_exists($manualPath)) {
            $response = Response::download($manualPath, 'MANUAL_DE_USUARIO.pdf');
            return $response;
        } else {
            abort(404);
        }
    }
    

}