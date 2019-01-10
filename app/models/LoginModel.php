<?php

/**
 * Login Model
 * @author Ashraf Ajida
 */

require_once __DIR__ . '/UserModel.php';

class LoginModel
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




    public function __construct()
    {
       $this->username = false;
       $this->password = false;
       $this->db = null;

    }

    /**
     * Handles the login process
     * @return Object $user
     * @param string $username user username
     * @param string $password user password
     * @param Object $db database object
     */

    public function loginUser($username, $password, $db)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;

        $user = null;

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
                echo "No records found"; 
            } 
            
            $result_username = filter_var($results['username'],  FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            $result_password = filter_var($results['password'],  FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

            $user = new UserModel($result_username, $result_password);

            return $user;
            
        } catch(Exception $e)
        {
            //Throw Exception
        }
        
    }
}