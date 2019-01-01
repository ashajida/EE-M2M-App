<?php

/**
 * @package M2Mclass
 * @author Ashraf Ajida 
 */

class M2MConsumer 
{
    /**@param {string} $fan this variable represent the fan on the telecom device */
    private $fan;

     /**@param {string} $temperature this variable represent the temperature on the telecom device */
    private $temperature;

    /**@param {string} $key_pad this variable represent the keypad on the telecom device */
    private $key_pad;

    /**@param {string} $four_switches this variable represent the four switches on the telecom device */
    private $four_switches;

    /**@param $fan this variable is the SOAP client object */
    private $client_obj = null;

    public function __construct()
    {}
    
    /** 
    *@method $setDeviceStatus this function set the status of the device
    *@param {string} $fan this is the status of the fan on/off
    *@param {string} $power this is status of the power on/off
    *@param {string} $number the number that is dailed
    */
    public function setDeviceStatus($fan, $temperature, $four_switches, $key_pad)
    {} 

    /**
     * @method $creatSoapClient
     * @return $client_obj
     */
    public function createSoapClient($wsdl, $options)
    {
        // $client_obj = null; 
        return $this->client_obj = new SoapClient($wsdl, $options);

    }

    /**
     * @method $sendMessage this function sends a message to the server
     * @param {string} $username this parameter is the username for the M2M server
     * @param {string} $password this parameter is the password for the M2M server
     * @param {string} $phone_number this parameter is the phone number of the M2M server
     * @param {string} $message this parameter is the message which going to be sent.
     * @param {bool} $delivery_report this shows whether there should be a delivery report for the message
     * @property {string} $message_type this is the type of the message SMS/GPS/RGPS
     * @return $client_obj
     */
    public function sendMessage(string $username, string $password, string $phone_number, string $message) 
    {

        return $this->client_obj->sendMessage(
            $username,
            $password,
            $phone_number,
            $message,
            true,
            'SMS'
         );

    }

    /**
     * @method $getMessage this function retrieves the unread messages from the M2M server
     * @param {string} $username this is the username for the M2M sever
     * @param {string} $password this is the password for the M2M server
     */

    public function getMessages()
    {
        //Validate all message from the server
        //store message in a database
        //display device state eg switches, heater
        $username = '18p2401696';
        $password = 'Myee2010';
        $count = 15;

        return $this->client_obj->peekMessages( 
            $username, 
            $password,
            $count
        );
    
    }

    public function deliveryReport()
    {}

    
}