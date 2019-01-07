<?php

/**
 * Login Controller
 * @author Ashraf Ajida
 */


require_once __DIR__ . '/Controller.php';


class LoginController extends Controller
{

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function index($request, $response, $args) 
    {

        return $this->view->render($response, 'login.twig', [
        
        ]);
    }

    public function login($request, $response, $args)
    {
        $username = filter_var($request->getParsed('username'), FILTER_SANITIZE_STRING);
        $password = filter_var($request->getParsed('password'), FILTER_SANITIZE_STRING);
    }

}