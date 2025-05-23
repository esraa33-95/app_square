<?php

use App\Http\Middleware\AddCustomHeader;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // then:function(){
        //     $namespace = 'App\Http\Controllers';
        //     Route::namespace($namespace.'\\App\Front')->prefix('api')->middleware('api')
        //     ->group(base_path('routes/api.php'));

            
        // }
        
    )
    

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([

            'custom-header' => AddCustomHeader::class
    
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
