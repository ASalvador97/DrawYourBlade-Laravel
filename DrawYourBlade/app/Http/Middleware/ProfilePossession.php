<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class ProfilePossession
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
        $requestedUser = User::find($request->id);
        $requestingUser = Auth::user();

        if($requestingUser->id == $requestedUser->id || $requestingUser->type == 'admin') {
            return $next($request);
        }
		
		Session::flash('error', 'You are not authorised to edit this profile.');
        return redirect('/');
    }
}
