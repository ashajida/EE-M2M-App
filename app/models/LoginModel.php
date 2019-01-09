<?php

/**
 * Login Model
 * @author Ashraf Ajida
 */

require_once __DIR__ . '/UserModel.php';

class LoginModel
{

    /**
     * holds the username error string
     *
     * @var string
     */

    private $username_error;

    /**
     * holds the password error string
     *
     * @var string
     */

    private $password_error;

    public function __construct()
    {
       $this->username_error = false;
       $this->password_error = false;
    }

    /**
     * Handles the login process
     * @return Object $user
     * @param string $username user username
     * @param string $password user password
     * @param Object $db database object
     */

    public function userLogin($username, $password, $db)
    {
        $username = $username;
        $password = $password;
        $db = $db;
        $user = null;

        $query = 'SELECT * FROM users WHERE password = :password AND username = :username';

        try
        {
            $db->prepare($query);
            $db->bind(':username', $username, 'STR');
            $db->bind(':password', $password, 'STR');
            $db->execute();

            $results = $db->getSingleData();

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