<?php

class Register 
{
    private $view;

    public function __construct($container)
    {
        $this->view = $container->get('view');
    }

    public function index($request, $response, $args) 
    {

        return $this->view->render($response, 'register.twig', [
            'name' => 'ash',
            'title' => 'Register',
            'login_page' => '/login'
        ]);
    }

}