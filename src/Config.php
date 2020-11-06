<?php
namespace Aihara;
class Config {
    private static $config;

    public static function get($name) {
        if(!self::$config) {
            self::$config = require INC_ROOT . '/application/config/app.php';
        }
        $parts = explode('.', $name);
        switch (count($parts)) {
            case 1:
                # code...
                return self::$config[$parts[0]] ?? false;
            case 2:
                # code...
                return self::$config[$parts[0]][$parts[1]] ?? false;
            case 3:
                # code...
                return self::$config[$parts[0]][$parts[1]][$parts[2]] ?? false;
            case 4:
                # code...
                return self::$config[$parts[0]][$parts[1]][$parts[2]][$parts[3]] ?? false;
            case 5:
                # code...
                return self::$config[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]] ?? false;
        }



        // return self::$config[]
        // name = validation.user_email
        // name = self::$config['validation']['user_email']
    }
}