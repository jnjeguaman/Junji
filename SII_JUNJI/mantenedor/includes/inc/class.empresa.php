<?php
require_once("class.db_connect.php");

/**
* Clase para utilizar los datos de la empresa en la generacion de documentos y validaciones
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
**/
class Empresa
{
	
	function __construct(){}

/**
* Método que permite obtener el detalle de la empresa
* @return String
* @param Object $error
**/
public function getEmpresa($input)
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_empresa WHERE empresa_id = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		if($stmt)
		{
			$stmt->bind_param("i",$input);
			if($stmt->execute())
			{
				$result = $stmt->get_result();
				while ($row = $result->fetch_array(MYSQLI_ASSOC))
				{
					$max += 1;
					foreach ($row as $key => $value)
					{
						$arrayName[$max][$key] = $value;
					}
				}
				return $arrayName;
			}else{
				return false;
			}
		}else{
			return false;
		}
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

/**
* Método que actualiza la informacion de la empresa emisora del documento electrónico
* @param Array $input Arreglo con los datos provenientes del formulario
* @return Array con la respuesta de la consulta
**/
public function actualizarEmpresa($input)
{
	try {
		$objDbConnect = new db_connect();
		$null = NULL;
		$query = "UPDATE sii_empresa SET  empresa_glosa = ?, empresa_rut = ?, empresa_dv = ?, empresa_giro = ?, empresa_telefono = ?, empresa_correo = ?, empresa_direccion = ?, empresa_comuna = ?, empresa_ciudad = ?, empresa_fecha = ?, empresa_resolucion = ?, empresa_acteco = ?, empresa_sucursal = ?, empresa_region = ? WHERE empresa_id = ?";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		
		if($stmt)
		{
			$stmt->bind_param("sississsssiiiii",$input["empresa_glosa"],$input["empresa_rut"],$input["empresa_dv"],$input["empresa_giro"],$input["empresa_telefono"],$input["empresa_correo"],$input["empresa_direccion"],$input["empresa_comuna"],$input["empresa_ciudad"],$input["empresa_fecha"],$input["empresa_resolucion"],$input["empresa_acteco"],$input["empresa_sucursal"],$input["empresa_region"],$input["empresa_id"]);
			if($stmt->execute())
			{
				return array("Respuesta" => true,"Mensaje" => "Información actualizada con exito!");
			}else{
				return array("Respuesta" => false,"Mensaje" => $stmt->error);
			}
		}else{
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en la consulta SQL");
		}
	}catch (Exception $e) {
		return $e->getMessage();
	}
}

/**
* Método que obtiene el listado de todas las direcciones utilizadas por los sistemas INEDIS (Inventario y Logística)
* y propios del sistema de facturación electrónica
* @return Array $arrayName Con el detalle de lo solicitado
**/
public function getEmpresas()
{
	try {
		$objDbConnect = new db_connect();
		$arrayName = array();
		$max = 0;
		$query = "SELECT * FROM sii_empresa ORDER BY empresa_region ASC";
		$stmt = $objDbConnect->getConnection()->prepare($query);
		if($stmt)
		{
			if($stmt->execute())
			{
				$result = $stmt->get_result();
				while ($row = $result->fetch_array(MYSQLI_ASSOC))
				{
					$max += 1;
					foreach ($row as $key => $value)
					{
						$arrayName[$max][$key] = $value;
					}
				}
				return $arrayName;
			}else{
				return false;
			}
		}else{
			return false;
		}
	} catch (Exception $e) {
		return $e->getMessage();
	}
}
}
?>