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
     * @var LoginValidator
     */
    private $login_validator;

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

    private $username_error;

    private $password_error;

    public function __construct($container)
    {
        parent::__construct($container);
        $this->db = $container->get('Database');
        $this->login = $container->get('LoginModel');
        $this->login_validator = $container->get('LoginValidator');
        $this->session_model =  $container->get('SessionModel');
        $this->session_wrapper =  $container->get('SessionWrapper');

        $this->username_error = false;
        $this->password_error = false;
        
    }

    public function index($request, $response, $args) 
    {
       
  
       if(isset($_SESSION))
       {
        return $response->withRedirect('/soap_app/app'); 
       }

        return $this->view->render($response, 'Login.twig', [
            'password_err' => $this->password_error,
            'username_err' => $this->username_error
        ]);
    }

    /**
     * Logs the user into the application
     * @method $login
     */

    public function login($request, $response, $args)
    {
  

        $user = null;

        if(empty($request->getParam('username')))
        {
            $this->username_error = true;
  
        }

        if(empty($request->getParam('password')))
        {
            $this->password_error = true;

        }

        if($this->password_error || $this->username_error )
        {
            return $this->view->render($response, 'Login.twig', [
                'password_err' => $this->password_error,
                'username_err' => $this->username_error
            ]);
        }

        $username = $this->login_validator->validateString($request->getParam('username'));
        $password = $this->login_validator->validateString($request->getParam('password'));

        $user = $this->login->userLogin($username, $password, $this->db);

        $this->session_model->setSessionValues($user->getUsername(), $user->getPassword());
        $this->session_model->setWrapperSessionFile($this->session_wrapper);
        $this->session_model->storeDataInSessionFile();

        return $response->withRedirect('/soap_app/app');

    }

}