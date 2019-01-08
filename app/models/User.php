<?php

/**
 * User Class
 * @author Ashraf Ajida
 */


class User
{
    /**
     * @var string $username username of a user
     */

    private $username;

    /**
     * @var string $password password of a user
     */

    private $password;



    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @method $getUsername this method returns username
     * @return string $username return username
     */

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @method $getPassword this methods return password
     * @return string $password returns password
     */

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @method $setUsername this method sets the username
     * 
     */

    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @method $setPassword this method sets the password
     * 
     */

    public function setPassword($password)
    {
        $this->password = $password;
    }
}



