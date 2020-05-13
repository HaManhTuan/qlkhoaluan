<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Auth;
class Lecturers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('lecturers')->check()) { 
            if (Auth::guard('lecturers')->user()->status == 1){
               return $next($request);
            }
            else
              return redirect('lecturers/login');
        }
        else
        {
          return redirect('lecturers/login');
        }

    }
}
?>
