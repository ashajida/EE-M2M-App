<?php

require_once __DIR__ . '/CircuitBoardStatus.php';


class CircuitBoardDbh
{
	/**
	 * this is the database class
	 *
	 * @var Database
	 */
    private $db;

    public function __construct($container)
    {
        $this->db = $container->get('Database');
    }

    public function updateBoardStatus($msisdn, $status)
    {
		$query = 'UPDATE board_status SET switchOne = :switchOne, switchTwo = :switchTwo,
		switchThree = :switchThree, switchFour = :switchFour, fan = :fan, 
		temperature = :temperature, keypad = :keypad, date = :date,
		msisdn = :msisdn WHERE id = :id';

		try 
		{
			$this->db->prepare($query);

			$this->db->bind(':switchOne', $status->getSwitchOne(), 'STR');
			$this->db->bind(':switchTwo', $status->getSwitchTwo(), 'STR');
			$this->db->bind(':switchThree', $status->getSwitchThree(), 'STR');
			$this->db->bind(':switchFour', $status->getSwitchFour(), 'STR');
			$this->db->bind(':fan', $status->getFan(), 'STR');
			$this->db->bind(':keypad', $status->getKeypad(), 'INT');
			$this->db->bind(':temperature', $status->getTemperature(), 'INT');
			$this->db->bind(':date', $status->getDate()->format(DB_DATE_FORMAT), 'STR');
			$this->db->bind(':id', 3, 'INT');
			$this->db->bind(':msisdn', $msisdn, 'STR');
			
			$this->db->execute();


		} catch (PDOException $e) 
		{
			//Throw Exception
			
		}
    }

    public function getCircuitBoardStatus()
    {
		$query = 'SELECT * FROM board_status WHERE msisdn = :msisdn';
		$status = null;
		
		try
		{
			$this->db->prepare($query);

			$this->db->bind(':msisdn', '447817814149', 'STR');

			$this->db->execute();

			$result = $this->db->getSingleData();

			$format_date = DateTime::createFromFormat(DB_DATE_FORMAT, $result['date']);
			
			$date = $format_date->format(DB_DATE_FORMAT);
			$switchOne = $result['switchOne'];
			$switchTwo = $result['switchTwo'];
			$switchThree = $result['switchThree'];
			$switchFour = $result['switchFour'];
			$fan = $result['fan'];
			$temperature = $result['temperature'];
			$keypad = $result['keypad'];

	
			$status = new CircuitBoardStatus($date,
			$switchOne, $switchTwo, $switchThree, $switchFour,
			$fan, $temperature, $keypad);

			return $status;

		}
		catch (PDOException $e)
		{
			echo $e->Message();
		}
    } 

}