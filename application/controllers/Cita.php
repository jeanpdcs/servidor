<?php
date_default_timezone_set('America/Bogota');

class Cita extends CI_Controller {

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
		$this->load->model("CitaModel");
    }
    
    public function getCitas(){
        $resultado=$this->CitaModel->fGetCitas();
        echo json_encode($resultado);
    }

    public function getCitasCampo(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("campo");
        $resultado = $this->CitaModel->fGetCitasCampo($campo);
        echo json_encode($resultado);
    }

    public function getCitasId(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $campo = $this->input->post("id");
        $resultado = $this->CitaModel->fGetCitasId($campo);
        echo json_encode($resultado);
    }

    public function insertCita(){

        $_POST = json_decode(file_get_contents("php://input"), true); 
        $doctor = $this->input->post('doctor');
        $consultorio = $this->input->post('consultorio');
        $paciente = $this->input->post('paciente');
        $dateTime = $this->input->post('dateTime');
        $descripcion = $this->input->post('descripcion');
        $data = array("CIT_ID"=>0, "DOC_ID"=>$doctor, "CON_ID"=>$consultorio, "PAC_ID"=>$paciente, "CIT_DESCRIPCION"=>$descripcion, "CIT_FECHA"=>$dateTime);
        $resultado = $this->CitaModel->fInsertarCita($data);
        if($resultado["exito"]){
            $resultado2 = $this->CitaModel->fGetCorreo($resultado["id"]);
            if($resultado2["exito"]){
                $correo = $resultado2["data"]["PAC_CORREO"];
                $nombre = $resultado2["data"]["nombre"];
                $fecha = $resultado2["data"]["CIT_FECHA"];
                
        

                $this->load->library('phpmailer_lib');
                // PHPMailer object
                $mail = $this->phpmailer_lib->load();
                $mail->IsSMTP();
                //$mail->SMTPDebug = 2;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAutoTLS = false;
                $mail->Host = 'ssl://smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = 'jeanpidc@gmail.com';
                $mail->Password = '095280570jpdcs';
                $mail->Timeout = 60;
                $mail->ContentType = 'text/plain';
                $mail->IsHTML(true);
                $mail->FromName = 'Clínica Odontológica Santa Apolonia';
                //A quién envía el correo
                $mail->AddAddress($correo, $nombre);
                $mail->CharSet = 'UTF-8';

                $mail->Subject = "Confirmación de cita";
                $mail->Body = "Estimado/a ".$nombre.", Su cita a sido registrada para la fecha y hora: ".$fecha.".<br/><br/><br/><br/>Atentamente:<br/><br/><br/><br/>Clínica Odontológica Santa Apolonia";
                $exito = $mail->Send();
                if ($exito)
                {
                    $mail->ClearAddresses();
                    
                    $r = array('exito' => true, 'error' => '');
                }
                else
                {
                    $error = $mail->ErrorInfo;
                    $r = array('exito' => false, 'error' => $error);
                }
            }
            else{
                $r = array('exito' => false);
            }
        }
        else{
            $r = array('exito' => false);
        }
        echo json_encode($r);
    }



    public function updateCita(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        //print_r($this->input->post(NULL, true));
        $id = $this->input->post('id');
        $doc = $this->input->post('doctor');
        $paciente = $this->input->post('paciente');
        $consultorio = $this->input->post('consultorio');
        $descripcion = $this->input->post('descripcion');
        $dateTime = $this->input->post('dateTime');
        $data = array("DOC_ID"=>$doc, "CON_ID"=>$consultorio, "PAC_ID"=>$paciente, "CIT_DESCRIPCION"=>$descripcion, "CIT_FECHA"=>$dateTime);
        $resultado = $this->CitaModel->fUpdateCita($data, $id);
        if($resultado["exito"]){
            $resultado2 = $this->CitaModel->fGetCorreo($id);
            if($resultado2["exito"]){
                $correo = $resultado2["data"]["PAC_CORREO"];
                $nombre = $resultado2["data"]["nombre"];
                $fecha = $resultado2["data"]["CIT_FECHA"];
                
        

                $this->load->library('phpmailer_lib');
                // PHPMailer object
                $mail = $this->phpmailer_lib->load();
                $mail->IsSMTP();
                //$mail->SMTPDebug = 2;
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAutoTLS = false;
                $mail->Host = 'ssl://smtp.gmail.com';
                $mail->Port = 465;
                $mail->Username = 'jeanpidc@gmail.com';
                $mail->Password = '095280570jpdcs';
                $mail->Timeout = 60;
                $mail->ContentType = 'text/plain';
                $mail->IsHTML(true);
                $mail->FromName = 'Clínica Odontológica Santa Apolonia';
                //A quién envía el correo
                $mail->AddAddress($correo, $nombre);
                $mail->CharSet = 'UTF-8';

                $mail->Subject = "Reasignación de cita";
                $mail->Body = "Estimado/a ".$nombre.", Su cita a sido reagendada para la fecha y hora: ".$fecha.".<br/><br/><br/><br/>Atentamente:<br/><br/><br/><br/>Clínica Odontológica Santa Apolonia";
                $exito = $mail->Send();
                if ($exito)
                {
                    $mail->ClearAddresses();
                    
                    $r = array('exito' => true, 'error' => '');
                }
                else
                {
                    $error = $mail->ErrorInfo;
                    $r = array('exito' => false, 'error' => $error);
                }
            }
            else{
                $r = array('exito' => false);
            }
        }
        else{
            $r = array('exito' => false);
        }
        echo json_encode($r);
    }

    public function deleteCita(){
        $_POST = json_decode(file_get_contents("php://input"), true); 
        $id = $this->input->post('id');
        $resultado = $this->CitaModel->fDeleteCita($id);
        echo json_encode($resultado);
    }

}