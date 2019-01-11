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


    private $password_not_matched;

    private $is_user_not_found;




    public function __construct()
    {
       $this->username = false;
       $this->password = false;
       $this->db = null;

       $this->password_not_matched = false;
       $this->is_user_not_found = false;

    }

    /**
     * Handles the login process
     * @return Object 
     * @param string $username user username
     * @param string $password user password
     * @param Object $db database object
     */

    public function loginUser($username, $password, $db)
    {
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;

        $is_password_correct = false;

        $user = null;

        $query = 'SELECT * FROM users WHERE username = :username';

        try
        {
            $this->db->prepare($query);
            $this->db->bind(':username', $this->username, 'STR');
            $this->db->execute();

            $results = $this->db->getSingleData();

            if($results < 0) 
            {
                $this->is_user_not_found = true;

                return;

            } 

            $is_password_correct = password_verify($this->password, $results['password']);
           
            if(!$is_password_correct)
            {
                $this->password_not_matched = true;
                return;
            }
 
            $result_username = filter_var($results['username'],  FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
            $result_password = filter_var($results['password'],  FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

            $user = new UserModel($result_username, $result_password);

            return $user;
            
        } catch(PDOException $e)
        {
            //Throw Exception
        }
        
    }

    public function passwordNotMatchedInDatabase()
    {
        return $this->password_not_matched;
    }

    public function userNotFoundInDatabase()
    {
        return $this->is_user_not_found;
    }
}