<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class AdminPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName=$request->route()->getName();
        $permission=Permission::whereRaw("FIND_IN_SET('$routeName',routes)")->first();
        if($permission){
            if(!auth()->user()->hasPermissionTo($permission)){
               abort(403);
            }
        }
        return $next($request);
    }
}
