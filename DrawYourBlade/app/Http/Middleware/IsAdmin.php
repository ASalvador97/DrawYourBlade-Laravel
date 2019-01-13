<?php

namespace App\Http\Middleware;

use App\Post;
use Auth;
use Closure;
use Session;

class IsAdmin
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
        if(Auth::user()->type == 'admin'){
            return $next($request);
        }

		Session::flash('error', 'You do not have admin rights.');
        return redirect('/');
    }
}