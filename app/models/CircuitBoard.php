<?php
class CircuitBoard
{
    private $status; 
    
    public function __construct($circuit_board_status)
    {
        $this->status = $circuit_board_status;
    }

    public function getStatus()
    {
        return $this->status;
    }

}