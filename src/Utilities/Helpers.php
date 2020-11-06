<?php

use Aihara\Config;
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


function removeTmpValues(&$arr) {
    foreach($arr as $key => &$value) {
        if(is_array($value)) {
            removeTmpValues($value);
        }
        if($key[0] === '!') {
            unset($arr[$key]);
        }
    }
}

function filterSession() {
    filterTmpValuesFromSession($_SESSION);
    filterTmpValuesFromSession($_SESSION);
}

function filterTmpValuesFromSession(&$arr) {
    $arr = array_filter($arr);
    foreach($arr as $key => &$value) {
        if(is_array($value)) {
            filterTmpValuesFromSession($value);
        }
    }
}



function session($name = null, $value = null, $removeAfterReload = false) {

        $parts = explode('.', $name);
        switch (count($parts)) {
            case 1:
                if(!is_null($name) && !is_null($value)) {
                    if($value === '') {
                        unset($_SESSION[$parts[0]]);
                        return true;
                    }
                    $session = $_SESSION;
                    $session[$removeAfterReload ? '!' . $parts[0] : $parts[0]] = $value;
                    $_SESSION = $session;
                } else if(!is_null($name)) {
                    if(isset($_SESSION[$parts[0]])) {
                        return $_SESSION[$parts[0]];
                    } else if( $_SESSION['!' . $parts[0]]) {
                        return $_SESSION['!' . $parts[0]];
                    } else {
                        return false;
                    }
                }

            break;
            case 2:
                # code...
                if(!is_null($name) && !is_null($value)) {
                    if($value === '') {
                        unset($_SESSION[$parts[0]][$parts[1]]);
                        return true;
                    }
                    $session = $_SESSION;
                    $session[$parts[0]][$removeAfterReload ? '!' . $parts[1] : $parts[1]] = $value;;
                    $_SESSION = $session;
                } else if(!is_null($name)) {
                    if(isset($_SESSION[$parts[0]][$parts[1]])) {
                        return $_SESSION[$parts[0]][$parts[1]];
                    } else if(isset($_SESSION[$parts[0]]['!' . $parts[1]])) {
                        return $_SESSION[ $parts[0]]['!' . $parts[1]];
                    } else {
                        return false;
                    }
                }

            break;
            case 3:
                # code...
                if(!is_null($name) && !is_null($value)) {
                    if($value === '') {
                        unset($_SESSION[$parts[0]][$parts[1]][$parts[2]]);
                        return true;
                    }
                    $session = $_SESSION;
                    $session[$parts[0]][$parts[1]][$removeAfterReload ? '!' . $parts[2] : $parts[2]] = $value;
                    $_SESSION = $session;
                } else if(!is_null($name)) {
                    // if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]])) {
                    //     return $_SESSION[$parts[0]][$parts[1]][$parts[2]];
                    // } else {
                    //     return false;
                    // }
                    if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]])) {
                        return $_SESSION[$parts[0]][$parts[1]][$parts[2]];
                    } else if(isset($_SESSION[$parts[0]][$parts[1]]['!' . $parts[2]])) {
                        return $_SESSION[ $parts[0]][$parts[1]]['!' . $parts[2]];
                    } else {
                        return false;
                    }
                }
            break;
            case 4:
                if(!is_null($name) && !is_null($value)) {
                    if($value === '') {
                        unset($_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]]);
                        return true;
                    }
                    $session = $_SESSION;
                    $session[$parts[0]][$parts[1]][$parts[2]][$removeAfterReload ? '!' . $parts[3] : $parts[3]] = $value;
                    $_SESSION = $session;
                } else if(!is_null($name)) {
                    // if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]])) {
                    //     return $_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]];
                    // } else {
                    //     return false;
                    // }
                    if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]])) {
                        return $_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]];
                    } else if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]]['!' . $parts[3]])) {
                        return $_SESSION[ $parts[0]][$parts[1]][$parts[2]]['!' . $parts[3]];
                    } else {
                        return false;
                    }
                }
            break;
            case 5:
                # code...
                if(!is_null($name) && !is_null($value)) {
                    if($value === '') {
                        unset($_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]]);
                        return true;
                    }
                    $session = $_SESSION;
                    $session[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$removeAfterReload ? '!' . $parts[4] : $parts[4]] = $value;
                    $_SESSION = $session;
                } else if(!is_null($name)) {
                    // if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]])) {
                    //     return $_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]];
                    // } else {
                    //     return false;
                    // }
                    if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]])) {
                        return $_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]][$parts[4]];
                    } else if(isset($_SESSION[$parts[0]][$parts[1]][$parts[2]][$parts[3]]['!' . $parts[4]])) {
                        return $_SESSION[ $parts[0]][$parts[1]][$parts[2]][$parts[3]]['!' . $parts[4]];
                    } else {
                        return false;
                    }
                }
            break;
            default:
                throw new InvalidArgumentException('Too deep key');
        }

        if(is_null($name) && is_null($value)) {
            // $_SESSION = format($_SESSION);
            return $_SESSION;
        }


}

function input($name) {
    if(isset($_SESSION['input'][$name])) {
        return $_SESSION['input'][$name];
    }
    return false;
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
function config($name) {
    return Config::get($name);
}

