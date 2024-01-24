<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        Session::put('previous_url', url()->previous());
        
        if(Auth()->user()->role==$role){
            return $next($request);
        }
        // Session::flash('alert', 'Anda tidak diperbolehkan akses halaman ini');
        // return $next($request);

        // @if (Session::has('alert'))
        //     <div class="alert alert-success">
        //         {{ Session::get('alert') }}
        //     </div>
        // @endif

        // return response()->json('Anda tidak diperbolehkan akses halaman ini');

        return redirect(Session::get('previous_url'));

    }
}
