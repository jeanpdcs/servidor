<?php

class DescuentoModel extends CI_Model
{
	public function fGetDescuentos()
	{
        $this->db->select("d.*, s.SERV_NOMBRE");
        $this->db->join("servicio s", "d.SERV_ID = s.SERV_ID", "inner");
        $resultado=$this->db->get("descuento d")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }

    public function fGetDescuentosId($campo)
	{
        $this->db->select("d.*, s.SERV_NOMBRE");
        $this->db->join("servicio s", "d.SERV_ID = s.SERV_ID", "inner");
        $this->db->where("d.DESC_ID",$campo);
        $resultado=$this->db->get("descuento d")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }
    
    public function fGetDescuentosCampo($campo)
	{
        $this->db->select("d.*, s.SERV_NOMBRE");
        $this->db->join("servicio s", "d.SERV_ID = s.SERV_ID", "inner");
        $this->db->like("d.DESC_DESCRIPCION", $campo, "both");
        $this->db->or_like("s.SERV_NOMBRE",$campo,"both");
        $this->db->or_like("d.DESC_VALOR",$campo,"both");
        $resultado=$this->db->get("descuento d")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarDescuento($data)
    {
      
      $this->db->insert("descuento", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateDescuento($data, $id){
        $this->db->where("DESC_ID", $id);
        $this->db->update("descuento", $data);
        if($this->db->trans_status()){
          return array("exito"=>true);
        }
        else{
          return array("exito"=>false);
        }
    }

    public function fDeleteDescuento($id)
    {
      $this->db->where("DESC_ID", $id);
      $this->db->delete("descuento");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}