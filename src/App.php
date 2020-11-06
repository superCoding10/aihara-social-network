<?php

namespace Aihara;

use Aihara\Database\DB;
use Aihara\Routing\Router;
use PDO;

class App {
    public static function start() {
        if(!session_id()) {
            session_start();
        }

        removeTmpValues($_SESSION);

        filterSession();

        require INC_ROOT . '/route/Router.php';

        
        DB::connection([PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
        Router::terminate();



    }
}

