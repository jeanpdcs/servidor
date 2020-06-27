<?php

class DetalleFacturaModel extends CI_Model
{
	public function fGetDetalleFacturas()
	{
    $this->db->select("df.*, f.*, s.*");
    $this->db->join("factura f", "df.FAC_ID = f.FAC_ID", "inner");
    $this->db->join("servicio s", "df.SERV_ID = s.SERV_ID", "inner");
    $resultado=$this->db->get("detalle_factura df")->result_array();
    if(!empty($resultado)){
			return array("exito"=>true,"data"=>$resultado);
		}
		else{
			return array("exito"=>false, "data"=>array());
		}
  }

  public function fGetDetalleFacturasId($campo)
	{
        $this->db->select("df.*, f.*, s.*");
        $this->db->join("factura f", "df.FAC_ID = f.FAC_ID", "inner");
        $this->db->join("servicio s", "df.SERV_ID = s.SERV_ID", "inner");
        $this->db->where("df.DETFAC_ID",$campo);
        $resultado=$this->db->get("detalle_factura df")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }
    
    public function fGetDetalleFacturasCampo($campo)
	{
        $this->db->select("df.*, f.*, s.*");
        $this->db->join("factura f", "df.FAC_ID = f.FAC_ID", "inner");
        $this->db->join("servicio s", "df.SERV_ID = s.SERV_ID", "inner");
        $this->db->like("f.FAC_ID", $campo, "both");
        $this->db->or_like("s.SERV_ID",$campo,"both");
        $this->db->or_like("df.DETFAC_CANTIDAD",$campo,"both");
        $resultado=$this->db->get("detalle_factura df")->result_array();
        if(!empty($resultado)){
          return array("exito"=>true,"data"=>$resultado);
        }
        else{
          return array("exito"=>false, "data"=>array());
        }
    }

    public function fGetDetalleFacturasFAC($factura)
	  {
        $this->db->select("d.*, s.*, f.*");
        $this->db->join("factura f", "d.FAC_ID = f.FAC_ID", "inner");
        $this->db->join("servicio s", "d.SERV_ID = s.SERV_ID", "inner");
        $this->db->where("f.FAC_ID",$factura);
        $resultado=$this->db->get("detalle_factura d")->result_array();
        
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
        }
        else{
            return array("exito"=>false, "data"=>array());
        }
    }

    public function fGetResumenFactura($id){
        //reultilizar el query
        //SELECT SUM(DETFAC_SUBTOTAL) AS SUBTOTAL, SUM(DETFAC_IVA) AS IVA, SUM(DETFAC_TOTAL) AS TOTAL FROM detalle_factura WHERE `FAC_ID`=1 
        $this->db->select("SUM(DETFAC_SUBTOTAL) AS SUBTOTAL, SUM(DETFAC_IVA) AS IVA, SUM(DETFAC_TOTAL) AS TOTAL");
        $this->db->where("FAC_ID", $id);
        $resultado=$this->db->get("detalle_factura")->result_array();
        if(!empty($resultado)){
            return array("exito"=>true,"data"=>$resultado);
          }
          else{
            return array("exito"=>false, "data"=>array());
          }
    }

    public function fInsertarDetalleFactura($data)
    {
      //HACER UN QUERY QUE TRAIGA EL DATO DE PRECIO DE SERVICIO Y EL IVA DEL SERVICIO CONSIDERANDO QUE EL SERVICIO QUE SE ESTA GUARDANDO ES: $data["SERV_ID"]
        $resultado=true;
        $this->db->select("*");
        $this->db->where("SERV_ID", $data["SERV_ID"]);
        $serv=$this->db->get("servicio")->row_array();
        if(!empty($serv)){
            $data["DETFAC_SUBTOTAL"]=$data["DETFAC_CANTIDAD"]*$serv["SERV_PRECIO"];
            $data["DETFAC_IVA"]=$data["DETFAC_SUBTOTAL"]*$serv["SERV_IVA"];
            $data["DETFAC_TOTAL"]=$data["DETFAC_SUBTOTAL"]+$data["DETFAC_IVA"];
        }
        else{
            $resultado=false;
        }
        if($resultado){
            $this->db->insert("detalle_factura", $data);
            if($this->db->trans_status()){
                return array("exito"=>true);
            }
            else{
                return array("exito"=>false);
            }
        }
        else{
            return array("exito"=>false);
        }
    }
    
    public function fUpdateDetalleFactura($data, $id)
	  {
      $this->db->where("DETFAC_ID", $id);
      $this->db->update("detalle_factura", $data);
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }

    public function fDeleteDetalleFactura($id){
      $this->db->where("DETFAC_ID", $id);
      $this->db->delete("detalle_factura");
      if($this->db->trans_status()){
        return array("exito"=>true);
      }
      else{
        return array("exito"=>false);
      }
    }
}