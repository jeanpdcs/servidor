<?php

class InventarioxServicioModel extends CI_Model
{
	public function fGetInventarioxServicios()
	{
        $this->db->select("is.*, s.*, i.*");
        $this->db->join("inventario i", "is.INV_ID = i.INV_ID", "inner");
        $this->db->join("servicio s", "is.SERV_ID = s.SERV_ID", "inner");
      $resultado=$this->db->get("inventario_x_servicio is")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
  }

  public function fGetInventarioxServiciosServ($serv)
	{
    $this->db->select("is.*, s.*, i.*");
    $this->db->join("inventario i", "is.INV_ID = i.INV_ID", "inner");
    $this->db->join("servicio s", "is.SERV_ID = s.SERV_ID", "inner");
        $this->db->where("s.SERV_ID",$serv);
        $resultado=$this->db->get("inventario_x_servicio is")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }
    
    public function fGetInventarioxServiciosCampo($campo)
	  {
      $this->db->select("is.*, s.*, i.*");
      $this->db->join("inventario i", "is.INV_ID = i.INV_ID", "inner");
      $this->db->join("servicio s", "is.SERV_ID = s.SERV_ID", "inner");
      $this->db->like("i.INV_ID", $campo, "both");
      $this->db->or_like("s.SERV_ID",$campo,"both");
      $resultado=$this->db->get("inventario_x_servicio is")->result_array();
      if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }

    public function fGetInventarioxServiciosId($invid, $servid)
	{
        $this->db->select("is.*, s.*, i.*");
        $this->db->join("inventario i", "is.INV_ID = i.INV_ID", "inner");
        $this->db->join("servicio s", "is.SERV_ID = s.SERV_ID", "inner");
        $this->db->where("is.SERV_ID",$servid);
        $this->db->where("is.INV_ID",$invid);
        $resultado=$this->db->get("inventario_x_servicio is")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarInventarioxServicio($data)
    {
      $this->db->insert("inventario_x_servicio", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateInventarioxServicio($data, $invid, $servid)
	  {
      $clave=array_keys($data);
      foreach($clave as $c){
        if(empty($data[$c]))
          unset($data[$c]);
      }
      $this->db->where("SERV_ID", $servid);
      $this->db->where("INV_ID", $invid);
      $this->db->update("inventario_x_servicio", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fDeleteInventarioxServicio($invid, $servid){
        $this->db->where("SERV_ID", $servid);
        $this->db->where("INV_ID", $invid);
        $this->db->delete("inventario_x_servicio");
        if($this->db->trans_status()){
            return array("exito"=>true);
        }
        else{
            return array("exito"=>false);
        }
    }
}