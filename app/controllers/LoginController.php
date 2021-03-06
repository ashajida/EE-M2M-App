<?php

/**
 * Login Controller
 * @author Ashraf Ajida
 */


require_once __DIR__ . '/Controller.php';

class LoginController extends Controller
{

    /**
     * database object
     * @var Database
     */

    private $db;

    /**
     * login model object
     *
     * @var LoginModel 
     */

    private $login;

    /**
     * login validator Object
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
    private $session_wrapper;
    
    /**
     * this variable gives a flag if their is an error with username input
     *
     * @var bool
     */
    private $username_error;

    /**
     * this variable gives a flag if their is an error with password input
     *
     * @var bool
     */
    private $password_error;

    /**
     * this variable gives a flag if their is an error with the length of password input
     *
     * @var bool
     */
    private $password_count_error;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->db = $container->get('Database');
        $this->login = $container->get('LoginModel');
        $this->string_validator = $container->get('StringValidator');
        $this->form_validator = $container->get('FormValidator');

        $this->session_model =  $container->get('SessionModel');
        $this->session_wrapper =  $container->get('SessionWrapper');

        $this->username_error = false;
        $this->password_error = false;
        $this->password_count_error = false;

        
    }

    public function __destruct()
    {}

    public function index($request, $response, $args) 
    {
       
  
       if(isset($_SESSION['user_name']))
       {
        return $response->withRedirect('/soap_app/app'); 
       }

        return $this->view->render($response, 'Login.twig', [
            'password_err' => $this->password_error,
            'username_err' => $this->username_error,
            'title'        => APP_NAME,
            'css'          => './views/css/styles.css',
            'js'           => 'js/app.js',
            'chart'        => '../public/images/temp.png',
            'action'       => 'login',
            'home'         => 'index.php',
            'update'       => 'index.php/update',
            'logout'       => 'logout'
        ]);
    }

    /**
     * Logs the user into the application
     * @method $login
     */

    public function login($request, $response, $args)
    {

        $user = null;

        $this->username_error = $this->form_validator->validateUsername($request->getParam('username'));
        $this->password_error = $this->form_validator->validatePassword($request->getParam('password'));

        if($this->password_error || $this->username_error || $this->password_count_error)
        {
            return $this->view->render($response, 'Login.twig', [
                'password_err' => $this->password_error,
                'username_err' => $this->username_error,
                'title'         => APP_NAME,
                'css'           => './views/css/styles.css',
                'js'            => 'js/app.js',
                'chart'         => '../public/images/temp.png',
                'action'        => 'login',
                'home'          => 'index.php',
                'update'        => 'index.php/update',
                'logout'        => 'logout'
            ]);
        }

        $username = $this->string_validator->validateString($request->getParam('username'));
        $password = $this->string_validator->validateString($request->getParam('password'));

        $user = $this->login->loginUser($username, $password, $this->db);
        $password_matched_error = $this->login->passwordNotMatchedInDatabase();
        $user_not_found_error = $this->login->userNotFoundInDatabase();

        if($password_matched_error)
        {
            return $this->view->render($response, 'Login.twig', [
                'password_err'          => $this->password_error,
                'username_err'          => $this->username_error,
                'password_match_err'    => $password_matched_error,
                'user_not_found_err'    => $user_not_found_error,
                'title'                 => APP_NAME,
                'css'                   => './views/css/styles.css',
                'js'                    => 'js/app.js',
                'chart'                 => '../public/images/temp.png',
                'action'                => 'login',
                'home'                  => 'index.php',
                'update'                => 'index.php/update',
                'logout'                => 'logout'
            ]);
        }

        $this->session_model->setSessionValues($user->getUsername(), $user->getPassword());
        $this->session_model->setWrapperSessionFile($this->session_wrapper);
        $this->session_model->storeDataInSessionFile();

        return $response->withRedirect('/soap_app/app');

    }

}