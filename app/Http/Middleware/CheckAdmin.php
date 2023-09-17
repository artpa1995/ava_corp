<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    // public function handle(Request $request, Closure $next)
    // {
    //     if (Auth::user() &&  Auth::user()->role_id == 1) {
    //         return $next($request);
    //     }

    //     return redirect('/');

    // }


    // public function handle(Request $request, Closure $next)
    // {
    //     // Obtenir la liste des roles de l'utilisateur
    //     $UserRoles = DB::table('roles')->join('role_user','role_id', '=', 'roles.id')->where('user_id', '=', Auth::user()->id)->lists('name');
    //     // vérifier si cet utilisateur  a le role d'admin
    //     $isAdmin = false;
    //     foreach($UserRoles as $role)
    //     {
    //         if($role == 'admin')
    //         {
    //             $isAdmin = true;
    //         }
    //     }

    //     
    //     if( ! $isAdmin )
    //     {
    //         if ($request->ajax()) {
    //             return response('Unauthorized.', 401);
    //         } else {
    //             return redirect()->back(); 
    //         }
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next)
    {

        $UserRoles = DB::table('roles')->where('id', '=', Auth::user()->role_id)->get()->first();
        $isAdmin = false;

        if(!empty($UserRoles) &&  $UserRoles->name == 'admin'){
            $isAdmin = true;
        }

        if(!$isAdmin){
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('/'); 
            }
        }

        return $next($request);
    }
}
