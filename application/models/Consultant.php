<?php 
class Consultant extends CI_Model
{	
  private $consultant_data = array();
  
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

	//insert into consultant table
  function insertConsultant()
  {
    return $this->db->insert('consultant', $this->consultant_data);
  }
  //remove from consultant table
  function removeConsultant()
  {
    $this->db->where('login', $this->consultant_data['login']);
    return $this->db->delete('consultant');
  }
  function getLogin($hash){
    $this->db->where('md5(login)', $hash);
    $cons=$this->db->get('consultant');
    return $cons->result_array()[0]['login'];
  }

  function getPropertyByLogin($login,$property){
    $this->db->where('login', $login);
    $cons=$this->db->get('consultant');
    return $cons->result_array()[0][$property];
  }

  function getPropertyById($id,$property){
    $this->db->where('id', $id);
    $cons=$this->db->get('consultant');
    return $cons->result_array()[0][$property];
  }

  public function get($id)
  {
    $where['id'] = $id;
    $result_set = $this->db->get_where('consultant', $where);
    $result_arr = $result_set->result_array();
    return $result_arr[0];
  }

  function updateConsultant($id)
  {
    $where['id'] = $id;
    return $this->db->update('consultant', $this->consultant_data,$where);
  }
      
    //activate user account
      function verifyEmailID($key)
      {
       $data = array('status' => 1);
       $this->db->where('md5(login)', $key);
       return $this->db->update('consultant', $data);
     }

     function get_user_actif()
     {
      $sql="select * from consultant where login='".$this->consultant_data['login']."' and pass='".md5($this->consultant_data['pass'])."' and status='1'";

      $query=$this->db->query($sql);
      return $query->num_rows();
    }
    
    function get_user_inactif()
    {
      $sql="select * from consultant where login='".$this->consultant_data['login']."' and pass='".md5($this->consultant_data['pass'])."' and status='0'";

      $query=$this->db->query($sql);
      return $query->num_rows();
    }

    


    /**
     * Gets the value of consultant_data.
     *
     * @return mixed
     */
    public function getConsultantData()
    {
      return $this->consultant_data;
    }

    /**
     * Sets the value of consultant_data.
     *
     * @param mixed $consultant_data the consultant data
     *
     * @return self
     */
    public function _setConsultantData($consultant_data)
    {
      $this->consultant_data = $consultant_data;

      return $this;
    }
  }