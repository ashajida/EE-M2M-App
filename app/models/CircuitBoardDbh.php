<?php

require_once __DIR__ . '/CircuitBoardStatus.php';


class CircuitBoardDbh
{
    private $db;

    public function __construct($container)
    {
        $this->db = $container->get('Database');
    }


    public function queryAllBoardInformation()
	{
		$statement = $this->database->prepare('SELECT * FROM board_info');

		if ($statement === false) {
			throw new PrepareStatementException(__FUNCTION__);
		}

		if ($statement->execute() == false) {
			throw new ExecuteStatementException(__FUNCTION__);
		}

		$boards = array();

		foreach ($statement as $boardInformation) {
			$msisdn = $boardInformation['msisdn'];
			$name = $boardInformation['name'];
			$information = new CircuitBoardInformation($msisdn, $name);

			array_push($boards, $information);
		}

		return $boards;
	}

    public function updateBoardStatus($status)
    {
		try 
		{
			$query = 'REPLACE INTO board_status SET switchOne = :switchOne, switchTwo = :switchTwo,
			switchThree = :switchThreee, switchFour = :switchFour, fan = :fan, 
			temperature = :temperature, keypad = :keypad, date = :date,
			msisdn = :msisdn';

			$this->db->prepare($query);

			$this->db->bind(':switchOne', $status->getSwitchOne, 'INT');
			$this->db->bind(':switchTwo', $status->getSwitchTwo, 'INT');
			$this->db->bind(':switchThree', $status->getSwitchThree, 'INT');
			$this->db->bind(':switchFour', $status->getSwitchFour, 'INT');
			$this->db->bind(':fan', $status->getFan, 'INT');
			$this->db->bind(':keypad', $status->getKeypad, 'INT');
			$this->db->bind(':tempareture', $status->getTemperature, 'INT');
			$this->db->bind(':date', $status->getDate, 'INT');
			
			$this->db->execute();

		} catch (Exception $e) 
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

			$this->db->bind(':msisdn', '447818000000', 'STR');

			$this->db->execute();

			$result = $this->db->getSingleData();

			$date = '0000000';
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

			echo $status->getFan();

			return $status;

		}
		catch (Exception $e)
		{
			echo $e->Message();
		}
    } 

	public function fetchNotification()
	{

	}
}