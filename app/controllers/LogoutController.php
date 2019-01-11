<?php

/**
 * logout controller class
 * @author Ashraf Ajida
 */

class LogoutController
{
    /**
     * Session wrapper class
     *
     * @var SessionWrapper
     */
    private $session_wrapper;


    /**
     * session model class
     *
     * @var SessionModel
     */
    private $session_model;


    public function __construct($container) 
    {
        $this->session_model =  $container->get('SessionModel');
        $this->session_wrapper =  $container->get('SessionWrapper');
    }

    public function __destruct()
    {}

    /**
     * this function logs the user out of the application
     *
     * @return method
     */
    public function logout($request, $response, $args)
    {
        $session_key_username = 'user_name';
        $session_key_password = 'password';

        $this->session_wrapper->unsetSession($session_key_username);
        $this->session_wrapper->unsetSession($session_key_password);

        return $response->withRedirect('/soap_app/app');
    }
}