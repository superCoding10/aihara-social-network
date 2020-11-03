<?php

namespace Aihara\Server;

class Csrf {

    private static $csrf_token;

    public static function makeToken() {
        self::$csrf_token = bin2hex(random_bytes(32));
        session('csrf_token',self::$csrf_token);
        return self::$csrf_token;
    }

    public static function getToken() {
        return self::$csrf_token;
    }
}