<?php

class Servicio extends CI_Controller {

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
		$this->load->model("ServicioModel");
    }
    
    public function getServicios(){
        $resultado=$this->ServicioModel->fGetServicios();
        echo json_encode($resultado); 
    }

    public function getServiciosCampo(){
        $_GET = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->get("campo");
        $resultado = $this->ServicioModel->fGetServiciosCampo($campo);
        echo json_encode($resultado);
    }

    public function getServiciosId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->ServicioModel->fGetServiciosId($campo);
        echo json_encode($resultado);
    }

    public function insertServicio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $IVA = $this->input->post('IVA');
        $data = array("SERV_ID"=>0, "SERV_NOMBRE"=>$nombre,"SERV_DESCRIPCION"=>$descripcion,"SERV_PRECIO"=>$precio,"SERV_IVA"=>$IVA);
        $resultado = $this->ServicioModel->fInsertarServicio($data);
        echo json_encode($resultado);
    }

    public function updateServicio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id'); 
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $IVA = $this->input->post('IVA');
        $data = array("SERV_ID"=>$id, "SERV_NOMBRE"=>$nombre,"SERV_DESCRIPCION"=>$descripcion,"SERV_PRECIO"=>$precio,"SERV_IVA"=>$IVA);
        $resultado = $this->ServicioModel->fUpdateServicio($data, $id);
        echo json_encode($resultado);
    }

    public function deleteServicio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->ServicioModel->fDeleteServicio($id);
        echo json_encode($resultado);
    }
}