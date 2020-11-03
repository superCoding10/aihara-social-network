<?php
ini_set('display_errors', 'On');
define('INC_ROOT', dirname(__DIR__));
echo INC_ROOT;
require INC_ROOT . '/vendor/autoload.php';

use Aihara\App;

// echo __NAMESPACE__;


App::start();
