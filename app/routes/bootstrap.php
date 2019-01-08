<?php

$app->get('/', \HomeController::class . ':index');
$app->get('/update', \UpdateStatus::class . ':index');
$app->post('/auth/login', \LoginController::class . ':login');




