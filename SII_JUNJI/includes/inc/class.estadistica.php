<?php
require_once("class.db_connect.php");

/**
 * Clase que permite la reportabilidad hacia el usuario
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Estadisticas
{
	
	function __construct(){}

	/**
	* Funcion que permite obtener un resumen del consumo de folios ordenados por tipo de documento
	* @return Array
	**/
	public function getConsumoFolio()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT COUNT(a.dte_id) AS Total, a.dte_dcto_id,folio_inicio,folio_fin,folio_actual,dcto_glosa FROM sii_dte a INNER JOIN sii_folio b ON b.folio_tipo = a.dte_dcto_id INNER JOIN sii_dcto c ON c.dcto_codigo = b.folio_tipo WHERE b.folio_estado = 1 GROUP BY a.dte_dcto_id";
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

	public function getDTEEmitidos($region,$periodo)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;

			if($region == 0)
			{
				$query = "SELECT COUNT(dte_id) AS y,dte_region AS label FROM sii_dte where YEAR(dte_fecha) = ? AND MONTH(dte_fecha) = ?  GROUP BY dte_region";		
			}else{
				$query = "SELECT COUNT(dte_id) AS y,dte_region AS label FROM sii_dte where YEAR(dte_fecha) = ? AND MONTH(dte_fecha) = ?  AND dte_region = ? GROUP BY dte_region";
			}
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				if($region == 0)
				{
					$stmt->bind_param("is",$periodo[0],$periodo[1]);
				}else{
					$stmt->bind_param("isi",$periodo[0],$periodo[1],$region);
				}
				if($stmt->execute())
				{
					$result = $stmt->get_result();
					while ($row = $result->fetch_array(MYSQLI_ASSOC))
					{
						foreach ($row as $key => $value)
						{
							$arrayName[$max][$key] = $value;
						}
						$max += 1;
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

	function setJSONObject($input)
	{
		$obj = new stdClass();
		$pila = array();
		foreach ($input as $key => $value) {
			array_push($pila, $value);
		}
		$obj->{"dataPoints"} = $pila;
		return json_encode($obj);
	}

}
?>