<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acceuils extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Mission');
	}

	public function index()
	{	if(isset($_SESSION['login']) && $_SESSION['who']=='recruteur')
	{
		redirect('recruteurs');
	}
	elseif (isset($_SESSION['login']) && $_SESSION['who']=='consultant') 
	{
		redirect('consultants');
	}
	else{
		$data['missions'] = $this->Mission->last();
		$this->load->view('acceuils/acceuil',$data);
		$this->load->view('layouts/footer');
	}
}
}