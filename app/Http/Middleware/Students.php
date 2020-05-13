<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use Auth;
class Students
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
        if (Auth::guard('students')->check()) { 
            if (Auth::guard('students')->user()->status == 1){
               return $next($request);
            }
            else
              return redirect('students/login');
        }
        else
        {
          return redirect('students/login');
        }

    }
}
?>
