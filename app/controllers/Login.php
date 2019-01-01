<?php

class Login 
{
    private $view;

    public function __construct($container)
    {
        $this->view = $container->get('view');
    }

    public function index($request, $response, $args) 
    {

        return $this->view->render($response, 'login.twig', [
            'name' => 'ash'
        ]);
    }

}