<?php

/**
 * @package M2Mclass
 * @author Ashraf Ajida 
 */

class M2MConsumer 
{

    /**
     * soap object
     *
     * @var SoapClient
     */
    private $client_obj;

    public function __construct()
    {
        $this->client_obj = null;
    }

    public function __destruct()
    {}
    
    /**
     * this methods creates a new instances of SoapClient
     * @method $createSoapClient
     * @return SoapCleint
     */
    public function createSoapClient($wsdl, $options)
    {
        try {

            return $this->client_obj = new SoapClient($wsdl, $options);

        } catch(SoapFault $fault)
        {
            //Throw Exception
        }
        

    }

    /**
     * this function retrieves the unread messages from the M2M server
     * @param string $username this is the username for the M2M sever
     * @param string $password this is the password for the M2M server
     * @param int $count this is the limit of return message from m2m
     * @return array
     */

    public function getMessages($username, $password, $count)
    {
        return $this->client_obj->peekMessages($username, $password,$count);
    }

    /**
     * gets delivery report from m2m server
     *
     * @param string $username
     * @param string $password
     * @param string $msisdn
     * @param string $country_code
     * @param string $date
     * @param DateTime $time
     * @return array
     */
    public function getDeliveryReport($username, $password, $msisdn, $country_code, $date, $time)
    {
        return $this->client_obj->getDeliveryReportsFromDate($username, $password,
        $msisdn,
        $country_code,
        $date,
        $time);
    }

    /**
     * sends a message to a chosen msisdn
     *
     * @param string $username
     * @param string $password
     * @param string $msisdn
     * @param string $message
     * @return method
     */
    public function sendMessage($username, $password, $msisdn, $message)
    {
        return $this->client_obj->sendMessage($username, $password, $msisdn, $message); 
    }
    
}