<?php
/*header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: GET, OPTIONS, POST');
header("Access-Control-Allow-Origin: *");
*/

class Login extends CI_Controller {

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
		$this->load->model("LoginModel");
	}
	
	public function iniciarsesion()
	{
		$_POST = json_decode(file_get_contents("php://input"), true); 
		//print_r($this->input->post('username', TRUE));
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		//print_r($this->input->post(NULL,true));
		/*$username=$this->input->input_stream('correo');
		$password=$this->input->input_stream('clave');/*
		$username=$_POST['correo'];
		$password=$_POST['clave'];*/
		//echo $username;
		//echo $password;
		/*$username='asfa';
		$password='asdas';*/
		$resultado=$this->LoginModel->fLogin($username, $password);
		if($resultado["exito"]){
			$this->session->set_userdata('session_user', $resultado["data"]["USU_ID"]);
			$resultado2=array("exito"=>true, "usuario"=>$resultado["data"]["USU_ID"]);
		}
		else{
			$resultado2=array("exito"=>false);
		}
		echo json_encode($resultado2);
		
	}

	public function cerrarsesion()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value)
		{
			$this->session->unset_userdata($key);
		}
		//Destruye la sesión actual
		$this->session->sess_destroy();
		$result = array('success' => TRUE);
		echo json_encode($result);
	}

	/*public function verificar(Request $r){
		try{
		$usuarios = \App\usuario::all();
		$aux = 0;
		$resultado = null;
  
		for($i = 0;$i < count($usuarios);$i++)
		{
			if($usuarios[$i]->user == $r->input('user') && $usuarios[$i]->password == $r->input('password'))
			{
				$resultado[$aux] = $usuarios[$i];
				$aux++;
			}
		}
		if($resultado != null){  
		   return json_encode($resultado[0]);
		 }
	   else return null;
	   }
		catch (Exception $e) {
		report($e);
		return $error;
	   }
	  }
  */
	
	
}
