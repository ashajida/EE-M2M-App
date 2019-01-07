<?php

/**
 * Login Model
 * @author Ashraf Ajida
 */


class Login
{
    /**
     * @var Object $user the user object
     */

    private $user;

    /**
     * @var string $username the user username
     */

    private $username;

    /**
     * @var string $password the user password
     */

    private $password;

    /**
     * @var object $db the database object
     */

    private $db;


    public function __construct($user, $username, $password, $db)
    {
        $this->user = $user;
        $this->db = $db;
    }

    /**
     * @return Object $user
     */

    public function userLogin()
    {
        $query = 'SELECT * FROM users WHERE password = :password AND username = :username';

        try
        {
            $this->db->prepare($query);
            $this->db->bind(':username', $this->username, 'STR');
            $this->db->bind(':password', $this->password, 'STR');
            $this->db->execute();

            $results = $this->db->getMultipleData();

            if(!$results < 0) 
            {

                die();

            } else
            {
                $this->user = new User($result['username'], $result['password']);

                return $this->user;
            }

            

        } catch(Exception $e)
        {
            //Throw Exception
        }
        
    }
}