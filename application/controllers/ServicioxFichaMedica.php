<?php
date_default_timezone_set('America/Bogota');

class ServicioxFichaMedica extends CI_Controller {

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
		$this->load->model("ServicioxFichaMedicaModel");
    }
    
    public function getServicioxFichaMedicas(){
        $resultado=$this->ServicioxFichaMedicaModel->fGetServicioxFichaMedicas();
        echo json_encode($resultado);
    }

    /*public function getServicioxFichaMedicasCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->ServicioxFichaMedicaModel->fGetServicioxFichaMedicasCampo($campo);
        echo json_encode($resultado);
    }*/

    public function getServicioxFichaMedicasFMED(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $fmed = $this->input->post('fmed');
        $resultado = $this->ServicioxFichaMedicaModel->fGetServicioxFichaMedicasFMED($fmed);
        echo json_encode($resultado);
    }

    public function getServicioxFichaMedicasCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->ServicioxFichaMedicaModel->fGetServicioxFichaMedicasCampo($campo);
        echo json_encode($resultado);
    }

    public function getServicioxFichaMedicasId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->ServicioxFichaMedicaModel->fGetServicioxFichaMedicasId($id);
        echo json_encode($resultado);
    }

    public function insertServicioxFichaMedica(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $servicio = $this->input->post('servicio');
        $fichaMedica = $this->input->post('fmed');
        $fecha = $this->input->post('fecha');
        $data = array("SFM_ID"=>0, "SERV_ID"=>$servicio, "FMED_ID"=>$fichaMedica, "SFM_FECHA"=>$fecha);
        $resultado = $this->ServicioxFichaMedicaModel->fInsertarServicioxFichaMedica($data);
        echo json_encode($resultado);
    }

    public function updateServicioxFichaMedica(){
        $_POST = json_decode(file_get_contents("php://input"), true);
        $id = $this->input->post('id');
        $servicio = $this->input->post('servicio');
        $fichaMedica = $this->input->post('fmed');
        $fecha = $this->input->post('fecha');
        $data = array("SFM_ID"=>$id, "SERV_ID"=>$servicio, "FMED_ID"=>$fichaMedica, "SFM_FECHA"=>$fecha);
        $resultado = $this->ServicioxFichaMedicaModel->fUpdateServicioxFichaMedica($data, $id);
        echo json_encode($resultado);
    }

    public function deleteServicioxFichaMedica(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->ServicioxFichaMedicaModel->fDeleteServicioxFichaMedica($id);
        echo json_encode($resultado);
    }

}