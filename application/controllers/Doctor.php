<?php

class Doctor extends CI_Controller {

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
		$this->load->model("DoctorModel");
    }
    
    public function getDoctores(){
        $resultado=$this->DoctorModel->fGetDoctores();
        echo json_encode($resultado);
    }

    public function getDoctoresCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->DoctorModel->fGetDoctoresCampo($campo);
        echo json_encode($resultado);
    }

    public function getDoctoresId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->DoctorModel->fGetDoctoresId($campo);
        echo json_encode($resultado);
    }

    public function insertDoctor(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $usuid = $this->input->post('usuid');
        $esp = $this->input->post('especialidad');
        $titulo = $this->input->post('titulo');
        //DOC_PRIMNOM DOC_SEGNOM DOC_APELLIDOS DOC_TELEFONO DOC_TLFCELULAR DOC_TITULO DOC_CORREO ESP_ID DOC_ID
        $data = array("DOC_ID"=>0, "USU_ID"=>$usuid, "ESP_ID"=>$esp, "DOC_TITULO"=>$titulo);
        $resultado = $this->DoctorModel->fInsertarDoctor($data);
        echo json_encode($resultado);
    }

    public function updateDoctor(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $usuid = $this->input->post('usuid');
        $esp = $this->input->post('especialidad');
        $titulo = $this->input->post('titulo');
        $data = array("DOC_ID"=>$id,"USU_ID"=>$usuid, "ESP_ID"=>$esp, "DOC_TITULO"=>$titulo);
        $resultado = $this->DoctorModel->fUpdateDoctor($data, $id);
        echo json_encode($resultado);
    }

    public function deleteDoctor(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->DoctorModel->fDeleteDoctor($id);
        echo json_encode($resultado);
    }
}