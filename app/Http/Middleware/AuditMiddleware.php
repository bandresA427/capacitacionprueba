<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AuditLog;


class AuditMiddleware
{
    public function handle($request, $next)
    {
        if ($request->isMethod('post') || $request->isMethod('get') || $request->isMethod('put') || $request->isMethod('delete')) {
            foreach ($request->request->all() as $key => $value) {
                if (strpos($key, 'btn-') === 0) {

                            // User exists in the database (authenticated user) or temporary ID exists
                            AuditLog::create([
                                'user_id' => auth()->id(),
                                'type' => $request->isMethod('post') ? 'submit' : 'click',
                                'component' => $key,
                                'action' => !empty($value) ? $value : 'Desconocida',
                                'url' => $request->url(),
                            ]);
                        } 
                    } 
                }

        return $next($request);
    }
}
