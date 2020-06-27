<?php

class ServicioModel extends CI_Model
{
	public function fGetServicios()
	{
        $resultado=$this->db->get("servicio")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }
    
    public function fGetServiciosCampo($campo)
	{
        $this->db->like("SERV_ID", $campo, "both");
        $this->db->or_like("SERV_NOMBRE",$campo,"both");
        $this->db->or_like("SERV_DESCRIPCION",$campo,"both");
        $this->db->or_like("SERV_PRECIO",$campo,"both");
        $this->db->or_like("SERV_IVA",$campo,"both");
        $resultado=$this->db->get("servicio")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }

    public function fGetServiciosId($campo)
	  {
      $this->db->select("*");
      $this->db->where("SERV_ID",$campo);
      $resultado=$this->db->get("servicio")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fInsertarServicio($data)
	  {
      $data["SERV_IVA"]=$data["SERV_IVA"]/100;
      $this->db->insert("servicio", $data);
      if($this->db->trans_status()){
			  return array("exito"=>true, "id"=>$this->db->insert_id());
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateServicio($data, $id)
	  {
      $this->db->where("SERV_ID", $id);
      $this->db->update("servicio", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
		  }
    }

    public function fDeleteServicio($id)
    {
        $this->db->where("SERV_ID", $id);
        $this->db->delete("servicio");
        if($this->db->trans_status()){
          return array("exito"=>true);
        }
        else{
          return array("exito"=>false);
        }
      }
}