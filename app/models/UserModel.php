<?php

/**
 * User Class
 * @author Ashraf Ajida
 */


class UserModel
{
    /**
     * username of a user
     * @var string 
     */

    private $username;

    /**
     * password of a user
     * @var string 
     */

    private $password;



    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * this method returns username
     * @method $getUsername 
     * @return string 
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



