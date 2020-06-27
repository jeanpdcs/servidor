<?php

class Paciente extends CI_Controller {

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
		$this->load->model("PacienteModel");
    }
    
    public function getPacientes(){
        $resultado=$this->PacienteModel->fGetPacientes();
        echo json_encode($resultado);
    }

    public function getPacientesCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->PacienteModel->fGetPacientesCampo($campo);
        echo json_encode($resultado);
    }

    public function getPacientesId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->PacienteModel->fGetPacientesId($campo);
        echo json_encode($resultado);
    }

    public function insertPaciente(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $tid = $this->input->post('TI');
        $ci = $this->input->post('ci');
        $primNom = $this->input->post('primNom');
        $segNom = $this->input->post('segNom');
        $apellido = $this->input->post('apellido');
        $nacimiento = $this->input->post('fechanacimiento');
        $edad = $this->input->post('edad');
        $sexo = $this->input->post('sexo');
        $sangre = $this->input->post('gruposanguineo');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $celular = $this->input->post('celular');
        $correo = $this->input->post('correo');
        $data = array("PAC_ID"=>0, "TID_ID"=>$tid, "PAC_CI"=>$ci,"PAC_PRIMNOM"=>$primNom, "PAC_SEGNOM"=>$segNom, "PAC_APELLIDOS"=>$apellido, "PAC_FECHANACIMIENTO"=>$nacimiento, "PAC_EDAD"=>$edad, "PAC_SEXO"=>$sexo,"PAC_GRUPOSANGUINEO"=>$sangre, "PAC_DIRECCION"=>$direccion,"PAC_TELEFONO"=>$telefono, "PAC_TLFCELULAR"=>$celular, "PAC_CORREO"=>$correo);
        $resultado = $this->PacienteModel->fInsertarPaciente($data);
        echo json_encode($resultado);
    }

    public function updatePaciente(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $tid = $this->input->post('TI');
        $ci = $this->input->post('ci');
        $primNom = $this->input->post('primNom');
        $segNom = $this->input->post('segNom');
        $apellido = $this->input->post('apellido');
        $nacimiento = $this->input->post('fechanacimiento');
        $edad = $this->input->post('edad');
        $sexo = $this->input->post('sexo');
        $sangre = $this->input->post('gruposanguineo');
        $direccion = $this->input->post('direccion');
        $telefono = $this->input->post('telefono');
        $celular = $this->input->post('celular');
        $correo = $this->input->post('correo');
        $data = array("TID_ID"=>$tid, "PAC_CI"=>$ci,"PAC_PRIMNOM"=>$primNom, "PAC_SEGNOM"=>$segNom, "PAC_APELLIDOS"=>$apellido, "PAC_FECHANACIMIENTO"=>$nacimiento, "PAC_EDAD"=>$edad, "PAC_SEXO"=>$sexo,"PAC_GRUPOSANGUINEO"=>$sangre, "PAC_DIRECCION"=>$direccion,"PAC_TELEFONO"=>$telefono, "PAC_TLFCELULAR"=>$celular, "PAC_CORREO"=>$correo);
        $resultado = $this->PacienteModel->fUpdatePaciente($data, $id);
        echo json_encode($resultado);
    }

    public function deletePaciente(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->PacienteModel->fDeletePaciente($id);
        echo json_encode($resultado);
    }
}