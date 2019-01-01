<?php

class Controller
{
    protected $view;
    protected $soap_client_obj = null;
    protected $circuit_board_dbh;
    protected $xml_parser = null;

    public function __construct($container)
    {
        $this->view = $container->get('view');
        $this->soap_client_obj = $container->get('M2MConsumer');
        $this->circuit_board_dbh = $container->get('CircuitBoardDbh');
        $this->xml_parser = $container->get('XmlParser');

        $options =  array(
            "trace" => 1, 
            "exception" => 0
        );

        $this->soap_client_obj->createSoapClient(WSDL, $options);
    }
}