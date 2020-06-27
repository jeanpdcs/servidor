<?php

class Cliente extends CI_Controller {

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
		$this->load->model("ClienteModel");
    }
    
    public function getClientes(){
        $resultado=$this->ClienteModel->fGetClientes();
        echo json_encode($resultado);
    }

    public function getClientesCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->ClienteModel->fGetClientesCampo($campo);
        echo json_encode($resultado);
    }

    public function getClientesId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->ClienteModel->fGetClientesId($campo);
        echo json_encode($resultado);
    }

    public function insertCliente(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $tid = $this->input->post('TI');
        $ci = $this->input->post('ci');
        $primNom = $this->input->post('primNom');
        $segNom = $this->input->post('segNom');
        $apellido = $this->input->post('apellido');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $correo = $this->input->post('correo');
        $data = array("CLI_ID"=>0, "TID_ID"=>$tid, "CLI_CI"=>$ci,"CLI_PRIMNOM"=>$primNom, "CLI_SEGNOM"=>$segNom, "CLI_APELLIDOS"=>$apellido, "CLI_DIRECCION"=>$direccion,"CLI_TELEFONO"=>$telefono, "CLI_CORREO"=>$correo);
        $resultado = $this->ClienteModel->fInsertarCliente($data);
        echo json_encode($resultado);
    }

    public function updateCliente(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $tid = $this->input->post('TI');
        $ci = $this->input->post('ci');
        $primNom = $this->input->post('primNom');
        $segNom = $this->input->post('segNom');
        $apellido = $this->input->post('apellido');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $correo = $this->input->post('correo');
        $data = array("CLI_ID"=>$id, "TID_ID"=>$tid, "CLI_CI"=>$ci,"CLI_PRIMNOM"=>$primNom, "CLI_SEGNOM"=>$segNom, "CLI_APELLIDOS"=>$apellido, "CLI_DIRECCION"=>$direccion,"CLI_TELEFONO"=>$telefono, "CLI_CORREO"=>$correo);
        $resultado = $this->ClienteModel->fUpdateCliente($data, $id);
        echo json_encode($resultado);
    }

    public function deleteCliente(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->ClienteModel->fDeleteCliente($id);
        echo json_encode($resultado);
    }
}