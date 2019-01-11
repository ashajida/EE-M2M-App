<?php

/**
 * @package Controller
 * @author Ashraf Ajida 
 */


require_once __DIR__ . '/Controller.php';
require_once './models/Validator.php';
require_once './models/CircuitBoardStatus.php';


class UpdateStatus extends Controller
{

    public function __construct($container)
    {
        parent::__construct($container);
    }

    public function __destruct()
    {}

    public function index($request, $response, $args) 
    {
        $messages = $this->soap_client_obj->getMessages();
        $filtered_arr = array();

		foreach ($messages as $message) {

            $this->xml_parser->parse($message);

            $parsedMessage = $this->xml_parser->getParsedData();

            
            if($parsedMessage['GROUPID'] === '18-3110-AM')
            {
               $filtered_arr = $parsedMessage;
            }

            $validator = new Validator($filtered_arr);
            try 
            {
                $msisdn = $validator->validateMSISDN();
                $status = $validator->validateStatus();
                $this->circuit_board_dbh->updateBoardStatus($msisdn, $status);

            } catch(Exception $e)
            {
                continue;
            }
               
        }
        
        return $response->withRedirect('/soap_app/app');

      
    }
}