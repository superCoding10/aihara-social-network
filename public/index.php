<?php
ini_set('display_errors', 'On');
define('INC_ROOT', dirname(__DIR__));
require INC_ROOT . '/vendor/autoload.php';

use Aihara\App;
use Aihara\database\Model;
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

App::start();

