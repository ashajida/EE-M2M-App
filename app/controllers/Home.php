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
    private $libchart_wrapper;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->session_wrapper = $container->get('SessionWrapper');
        $this->libchart_wrapper = $container->get('LibchartWrapper');
    }

    public function __destruct()
    {}

    public function index($request, $response, $args) 
    {
 
        if(!isset($_SESSION['user_name']))
        {
         return $response->withRedirect('/soap_app/app/login'); 
        }

        $status = $this->circuit_board_dbh->getCircuitBoardStatus();

        $chart_title = 'Temperature';
        $data = $status->getTemperature();
        $location = '../public/images/temp.png';
        $main_title = 'Temperature Chart';

        $this->libchart_wrapper->setChartData($chart_title, $data);
        $this->libchart_wrapper->setTitle($main_title);
        $this->libchart_wrapper->render($location);

        return $this->view->render($response, 'status.twig',[
            'keypad'        => $status->getKeypad(),
            'fan'           => $status->getFan(),
            'temp'          => $status->getTemperature(),
            's1'            => $status->getSwitchOne(),
            's2'            => $status->getSwitchTwo(),
            's3'            => $status->getSwitchThree(),
            's4'            => $status->getSwitchFour(),
            'last_updated'  => $status->getDate(),
            'username'      => $_SESSION['user_name'],
            'title'         => APP_NAME,
            'css'           => './views/css/styles.css',
            'js'            => 'js/app.js',
            'chart'         => '../public/images/temp.png',
            'home'          => 'index.php',
            'update'        => 'index.php/update',
            'logout'        => 'logout'
        ]);
        
    }

}