<?php

namespace App\Server;


class Env {

    static private $env = [];
    static private $parsed = false;
    static public function get($name) {
        if(!self::$parsed) {
            $env_file_contents = file_get_contents('../.env');
            foreach(str_getcsv($env_file_contents, "\n") as $env_str) {
                $exploded_env_str = explode('=', $env_str);
                self::$env[$exploded_env_str[0]] = isset($exploded_env_str[1]) ? $exploded_env_str[1] : '';
            }
            self::$parsed = true;
        }


        if(isset(self::$env[$name])) {
            return self::$env[$name];
        }
        return false;
    }
}