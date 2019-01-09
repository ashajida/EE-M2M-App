<?php
/**
 * SessionModel.php
 *
 * stores the validated values in the relevant storage location
 *
 * Author: CF Ingrams
 * Email: <clinton@cfing.co.uk>
 * Date: 22/10/2017
 *
 *
 * @author CF Ingrams <clinton@cfing.co.uk>
 * @copyright CFI
 *
 */

class SessionModel
{
  private $c_username;
  private $c_password;
  private $c_arr_storage_result;
  private $c_obj_wrapper_session_file;
  private $session_db_handle;
  
  public function __construct()
  {
    $this->c_username = null;
    $this->c_password = null;
    $this->c_arr_storage_result = null;
    $this->c_obj_wrapper_session_file = null;
    $this->session_db_handle = null;
  }

  public function __destruct() { }

  public function setSessionValues($p_username, $p_password)
  {
    $this->c_username = $p_username;
    $this->c_password = $p_password;
  }

  public function setWrapperSessionFile($p_obj_wrapper_session)
  {
    $this->c_obj_wrapper_session_file = $p_obj_wrapper_session;
  }

  public function storeDataInSessionFile()
  {
    $m_store_result = false;
    $m_store_result_username = $this->c_obj_wrapper_session_file->setSession('user_name', $this->c_username);
    $m_store_result_password = $this->c_obj_wrapper_session_file->setSession('password', $this->c_password);

    if ($m_store_result_username !== false && $m_store_result_password !== false)	{
      $m_store_result = true;
    }
    return $m_store_result;
  }
  

}
