<?php

/**
 * form validation
 * @author Ashraf Ajida
 */

class FormValidator
{
    /**
     * booleen to show if username is validated
     *
     * @var string
     */
    private $is_username_validated;

    /**
     * booleen to show if password is validated
     *
     * @var string
     */
    private $is_password_validated;

    /**
     * booleen to show if password is the correct length
     * @var string
     */
    private $is_password_len_validated;

    public function __construct()
    {
        $this->is_username_validated = false;
        $this->is_password_validated = false;
        $this->is_password_len_validated = false;
    }

    /**
     * this function validates username input
     *
     * @param string $string_to_validate
     * @return bool
     */
    public function validateUsername($string_to_validate)
    {
        if(empty($string_to_validate))
        {
            $this->is_username_validated = true;

            return $this->is_username_validated;
        }
    }

    /**
     * this function validates password input
     *
     * @param string $string_to_validate
     * @return bool
     */
    public function validatePassword($string_to_validate)
    {
        if(empty($string_to_validate))
        {
            $this->is_password_validated = true;

            return $this->is_password_validated;
        } 

    }

    public function validatePasswordLength($string_to_validate)
    {
        if(!empty($string_to_validate))
        {
            if(strlen($string_to_validate) < 8)
             {
                $this->is_password_len_validated = true;

                return $this->is_password_len_validated;
             }
        }
    }


}