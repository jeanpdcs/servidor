<?php

class Consultorio extends CI_Controller {

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
		$this->load->model("ConsultorioModel");
    }
    
    public function getConsultorios(){
        $resultado=$this->ConsultorioModel->fGetConsultorios();
        echo json_encode($resultado); 
    }

    public function getConsultoriosCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->ConsultorioModel->fGetConsultoriosCampo($campo);
        echo json_encode($resultado);
    }

    public function getConsultoriosId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->ConsultorioModel->fGetConsultoriosId($campo);
        echo json_encode($resultado);
    }

    public function insertConsultorio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $descripcion = $this->input->post('descripcion');
        $data = array("CON_ID"=>0,"CON_DESCRIPCION"=>$descripcion);
        $resultado = $this->ConsultorioModel->fInsertarConsultorio($data);
        echo json_encode($resultado);
    }

    public function updateConsultorio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $descripcion = $this->input->post('descripcion');
        $data = array("CON_DESCRIPCION"=>$descripcion);
        $resultado = $this->ConsultorioModel->fUpdateConsultorio($data, $id);
        echo json_encode($resultado);
    }

    public function deleteConsultorio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->ConsultorioModel->fDeleteConsultorio($id);
        echo json_encode($resultado);
    }

}