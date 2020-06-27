<?php

class Especialidad extends CI_Controller {

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
		$this->load->model("EspecialidadModel");
    }
    
    public function getEspecialidades(){
        $resultado=$this->EspecialidadModel->fGetEspecialidades();
        echo json_encode($resultado); 
    }

    public function getEspecialidadesCampo(){
        $_GET = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->get("campo");
        $resultado = $this->EspecialidadModel->fGetEspecialidadesCampo($campo);
        echo json_encode($resultado);
    }

    public function getEspecialidadesId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->EspecialidadModel->fGetEspecialidadesId($campo);
        echo json_encode($resultado);
    }

    public function insertEspecialidad(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $data = array("ESP_ID"=>0, "ESP_NOMBRE"=>$nombre,"ESP_DESCRIPCION"=>$descripcion);
        $resultado = $this->EspecialidadModel->fInsertarEspecialidad($data);
        echo json_encode($resultado);
    }

    public function updateEspecialidad(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id'); 
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $data = array("ESP_NOMBRE"=>$nombre,"ESP_DESCRIPCION"=>$descripcion);
        $resultado = $this->EspecialidadModel->fUpdateEspecialidad($data, $id);
        echo json_encode($resultado);
    }

    public function deleteEspecialidad(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->EspecialidadModel->fDeleteEspecialidad($id);
        echo json_encode($resultado);
    }
}