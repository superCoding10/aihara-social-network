<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

header('Set-Cookie: a=b; SameSite=none; Secure');

$app->get('/', function (Request $request, Response $response, $args) {
    return $response;
});

$app->run();