<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logins extends CI_Controller
{

 public function __construct()
 {
  parent::__construct();
  $this->load->library(array('session', 'form_validation'));
  $this->load->helper(array('form','html'));
  $this->load->database();
          //load the login model
  $this->load->model(array('Consultant','Recruteur'));
}

public function disconnect(){
  session_destroy();
  redirect('logins/login');
}

public function login()
{  
 if(isset($_SESSION['login']) && $_SESSION['who']=='recruteur')
 {
  redirect('recruteurs');
}
elseif (isset($_SESSION['login']) && $_SESSION['who']=='consultant') 
{
  redirect('consultants');
}
if(isset($_POST['login'])){
  $login='login';
  $pass='pass';
  $msg='msg';
  $user='consultant';
}
else{
  $login='r_login';
  $pass='r_pass';
  $msg='r_msg';
  $user='recruteur';
}

$this->form_validation->set_rules($login, "Username", "trim");
$this->form_validation->set_rules($pass, "Password", "trim");


if ($this->form_validation->run() == FALSE)
{
               //validation fails

 $this->load->view('logins/login');
 $this->load->view('layouts/footer');
}
else
{
  $data = array($login => $this->input->post($login),
   $pass => $this->input->post($pass));
  if ($login=='login') {
    $this->Consultant->_setConsultantData($data);
    $var1 = $this->Consultant->get_user_actif();
    $var2 = $this->Consultant->get_user_inactif();
  }
  else{
    $this->Recruteur->_setRecruteurData($data);
    $var1 = $this->Recruteur->get_user_actif();
    $var2 = $this->Recruteur->get_user_inactif();
  }
      if ($var1 >0) //active user record is present
      {
                       //set the session variables
       $sessiondata = array(
        'login' => $_POST[$login],
        'activeuser' => TRUE,
        'who' => $user
        );
       $this->session->set_userdata($sessiondata);
       if($user=='consultant')
         redirect('consultants');
       else{
        redirect('recruteurs');
      }
    }
    else if($var2>0)
    {
     $this->session->set_userdata($msg, '<div class="alert alert-danger text-center">vous n\'avez pas activé la vérification de l\'email </div>');
     $sessiondata = array(
      'login' => $_POST[$login],
      'activeuser' => FALSE,
      'who' => $user
      );
     $this->session->set_userdata($sessiondata);
     if($user=='consultant')
       redirect('consultants');
     else{
      redirect('recruteurs');
    }
  }
  else 
  {
    $this->session->set_flashdata($msg, '<div class="alert alert-danger text-center">password ou login invalide </div>');
    redirect('logins/login');
  }
}
}
}?>
