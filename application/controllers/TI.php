<?php

class TI extends CI_Controller {

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
		$this->load->model("TIModel");
    }
    
    public function getTI(){
        $resultado=$this->TIModel->fGetTI();
        echo json_encode($resultado); 
    }

    public function getTICampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->TIModel->fGetTICampo($campo);
        echo json_encode($resultado);
    }

    public function getTIId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->TIModel->fGetTIId($campo);
        echo json_encode($resultado);
    }

    public function insertTI(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $nombre = $this->input->post('nombre');
        $data = array("TID_ID"=>0,"TID_NOMBRE"=>$nombre);
        $resultado = $this->TIModel->fInsertarTI($data);
        echo json_encode($resultado);
    }

    public function updateTI(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $data = array("TID_NOMBRE"=>$nombre);
        $resultado = $this->TIModel->fUpdateTI($data, $id);
        echo json_encode($resultado);
    }

    public function deleteTI(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->TIModel->fDeleteTI($id);
        echo json_encode($resultado);
    }

}