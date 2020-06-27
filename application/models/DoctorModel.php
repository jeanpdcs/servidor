<?php

class DoctorModel extends CI_Model
{
	public function fGetDoctores()
	{
        $this->db->select("d.*, e.ESP_NOMBRE, u.*");
        $this->db->join("especialidad e", "d.ESP_ID = e.ESP_ID", "inner");
        $this->db->join("usuario u", "d.USU_ID = u.USU_ID", "inner");
        $resultado=$this->db->get("doctor d")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }
    
    public function fGetDoctoresCampo($campo)
	{
        $this->db->select("d.*, e.ESP_NOMBRE, u.*");
        $this->db->join("especialidad e", "d.ESP_ID = e.ESP_ID", "inner");
        $this->db->join("usuario u", "d.USU_ID = u.USU_ID", "inner");
        $this->db->like("u.USU_PRIMNOM", $campo, "both");//DOC_PRIMNOM DOC_SEGNOM DOC_APELLIDOS DOC_TELEFONO DOC_TLFCELULAR DOC_TITULO DOC_CORREO ESP_ID DOC_ID
        $this->db->or_like("u.USU_SEGNOM",$campo,"both");
        $this->db->or_like("u.USU_APELLIDOS",$campo,"both");
        $this->db->or_like("u.USU_TELEFONO",$campo,"both");
        $this->db->or_like("u.USU_TLFCELULAR",$campo,"both");
        $this->db->or_like("d.DOC_TITULO",$campo,"both");
        $this->db->or_like("u.USU_CORREO",$campo,"both");
        $this->db->or_like("u.USU_DIRECCION",$campo,"both");
        $this->db->or_like("d.DOC_ID",$campo,"both");
        $this->db->or_like("e.ESP_NOMBRE",$campo,"both");
        $resultado=$this->db->get("doctor d")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fGetDoctoresId($campo)
	  {
      $this->db->select("d.*, e.ESP_NOMBRE, u.*");
        $this->db->join("especialidad e", "d.ESP_ID = e.ESP_ID", "inner");
        $this->db->join("usuario u", "d.USU_ID = u.USU_ID", "inner");
        $this->db->where("d.DOC_ID",$campo);
      $resultado=$this->db->get("doctor d")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fInsertarDoctor($data)
    {
      $verifica = $this->db->where("USU_ID", $data['USU_ID'])->get("doctor")->row_array();
      if(empty($verifica)){
        $this->db->insert("doctor", $data);
        if($this->db->trans_status()){
          return array("exito"=>true);
        }
        else{
          return array("exito"=>false);
        }
      }
      else{
        return array("exito"=>false);
      }
    }
    
  public function fUpdateDoctor($data, $id){
    $this->db->where("DOC_ID", $id);
    $this->db->update("doctor", $data);
    if($this->db->trans_status()){
      return array("exito"=>true);
    }
    else{
      return array("exito"=>false);
    }
  }

  public function fDeleteDoctor($id){
    $this->db->where("DOC_ID", $id);
    $this->db->delete("doctor");
    if($this->db->trans_status()){
      return array("exito"=>true);
    }
    else{
      return array("exito"=>false);
    }
  }
}