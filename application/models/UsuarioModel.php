<?php

class UsuarioModel extends CI_Model
{
	public function fGetUsuarios()
	{
        $this->db->select("u.*, t.TID_NOMBRE");
        $this->db->join("tipo_identificacion t", "u.TID_ID = t.TID_ID", "inner");
        $resultado=$this->db->get("usuario u")->result_array();
        if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
    }

    public function fGetUsuariosId($campo)
	{
        $this->db->select("u.*, t.TID_NOMBRE");
        $this->db->join("tipo_identificacion t", "u.TID_ID = t.TID_ID", "inner");
        $this->db->where("u.USU_ID",$campo);
        $resultado=$this->db->get("usuario u")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }
    
    public function fGetUsuariosCampo($campo)
	{
        $this->db->select("u.*, t.TID_NOMBRE");
        $this->db->join("tipo_identificacion t", "u.TID_ID = t.TID_ID", "inner");
        $this->db->like("u.USU_PRIMNOM", $campo, "both");
        $this->db->or_like("u.USU_ROL",$campo,"both");
        $this->db->or_like("u.USU_SEGNOM",$campo,"both");
        $this->db->or_like("u.USU_APELLIDOS",$campo,"both");
        $this->db->or_like("u.USU_TELEFONO",$campo,"both");
        $this->db->or_like("u.USU_TLFCELULAR",$campo,"both");
        $this->db->or_like("u.USU_CORREO",$campo,"both");
        $this->db->or_like("u.USU_CLAVE",$campo,"both");
        $this->db->or_like("u.USU_ID",$campo,"both");
        $this->db->or_like("u.USU_CEDULA",$campo,"both");
        $this->db->or_like("u.USU_DIRECCION",$campo,"both");
        $this->db->or_like("t.TID_NOMBRE",$campo,"both");
        $resultado=$this->db->get("usuario u")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarUsuario($data)
    {
      
      $this->db->insert("usuario", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateUsuario($data, $id){
        $this->db->where("USU_ID", $id);
        $this->db->update("usuario", $data);
        if($this->db->trans_status()){
          return array("exito"=>true);
        }
        else{
          return array("exito"=>false);
        }
    }

    public function fDeleteUsuario($id)
    {
      $this->db->where("USU_ID", $id);
      $this->db->delete("usuario");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}