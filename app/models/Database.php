<?php

class Database 
{
    private $dbh = null;
    private $options = array();
    private $hostname;
    private $stmt;
    
    
    public function __construct()
    {
        $dns = 'mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8';

        $options = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        );

        try {
            $this->dbh = new PDO($dns, USERNAME, PASSWORD, $options);
        } catch(PDOException $exception)
        {
            //Throw Exception
        }
    }

    public function __destruct()
    {}


    public function getMultipleData()
    {

        $results = $this->stmt->fetch(PDO::FETCH_ASSOC);

        foreach($results as $result)
        {
            echo $result;
        }

    }

    public function getSingleData()
    {

        $results = $this->stmt->fetch(PDO::FETCH_ASSOC);

        return $results;

    }

    public function update($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    public function prepare($query)
    {
        $this->stmt = $this->dbh->prepare($query);
        
    }

    public function execute()
    {
        return  $this->stmt->execute();
    }
    
    public function bind($param, $value, $type = null)
    {
        $param_type = '';
        
        switch($type)
        {
            case 'INT':
            $param_type = PDO::PARAM_INT;
            break;
            case 'BOOL':
            $param_type = PDO::PARAM_BOOL;
            break;
            case 'STR':
            $param_type = PDO::PARAM_STR;
            break;
            case 'DATE':
            $param_type = PDO::PARAM_STR;
            break;
            default:
            $param_type = PDO::PARAM_STR;
        }

        //get data from a foreach loop and bind params
        return $this->stmt->bindParam($param, $value, $param_type);
    }

}