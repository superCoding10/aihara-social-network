<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

header('Set-Cookie: pass=none; Expires=Thu, 22 Oct 2020 16:00:00 GMT');

$app->get('/', function (Request $request, Response $response, $args) {
    return $response;
});

$app->run();
