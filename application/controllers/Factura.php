<?php

class Factura extends CI_Controller {

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
		$this->load->model("FacturaModel");
    }
    
    public function getFacturas(){
        $resultado=$this->FacturaModel->fGetFacturas();
        echo json_encode($resultado);
    }

    public function getFacturasCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->FacturaModel->fGetFacturasCampo($campo);
        echo json_encode($resultado);
    }

    public function getFacturasId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->FacturaModel->fGetFacturasId($campo);
        echo json_encode($resultado);
    }

    public function insertFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $cliente = $this->input->post('cliente');
        $numero = $this->input->post('numero');
        $estado = $this->input->post('estado');
        $fecha = $this->input->post('fecha');
        $data = array("FAC_ID"=>0, "CLI_ID"=>$cliente, "FAC_NUMERO"=>$numero,"FAC_ESTADO"=>$estado, "FAC_FECHA"=>$fecha);
        $resultado = $this->FacturaModel->fInsertarFactura($data);
        echo json_encode($resultado);
    }

    public function updateFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $cliente = $this->input->post('cliente');
        $numero = $this->input->post('numero');
        $estado = $this->input->post('estado');
        $fecha = $this->input->post('fecha');
        $data = array("FAC_ID"=>$id, "CLI_ID"=>$cliente, "FAC_NUMERO"=>$numero,"FAC_ESTADO"=>$estado, "FAC_FECHA"=>$fecha);
        $resultado = $this->FacturaModel->fUpdateFactura($data, $id);
        echo json_encode($resultado);
    }

    public function anularFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->FacturaModel->fAnularFactura($id);
        echo json_encode($resultado);
    }

    public function pagarFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->FacturaModel->fPagarFactura($id);
        echo json_encode($resultado);
    }
}