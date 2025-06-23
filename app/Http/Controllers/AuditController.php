<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Models\User;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $logs = AuditLog::query();
        

        // Aplicar filtros según los parámetros de la solicitud
        if ($request->filled('type')) {
            $logs->where('type', $request->type);
        }

        if ($request->filled('date_from')) {
            $logs->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $logs->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('user_id')) {
            $logs->where('user_id', $request->user_id);
        }

        $logs = $logs->orderBy('created_at', 'desc') // Add this line to order by latest date
        ->paginate(10);


        return view('audit.index', compact('logs', 'users'));
    }
}


