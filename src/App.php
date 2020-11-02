<?php

namespace App;

use App\Database\DB;
use App\Middleware\Middleware;
use App\Routing\Router;
use PDO;

class App {
    public static function start() {
        // if(!session_id()) {
        //     session_start();
        // }



        // setcookie('z', 'y');

        // if(empty(session('csrf_token'))) {
        //     session('csrf_token', bin2hex(random_bytes(32)));
        // }


        // foreach($_SESSION as $name => $value) {
        //     if(isset($_SESSION[$name]['removeAfterReload']) && $_SESSION[$name]['removeAfterReload']) {
        //         unset($_SESSION[$name]);
        //     }
        // }

        // require INC_ROOT . '/route/Router.php';
        
        // Middleware::start();
        // Router::terminate();


        // DB::connection([PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);



    }
}

