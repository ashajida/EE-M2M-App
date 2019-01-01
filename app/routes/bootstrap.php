<?php

$app->get('/', \HomeController::class . ':index');
$app->post('/{send}', \HomeController::class . ':send');
// $app->get('/{status}', \StatusController::class . ':index');
$app->get('/{update}', \UpdateStatus::class . ':index');
// $app->get('/login', \LoginController::class . ':index');
// $app->get('/register', \HomeController::class . ':index');


