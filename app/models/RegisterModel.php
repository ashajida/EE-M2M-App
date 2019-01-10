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


    /**
     * libSodium wrapper class
     *
     * @var LibSodiumWrapper
     */
    private $libsodium;




    public function __construct($container)
    {
        $this->username = false;
        $this->password = false;
        $this->db = null;
        $this->doublicated_user = false;

        $this->libsodium = $container->get('LibSodiumWrapper');
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
        $this->username = $this->encrypt($this->libsodium, $username);
        $this->password = $this->hashValues($this->$bcrypt_wrapper, $password);
        
        $this->db = $db;


        $user = null;

        $query_insert_user = 'INSERT INTO users (username, password) VALUES (:username, :password)';
        $query_fetch_users = 'SELECT * FROM users WHERE password = :password AND username = :username';

        try{

            $this->db->prepare($query_fetch_users);
            $this->db->bind(':username', $this->username, 'STR');
            $this->db->bind(':password', $this->password, 'STR');
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

        } catch(Exception $e)
        {
            //Throw Exception
        }

    }

    public function IsUserInDatabase()
    {
        return $this->doublicated_user;
    }

    function encrypt($libsodium_wrapper, $cleaned_parameters)
    {
        $arr_encrypted = [];
        $arr_encrypted['encrypted_username_and_nonce'] = $libsodium_wrapper->encrypt($cleaned_parameters['sanitised_username']);
        $arr_encrypted['encrypted_email_and_nonce'] = $libsodium_wrapper->encrypt($cleaned_parameters['sanitised_email']);
        $arr_encrypted['encrypted_dietary_requirements_and_nonce'] = $libsodium_wrapper->encrypt($cleaned_parameters['sanitised_requirements']);

        return $arr_encrypted;
    }

    function encode($base64_wrapper, $encrypted_data)
    {
        $arr_encoded = [];
        $arr_encoded['encoded_username'] = $base64_wrapper->encode_base64($encrypted_data['encrypted_username_and_nonce']);
        $arr_encoded['encoded_email'] = $base64_wrapper->encode_base64($encrypted_data['encrypted_email_and_nonce']);
        $arr_encoded['encoded_requirements'] = $base64_wrapper->encode_base64($encrypted_data['encrypted_dietary_requirements_and_nonce']);
        return $arr_encoded;
    }

    function hashValues($bcrypt_wrapper, $arr_cleaned_params)
    {
        $arr_encoded = [];
        $arr_encoded['hashed_password'] = $bcrypt_wrapper->create_hashed_password($arr_cleaned_params['password']);
        return $arr_encoded;
    }
        
 }