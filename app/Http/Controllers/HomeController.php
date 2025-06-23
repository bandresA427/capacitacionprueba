<?php

namespace App\Http\Controllers;
use App\Models\CapacitacionModulo;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Evaluacion;

use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype=Auth()->user()->usertype;
            $status=Auth()->user()->status;

            if ($usertype=='user' && $status=='Activo')
            { //nivel  usuari normal
                $modulos = CapacitacionModulo::all();
                return view('capacitacion.modulos.index', compact('modulos'));
            }
            elseif ($usertype=='user' && $status=='Retirado'){
                echo "Su usuario está retirado del sistema , por favor comunicarse con el encargado .";
                return redirect()->back();
            }
            else if ($usertype=='instructor' && $status=='Activo')
            {// nivel instructor
                return view('instructor.instructor_dashboard');
            }
            elseif ($usertype=='instructor' && $status=='Retirado'){
                echo "Su usuario está retirado del sistema , por favor comunicarse con el encargado .";
                return redirect()->back();
            }
            else if ($usertype=='admin' && $status=='Activo')
            {// nivel admin

                $userCount = User::count();
                $moduleCount = CapacitacionModulo::count();
                $evaluationCount = Evaluacion::count();

                return view('admin.admin_dashboard', compact('userCount', 'moduleCount', 'evaluationCount'));
            }
            elseif ($usertype=='admin' && $status=='Retirado'){
                echo "Su usuario está retirado del sistema , por favor comunicarse con el encargado .";
                return redirect()->back();
            }

            else
            {
                return redirect()->back();
            }
        }

    }
}
