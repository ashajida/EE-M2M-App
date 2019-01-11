<?php

/**
 * Registration class
 * @author Ashraf Ajida
 */

 class RegisterModel
 {

        /**
     * user username
     *
     * @var string
     */

    private $username;

    /**
     * user password
     *
     * @var string
     */

    private $password;

    /**
     * database object
     * @var Database
     */

    private $db;

    /**
     * booleen to show if users exists in the database
     *
     * @var bool
     */
    private $doublicated_user;


    public function __construct($container)
    {
        $this->username = false;
        $this->password = false;
        $this->db = null;
        $this->doublicated_user = false;

    }

    /**
     * Handles the login process
     * @return User $user
     * @param string $username user username
     * @param string $password user password
     * @param Database $db database object
     */

    public function registerUser($username, $password, $db)
    {
        
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_BCRYPT);

        $this->db = $db;


        $user = null;

        $query_insert_user = 'INSERT INTO users (username, password) VALUES (:username, :password)';
        $query_fetch_users = 'SELECT * FROM users WHERE username = :username';

        try{

            $this->db->prepare($query_fetch_users);
            $this->db->bind(':username', $this->username, 'STR');
            $this->db->execute();

            $results = $this->db->getSingleData();

            if($results['username'] === $this->username) 
            {
                $this->doublicated_user = true;

                return;

            } else {  

                $this->db->prepare($query_insert_user);
                $this->db->bind(':username', $this->username, 'STR');
                $this->db->bind(':password', $this->password, 'STR');
                $this->db->execute();

            }

        } catch(PDOException $e)
        {
            //Throw Exception
        }

    }

    public function IsUserInDatabase()
    {
        return $this->doublicated_user;
    }
        
 }