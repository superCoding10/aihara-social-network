<?php



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Credentials: true');
use App\App;
header('Set-Cookie: key=value;SameSite=none;Secure');
var_dump($_COOKIE);
ini_set('display_errors', 'On');
define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

App::start();
