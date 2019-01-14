<?php

use PHPUnit\Framework\TestCase;

require_once './app/models/CircuitBoardStatus.php';

class CircuitBoardStatusTest extends TestCase
{
    protected $circuit_board_status;

    public function setup()
    {
        $date = '2019-01-12 17:19:06';
        $switchOne = 'ON';
        $switchTwo = 'ON';
        $switchThree = 'OFF';
        $switchFour = 'ON';
        $fan = 'FORWARD';
        $temperature = 12;
        $keypad = 21;

        $this->circuit_board_status = new CircuitBoardStatus($date, $switchOne, $switchTwo, $switchThree, $switchFour, $fan, $temperature, $keypad);
    }

    public function testThatWeCanGetDate()
    {
        $date = '2019-01-12 17:19:06';
        $this->assertEquals($date, $this->circuit_board_status->getDate());
    }

    public function testThatWeCanGetSwitchOne()
    {
        $switchOne = 'ON';
        $this->assertEquals($switchOne, $this->circuit_board_status->getSwitchOne());
    }

    public function testThatWeCanGetSwitchTwo()
    {
        $switchTwo = 'ON';
        $this->assertEquals($switchTwo, $this->circuit_board_status->getSwitchTwo());
    }

    public function testThatWeCanGetSwitchThree()
    {
        $switchThree = 'OFF';
        $this->assertEquals($switchThree, $this->circuit_board_status->getSwitchThree());
    }

    public function testThatWeCanGetSwitchFour()
    {
        $switchFour = 'ON';
        $this->assertEquals($switchFour, $this->circuit_board_status->getSwitchFour());
    }

    public function testThatWeCanGetFan()
    {
        $fan = 'FORWARD';
        $this->assertEquals($fan, $this->circuit_board_status->getFan());
    }

    public function testThatWeCanGetTemperature()
    {
        $temperature = 12;
        $this->assertEquals($temperature, $this->circuit_board_status->getTemperature());
    }

    public function testThatWeCanGetKeypad()
    {
        $keypad = 21;
        $this->assertEquals($keypad, $this->circuit_board_status->getKeypad());
    }

}