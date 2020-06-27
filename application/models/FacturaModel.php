<?php

class FacturaModel extends CI_Model
{
	public function fGetFacturas()
	{
    $this->db->select("f.*, c.*");
    $this->db->join("cliente c", "f.CLI_ID = c.CLI_ID", "inner");
    $this->db->order_by("FAC_ID","DESC");
    $resultado=$this->db->get("factura f")->result_array();
    if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }

    public function fGetFacturasId($campo)
	{
        $this->db->select("f.*, c.*");
        $this->db->join("cliente c", "f.CLI_ID = c.CLI_ID", "inner");
        $this->db->where("f.FAC_ID",$campo);
        $resultado=$this->db->get("factura f")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }
    
    public function fGetFacturasCampo($campo)
	{
        $this->db->select("f.*, c.*");
        $this->db->join("cliente c", "f.CLI_ID = c.CLI_ID", "inner");
        $this->db->like("f.FAC_ID", $campo, "both");
        $this->db->or_like("f.FAC_NUMERO",$campo,"both");
        $this->db->or_like("f.FAC_ESTADO",$campo,"both");
        $this->db->or_like("f.FAC_FECHA",$campo,"both");
        $this->db->or_like("c.CLI_ID",$campo,"both");
        $this->db->or_like("c.CLI_PRIMNOM",$campo,"both");
        $this->db->or_like("c.CLI_SEGNOM",$campo,"both");
        $this->db->or_like("c.CLI_APELLIDOS",$campo,"both");
        $resultado=$this->db->get("factura f")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarFactura($data)
    {
      
      $this->db->insert("factura", $data);
      if($this->db->trans_status()){
        return array("exito"=>true, "id"=>$this->db->insert_id());
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateFactura($data, $id)
	{
      $this->db->where("FAC_ID", $id);
      $this->db->update("factura", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fAnularFactura($id)
	{
      $this->db->where("FAC_ID", $id);
      $this->db->set("FAC_ESTADO", "Anulado");
      $this->db->update("factura");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fPagarFactura($id)
	{
      $this->db->where("FAC_ID", $id);
      $this->db->set("FAC_ESTADO", "Pagado");
      $this->db->update("factura");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}