<?php
require_once("class.db_connect.php");
/**
* 
*/
class CAF
{
	
	function __construct()
	{
		# code...
	}

	public function getDocumentos()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dcto";
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

	public function insertarCAF($archivo,$tipo,$inicio,$fin,$region,$fichero,$folio_umbral,$folio_umbral2,$folio_umbral3)
	{
		try {
			if($inicio > $fin)
			{
				return array("Respuesta" => false,"Mensaje" => "HAY UN ERROR EN LOS RANGOS DE LOS FOLIOS.");
			}else{
				
				$objDbConnect = new db_connect();
				$null = NULL;
				$estado = 1;
				$actual = $inicio - 1;
				$query = "INSERT INTO sii_folio VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $objDbConnect->getConnection()->prepare($query);

				if($stmt)
				{

					$this->deshabilitarCAF($tipo,$region);
					$stmt->bind_param("iiiiisissisiii",
						$null,
						$inicio,
						$fin,
						$tipo,
						$estado,
						$archivo,
						$actual,
						date("Y-m-d"),
						date("H:i:s"),
						$region,
						$fichero,
						$folio_umbral,
						$folio_umbral2,
						$folio_umbral3
						);

					if($stmt->execute())
					{
						return array("Respuesta" => true,"Mensaje" => "Folios correctamente cargados a la region : ".$region.". Tipo de documento : ".$tipo.". Rangos (Desde - Hasta) : ".$inicio."-".$fin);
					}else{
						return array("Respuesta" => false,"Mensaje" => $stmt->error);
					}
				}else{
					return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en la consulta SQL");
				}
			}

		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	private function deshabilitarCAF($tipo,$region)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_folio SET folio_estado = 0 WHERE folio_tipo = ? AND folio_region = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("ii",$tipo,$region);

				if($stmt->execute())
				{
					return true;
				}else{
					return $stmt->error;
				}
			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function getCAF()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_folio a inner join sii_dcto b on b.dcto_codigo = a.folio_tipo WHERE a.folio_estado = 1 ORDER BY a.folio_estado DESC,b.dcto_codigo";
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