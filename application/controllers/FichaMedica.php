<?php

class FichaMedica extends CI_Controller {

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
		$this->load->model("FichaMedicaModel");
    }
    
    public function getFichaMedicas(){
        $resultado=$this->FichaMedicaModel->fGetFichaMedicas();
        echo json_encode($resultado);
    }

    public function getFichaMedicasCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->FichaMedicaModel->fGetFichaMedicasCampo($campo);
        echo json_encode($resultado);
    }

    public function getFichaMedicasId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->FichaMedicaModel->fGetFichaMedicasId($campo);
        echo json_encode($resultado);
    }

    public function insertFichaMedica(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $paciente = $this->input->post('paciente');
        $enfermedades = $this->input->post('enfermedades');
        $alergias = $this->input->post('alergias');
        $operaciones = $this->input->post('operaciones');
        $medicacion = $this->input->post('medicacion');
        $data = array("FMED_ID"=>0, "PAC_ID"=>$paciente, "FMED_ENFERMEDADES"=>$enfermedades,"FMED_ALERGIAS"=>$alergias, "FMED_OPERACIONES"=>$operaciones, "FMED_MEDICACION"=>$medicacion);
        $resultado = $this->FichaMedicaModel->fInsertarFichaMedica($data);
        echo json_encode($resultado);
    }

    public function updateFichaMedica(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $paciente = $this->input->post('paciente');
        $enfermedades = $this->input->post('enfermedades');
        $alergias = $this->input->post('alergias');
        $operaciones = $this->input->post('operaciones');
        $medicacion = $this->input->post('medicacion');
        $data = array("FMED_ID"=>$id, "PAC_ID"=>$paciente, "FMED_ENFERMEDADES"=>$enfermedades,"FMED_ALERGIAS"=>$alergias, "FMED_OPERACIONES"=>$operaciones, "FMED_MEDICACION"=>$medicacion);        $resultado = $this->FichaMedicaModel->fUpdateFichaMedica($data, $id);
        echo json_encode($resultado);
    }

    public function deleteFichaMedica(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->FichaMedicaModel->fDeleteFichaMedica($id);
        echo json_encode($resultado);
    }
}