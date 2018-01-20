<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultants extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('session', 'form_validation', 'email'));
		$this->load->model(array('Consultant','Mission','Recruteur'));
	}

	public function index($periode=NULL){
		if(isset($_SESSION['login']) && $_SESSION['who']=='consultant')
		{	
			if (isset($_GET['keyword'])) {
				$data['missions'] = $this->Mission->all($periode,htmlspecialchars($_GET['keyword']));
			}
			else
			{
				$data['missions'] = $this->Mission->all($periode,NULL);
			}
			$data1['id_cons'] = $this->Consultant->getPropertyByLogin($_SESSION['login'],'id');
			if (isset($periode)) {
				$data['periode']=$periode;
			}
			$this->load->view("layouts/header_cons",$data1);
			$this->load->view("consultants/espaceconsultant",$data);
			$this->load->view("layouts/footer");
		}
		elseif(isset($_SESSION['login']))
			redirect('recruteurs');
		else
			redirect('logins/login');
	}

    public function MesPostul(){
        if(isset($_SESSION['login']) && $_SESSION['who']=='consultant')
        {
            $data1['id_cons'] = $this->Consultant->getPropertyByLogin($_SESSION['login'],'id');
            $data['missions'] = $this->Mission->getApply($data1['id_cons']);
            $this->load->view("layouts/header_cons",$data1);
            $this->load->view("consultants/espaceconsultant",$data);
            $this->load->view("layouts/footer");  
        }
        elseif(isset($_SESSION['login']))
            redirect('recruteurs');
        else
            redirect('logins/login');
    }

    public function charger()
    {	
      if(!isset($_SESSION['login']))
      {
       redirect('consultants');
   }
   $this->load->view('consultants/charger');
}

public function do_upload()
{
  $id = $this->Consultant->getPropertyByLogin($_SESSION['login'],'id');
  $config['upload_path']          = './uploads/';
  $config['allowed_types']        = 'pdf';
  $config['file_name']			= "cv_$id";
  $config['overwrite']			= TRUE;

  $this->load->library('upload', $config);

  if ( ! $this->upload->do_upload('mycv'))
  {
   $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Votre CV n\'a pas été charger vérifiez que c\'est bien un fichier pdf!</div>');;
}
else {
   $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Votre CV a été bien charger!</div>');
   $data['hascv'] = 1;
   $this->Consultant->_setConsultantData($data);
   $this->Consultant->updateConsultant($id);
}
}


public function editer($id=NULL){

        //set validation rules
  $this->form_validation->set_rules('nom', 'First Name', 'trim|alpha|min_length[3]|max_length[30]');
  $this->form_validation->set_rules('prenom', 'Last Name', 'trim|alpha|min_length[3]|max_length[30]');
  $this->form_validation->set_rules('pass', 'Password', 'trim|matches[cpass]');
  $this->form_validation->set_rules('cpass', 'Confirm Password', 'trim');
		//custom error messages
  $this->form_validation->set_message('matches', 'les mots de passe ne sont pas identiques');
  $this->form_validation->set_message('min_length', 'minimum 3 caratères');
  $this->form_validation->set_message('alpha', 'Seulement les lettres autorisées');


        //validate form input
  if ($this->form_validation->run() == FALSE)
  {	
   if(isset($_SESSION['login']) && $_SESSION['who']=='consultant')
   {	
    $data['consultant']=$this->Consultant->get($id);
    $data1['indice']=1;
    $this->load->view("layouts/header_cons",$data1);
    $this->load->view("consultants/editer",$data);
    $this->load->view("layouts/footer");
}
elseif(isset($_SESSION['login']))
    redirect('recruteurs');
else
    redirect('logins/login');
}
else
{
            //insert the consultant registration details into database
   $data = array(
    'nom' => htmlspecialchars($this->input->post('nom')),
    'prenom' => htmlspecialchars($this->input->post('prenom')),
    'specialite' => htmlspecialchars($this->input->post('specialite'))
    );
   if(isset($_POST['passact']))
   {
    $pass=$this->Consultant->getPropertyByLogin($_SESSION['login'],'pass');
    if ($pass==md5($_POST['passact']) && isset($_POST['pass'])) {
     $data['pass']=md5($_POST['pass']);
 }
}
$this->Consultant->_setConsultantData($data);

            // insert form data into database
if ($this->Consultant->updateConsultant($id))
{
    $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Changements effectués avec succés!</div>');
}	
else
{
                // error
    $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Erreur.  Veuillez ressayer ulterieurement!!!</div>');
}
redirect('consultants');
}

}

	//send verification email to user's email id
