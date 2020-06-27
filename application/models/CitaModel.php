<?php

class CitaModel extends CI_Model
{
	public function fGetCitas()
	{
      $this->db->select("c.*, o.CON_DESCRIPCION, d.*, p.*, u.*");
      $this->db->join("doctor d", "c.DOC_ID = d.DOC_ID", "inner");
      $this->db->join("usuario u", "d.USU_ID = u.USU_ID", "inner");
      $this->db->join("consultorio o", "c.CON_ID = o.CON_ID", "inner");
      $this->db->join("paciente p", "c.PAC_ID = p.PAC_ID", "inner");
      $resultado=$this->db->get("cita c")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
  }
    
    public function fGetCitasCampo($campo)
	  {
      $this->db->select("c.*, o.CON_DESCRIPCION, d.*, p.*");
      $this->db->join("doctor d", "c.DOC_ID = d.DOC_ID", "inner");
      $this->db->join("consultorio o", "c.CON_ID = o.CON_ID", "inner");
      $this->db->join("paciente p", "c.PAC_ID = p.PAC_ID", "inner");
      $this->db->like("d.DOC_ID", $campo, "both");
      $this->db->or_like("o.CON_ID",$campo,"both");
      $this->db->or_like("p.PAC_ID",$campo,"both");
      $this->db->or_like("c.CIT_DESCRIPCION",$campo,"both");
      $this->db->or_like("c.CIT_ID",$campo,"both");
      $resultado=$this->db->get("cita c")->result_array();
      if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fGetCitasId($campo)
	  {
      $this->db->select("c.*, o.CON_DESCRIPCION, d.*, p.*");
      $this->db->join("doctor d", "c.DOC_ID = d.DOC_ID", "inner");
      $this->db->join("consultorio o", "c.CON_ID = o.CON_ID", "inner");
      $this->db->join("paciente p", "c.PAC_ID = p.PAC_ID", "inner");
      $this->db->where("c.CIT_ID",$campo);
      $resultado=$this->db->get("cita c")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fInsertarCita($data)
    {
      $this->db->insert("cita", $data);
      if($this->db->trans_status()){
        return array("exito"=>true, "id"=>$this->db->insert_id());
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fGetCorreo($id)
    {
      $this->db->select("c.*, p.*");
      $this->db->join("paciente p", "c.PAC_ID = p.PAC_ID", "inner");
      $this->db->where("c.CIT_ID",$id);
      $resultado=$this->db->get("cita c")->row_array();
      if(!empty($resultado)){
        $resultado["nombre"] = $resultado["PAC_PRIMNOM"]." ".$resultado["PAC_SEGNOM"]." ".$resultado["PAC_APELLIDOS"];
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }
    
    public function fUpdateCita($data, $id)
	  {
      $clave=array_keys($data);
      foreach($clave as $c){
        if(empty($data[$c]))
          unset($data[$c]);
      }
      $this->db->where("CIT_ID", $id);
      $this->db->update("cita", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fDeleteCita($id){
      $this->db->where("CIT_ID", $id);
      $this->db->delete("cita");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}