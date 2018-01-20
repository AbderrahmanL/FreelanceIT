<?php 
class Recruteur extends CI_Model
{ 
  private $recruteur_data = array();

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    $this->load->model('mission');
  }

  //insert into recruteur table
  function insertRecruteur()
  {
    return $this->db->insert('recruteur', $this->recruteur_data);
  }
  //remove from recruteur table
  function removeRecruteur()
  {
    $this->db->where('login', $this->recruteur_data['login']);
    return $this->db->delete('recruteur');
  }

  function getLogin($hash){
      $this->db->where('md5(login)', $hash);
      $rec=$this->db->get('recruteur');
      return $rec->result_array()[0]['login'];
  }

  function getPropertyByLogin($login,$property){
    $this->db->where('login', $login);
      $rec=$this->db->get('recruteur');
      return $rec->result_array()[0][$property];
  }

  function getPropertyById($id,$property){
    $this->db->where('id', $id);
      $rec=$this->db->get('recruteur');
      return $rec->result_array()[0][$property];
  }

  //get recruteur's missions
  function myMissions($login){
    $this->db->where('login', $login);
    $tmp = $this->db->get('recruteur');
    $this->db->where('id_rec', $tmp->result_array()[0]['id']);
    $this->db->order_by('date', 'DESC');
    $this->db->limit(10);  
    $result_set=$this->db->get('mission');
    return $result_set->result_array();
  }

  public function get($id)
   {
    $where['id'] = $id;
    $result_set = $this->db->get_where('recruteur', $where);
    $result_arr = $result_set->result_array();
    return $result_arr[0];
   }

   function updateRecruteur($id)
  {
    $where['id'] = $id;
    return $this->db->update('recruteur', $this->recruteur_data,$where);
  }


    //send verification email to user's email id
  function sendEmail()
  {
        $from_email = 'servicefreelanceit@gmail.com'; //change this to yours
        $to_email = $this->recruteur_data['login'];
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

    //activate user account
      function verifyEmailID($key)
      {
        $data = array('status' => 1);
        $this->db->where('md5(login)', $key);
        return $this->db->update('recruteur', $data);
      }

      function get_user_actif()
      {
        $sql="select * from recruteur where login='".$this->recruteur_data['r_login']."' and pass='".md5($this->recruteur_data['r_pass'])."' and status='1'";

        $query=$this->db->query($sql);
        return $query->num_rows();
      }

      function get_user_inactif()
      {
        $sql="select * from recruteur where login='".$this->recruteur_data['r_login']."' and pass='".md5($this->recruteur_data['r_pass'])."' and status='0'";

        $query=$this->db->query($sql);
        return $query->num_rows();
      }

    /**
     * Gets the value of recruteur_data.
     *
     * @return mixed
     */
    public function getRecruteurData()
    {
      return $this->recruteur_data;
    }

    /**
     * Sets the value of recruteur_data.
     *
     * @param mixed $recruteur_data the recruteur data
     *
     * @return self
     */
    public function _setRecruteurData($recruteur_data)
    {
      $this->recruteur_data = $recruteur_data;

      return $this;
    }
  }