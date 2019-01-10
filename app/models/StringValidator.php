<?php

/**
 * String Validator
 * @author Ashraf Ajida
 */

 class StringValidator
 {

    /**
     * validated string
     *
     * @var string 
     */

    private $validatedString;

    public function __construct()
    {}
    

    /**
     * this function validates the string
     *
     * @param string $string
     * @return string
     */

    public function validateString($string)
    {

        if(!empty($string))
        {
            $this->validatedString = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        }  
        
        return $this->validatedString;
    }


 }