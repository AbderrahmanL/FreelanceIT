<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Missions extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->library(array('session', 'form_validation'));
		$this->load->model('Mission');
		$this->load->model('Recruteur');
		$this->load->model('Consultant');
	}

	public function supprimer($id){
		$this->Mission->removeMission($id);
		redirect("recruteurs");
	}

	public function missiondetails($id){
		if(isset($_SESSION['login']) && $_SESSION['who']=='recruteur')
		{
			$data['mission']=$this->Mission->get($id);
			$data1['id_rec'] = $this->Recruteur->getPropertyByLogin($_SESSION['login'],'id');
			$this->load->view("layouts/header_rec",$data1);
			$this->load->view('missions/missiondetails',$data);
			$this->load->view("layouts/footer");
		}
		elseif(isset($_SESSION['login']))
		{
			$data1['id_cons'] = $this->Consultant->getPropertyByLogin($_SESSION['login'],'id');
			$data['mission']=$this->Mission->get($id);
			$data['hascv'] = $this->Consultant->getPropertyByLogin($_SESSION['login'],'hascv');
			$this->load->view("layouts/header_cons",$data1);
			$this->load->view('missions/missiondetails',$data);
			$this->load->view("layouts/footer");
		}	
		else
			redirect('logins/login');
	}

	public function creermission(){

		if(isset($_SESSION['login']) && $_SESSION['who']=='recruteur')
		{	
			$data1['id_rec'] = $this->Recruteur->getPropertyByLogin($_SESSION['login'],'id');
			$this->load->view("layouts/header_rec",$data1);
			$this->load->view('missions/creermission');
			$this->load->view("layouts/footer");
		}
		elseif(isset($_SESSION['login']))
			redirect('consultants');
		else
			redirect('logins/login');

		if(isset($_POST['titre']))
		{
//insert the recruteur registration details into database
			$data = array(
				'id_rec' => $this->Recruteur->getPropertyByLogin($_SESSION['login'],"id"),
				'titre' => htmlspecialchars($this->input->post('titre'), ENT_QUOTES, 'ISO-8859-1'),
				'duree' => htmlspecialchars($this->input->post('duree'), ENT_QUOTES, 'ISO-8859-1'),
				'tarif' => htmlspecialchars($this->input->post('tarif'), ENT_QUOTES, 'ISO-8859-1'),
				'debut' => htmlspecialchars($this->input->post('debut'), ENT_QUOTES, 'ISO-8859-1'),
				'description' => htmlspecialchars($this->input->post('description'), ENT_QUOTES, 'ISO-8859-1'),
				'date' => date("Y-m-d H:i:s"),
				'lieu' => htmlspecialchars($this->input->post('lieu'),ENT_QUOTES, 'ISO-8859-1')
				);
			if (isset($_POST['renouvelable'])) {
				$data['duree']=$data['duree']." renouvelable";
			}
			if($_POST['duree']=="1 mois" && $_POST['duree']=="2 mois" && $_POST['duree']=="3 mois")
			{
				$data['periode']=1;
			}
			elseif ($_POST['duree']=="4 mois" && $_POST['duree']=="5 mois" && $_POST['duree']=="6 mois") {
				$data['periode']=2;
			}
			elseif ($_POST['duree']=="7 mois" && $_POST['duree']=="8 mois" &&$_POST['duree']=="9 mois") {
				$data['periode']=3;
			}
			elseif ($_POST['duree']=="10 mois" && $_POST['duree']=="11 mois" && $_POST['duree']=="1 an") {
				$data['periode']=4;
			}
			elseif ($_POST['duree']=="2 ans") {
				$data['periode']=5;
			}
			$this->Mission->_setMissionData($data);

            // insert form data into database
			if ($this->Mission->insertMission())
			{
				$this->session->set_flashdata('mission','<div class="alert alert-success text-center">Creation avec succés!!!</div>');
				redirect('recruteurs');
			}
			else
			{
                // error
				$this->session->set_flashdata('mission','<div class="alert alert-danger text-center">Oops! Erreur.  Veuillez ressayer ulterieurement!!!</div>');
				redirect("missions/creermission");
			}
		}
	}

	public function editer($id){
		if(isset($_SESSION['login']) && $_SESSION['who']=='recruteur')
		{	
			$data['mission']=$this->Mission->get($id);
			$data1['id_rec'] = $this->Recruteur->getPropertyByLogin($_SESSION['login'],'id');
			$this->load->view("layouts/header_rec",$data1);
			$this->load->view("missions/editer",$data);
			$this->load->view("layouts/footer");
		}
		elseif(isset($_SESSION['login']))
			redirect('consultants');
		else
			redirect('logins/login');

            //insert the recruteur registration details into database
		if (isset($_POST['titre'])) {
			$data = array(
				'titre' => htmlspecialchars($this->input->post('titre'), ENT_QUOTES, 'ISO-8859-1'),
				'duree' => htmlspecialchars($this->input->post('duree'), ENT_QUOTES, 'ISO-8859-1'),
				'debut' => htmlspecialchars($this->input->post('debut'), ENT_QUOTES, 'ISO-8859-1'),
				'description' => htmlspecialchars($this->input->post('description'), ENT_QUOTES, 'ISO-8859-1'),
				'lieu' => htmlspecialchars($this->input->post('lieu'),ENT_QUOTES, 'ISO-8859-1')
				);
			
			$this->Mission->_setMissionData($data);

            // insert form data into database
			if ($this->Mission->updateMission($id))
			{
				$this->session->set_flashdata('update','<div class="alert alert-success text-center">Mis a jours avec succés!!!</div>');
				redirect('recruteurs');
			}
			else
			{
                // error
				$this->session->set_flashdata('update','<div class="alert alert-danger text-center">Oops! Erreur.  Veuillez ressayer ulterieurement!!!</div>');
			}
		}	
	}
}

