<?php

class Inventario extends CI_Controller {

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
		$this->load->model("InventarioModel");
    }
    
    public function getInventarios(){
        $resultado=$this->InventarioModel->fGetInventarios();
        echo json_encode($resultado); 
    }

    public function getInventariosCampo(){
        $_GET = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->get("campo");
        $resultado = $this->InventarioModel->fGetInventariosCampo($campo);
        echo json_encode($resultado);
    }

    public function getInventariosId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->InventarioModel->fGetInventariosId($campo);
        echo json_encode($resultado);
    }

    public function insertInventario(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $data = array("INV_ID"=>0, "INV_NOMBRE"=>$nombre,"INV_DESCRIPCION"=>$descripcion);
        $resultado = $this->InventarioModel->fInsertarInventario($data);
        echo json_encode($resultado);
    }

    public function updateInventario(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id'); 
        $nombre = $this->input->post('nombre');
        $descripcion = $this->input->post('descripcion');
        $data = array("INV_NOMBRE"=>$nombre,"INV_DESCRIPCION"=>$descripcion);
        $resultado = $this->InventarioModel->fUpdateInventario($data, $id);
        echo json_encode($resultado);
    }

    public function deleteInventario(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->InventarioModel->fDeleteInventario($id);
        echo json_encode($resultado);
    }
}