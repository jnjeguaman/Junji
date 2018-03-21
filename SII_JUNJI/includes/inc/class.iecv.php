<?php
require_once("class.db_connect.php");
/**
* Clase que permite trabajar con los libros de compra y venta (IECV)
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*
*/
class IECV
{
	function __construct(){}

	public function getHistorialIECV($periodo,$tipo)
	{
		try {
					$objDbConnect = new db_connect();
					$arrayName = array();
					$max = 0;
					$query = "SELECT * FROM sii_iecv_historial WHERE iecv_periodo = ? AND iecv_tipo_operacion = ?";
					$stmt = $objDbConnect->getConnection()->prepare($query);
					if($stmt)
					{
						$stmt->bind_param("ss",$periodo,$tipo);
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