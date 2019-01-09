<?php

$app->get('/', \HomeController::class . ':index');
$app->get('/update', \UpdateStatus::class . ':index');
$app->post('/login', \LoginController::class . ':login');
$app->get('/auth', \LoginController::class . ':index');




