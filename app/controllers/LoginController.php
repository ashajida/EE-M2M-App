<?php

/**
 * Login Controller
 * @author Ashraf Ajida
 */


require_once __DIR__ . '/Controller.php';
require_once './models/Login.php';


class LoginController extends Controller
{

    private $db;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->db = $container->get('Database');
    }

    public function index($request, $response, $args) 
    {}

    public function login($request, $response, $args)
    {
        $login_handler = null;
        $session_handler = null;
        $user_validator = null;

        // $user_validator = new UserValidator();
        $username = filter_var($request->getParam('username'), FILTER_SANITIZE_STRING);
        $password = filter_var($request->getParam('password'), FILTER_SANITIZE_STRING);

        $login_handler = new Login($username, $password, $this->db);
        $user = $login_handler->userLogin();

        // return $response->withRedirect('/soap_app/app');

    }

}