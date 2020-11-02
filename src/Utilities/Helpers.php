<?php

use App\Server\Env;
use App\Http\Request;
use App\Http\Response;


function dd($value) {
    echo '<code>';
    var_dump($value);
    echo '</code>';
}

function request() {
    return new Request;
}

function response() {
    return new Response;
}

function env($name) {
    return Env::get($name);
}

function session($name = null, $value = null, $removeAfterReload = false) {
    if($name && ! is_null($value)) {
        if(! is_bool($removeAfterReload)) {
            throw new InvalidArgumentException('Argument 3 expected to be of type boolean; provided ' . gettype($removeAfterReload));
        }
        $_SESSION[$name] = ['value' => $value, 'removeAfterReload' => $removeAfterReload];
    } else if($name) {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name]['value'];
        }
        return false;
    }

    $session = $_SESSION;

    foreach($session as $name => $value) {
        if(isset($session[$name]['removeAfterReload'])) {
            $session[$name] = $session[$name]['value'];
        }
    }

    return $session;
}