<?php

class Descuento extends CI_Controller {

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
		$this->load->model("DescuentoModel");
    }
    
    public function getDescuentos(){
        $resultado=$this->DescuentoModel->fGetDescuentos();
        echo json_encode($resultado);
    }

    public function getDescuentosCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->DescuentoModel->fGetDescuentosCampo($campo);
        echo json_encode($resultado);
    }

    public function getDescuentosId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->DescuentoModel->fGetDescuentosId($campo);
        echo json_encode($resultado);
    }

    public function insertDescuento(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $servicio = $this->input->post('servicio');
        $valor = $this->input->post('valor');
        $descripcion = $this->input->post('descripcion');
        $data = array("DESC_ID"=>0, "SERV_ID"=>$servicio, "DESC_VALOR"=>$valor, "DESC_DESCRIPCION"=>$descripcion);
        $resultado = $this->DescuentoModel->fInsertarDescuento($data);
        echo json_encode($resultado);
    }

    public function updateDescuento(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $servicio = $this->input->post('servicio');
        $valor = $this->input->post('valor');
        $descripcion = $this->input->post('descripcion');
        $data = array("DESC_ID"=>$id, "SERV_ID"=>$servicio, "DESC_VALOR"=>$valor,"DESC_DESCRIPCION"=>$descripcion);
        $resultado = $this->DescuentoModel->fUpdateDescuento($data, $id);
        echo json_encode($resultado);
    }

    public function deleteDescuento(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->DescuentoModel->fDeleteDescuento($id);
        echo json_encode($resultado);
    }
}