<?php

$app->get('/', \HomeController::class . ':index');
$app->get('/update', \UpdateStatus::class . ':index');
$app->post('/login', \LoginController::class . ':login');
$app->get('/login', \LoginController::class . ':index');
$app->get('/logout', \LogoutController::class . ':logout');
$app->get('/register', \RegisterController::class . ':index');
$app->post('/register', \RegisterController::class . ':register');




