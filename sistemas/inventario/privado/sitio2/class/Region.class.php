<?php

require_once "BDInventario.class.php";
require_once "MyException.class.php";
require_once "Utilidades.class.php";

class Region{
    public $myException;
    public $bd;

    public function __construct(){
        $this->myException= new MyException();
        $this->bd = new BDInventario();
        if ($this->bd->myException->getEstado()!=0){
            $this->myException->setEstado(1);
            foreach($this->bd->myException->getMensaje() as $er){
                $this->myException->addError(array('user'=>$er['user'],'admin'=>$er['admin']));
            }
        }
    }
    
    
    public function __destruct(){
        $this->bd=NULL;
    }
    
    
    public function __toString(){
        $mensaje="CLASE REGION";
        return $mensaje;
    }

    
    public function Listar($sqlend="",$sqlGroupBy="",$sqlOrden="",$sqlLimit="",$modo="query")
    {
        try{
            $campos=array();
            $objEntidad=null;
            $sqlentidad="";
            $resultEntidad=array();
            
            #PREGUNTO SI VINO EN MODO QUERY O EN MODO COUNT
            $nro_registros=0;
            if ($modo=="query"){
                $sqlCampos=" region_id, 
                region_glosa, 
                region_folio, 
                region_estado, 
                region_dist, 
                region_ciudad, 
                region_direccion, 
                region_telefono, 
                region_dir_bodega, 
                region_tel_bodega, 
                region_encargado, 
                region_envinv ";
            }else{
                $sqlCampos=" count(*) as hay ";
            }
            
            #CONCATENO SQL CAMPOS Y SQLEND
            $sql="SELECT ".$sqlCampos." from acti_region WHERE 1=1 and region_estado=1 ".$sqlend;
            
            #PREGUNTO SI VIENE SQLGROUP
            if ($sqlGroupBy!=""){
                $sql.=" GROUP BY ".$sqlGroupBy;
            }
            
            #PREGUNTO SI VIENE SQL ORDEN
            if ($sqlOrden!=""){
                $sql.=" ORDER BY ".$sqlOrden;
            }else{
                $sql.=" ORDER BY region_id asc";
            }
            
            #PREGUNTO POR EL LIMIT 
            if ($sqlLimit!=""){
                $sql.=" LIMIT ".$sqlLimit;
            }
            
            #EJECUTO LA CONSULTA
            $res=$this->bd->select($sql,array());
            if ($this->bd->myException->getEstado()==0)
            {
                if ($modo=="query")
                {
                    while($rs=$res->fetch())
                    {
                        $campos[]=array(
                            "region_id" => utf8_encode($rs["region_id"]),
                            "region_glosa" => utf8_encode($rs["region_glosa"]),
                            "region_folio" => utf8_encode($rs["region_folio"]),
                            "region_estado" => utf8_encode($rs["region_estado"]),
                            "region_dist" => utf8_encode($rs["region_dist"]),
                            "region_ciudad" => utf8_encode($rs["region_ciudad"]),
                            "region_direccion" => utf8_encode($rs["region_direccion"]),
                            "region_telefono" => utf8_encode($rs["region_telefono"]),
                            "region_dir_bodega" => utf8_encode($rs["region_dir_bodega"]),
                            "region_tel_bodega" => utf8_encode($rs["region_tel_bodega"]),
                            "region_encargado" =>utf8_encode($rs["region_encargado"]),
                            "region_envinv" => utf8_encode($rs["region_envinv"])
                        );
                    }
                    return $campos;
                }else{
                    if ($rs=$res->fetch()){
                        $numero_registros=$rs["hay"];
                    }else{
                        $numero_registros=0;
                    }
                    return $numero_registros;
                }
            }else{
                $this->myException->setEstado(1);
                foreach($this->bd->myException->getMensaje() as $er){
                    $this->myException->addError(array('user'=>$er['user'],'admin'=>$er['admin']));
                }
            }
        }catch(Exception $e){
            $this->myException->setEstado(1);
			$error=array(
				'user'=>'SE PRODUJO UN ERROR AL COMUNICARSE CON EL ADMINISTRADOR DEL SISTEMA',
				'admin'=>$e->getMessage().'<br>codigo: '.$e->getCode().'<br>linea: ',$e->getLine().'<br> archivo:'.$e->getFile()
			);
			$this->myException->addError($error); 
        }
    }

    
}

?>