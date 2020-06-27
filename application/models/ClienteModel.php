<?php

class ClienteModel extends CI_Model
{
	public function fGetClientes()
	{
    $this->db->select("c.*, t.TID_NOMBRE");
    $this->db->join("tipo_identificacion t", "c.TID_ID = t.TID_ID", "inner");
    $resultado=$this->db->get("cliente c")->result_array();
    if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
  }

  public function fGetClientesId($campo)
	  {
      $this->db->select("c.*, t.TID_NOMBRE");
      $this->db->join("tipo_identificacion t", "c.TID_ID = t.TID_ID", "inner");
      $this->db->where("c.CLI_ID",$campo);
      $resultado=$this->db->get("cliente c")->result_array();
      if(!empty($resultado)){
        return array("exito"=>true,"data"=>$resultado);
      }
      else{
        return array("exito"=>false, "data"=>array());
      }
    }
    
    public function fGetClientesCampo($campo)
	{
        $this->db->select("c.*, t.TID_NOMBRE");
        $this->db->join("tipo_identificacion t", "c.TID_ID = t.TID_ID", "inner");
        $this->db->like("c.CLI_PRIMNOM", $campo, "both");//DOC_PRIMNOM DOC_SEGNOM DOC_APELLIDOS DOC_TELEFONO DOC_TLFCELULAR DOC_TITULO DOC_CORREO ESP_ID DOC_ID
        $this->db->or_like("c.CLI_SEGNOM",$campo,"both");
        $this->db->or_like("c.CLI_APELLIDOS",$campo,"both");
        $this->db->or_like("c.CLI_TELEFONO",$campo,"both");
        $this->db->or_like("c.CLI_DIRECCION",$campo,"both");
        $this->db->or_like("c.CLI_CORREO",$campo,"both");
        $this->db->or_like("c.CLI_ID",$campo,"both");
        $this->db->or_like("c.CLI_CI",$campo,"both");
        $this->db->or_like("t.TID_NOMBRE",$campo,"both");
        $resultado=$this->db->get("cliente c")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarCliente($data)
    {
      
      $this->db->insert("cliente", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateCliente($data, $id)
	  {
      $this->db->where("CLI_ID", $id);
      $this->db->update("cliente", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fDeleteCliente($id){
      $this->db->where("CLI_ID", $id);
      $this->db->delete("cliente");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}