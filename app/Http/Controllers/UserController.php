<?php
namespace App\Http\Controllers;

use App\Models\Archivo;

class UserController extends Controller
{
    public function index()
    {

        
        return view('user.index', );
    }

    public function show($id)
    {
        
        // Registrar la visualización del archivo por parte del usuario normal

        return view('user.show', );
    }
}