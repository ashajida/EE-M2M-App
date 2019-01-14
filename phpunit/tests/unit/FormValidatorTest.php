<?php

use PHPUnit\Framework\TestCase;

require_once './app/models/FormValidator.php';

class FormValidatorTest extends TestCase
{
    protected $form_validator;

    public function setup()
    {
        $this->form_validator = new FormValidator();
    }

    public function testThatWeCanValidateUsername()
    {
        $string = 'user_1';
        $validate_username = $this->form_validator->validateUsername($string);
        $this->assertContains(false, [$validate_username]);
    }

    public function testThatWeCanValidatePassword()
    {
        $string = '1234';
        $validate_password = $this->form_validator->validatePassword($string);
        $this->assertContains(false, [$validate_password]);
    }

    public function testPasswordLength()
    {
        $string = '12345678';
        $validate_password_len = $this->form_validator->validatePasswordLength($string);
        $this->assertContains(false, [$validate_password_len]);
    }
}