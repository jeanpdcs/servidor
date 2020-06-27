<?php

class InventarioModel extends CI_Model
{
	public function fGetInventarios()
	{
        $resultado=$this->db->get("inventario")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }
    
    public function fGetInventariosCampo($campo)
	{
        $this->db->like("INV_ID", $campo, "both");
        $this->db->or_like("INV_NOMBRE",$campo,"both");
        $this->db->or_like("INV_DESCRIPCION",$campo,"both");
        $resultado=$this->db->get("inventario")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }

    public function fGetInventariosId($campo)
	  {
      $this->db->select("*");
      $this->db->where("INV_ID",$campo);
      $resultado=$this->db->get("inventario")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fInsertarInventario($data)
	{
        $this->db->insert("inventario", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
    }
    
    public function fUpdateInventario($data, $id)
	{
        $this->db->where("INV_ID", $id);
        $this->db->update("inventario", $data);
        if($this->db->trans_status()){
			return array("exito"=>true);
		}
		else{
			return array("exito"=>false);
		}
    }

    public function fDeleteInventario($id){
        $this->db->where("INV_ID", $id);
        $this->db->delete("inventario");
        if($this->db->trans_status()){
          return array("exito"=>true);
        }
        else{
          return array("exito"=>false);
        }
      }
}