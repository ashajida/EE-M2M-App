<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

session_start();

require '../vendor/autoload.php';

require __DIR__ . '/settings.php';

require __DIR__ . '/routes/bootstrap.php';



$app->run();



