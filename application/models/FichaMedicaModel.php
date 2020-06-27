<?php

class FichaMedicaModel extends CI_Model
{
	public function fGetFichaMedicas()
	{
        $this->db->select("f.*, p.*");
        $this->db->join("paciente p", "f.PAC_ID = p.PAC_ID", "inner");
        $resultado=$this->db->get("ficha_medica f")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }

    public function fGetFichaMedicasId($campo)
	{
        $this->db->select("f.*, p.*");
        $this->db->join("paciente p", "f.PAC_ID = p.PAC_ID", "inner");
        $this->db->where("f.FMED_ID",$campo);
        $resultado=$this->db->get("ficha_medica f")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }
    
    public function fGetFichaMedicasCampo($campo)
	{
        $this->db->select("f.*, p.*");
        $this->db->join("paciente p", "f.PAC_ID = p.PAC_ID", "inner");
        $this->db->like("f.FMED_ID", $campo, "both");
        $this->db->or_like("p.PAC_PRIMNOM",$campo,"both");
        $this->db->or_like("p.PAC_SEGNOM",$campo,"both");
        $this->db->or_like("p.PAC_APELLIDOS",$campo,"both");
        $this->db->or_like("f.FMED_ENFERMEDADES",$campo,"both");
        $this->db->or_like("f.FMED_ALERGIAS",$campo,"both");
        $this->db->or_like("f.FMED_OPERACIONES",$campo,"both");
        $this->db->or_like("f.FMED_MEDICACION",$campo,"both");
        $resultado=$this->db->get("ficha_medica f")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarFichaMedica($data)
    {
      $this->db->insert("ficha_medica", $data);
      if($this->db->trans_status()){
        return array("exito"=>true, "id"=>$this->db->insert_id());
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateFichaMedica($data, $id){
        $this->db->where("FMED_ID", $id);
        $this->db->update("ficha_medica", $data);
        if($this->db->trans_status()){
          return array("exito"=>true);
        }
        else{
          return array("exito"=>false);
        }
    }

    public function fDeleteFichaMedica($id)
    {
      $this->db->where("FMED_ID", $id);
      $this->db->delete("ficha_medica");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}