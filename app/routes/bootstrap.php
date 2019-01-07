<?php

$app->get('/', \HomeController::class . ':index');
$app->get('/sigin', \LoginController::class . ':index');
$app->post('/login', \LoginController::class . ':login');
$app->get('/update', \UpdateStatus::class . ':index');

// $app->get('/{status}', \StatusController::class . ':index');

// $app->get('/login', \LoginController::class . ':index');
// $app->get('/register', \HomeController::class . ':index');


