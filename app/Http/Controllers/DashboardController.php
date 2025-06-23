<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CapacitacionModulo;
use App\Models\Evaluacion;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Conteo de usuarios registrados en el mes actual
        $userCount = User::whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->count();

        // Conteo de módulos disponibles en el mes actual
        $moduleCount = CapacitacionModulo::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->count();

        // Conteo de evaluaciones disponibles en el mes actual
        $evaluationCount = Evaluacion::whereMonth('created_at', Carbon::now()->month)
                                    ->whereYear('created_at', Carbon::now()->year)
                                    ->count();

                                    

        return view('dashboard.index', compact('userCount', 'moduleCount', 'evaluationCount'));
    }
}
