<?php
require_once("class.db_connect.php");
/**
* Clase que permite manipular las guias de despacho emitidas
* @author Freddy Varas Henríquez (fvaras@pradi.cl)
*/
class GD
{

	function __construct(){}

	/**
	* Método que permite anular el folio de una guia de despacho emitida
	* @param Integer $input ID del documento electrónico emitido
	* @return Array Respuesta de la consulta
	**/
	public function anularFolio($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_dte SET dte_gd_estado = 1, dte_gd_tipo_anulacion = ? WHERE dte_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("ii",$input["dte_gd_tipo_anulacion"],$input["dte_id"]);

				if($stmt->execute())
				{
					return array("Respuesta" => true,"Mensaje" => "Folio anulado exitosamente");
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
	* Método que permite anular una guia de despacho emitida
	* @param Integer $input ID del documento electrónico emitido
	* @return Array Respuesta de la consulta
	**/
	public function anularGuia($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_dte SET dte_gd_estado = 2, dte_gd_tipo_anulacion = ? WHERE dte_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				
				$stmt->bind_param("ii",$input["dte_gd_tipo_anulacion"],$input["dte_id"]);
				
				if($stmt->execute())
				{
					return array("Respuesta" => true,"Mensaje" => "Guía anulada exitosamente");
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

}

?>