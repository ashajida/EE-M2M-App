<?php

/**
 * @package Controller
 * @author Ashraf Ajida 
 */


require_once 'Controller.php';

require_once './models/Validator.php';


class UpdateStatus extends Controller
{

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
		$messages = $this->soap_client_obj->getMessages();

		foreach ($messages as $message) {

            $this->xml_parser->parse($message);
            
			$parsedMessage = $this->xml_parser->getParsedData();

            $validator = new Validator($parsedMessage);
      
			try {

                $msisdn = $validator->validateMSISDN();
                
                $status = $validator->validateStatus();

				// $information = $database->queryBoardInformation($msisdn);

				// $update = new CircuitBoard($information, $status);

                // $database->updateBoardStatus($msisdn, $status);
                
				// $this->model->addUpdate($update);
			} catch (Exception $e) {
				continue;
			}
		}

      
    }
}