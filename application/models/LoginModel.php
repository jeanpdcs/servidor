<?php

class LoginModel extends CI_Model
{
	public function fLogin($username,$password)
	{
		$this->db->where("usu_correo", $username)->where("usu_clave", $password);
		$resultado=$this->db->get("usuario")->row_array();
		//si es que el query devuelve muchos registros uso->result_array(); en el controlador $this->session->set_userdata('session_user', $resultado["data"][0]["USU_ID"]);
		//si es que el query devuelve un solo registro uso->row_array(); en el controlador $this->session->set_userdata('session_user', $resultado["data"]["USU_ID"]);
		if(!empty($resultado)){//si no esta vacio, entonces el usuario puede iniciar sesion
			return array("exito"=>true,"data"=>$resultado);
		}
		else{//si esta vacio el usuario no concuerda
			return array("exito"=>false);
		}
	}
}