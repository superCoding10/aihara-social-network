<?php

namespace Aihara\Middleware;

class Middleware {
    
    private $middlewares = [];
    
    public function __construct(string $middlewares)
    {
        # code...
        $this->middlewares = array_filter(explode('|', $middlewares));

    }

    public function handle() {
        foreach($this->middlewares as $middleware) {
            $className = '\\App\\Middleware\\' . ucfirst($middleware) . 'Middleware';
            (new $className)->handle();
        }
    }

}