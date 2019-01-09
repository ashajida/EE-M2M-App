<?php

/**
 * Login Validator
 * @author Ashraf Ajida
 */

 class LoginValidator
 {

    private $validatedString;

    public function __construct()
    {}
    
    public function validateString($string)
    {

        if(!empty($string))
        {
            $this->validatedString = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        }  
        
        return $this->validatedString;
    }


 }