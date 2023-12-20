<?php

namespace App\Http\Middleware;

use App\Models\KriteriaBobotModel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkBobot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bobot = (string)KriteriaBobotModel::sum('bobot');
        
        if ($bobot == '1.0') {
            return $next($request);
        } else {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Total bobot harus 1.');
        }
    }
}
