<?php 
class Candidature extends CI_Model
{	
  private $candidature_data = array();

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  
  
}