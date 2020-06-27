<?php

class ServicioxFichaMedicaModel extends CI_Model
{
	public function fGetServicioxFichaMedicas()
	{
        $this->db->select("sfm.*, s.*, fm.*");
        $this->db->join("servicio s", "sfm.SERV_ID = s.SERV_ID", "inner");
        $this->db->join("ficha_medica fm", "sfm.INV_ID = fm.INV_ID", "inner");
        $resultado=$this->db->get("servicio_x_ficha_medica sfm")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }
    
    public function fGetServicioxFichaMedicasCampo($campo)
	{
        $this->db->select("sfm.*, s.*, fm.*");
        $this->db->join("servicio s", "sfm.SERV_ID = s.SERV_ID", "inner");
        $this->db->join("ficha_medica fm", "sfm.FMED_ID = fm.FMED_ID", "inner");
        $this->db->like("sfm.SFM_ID",$campo,"both");
        $this->db->or_like("s.SERV_NOMBRE",$campo,"both");
        $this->db->or_like("fm.FMED_ID", $campo, "both");
        $this->db->or_like("sfm.SFM_FECHA", $campo, "both");    
        $resultado=$this->db->get("servicio_x_ficha_medica sfm")->result_array();
        if(!empty($resultado)){
                return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }

    public function fGetServicioxFichaMedicasFMED($fmed)
	{
        $this->db->select("sfm.*, s.*, fm.*");
        $this->db->join("servicio s", "sfm.SERV_ID = s.SERV_ID", "inner");
        $this->db->join("ficha_medica fm", "sfm.FMED_ID = fm.FMED_ID", "inner");
        $this->db->where("sfm.FMED_ID",$fmed);
        $resultado=$this->db->get("servicio_x_ficha_medica sfm")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }

    public function fGetServicioxFichaMedicasId($id)
	{
        $this->db->select("sfm.*, s.*, fm.*");
        $this->db->join("servicio s", "sfm.SERV_ID = s.SERV_ID", "inner");
        $this->db->join("ficha_medica fm", "sfm.FMED_ID = fm.FMED_ID", "inner");
        $this->db->where("sfm.SFM_ID",$id);
        $resultado=$this->db->get("servicio_x_ficha_medica sfm")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }

    public function fInsertarServicioxFichaMedica($data)
    {
      $this->db->insert("servicio_x_ficha_medica", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
    
    public function fUpdateServicioxFichaMedica($data, $id)
	  {
      $clave=array_keys($data);
      foreach($clave as $c){
        if(empty($data[$c]))
          unset($data[$c]);
      }
      $this->db->where("SFM_ID", $id);
      $this->db->update("servicio_x_ficha_medica", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fDeleteServicioxFichaMedica($id){
        $this->db->where("SFM_ID", $id);
        $this->db->delete("servicio_x_ficha_medica");
        if($this->db->trans_status()){
            return array("exito"=>true);
        }
        else{
            return array("exito"=>false);
        }
    }
}