<?php

class DetalleFactura extends CI_Controller {

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
		$this->load->model("DetalleFacturaModel");
    }
    
    public function getDetalleFacturas(){
        $resultado=$this->DetalleFacturaModel->fGetDetalleFacturas();
        echo json_encode($resultado);
    }

    public function getDetalleFacturasCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->DetalleFacturaModel->fGetDetalleFacturasCampo($campo);
        echo json_encode($resultado);
    }

    public function getDetalleFacturasId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->DetalleFacturaModel->fGetDetalleFacturasId($campo);
        echo json_encode($resultado);
    }

    public function getDetalleFacturasFAC(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $factura = $this->input->post('factura');
        $resultado = $this->DetalleFacturaModel->fGetDetalleFacturasFAC($factura);
        echo json_encode($resultado);
    }

    public function getResumenFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("factura");
        $resultado = $this->DetalleFacturaModel->fGetResumenFactura($campo);
        echo json_encode($resultado);
    }
 
    public function insertDetalleFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $factura = $this->input->post('factura');
        $servicio = $this->input->post('servicio');
        $cantidad = $this->input->post('cantidad');
        $data = array("DETFAC_ID"=>0, "FAC_ID"=>$factura, "SERV_ID"=>$servicio, "DETFAC_CANTIDAD"=>$cantidad);
        $resultado = $this->DetalleFacturaModel->fInsertarDetalleFactura($data);
        echo json_encode($resultado);
    }

    public function updateDetalleFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $factura = $this->input->post('factura');
        $servicio = $this->input->post('servicio');
        $cantidad = $this->input->post('cantidad');
        $data = array("DETFAC_ID"=>$id, "FAC_ID"=>$factura, "SERV_ID"=>$servicio, "DETFAC_CANTIDAD"=>$cantidad);
        $resultado = $this->DetalleFacturaModel->fUpdateDetalleFactura($data, $id);
        echo json_encode($resultado);
    }

    public function deleteDetalleFactura(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->DetalleFacturaModel->fDeleteDetalleFactura($id);
        echo json_encode($resultado);
    }
}