public function sendEmail($toEmail)
{
        $from_email = 'servicefreelanceit@gmail.com'; //change this to yours
        $to_email = $this->Recruteur->getPropertyById($_POST['idRec'],'login');
        if (isset($_POST['mycv']) || $_SESSION['activeuser']==TRUE) {
        	$subject = utf8_decode('Candidature reçu');
        	$message = 'Cher Recruteur,<br /><br />vous avez recu une candidature pour votre mission: <b>'.utf8_decode($_POST['titre']).'</b> <br /><br />  Vous trouverez le cv ci-joint.<br /><br /><br />Merci<br />FreelanceIt';
        }
        else{
        	$subject = 'Verifiez votre Addresse Email';
        	$message = 'Cher consultant,<br /><br />Cliquez sur le lien suivant <br /><br /> <a href="'.base_url('index.php/consultants/verify/'.md5($to_email) ).'"> activation link</a> Pour verifier votre adresse.<br /><br /><br />Merci<br />FreelanceIt';
        }

        
        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = "pass'1234"; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);
        
        //send mail
        $this->email->from($from_email, 'freelanceIt');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        $stop = FALSE;
        if (isset($_FILES['mycv'])) {
        	$this->email->attach($_FILES['mycv']['tmp_name'],$disposition = '',$_FILES['mycv']['name'] );
            if (strlen($_FILES['mycv']['tmp_name']=='')) {
                $stop = TRUE;
                echo strlen($_FILES['mycv']['tmp_name']);
            }
        }
        elseif($_SESSION['activeuser']==TRUE){
        	$id = $this->Consultant->getPropertyByLogin($_SESSION['login'],'id');
        	$this->email->attach(base_url("uploads/cv_$id.pdf"));
        }
        else{
        	return $this->email->send();
        }
        if (isset($_POST['mycv']) || $_SESSION['activeuser']==TRUE) {
            if ($stop==FALSE ) {
                if ($this->email->send()) {
        		// successfully sent mail
                   $this->session->set_flashdata('msg','<div class="alert alert-success text-center">La candidature a été énvoyé avec succés</div>');
                   $idCon = $this->Consultant->getPropertyByLogin($_SESSION['login'],'id');
                   $this->Mission->applied_to($_POST['idMiss'],$idCon);
               }
               else {
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Erreur! réessayer ultérieurement </div>');
            }
        }
        else
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Sélectionner un fichier pdf avant d\'énvoyer </div>');
        }
        redirect('missions/missiondetails/'.$_POST['idMiss']);
        
    }
}

public function inscriptionConsultant()
{
   if(isset($_SESSION['login']))
   {
      redirect('consultants');
  }
        //set validation rules
  $this->form_validation->set_rules('nom', 'First Name', 'trim|alpha|min_length[3]|max_length[30]');
  $this->form_validation->set_rules('prenom', 'Last Name', 'trim|alpha|min_length[3]|max_length[30]');
  $this->form_validation->set_rules('login', 'Email ID', 'trim|valid_email|is_unique[consultant.login]');
  $this->form_validation->set_rules('pass', 'Password', 'trim|matches[cpass]');
  $this->form_validation->set_rules('cpass', 'Confirm Password', 'trim');
		//custom error messages
  $this->form_validation->set_message('is_unique', 'Cet email est associé à un compte existant');
  $this->form_validation->set_message('matches', 'les mots de passe ne sont pas identiques');
  $this->form_validation->set_message('valid_email', 'Cet email est invalide');
  $this->form_validation->set_message('min_length', 'minimum 3 caratères');
  $this->form_validation->set_message('alpha', 'Seulement les lettres autorisées');


        //validate form input
  if ($this->form_validation->run() == FALSE)
  {
            // fails
      $this->load->view('consultants/inscriptionConsultant');
      $this->load->view('layouts/footer');
  }
  else
  {
            //insert the consultant registration details into database
      $data = array(
         'nom' => htmlspecialchars($this->input->post('nom')),
         'prenom' => htmlspecialchars($this->input->post('prenom')),
         'login' => htmlspecialchars($this->input->post('login')),
         'pass' => md5(htmlspecialchars($this->input->post('pass'))),
         'civilite' => htmlspecialchars($this->input->post('civilite')),
         'specialite' => htmlspecialchars($this->input->post('specialite'))
         );
      $this->Consultant->_setConsultantData($data);

            // insert form data into database
      if ($this->Consultant->insertConsultant())
      {
                // send email
         if ($this->sendEmail($data['login']))
         {
                    // successfully sent mail
            $this->session->set_flashdata('msg','<div class="alert alert-success text-center">L\'inscription est effectué avec succés, activez votre compte depuis le lien qui vous a été envoyer par email</div>');
            $sessiondata = array(
               'login' => $_POST['login'],
               'who' => 'consultant',
               'activeuser'=> FALSE
               );
            $this->session->set_userdata($sessiondata);
            redirect('consultants');
        }
        else
        {
                    // error
            $this->Consultant->removeConsultant();
            $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Erreur email.  Veuillez ressayer ulterieurement!!!</div>');
            redirect('consultants/inscriptionConsultant');
        }
    }
    else
    {
                // error
     $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Erreur.  Veuillez ressayer ulterieurement!!!</div>');
     redirect('consultants/inscriptionConsultant');
 }
}
}

function verify($hash=NULL)
{	
   if($this->Consultant->get_user_actif()>0){
      redirect('consultants');
  }
  if ($this->Consultant->verifyEmailID($hash))
  {	
      $this->session->set_flashdata('verify_msg',"<div class=\"alert alert-success text-center\">Votre compte a été bien activé, Bienvenu!</div>");
      $sessiondata = array(
         'login' => $this->Consultant->getLogin($hash),
         'who' => 'consultant',
         'activeuser' => TRUE,
         );
      $this->session->set_userdata($sessiondata);
      unset($_SESSION['msg']);
      redirect('consultants');
  }
  else
  {
      $this->session->set_userdata('verify_msg','<div class="alert alert-danger text-center">Désolé! Il y avait un probleme en vérifiant votre compte, merci de relancer votre inscription!</div>');
      redirect('consultants');
  }
}


}
