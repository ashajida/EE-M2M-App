<?php

require __DIR__ . '/controllers/home.php';
require __DIR__ . '/controllers/LoginController.php';
require __DIR__ . '/controllers/LogoutController.php';
require __DIR__ . '/controllers/RegisterController.php';
require __DIR__ . '/controllers/status.php';
require __DIR__ . '/controllers/UpdateStatus.php';
require __DIR__ . '/models/M2mConsumer.php';
require __DIR__ . '/models/database.php';
require __DIR__ . '/models/CircuitBoardDbh.php';
require __DIR__ . '/models/XmlParser.php';
require __DIR__ . '/models/StringValidator.php';
require __DIR__ . '/models/FormValidator.php';
require __DIR__ . '/models/LoginModel.php';
require __DIR__ . '/models/RegisterModel.php';
require __DIR__ . '/models/SessionWrapper.php';
require __DIR__ . '/models/SessionModel.php';


$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ], 
];

$container = new \Slim\Container($configuration);
$app = new \Slim\App($container);
$container = $app->getContainer();


//Twig settings
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/views/templates');

    // Instantiate and add Slim specific extension
    $view->addExtension(new Slim\Views\TwigExtension(
        $container->router, 
        $container->request->getUri()
    ));

    return $view;
};


//Constants
$wsdl = 'https://m2mconnect.ee.co.uk/orange-soap/services/MessageServiceByCountry?wsdl';

$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'circuit_board';

define('DBHOST', $db_host);
define('DBNAME', $db_name);
define('USERNAME', $db_username);
define('PASSWORD', $db_password);
define('WSDL', $wsdl);

define('SMS_IDENTIFIER', 'abc123'); 

define('TIMEZONE', 'UTC'); 
define('DATE_FORMAT', 'd/m/Y H:i:s');
define('DB_DATE_FORMAT', 'Y-m-d H:i:s');

define('M2M_MSISDN', '447817814149');




//Controller settings
$container['HomeController'] = function ($container) {
    return new Home($container);
};

$container['LoginController'] = function ($container) {
    return new Login($container);
};

$container['LogoutController'] = function ($container) {
    return new LogoutController($container);
};

$container['StatusController'] = function ($container) {
    return new Status($container);
};

$container['RegisterController'] = function ($container) {
    return new RegisterController($container);
};

$container['UpdateStatus'] = function ($container) {
    return new UpdateStatus($container);
};

$container['LoginController'] = function ($container) {
    return new LoginController($container);
};

$container['M2MConsumer'] = function ($container) {
    return new M2MConsumer();
};

//Models 
$container['Database'] = function ($container) {
    return new Database();
};

$container['CircuitBoardDbh'] = function ($container) {
    return new CircuitBoardDbh($container);
};

$container['XmlParser'] = function ($container) {
    return new XmlParser($container);
};

$container['StringValidator'] = function ($container) {
    return new StringValidator($container);
};

$container['FormValidator'] = function ($container) {
    return new FormValidator($container);
};


$container['SessionWrapper'] = function ($container) {
    return new SessionWrapper($container);
};


$container['SessionModel'] = function ($container) {
    return new SessionModel($container);
};


$container['LoginModel'] = function ($container) {
    return new LoginModel($container);
};

$container['RegisterModel'] = function ($container) {
    return new RegisterModel($container);
};





