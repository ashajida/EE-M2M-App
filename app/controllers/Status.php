<?php

/**
 * @package Controller
 * @author Ashraf Ajida 
 */

class Status 
{
    private $view;
              
    public function __construct($container)
    {
        $this->view = $container->get('view');

    }

    public function __destruct()
    {}
        
    /**
     * @method $index
     * @param [object] $request
     * @param [object] $response
     * @param [array] $args
     */


    public function index($request, $response, $args) 
    {

        return $this->view->render($response, 'status.twig', [
            'title' => 'homepage',
            'fan' =>'',
            'temperature' => '',
            'switch1' => '',
            'switch2' => '',
            'switch3' => '',
            'switch4' => '',
            'keypad' => '',
        ]);
    }
}