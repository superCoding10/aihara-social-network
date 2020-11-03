<?php

namespace Aihara;

use Aihara\Database\DB;
use Aihara\Middleware\Middleware;
use Aihara\Routing\Router;
use PDO;

class App {
    public static function start() {
        if(!session_id()) {
            session_start();
        }




        // if(empty(session('csrf_token'))) {
            
        // }


        foreach($_SESSION as $name => $value) {
            if(isset($_SESSION[$name]['removeAfterReload']) && $_SESSION[$name]['removeAfterReload']) {
                unset($_SESSION[$name]);
            }
        }

        require INC_ROOT . '/route/Router.php';
        
        // Middleware::start();
        Router::terminate();


        DB::connection([PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);



    }
}

