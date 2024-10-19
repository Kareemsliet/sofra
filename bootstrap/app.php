<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware){

        $middleware->statefulApi();

        $middleware->alias([
            'auto-permission'=>\App\Http\Middleware\AdminPermission::class,
        ]);

        $middleware->redirectUsersTo(function(){
            if(auth('client')->check()){
                 return route("index");
            }else if(auth('restaurant')->check()){
                return route("restaurant.index");
            }else{
                return route("admin.index");
            }
        });

        $middleware->redirectGuestsTo(function(){
            if(auth('restaurant')->guest()){
                return route("restaurant.showLoginForm");
            }else{
                return route("client.showLoginForm");
            }
        });


    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
