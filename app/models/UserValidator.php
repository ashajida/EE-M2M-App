<?php

/**
 * Login Controller
 * @author Ashraf Ajida
 */

 class UserValidator
 {

    private $username;
    private $password;

    public function __construct()
    {}

    private function checkValues($param, $name)
    {
        if(isset($param))
        {
            return $param;
        } else
        {
            new Exception('Param is not set');
        }
    }
    
    public function validateUsername($username)
    {
        $this->username = checkValues($username);

        return $this->username;

         
    }

    public function validatePassword($password)
    {
        $this->password = checkValues($password);

        return $this->password;

    }
 }