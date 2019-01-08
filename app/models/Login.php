<?php

/**
 * Login Model
 * @author Ashraf Ajida
 */

require_once __DIR__ . '/User.php';

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


    public function __construct($username, $password, $db)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
    }

    /**
     * Handles the login process
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

            $results = $this->db->getSingleData();

            if(!$results < 0) 
            {

                echo "lol";
                

            } else
            {
                $this->user = new User($results['username'], $results['password']);

                return $this->user;
            }

            

        } catch(Exception $e)
        {
            //Throw Exception
        }
        
    }
}