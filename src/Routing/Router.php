<?php

namespace App\Routing;

use InvalidArgumentException;
use App\Middleware\MiddlewareManager;


class Router {

    static protected $path;

    static function terminate()
    {
        // if(in_array())
        if(!self::$path) {
           require '../resources/view/404.php';
        }
    }

    static public function get($pattern, $callback) 
    {
        # code...
        // a/{id}
        $oldPattern = $pattern;
        if(!is_string($pattern)) {
            throw new InvalidArgumentException('Route pattern arg expected to be string, given ' . gettype($pattern));
        }

        if(strlen($pattern) === 0) {
            throw new InvalidArgumentException('Wrong string length provided');
        }

        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $exploded_path = explode('/', trim($path, '/'));
        $exploded_pattern = explode('/', trim($pattern, '/'));
        $placeholders = [];
        for($i = 0; $i < count($exploded_pattern); $i++) {
            if(isset($exploded_path[$i]) && $exploded_path[$i] !== '') {
                $exploded_pattern[$i] = preg_replace('/\{\w*\}/', $exploded_path[$i], $exploded_pattern[$i], -1, $count);
                if($count > 0) {
                    $placeholders[] = $exploded_path[$i];
                }
            }
        }
        $pattern = '/' . implode('/', $exploded_pattern);
        $path = '/' . implode('/', $exploded_path);
        if($path === $pattern && $_SERVER['REQUEST_METHOD'] === strtoupper(__FUNCTION__)) {
            self::$path = $pattern;
            $callback(...$placeholders);
        }
        // echo 

        return new MiddlewareManager($oldPattern);
    }


    static public function post($pattern, $callback) 
    {
        # code...
        // a/{id}
        $oldPattern = $pattern;
        if(!is_string($pattern)) {
            throw new InvalidArgumentException('Route pattern arg expected to be string, given ' . gettype($pattern));
        }

        

        if(strlen($pattern) === 0) {
            throw new InvalidArgumentException('Wrong string length provided');
        }

        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $exploded_path = explode('/', trim($path, '/'));
        $exploded_pattern = explode('/', trim($pattern, '/'));
        $placeholders = [];
        for($i = 0; $i < count($exploded_pattern); $i++) {
            if(isset($exploded_path[$i]) && $exploded_path[$i] !== '') {
                $exploded_pattern[$i] = preg_replace('/\{\w*\}/', $exploded_path[$i], $exploded_pattern[$i], -1, $count);
                if($count > 0) {
                    $placeholders[] = $exploded_path[$i];
                }
            }
        }
        $pattern = '/' . implode('/', $exploded_pattern);
        $path = '/' . implode('/', $exploded_path);
        if($path === $pattern && $_SERVER['REQUEST_METHOD'] === strtoupper(__FUNCTION__)) {
            self::$path = $pattern;
            $callback(...$placeholders);
        }
        // echo 
        return new MiddlewareManager($oldPattern);

    }
}