<?php

/**
 * @package Controller
 * @author Ashraf Ajida 
 */

require_once './models/CircuitBoard.php';
require_once 'Controller.php';

class Home extends Controller
{

    private $session_wrapper;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->session_wrapper = $container->get('SessionWrapper');
    }

    public function index($request, $response, $args) 
    {

        // if(!isset($_SESSION))
        // {
        //  return $response->withRedirect('/soap_app/app/auth'); 
        // }

        $status = $this->circuit_board_dbh->getCircuitBoardStatus();

        return $this->view->render($response, 'status.twig',[
            'keypad'    => $status->getKeypad(),
            'fan'       => $status->getFan(),
            'temp'      => $status->getTemperature(),
            's1'        => $status->getSwitchOne(),
            's2'        => $status->getSwitchTwo(),
            's3'        => $status->getSwitchThree(),
            's4'        => $status->getSwitchFour(),
            'username'  => $_SESSION['user_name']
        ]);
        
    }

}