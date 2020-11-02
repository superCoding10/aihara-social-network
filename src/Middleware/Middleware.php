<?php

namespace App\Middleware;

class Middleware {
    
    private static $middlewares = [];
    
    public static function add(string $middlewareClassName)
    {
        # code...
        
        foreach(explode('|', $middlewareClassName) as $middleware) {
            self::$middlewares[] = $middleware;
        }

    }

    public static function start() {
        foreach(self::$middlewares as $middleware) {
                require_once INC_ROOT . '/application/Middleware/' . $middleware . '.php';
                (new $middleware())->handle();
        }
    }

}