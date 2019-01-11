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

    /**
     * @method $index
     * @param [object] $request
     * @param [object] $response
     * @param [array] $args
     */


    public function index($request, $response, $args) 
    {
		$messages = $this->soap_client_obj->getMessages();

		foreach ($messages as $message) {

            $this->xml_parser->parse($message);

            $parsedMessage = $this->xml_parser->getParsedData();

            print_r($parsedMessage);

            if($parsedMessage['GROUPID'] === '18-3110-AM')
            {
               $validator = new Validator($parsedMessage);
               $status = $validator->validateStatus();
               $this->circuit_board_dbh->updateBoardStatus('447817814149', $status);
              
            } else {
                echo 'NULL';
            }

        
           
                // try{
                // $msisdn = $validator->validateMSISDN();
                // } catch(Exception $e)
                // {

                // }
                
                
                

				// $information = $database->queryBoardInformation($msisdn);

				// $update = new CircuitBoard($information, $status);

                
                
				// $this->model->addUpdate($update);
			
        }
        
        return $response->withRedirect('/soap_app/app');

      
    }
}