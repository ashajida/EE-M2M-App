<?php

use PHPUnit\Framework\TestCase;

require_once './app/models/Database.php';


$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'circuit_board';

define('DBHOST', $db_host);
define('DBNAME', $db_name);
define('USERNAME', $db_username);
define('PASSWORD', $db_password);

class DatabaseTest extends TestCase
{
    protected $db;

    public function setup()
    {
        $this->db = new Database();
    }

    /**
     * @expectedException PDOException
     */
    public function testPdoPrepare()
    {
        $this->db->prepare();
    }

    public function testThatWeCanGetSingleDataFromDatabase()
    {
        $query = 'SELECT * FROM board_status';
        $this->db->prepare($query);
        $this->db->execute();
        $result = $this->db->getSingleData();

        $this->assertArrayHasKey('switchOne', $result);
        $this->assertArrayHasKey('switchTwo', $result);
        $this->assertArrayHasKey('switchThree', $result);
        $this->assertArrayHasKey('switchFour', $result);
        $this->assertArrayHasKey('keypad', $result);
        $this->assertArrayHasKey('temperature', $result);

        $expected_arr = [
            'switchOne' => 'ON',
            'switchTwo' => 'OFF',
            'switchThree' => 'OFF',
            'switchFour' => 'ON',
            'fan'  => 'FORWARD',
            'temperature' => 21,
            'date' => '2019-01-12 17:19:06',
            'keypad' => 3,
            'id' => 3,
            'msisdn' => '447817814149'
        ]; 

        $this->assertEquals($expected_arr['switchOne'], $result['switchOne']);
        $this->assertEquals($expected_arr['switchTwo'], $result['switchTwo']);
        $this->assertEquals($expected_arr['switchThree'], $result['switchThree']);
        $this->assertEquals($expected_arr['switchFour'], $result['switchFour']);
        $this->assertEquals($expected_arr['fan'], $result['fan']);
        $this->assertEquals($expected_arr['temperature'], $result['temperature']);
    }
    

}