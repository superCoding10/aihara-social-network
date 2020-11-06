<?php
namespace Aihara\Routing;
use Aihara\Middleware\Middleware;
use Aihara\Routing\Router;

class RouterManager extends Router {

    private $currentPage;
    private static $names = [];
    private $method;
    public static function getName($name) {
        return isset(self::$names[$name]) ? self::$names[$name] : false;
    }

    public function __construct($currentPage, $method) {
        $this->currentPage = $currentPage;
        $this->method = strtoupper($method);
    }


    public function middleware($middleware)
    {
        # code...
        // echo Router::$method;
        if($this->currentPage === url('path') && $this->method === $_SERVER['REQUEST_METHOD']) {
            (new Middleware($middleware))->handle();
        }
        return new RouterManager($this->currentPage, $this->method);
    }

    public function name($name)
    {
        # code...



        self::$names[$name] = url('domain') . '/' . $name;
        return new RouterManager($this->currentPage, $this->method);
    }
}