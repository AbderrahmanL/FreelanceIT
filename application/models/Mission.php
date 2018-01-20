<?php 
class Mission extends CI_Model
{	
  private $mission_data = array();

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function insertMission()
  {
    return $this->db->insert('mission', $this->mission_data);
  }

  public function updateMission($id=NULL)
  {
    $where['id'] = $id;
    return $this->db->update('mission', $this->mission_data,$where);
  }

  public function removeMission($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('mission');
  }

  public function all($periode=NULL,$keyword=NULL)
  { 
   $where= array();
   if ($periode!=NULL) {
    $where['periode'] = $periode;
  }
  $this->db->like('description', $keyword, 'both');
  $this->db->order_by('date', 'DESC');
  $result_set = $this->db->get_where('mission',$where);
  return $result_set->result_array();
}

public function getApply($id=NULL){
  $sql="select * from candidature,mission where idCon='".$id."' and idMis=id";
  $query=$this->db->query($sql);
  return $query->result_array();
}

public function last(){
 $this->db->order_by('date', 'DESC');
 $this->db->limit(10);
 $result_set = $this->db->get('mission');
 return $result_set->result_array();
}

public function get($id=NULL)
{
  $where['id'] = $id;
  $result_set = $this->db->get_where('mission', $where);
  $result_arr = $result_set->result_array();
  return $result_arr[0];
}

public function applied_to($idM,$idC){
  $data['idCon'] = $idC;
  $data['idMis'] = $idM;
  $data['postuler'] = 1;
  return $this->db->insert('candidature', $data);
}

public function favorit($idM,$idC){
  $data['idCon'] = $idC;
  $data['idMis'] = $idM;
  $data['favorit'] = 1;
  return $this->db->insert('candidature', $data);
}


    /**
     * Gets the value of mission_data.
     *
     * @return mixed
     */
    public function getMissionData()
    {
      return $this->mission_data;
    }

    /**
     * Sets the value of mission_data.
     *
     * @param mixed $mission_data the mission data
     *
     * @return self
     */
    public function _setMissionData($mission_data=NULL)
    {
      $this->mission_data = $mission_data;

      return $this;
    }
  }