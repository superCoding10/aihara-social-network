<?php

namespace App\Middleware;

class MiddlewareManager {
    private $pattern;
    public function __construct($pattern) {
        $this->pattern = $pattern;
    }

    public function add(string $middlewareClassName)
    {
        # code...
        if($this->pattern === explode('?', $_SERVER['REQUEST_URI'])[0]) {
            Middleware::add($middlewareClassName);
        }
    }
}