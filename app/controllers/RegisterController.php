<?php

/**
 * Register Controller
 * @author Ashraf Ajida
 */


require_once __DIR__ . '/Controller.php';

class RegisterController extends Controller
{

    /**
     * database object
     * @var Database
     */

    private $db;

    /**
     * register model object
     *
     * @var RegisterModel
     */

    private $register_model;

    /**
     * string validator Object
     *
     * @var StringValidator
     */
    private $string_validator;

    /**
     * form validator model
     * @var FormValidator
     */
    private $form_validator;

    /**
     * session model object
     *
     * @var SessionModel
     */
    private $session_model;

    /**
     * session wrapper object
     *
     * @var SessionWrapper
     */

    private $username_error;

    private $password_error;

    private  $password_count_error;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->db = $container->get('Database');
        $this->register_model = $container->get('RegisterModel');
        $this->string_validator = $container->get('StringValidator');
        $this->form_validator = $container->get('FormValidator');

        $this->username_error = false;
        $this->password_error = false;
        $this->password_count_error = false;
        
    }

    public function __destruct()
    {}

    public function index($request, $response, $args) 
    {
       
        return $this->view->render($response, 'register.twig', [
            'password_err'          => $this->password_error,
            'username_err'          => $this->username_error,
            'password_count_err'    => $this->password_count_error
        ]);
    }

    /**
     * Logs the user into the application
     * @method $login
     */

    public function register($request, $response, $args)
    {
        $validate_user_in_database = false;

        $this->username_error = $this->form_validator->validateUsername($request->getParam('username'));
        $this->password_error = $this->form_validator->validatePassword($request->getParam('password'));
        $this->password_count_error = $this->form_validator->validatePasswordLength($request->getParam('password'));

        if($this->password_error || $this->username_error || $this->password_count_error )
        {
            return $this->view->render($response, 'register.twig', [
                'password_err'          => $this->password_error,
                'username_err'          => $this->username_error,
                'password_count_err'    => $this->password_count_error,
                'doublicated_user_err'  => false
            ]);
        }

        $username = $this->string_validator->validateString($request->getParam('username'));
        $password = $this->string_validator->validateString($request->getParam('password'));

        $this->register_model->registerUser($username, $password, $this->db);

        $validate_user_in_database = $this->register_model->IsUserInDatabase();

        if($validate_user_in_database)
        {
            return $this->view->render($response, 'register.twig', [
                'password_err'          => $this->password_error,
                'username_err'          => $this->username_error,
                'password_count_err'    => $this->password_count_error,
                'doublicated_user_err'  => $validate_user_in_database
            ]);
        }

        return $response->withRedirect('/soap_app/app/login');

    }

}