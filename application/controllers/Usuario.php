<?php

class Usuario extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
		}
		parent::__construct();
		$this->load->model("UsuarioModel");
    }
    
    public function getUsuarios(){
        $resultado=$this->UsuarioModel->fGetUsuarios();
        echo json_encode($resultado);
    }

    public function getUsuariosCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->UsuarioModel->fGetUsuariosCampo($campo);
        echo json_encode($resultado);
    }

    public function getUsuariosId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->UsuarioModel->fGetUsuariosId($campo);
        echo json_encode($resultado);
    }

    public function insertUsuario(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $tid = $this->input->post('TI');
        $ci = $this->input->post('ci');
        $rol = $this->input->post('rol');
        $primNom = $this->input->post('primNom');
        $segNom = $this->input->post('segNom');
        $apellido = $this->input->post('apellido');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $celular = $this->input->post('celular');
        $correo = $this->input->post('correo');
        $clave = $this->input->post('clave');
        $data = array("USU_ID"=>0, "TID_ID"=>$tid, "USU_CEDULA"=>$ci, "USU_ROL"=>$rol, "USU_PRIMNOM"=>$primNom, "USU_SEGNOM"=>$segNom, "USU_APELLIDOS"=>$apellido, "USU_DIRECCION"=>$direccion,"USU_TELEFONO"=>$telefono, "USU_TLFCELULAR"=>$celular, "USU_CORREO"=>$correo, "USU_CLAVE"=>$clave);
        $resultado = $this->UsuarioModel->fInsertarUsuario($data);
        echo json_encode($resultado);
    }

    public function updateUsuario(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $tid = $this->input->post('TI');
        $ci = $this->input->post('ci');
        $rol = $this->input->post('rol');
        $primNom = $this->input->post('primNom');
        $segNom = $this->input->post('segNom');
        $apellido = $this->input->post('apellido');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $celular = $this->input->post('celular');
        $correo = $this->input->post('correo');
        $clave = $this->input->post('clave');
        $data = array("USU_ID"=>$id,"TID_ID"=>$tid, "USU_CEDULA"=>$ci, "USU_ROL"=>$rol, "USU_PRIMNOM"=>$primNom, "USU_SEGNOM"=>$segNom, "USU_APELLIDOS"=>$apellido, "USU_DIRECCION"=>$direccion,"USU_TELEFONO"=>$telefono, "USU_TLFCELULAR"=>$celular, "USU_CORREO"=>$correo, "USU_CLAVE"=>$clave);
        $resultado = $this->UsuarioModel->fUpdateUsuario($data, $id);
        echo json_encode($resultado);
    }

    public function deleteUsuario(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->UsuarioModel->fDeleteUsuario($id);
        echo json_encode($resultado);
    }
}