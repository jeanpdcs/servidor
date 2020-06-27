<?php

class TIModel extends CI_Model
{
	public function fGetTI()
	{
        $resultado=$this->db->get("tipo_identificacion")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }
    
    public function fGetTICampo($campo)
	{
        $this->db->like("TID_ID", $campo, "both");
        $this->db->or_like("TID_NOMBRE",$campo,"both");
        $resultado=$this->db->get("tipo_identificacion")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
	}
	
	public function fGetTIId($campo)
	  {
      $this->db->select("*");
      $this->db->where("TID_ID",$campo);
      $resultado=$this->db->get("tipo_identificacion")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fInsertarTI($data)
	{
        $this->db->insert("tipo_identificacion", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
    }
    
    public function fUpdateTI($data, $id)
	{
        $this->db->where("TID_ID", $id);
        $this->db->update("tipo_identificacion", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
	}
	
	public function fDeleteTI($id){
		$this->db->where("TID_ID", $id);
		$this->db->delete("tipo_identificacion");
		if($this->db->trans_status()){
		  return array("exito"=>true);
		}
		else{
		  return array("exito"=>false);
		}
	  }
}