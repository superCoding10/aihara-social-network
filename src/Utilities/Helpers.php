<?php

use Aihara\Server\Env;
use Aihara\Server\Csrf;
use Aihara\Http\Request;
use Aihara\Http\Response;
use Aihara\Routing\RouterManager;

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

function makeCsrf() {
    return Csrf::makeToken();
}

function getCsrf() {
    return Csrf::getToken();
}


function url($part = null) {
    switch ($part) {
        case 'protocol':
            return $_SERVER['REQUEST_SCHEME'];
        case 'scheme':
            return $_SERVER['REQUEST_SCHEME'] . '://';
        case 'host':
            return $_SERVER['HTTP_HOST'];
        case 'domain':
            return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        case 'uri':
            return $_SERVER['REQUEST_URI'];
        case 'path':
            return explode('?', $_SERVER['REQUEST_URI'])[0];
        case 'query':
            return $_SERVER['QUERY_STRING'];
        default:
            return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
}

function router($name) {
    return RouterManager::getName($name);
}