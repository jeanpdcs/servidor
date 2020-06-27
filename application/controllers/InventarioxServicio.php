<?php
date_default_timezone_set('America/Bogota');

class InventarioxServicio extends CI_Controller {

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
		$this->load->model("InventarioxServicioModel");
    }
    
    public function getInventarioxServicios(){
        $resultado=$this->InventarioxServicioModel->fGetInventarioxServicios();
        echo json_encode($resultado);
    }

    public function getInventarioxServiciosServ(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $servicio = $this->input->post('servicio');
        $resultado = $this->InventarioxServicioModel->fGetInventarioxServiciosServ($servicio);
        echo json_encode($resultado);
    }

    public function getInventarioxServiciosCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->InventarioxServicioModel->fGetInventarioxServiciosCampo($campo);
        echo json_encode($resultado);
    }

    public function getInventarioxServiciosId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $invid = $this->input->post('invid');
        $servid = $this->input->post('servid');
        $resultado = $this->InventarioxServicioModel->fGetInventarioxServiciosId($invid, $servid);
        echo json_encode($resultado);
    }

    public function insertInventarioxServicio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $inventario = $this->input->post('inventario');
        $servicio = $this->input->post('servicio');
        $data = array("INV_ID"=>$inventario, "SERV_ID"=>$servicio);
        $resultado = $this->InventarioxServicioModel->fInsertarInventarioxServicio($data);
        echo json_encode($resultado);
    }

    public function updateInventarioxServicio(){
        $_POST = json_decode(file_get_contents("php://input"), true);
        $invid = $this->input->post('invid');
        $servid = $this->input->post('servid');
        $inventario = $this->input->post('inventario');
        $servicio = $this->input->post('servicio');
        $data = array("INV_ID"=>$inventario, "SERV_ID"=>$servicio);
        $resultado = $this->InventarioxServicioModel->fUpdateInventarioxServicio($data, $invid, $servid);
        echo json_encode($resultado);
    }

    public function deleteInventarioxServicio(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $invid = $this->input->post('invid');
        $servid = $this->input->post('servid');
        $resultado = $this->InventarioxServicioModel->fDeleteInventarioxServicio($invid, $servid);
        echo json_encode($resultado);
    }

}