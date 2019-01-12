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
        $count = 180;

        $messages = $this->soap_client_obj->getMessages(M2M_USERNAME, M2M_PASSWORD, $count);
        $filtered_arr = array();

		foreach ($messages as $message) {

            $this->xml_parser->parse($message);

            $parsed_message = $this->xml_parser->getParsedData();

            if($parsed_message['GROUPID'])
            {
                if($parsed_message['GROUPID'] === '18-3110-AM')
                {
                    $filtered_arr = $parsed_message;
                }
            }


            $validator = new Validator($filtered_arr);

            $status = $validator->validateStatus();
                
            $this->circuit_board_dbh->updateBoardStatus(M2M_MSISDN, $status); 
            

            //send a message that a new update has been recieved
               
        }
        
        return $response->withRedirect('/soap_app/app');

    }

private function fetchDeliveryReport($msisdn, $date_time)
    {
        $delivery_report = $this->soap_client_obj->getDeliveryReport(M2M_USERNAME, M2M_PASSWORD, $msisdn, $date_time);
        $sendMessage = null;
        $message = false;

        foreach ($delivery_report as $message) {

            $this->xml_parser->parse($message);

            $parsedMessage = $this->xml_parser->getParsedData();

            print_r($message);

            $message = "<msg>message delivered</msg>";
            $sendMessage = $this->soap_client_obj->sendMessage(M2M_USERNAME, M2M_PASSWORD, $msisdn, $message);

            if($parsedMessage['GROUPID'])
            {
                if($parsedMessage['GROUPID'] === '18-3110-AM')
                {
                    $message = "<msg>message delivered</msg>";
                    $sendMessage = $this->soap_client_obj->sendMessage(M2M_USERNAME, M2M_PASSWORD, $msisdn, $message);
                }
            }
        }
    }
}