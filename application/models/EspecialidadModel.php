<?php

class EspecialidadModel extends CI_Model
{
	public function fGetEspecialidades()
	{
        $resultado=$this->db->get("especialidad")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }
    
    public function fGetEspecialidadesCampo($campo)
	{
        $this->db->like("ESP_ID", $campo, "both");
        $this->db->or_like("ESP_NOMBRE",$campo,"both");
        $this->db->or_like("ESP_DESCRIPCION",$campo,"both");
        $resultado=$this->db->get("especialidad")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }

    public function fGetEspecialidadesId($campo)
	  {
      $this->db->select("*");
      $this->db->where("ESP_ID",$campo);
      $resultado=$this->db->get("especialidad")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fInsertarEspecialidad($data)
	{
        $this->db->insert("especialidad", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
    }
    
    public function fUpdateEspecialidad($data, $id)
	{
        $this->db->where("ESP_ID", $id);
        $this->db->update("especialidad", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
    }

    public function fDeleteEspecialidad($id){
        $this->db->where("ESP_ID", $id);
        $this->db->delete("especialidad");
        if($this->db->trans_status()){
          return array("exito"=>true);
        }
        else{
          return array("exito"=>false);
        }
      }
}