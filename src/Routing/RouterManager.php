<?php
namespace Aihara\Routing;
use Aihara\Middleware\Middleware;
use Aihara\Routing\Router;

class RouterManager extends Router {

    private $currentPage;
    private static $names = [];

    public static function getName($name) {
        return isset(self::$names[$name]) ? self::$names[$name] : false;
    }

    public function __construct($currentPage, $result) {
        $this->currentPage = $currentPage;
        $this->result = $result;
    }


    public function middleware($middleware)
    {
        # code...
        // echo Router::$method;
        if($this->currentPage === url('path') && $this->result === 'true') {
            (new Middleware($middleware))->handle();
        }
        return new RouterManager($this->currentPage, $this->result);
    }

    public function name($name)
    {
        # code...



        self::$names[$name] = url('domain') . '/' . $name;
        return new RouterManager($this->currentPage, $this->result);
    }
}