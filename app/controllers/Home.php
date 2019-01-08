<?php

/**
 * @package Controller
 * @author Ashraf Ajida 
 */

require_once './models/CircuitBoard.php';
require_once 'Controller.php';

class Home extends Controller
{

    private $keypad;
    private $switch_one;
    private $switch_two;
    private $switch_three;
    private $fan;
    private $temp;

    public function __construct($container)
    {
        parent::__construct($container);
    }

    /**
     * @method $index
     * @param [object] $request
     * @param [object] $response
     * @param [array] $args
     */


    public function index($request, $response, $args) 
    {

        $status = $this->circuit_board_dbh->getCircuitBoardStatus();

        $SESSION['username'] = 'user1';

        if(!isset($SESSION['username']))
        {
            return $this->view->render($response, 'status.twig',[
                'keypad'    => $status->getKeypad(),
                'fan'       => $status->getFan(),
                'temp'      => $status->getTemperature(),
                's1'        => $status->getSwitchOne(),
                's2'        => $status->getSwitchTwo(),
                's3'        => $status->getSwitchThree(),
                's4'        => $status->getSwitchFour(),
            ]);
        } else {
            return $this->view->render($response, 'login.twig', [
        
            ]);
        }
        
    }

    /**
     * @method $send this function sends the Message to the M2M server
     * @param  $request
     * @param $response
     * @param $args
     */
    public function send($request, $response, $args)
    {
        $username = '18p2401696';
        $password = 'Myee2010';
        $phone_number = '+447817814149';

        $keypad = filter_var($request->getParam('keypad'), FILTER_SANITIZE_STRING);
        $switch_1 = filter_var($request->getParam('switch-1'), FILTER_SANITIZE_STRING);
        $switch_2 = filter_var($request->getParam('switch-2'), FILTER_SANITIZE_STRING);
        $switch_3 = filter_var($request->getParam('switch-3'), FILTER_SANITIZE_STRING);
        $fan = filter_var($request->getParam('fan'), FILTER_SANITIZE_STRING);
        $temperature = filter_var($request->getParam('temperature'), FILTER_SANITIZE_STRING);

        $message = '"
        <msg>
            <keypad>'.$keypad.'</keypad><s1>'.$switch_1.'</s1><s2>'.$switch_2.'</s2><s3>'.$switch_3.'</s3><fan>'.$fan.'</fan><temp>'.$temperature.'</temp>
        </msg> 
        "';

        return $this->client_obj->sendMessage($username, $password, $phone_number, $message);
    }

}