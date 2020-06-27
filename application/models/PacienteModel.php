<?php

class PacienteModel extends CI_Model
{
	public function fGetPacientes()
	{
    $this->db->select("p.*, t.TID_NOMBRE");
    $this->db->join("tipo_identificacion t", "p.TID_ID = t.TID_ID", "inner");
    $resultado=$this->db->get("paciente p")->result_array();
    if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
  }

  public function fGetPacientesId($campo)
	  {
      $this->db->select("p.*, t.TID_NOMBRE");
      $this->db->join("tipo_identificacion t", "p.TID_ID = t.TID_ID", "inner");
      $this->db->where("p.PAC_ID",$campo);
      $resultado=$this->db->get("paciente p")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }
    
    public function fGetPacientesCampo($campo)
	{
        $this->db->select("p.*, t.TID_NOMBRE");
        $this->db->join("tipo_identificacion t", "p.TID_ID = t.TID_ID", "inner");
        $this->db->like("p.PAC_PRIMNOM", $campo, "both");//DOC_PRIMNOM DOC_SEGNOM DOC_APELLIDOS DOC_TELEFONO DOC_TLFCELULAR DOC_TITULO DOC_CORREO ESP_ID DOC_ID
        $this->db->or_like("p.PAC_SEGNOM",$campo,"both");
        $this->db->or_like("p.PAC_APELLIDOS",$campo,"both");
        $this->db->or_like("p.PAC_TELEFONO",$campo,"both");
        $this->db->or_like("p.PAC_TLFCELULAR",$campo,"both");
        $this->db->or_like("p.PAC_FECHANACIMIENTO",$campo,"both");
        $this->db->or_like("p.PAC_CORREO",$campo,"both");
        $this->db->or_like("p.PAC_ID",$campo,"both");
        $this->db->or_like("p.PAC_CI",$campo,"both");
        $this->db->or_like("p.PAC_EDAD",$campo,"both");
        $this->db->or_like("p.PAC_SEXO",$campo,"both");
        $this->db->or_like("p.PAC_DIRECCION",$campo,"both"); 
        $this->db->or_like("p.PAC_GRUPOSANGUINEO",$campo,"both");
        $this->db->or_like("t.TID_NOMBRE",$campo,"both");
        $resultado=$this->db->get("paciente p")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarPaciente($data)
    {
      
      $this->db->insert("paciente", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdatePaciente($data, $id)
	  {
      $this->db->where("PAC_ID", $id);
      $this->db->update("paciente", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fDeletePaciente($id){
      $this->db->where("PAC_ID", $id);
      $this->db->delete("paciente");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}