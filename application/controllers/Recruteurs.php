<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruteurs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library(array('session', 'form_validation', 'email'));
		$this->load->model('Recruteur');
		$this->load->model('Mission');
	}

	public function index(){
		if(isset($_SESSION['login']) && $_SESSION['who']=='recruteur')
		{
			$data['missions'] = $this->Recruteur->myMissions($_SESSION['login']);
			$data['logo']=$this->Recruteur->getPropertyByLogin($_SESSION['login'],'logo');
			$data1['id_rec'] = $this->Recruteur->getPropertyByLogin($_SESSION['login'],'id');
			$this->load->view("layouts/header_rec",$data1);
			$this->load->view("recruteurs/espacerecruteur",$data);
			$this->load->view("layouts/footer");
		}
		elseif(isset($_SESSION['login']))
			redirect('consultants');
		else
			redirect('logins/login');
	}

	public function ajouterLogo($login){
		$rec_id=$this->Recruteur->getPropertyByLogin($login,'id');
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'jpg|png';
		$config['file_name']			= "img_$rec_id.png";
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('logo'))
		{
			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Votre image n\'a pas été charger réessayez ulterieurement!</div>');
		}
		else {
			$data1 = array('logo' => 1);
			$this->db->where('id', $rec_id);
			$this->db->update('recruteur', $data1);
		}
	}
	public function editer($id){

        //set validation rules
		$this->form_validation->set_rules('login', 'Email ID', 'trim|valid_email|is_unique[recruteur.login]');
		$this->form_validation->set_rules('pass', 'Password', 'trim|matches[cpass]');
		$this->form_validation->set_rules('cpass', 'Confirm Password', 'trim');
				//custom error messages
		$this->form_validation->set_message('is_unique', 'Cet email est associé à un compte existant');
		$this->form_validation->set_message('matches', 'les mots de passe ne sont pas identiques');
		$this->form_validation->set_message('valid_email', 'Cet email est invalide');


        //validate form input
		if ($this->form_validation->run() == FALSE)
		{
			if(isset($_SESSION['login']) && $_SESSION['who']=='recruteur')
			{
				$data['recruteur']=$this->Recruteur->get($id);
				$data1['indice']=1;
				$this->load->view("layouts/header_rec",$data1);
				$this->load->view("recruteurs/editer",$data);
				$this->load->view("layouts/footer");
			}
			elseif(isset($_SESSION['login']))
				redirect('recruteurs');
			else
				redirect('logins/login');
		}
		else
		{
			if(isset($_POST['nom']))
			{
				$data = array(
					'nom' => htmlspecialchars($this->input->post('nom')),
					'prenom' => htmlspecialchars($this->input->post('prenom'))
					);
			}
			elseif(isset($_POST['nomse']))
			{
				$data = array(
					'nomse' => htmlspecialchars($this->input->post('nomse')),
					'adresse' => htmlspecialchars($this->input->post('adresse'))
					);
				$this->ajouterLogo($_SESSION['login']);
			}
			if(isset($_POST['passact']))
			{
				$pass=$this->Recruteur->getPropertyByLogin($_SESSION['login'],'pass');
				if ($pass==md5($_POST['passact']) && isset($_POST['pass'])) {
					$data['pass']=md5($_POST['pass']);
				}
			}
			$this->Recruteur->_setRecruteurData($data);

			if ($this->Recruteur->updateRecruteur($id))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Changements effectués avec succés!</div>');
			}
			else
			{
                // error
				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Erreur.  Veuillez ressayer ulterieurement!!!</div>');
			}
			redirect('recruteurs');
		}

	}

	//send verification email to user's email id
	function sendEmail($toEmail)
	{
        $from_email = 'servicefreelanceit@gmail.com'; //change this to yours
        $to_email = $toEmail;
        $subject = 'Verifiez votre Addresse Email';
        $message = 'Cher recruteur,<br /><br />Cliquez sur le lien suivant <br /><br /> <a href="'.base_url('index.php/recruteurs/verify/'.md5($to_email) ).'"> activation link</a> Pour verifier votre adresse.<br /><br /><br />Merci<br />FreelanceIt';

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
        return $this->email->send();
    }

    public function inscriptionRecruteur()
    {
    	if(isset($_SESSION['login']))
    	{
    		redirect('recruteurs');
    	}
        //set validation rules
    	$this->form_validation->set_rules('login', 'Email ID', 'trim|valid_email|is_unique[recruteur.login]');
    	$this->form_validation->set_rules('pass', 'Password', 'trim|matches[cpass]');
    	$this->form_validation->set_rules('cpass', 'Confirm Password', 'trim');
		//custom error messages
    	$this->form_validation->set_message('is_unique', 'Cet email est associé à un compte existant');
    	$this->form_validation->set_message('matches', 'les mots de passe ne sont pas identiques');
    	$this->form_validation->set_message('valid_email', 'Cet email est invalide');


        //validate form input
    	if ($this->form_validation->run() == FALSE)
    	{
            // fails
    		$this->load->view('recruteurs/inscriptionRecruteur');
    		$this->load->view('layouts/footer');
    	}
    	else
    	{
            //insert the recruteur registration details into database
    		if ($this->input->post('compte')=='particulier')
    		{
    			$data = array(
    				'nom' => htmlspecialchars($this->input->post('nom')),
    				'prenom' => htmlspecialchars($this->input->post('prenom')),
    				'login' => htmlspecialchars($this->input->post('login')),
    				'pass' => md5(htmlspecialchars($this->input->post('pass'))),
    				'compte' => htmlspecialchars($this->input->post('compte'))
    				);
    		}
    		else
    		{
    			$data = array(
    				'nomse' => htmlspecialchars($this->input->post('nomse')),
    				'adresse' => htmlspecialchars($this->input->post('adresse')),
    				'login' => htmlspecialchars($this->input->post('login')),
    				'pass' => md5(htmlspecialchars($this->input->post('pass'))),
    				'compte' => htmlspecialchars($this->input->post('compte'))
    				);
    		}
    		$this->Recruteur->_setRecruteurData($data);

            // insert form data into database
    		if ($this->Recruteur->insertRecruteur())
    		{
				//add logo
    			if ($_POST['compte']=='societe') {
    				$this->ajouterLogo($data['login']);
    			}
                // send email
    			if ($this->sendEmail($data['login']))
    			{
                    // successfully sent mail
    				$this->session->set_flashdata('r_msg','<div class="alert alert-success text-center">L\'inscription est effectué avec succés, activez votre compte depuis le lien qui vous a été envoyer par email</div>');
    				$sessiondata = array(
    					'login' => $_POST['login'],
    					'who' => 'recruteur',
    					'activeuser'=> FALSE
    					);
    				$this->session->set_userdata($sessiondata);
    				redirect('recruteurs');
    			}
    			else
    			{
                    // error
    				$this->Recruteur->removeRecruteur();
    				$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Erreur.  Veuillez ressayer ulterieurement!!!</div>');
    				redirect('recruteurs/inscriptionRecruteur');
    			}
    		}
    		else
    		{
                // error
    			$this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Oops! Erreur.  Veuillez ressayer ulterieurement!!!</div>');
    			redirect('recruteurs/inscriptionRecruteur');
    		}
    	}
    }

    function verify($hash=NULL)
    {
    	if($this->Recruteur->get_user_actif()>0){
    		redirect('recruteurs');
    	}
    	if ($this->Recruteur->verifyEmailID($hash))
    	{
    		$this->session->set_flashdata('verify_msg',"<div class=\"alert alert-success text-center\">Votre compte a été bien activé, Bienvenu!</div>");
    		$sessiondata = array(
    			'login' => $this->Recruteur->getLogin($hash),
    			'who' => 'recruteur',
    			'activeuser' => TRUE,
    			);
    		$this->session->set_userdata($sessiondata);
    		redirect('recruteurs');
    	}
    	else
    	{
    		$this->session->set_flashdata('verify_msg','<div class="alert alert-danger text-center">Désolé! Il y avait un probleme en vérifiant votre compte, merci de ressayer ulterieurement!</div>');
    		redirect('recruteurs');
    	}
    }
}
