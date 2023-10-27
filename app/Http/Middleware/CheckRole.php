<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user=Auth::user();
        //if not login user rediresct  to login
        if(!$user){
            return redirect('/login');
        }
        $role_id= $user->role_id;
        $role= Role::find($role_id);
        $role= $role->role;
        //user has the required role allow the request
        if(in_array($role, $roles)){

            return $next($request);
        }
        // user does not have the required role return 403 and abort
        return abort(403);
    }
}
