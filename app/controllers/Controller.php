<?php

/**
 * abstract Controller class
 * @author Ashraf Ajida 
 */

class Controller
{
    /**
     * Twig templating
     * @var Twig
     */
    protected $view;

    /**
     * soap client for m2m
     *
     * @var SoapClient
     */
    protected $soap_client_obj;

    /**
     * circuit board database handle, handles all the query to the database
     *
     * @var CicuitBoardDbh
     */
    protected $circuit_board_dbh;

    /**
     * parses the xml array to the xmlParser
     *
     * @var XmlParser
     */
    protected $xml_parser;

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