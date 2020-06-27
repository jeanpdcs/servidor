<?php

class ConsultorioModel extends CI_Model
{
	public function fGetConsultorios()
	{
        $resultado=$this->db->get("consultorio")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }
    
    public function fGetConsultoriosCampo($campo)
	{
        $this->db->like("CON_ID", $campo, "both");
        $this->db->or_like("CON_DESCRIPCION",$campo,"both");
        $resultado=$this->db->get("consultorio")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
	}
	
	public function fGetConsultoriosId($campo)
	  {
      $this->db->select("*");
      $this->db->where("CON_ID",$campo);
      $resultado=$this->db->get("consultorio")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fInsertarConsultorio($data)
	{
        $this->db->insert("consultorio", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
    }
    
    public function fUpdateConsultorio($data, $id)
	{
        $this->db->where("CON_ID", $id);
        $this->db->update("consultorio", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
	}
	
	public function fDeleteConsultorio($id){
		$this->db->where("CON_ID", $id);
		$this->db->delete("consultorio");
		if($this->db->trans_status()){
		  return array("exito"=>true);
		}
		else{
		  return array("exito"=>false);
		}
	  }
}