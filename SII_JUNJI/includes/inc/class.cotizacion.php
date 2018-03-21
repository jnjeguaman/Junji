<?php
require_once("class.db_connect.php");
require_once("class.documentos.php");
/**
* Clase que permite trabajar con las cotizaciones generadas por el sistema
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Cotizacion
{
	
	function __construct(){}

	/**
	* Método que permite generar el esquema de una cotizacion
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param $input Contiene la informacion del formulario
	**/
	public function crearCotizacion($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$estado = 1;
			$query = "INSERT INTO sii_cotizacion VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			
			if($stmt)
			{
				$stmt->bind_param("iiissssssssssi",$null,$input["cliente_id"],$estado,$null,$null,$null,$null,$null,$null,$null,$null,$null,$null,$input["emisor_region"]);

				if($stmt->execute())
				{
					return array("Respuesta" => true,"id" => $stmt->insert_id);
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

	/**
	* Método que permite añadir productos a la cotizacion deseada
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param $input Informacion en detalle del producto a agregar
	**/
	public function agregarProducto($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$estado = 1;
			$query = "INSERT INTO sii_detalle_cotizacion VALUES(?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("isiiisssiis",$null,utf8_decode($input["unitario_glosa"]),$input["cotizacion_id"],$input["producto_cantidad"],$estado,$null,$null,$null,$input["unitario_neto"],$input["unitario_indexe"],$input["umedida"]);

				if($stmt->execute())
				{
					return true;
				}else{
					echo $stmt->error;
				}
			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que despliega al usuario el detalle de la cotizacion deseada
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Array
	* @param $input Contiene el ID de la cotizacion
	**/
	public function getDetalleCotizacion($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_detalle_cotizacion a /*INNER JOIN sii_productos b ON a.detalle_producto_id = b.producto_id*/ WHERE a.detalle_cotizacion_id = ? AND a.detalle_estado = 1";
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
	* Método que permite eliminar un producto de la cotizacion
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param $input ID del producto a eliminar de la base de datos
	**/
	public function eliminarProducto($input)
	{
		try {
			$objDbConnect = new db_connect();
			$query = "UPDATE sii_detalle_cotizacion SET detalle_estado = 0 WHERE detalle_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("i",$input);

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

	/**
	* Método que permite finalizar la cotizacion para su facturacion
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param Array $input Informacion proveniente del formulario
	**/
	public function cerrarCotizacion($input)
	{
		try {
			if(isset($input["DscRcgGlobal"]) && $input["DscRcgGlobal"] == "on")
			{
				// SE APLICA EL DESCUENTO O RECARGO A ITEMS AFECTOS SÓLO SI SE HA ESTABLECIDO ASI EN EL FORMULARIO
				if($input["DscRcgGlobalTpoMov"] <> "" && $input["DscRcgGlobalTpoValor"] <> "" && $input["DscRcgGlobalValorDR"] <> "")
				{
					$DscRcgGlobalTpoMov = $input["DscRcgGlobalTpoMov"];
					$DscRcgGlobalTpoValor = $input["DscRcgGlobalTpoValor"];
					$DscRcgGlobalValorDR = $input["DscRcgGlobalValorDR"];

					if($DscRcgGlobalTpoMov == "D")
					{
						if($DscRcgGlobalTpoValor == "%")
						{
							$neto = $input["cotizacion_neto"] - (round($input["cotizacion_neto"] * ($DscRcgGlobalValorDR / 100)));
						}else{
							$neto = $input["cotizacion_neto"] - $DscRcgGlobalValorDR;
						}
					}else{
						if($DscRcgGlobalTpoValor == "%")
						{
							$neto = $input["cotizacion_neto"] + (round($input["cotizacion_neto"] * ($DscRcgGlobalValorDR / 100)));
						}else{
							$neto = $input["cotizacion_neto"] + $DscRcgGlobalValorDR;
						}
					}
					$iva = round($neto * 0.19);
					$total = $neto + $iva + $input["cotizacion_exento"];
				}else{
					$neto = $input["cotizacion_neto"];
					$iva = round($neto * 0.19);
					$total = $neto + $iva + $input["cotizacion_exento"];

					$DscRcgGlobalTpoMov = NULL;
					$DscRcgGlobalTpoValor = NULL;
					$DscRcgGlobalValorDR = NULL;
				}
			}else{
				$neto = $input["cotizacion_neto"];
				$iva = $input["cotizacion_iva"];
				$total = $neto + $iva + $input["cotizacion_exento"];
			}

			$objDbConnect = new db_connect();
			$null = NULL;
			$estado = 0;
			$query = "UPDATE sii_cotizacion SET cotizacion_neto = ?, cotizacion_iva = ?, cotizacion_total = ?, cotizacion_estado = ?,cotizacion_valordr = ?, cotizacion_exento = ?,cotizacion_tpomov = ?, cotizacion_tpovalor = ? WHERE cotizacion_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("iiiiiissi",
					$neto,
					$iva,
					$total,
					$estado,
					$DscRcgGlobalValorDR,
					$input["cotizacion_exento"],
					$DscRcgGlobalTpoMov,
					$DscRcgGlobalTpoValor,
					$input["cotizacion_id"]);

				if($stmt->execute())
				{
					return $this->actualizaProductos($input);
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

	/**
	* Método que permite actualizar los valores de un producto en una cotizacion
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param Attay $input Informacion proveniente del formulario de cotizacion
	**/
	public function actualizaProductos($input)
	{
		try {
			$exito = 0;
			$error = "";
			$objDbConnect = new db_connect();
			$null = NULL;
			$divisor = 100;
			$query = "UPDATE sii_detalle_cotizacion SET detalle_cantidad = ?, detalle_descuento = ?, detalle_subtotal = ?,detalle_descuento_monto = ?,detalle_umedida = ? WHERE detalle_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				
				for ($i=0; $i < $input["totalElementos"]; $i++) { 
					$stmt->bind_param("iiiisi",
						$input["var9"][$i],
						$input["var1"][$i],
						$input["var2"][$i],
						$input["var6"][$i],
						$input["umedida"][$i],
						$input["detalle_id"][$i]
						);

					if($stmt->execute())
					{
						$exito++;
					}else{
						$error .= $stmt->error."\n";
					}

				}//FOR

				if($exito == $input["totalElementos"])
				{
					return array("Respuesta" => true);
				}else{
					return $error;
				}
				
			}else{
				return false;
			}
		}catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que permite el listado de las cotizaciones
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @param $region Region del usuario
	* @return Array
	**/
	public function getCotizaciones($region)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_cotizacion a INNER JOIN sii_cliente b ON a.cotizacion_cliente_id = b.cliente_id WHERE a.cotizacion_estado = 0 AND (cotizacion_fe IS NULL OR cotizacion_gd IS NULL OR cotizacion_gd = 0) AND cotizacion_region = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("i",$region);
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
	* Método que obtiene el detalle de una cotizacion
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Array
	**/
	public function getCotizacion($input)
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_cotizacion a INNER JOIN sii_detalle_cotizacion b ON a.cotizacion_id = b.detalle_cotizacion_id INNER JOIN sii_cliente c ON a.cotizacion_cliente_id = c.cliente_id /*INNER JOIN sii_productos d ON b.detalle_producto_id = d.producto_id INNER JOIN sii_region e ON c.cliente_provincia_id = e.region_id INNER JOIN sii_comuna f ON c.cliente_comuna_id = f.comuna_id*/ WHERE a.cotizacion_id = ? AND b.detalle_estado = 1";
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
	* Método que permite actualizar el estado de la cotizacion, si se genero una guia de despacho o una factura
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param Intener $cotizacion_id ID de la cotizacion a actualizar
	* @param Integer $tipo Tipo de documento a actualizar. 52 : Guia de despacho. 33 : Factura Electrónica
	**/
	public function actualizarEstado($cotizacion_id,$tipo)
	{
		try {
			if($tipo == 52)
			{
				$campo = "cotizacion_gd";
			}else{
				$campo = "cotizacion_fe";
			}
			$objDbConnect = new db_connect();
			$null = NULL;
			$estado = 1;
			$query = "UPDATE sii_cotizacion SET ".$campo." = ? WHERE cotizacion_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{

				$stmt->bind_param("ii",$estado,$cotizacion_id);

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

	/**
	* Método que permite crear una cotizacion a partir de la creacion de una Factura Electrónica para luego generara la guia de despacho u otro documento si corresponde
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param Array $input Informacion del formulario
	* @param String $referencia Etiqueta unico que identifica cada documento generado en el sistema. Ej: F100T33
	* @param Object $res Respuesta de la subida automatica al Servicio de Impuestos Internos
	* @param Integer $folio Folio del documento emitido
	* @param Integer $region Region generadora del DTE
	**/
	public function crearCotizacion2($input,$referencia,$res,$folio,$region)
	{
		try {
			if($input["DscRcgGlobal"] == "on")
			{
					$DscRcgGlobalTpoMov = ($input["DscRcgGlobalTpoMov"] <> "" ? $input["DscRcgGlobalTpoMov"] : NULL);
					$DscRcgGlobalTpoValor = ($input["DscRcgGlobalTpoValor"] <> "" ? $input["DscRcgGlobalTpoValor"] : NULL);
					$DscRcgGlobalValorDR = ($input["DscRcgGlobalValorDR"] <> "" ? $input["DscRcgGlobalValorDR"] : NULL);
			}else{
				$DscRcgGlobalTpoMov = NULL;
				$DscRcgGlobalTpoValor = NULL;
				$DscRcgGlobalValorDR = NULL;
			}
			$objDbConnect = new db_connect();
			$null = NULL;
			$estado = 0;
			$otro = 0;
			$query = "INSERT INTO sii_cotizacion VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			$fe = 1;
			if($stmt)
			{
				$stmt->bind_param("iiiiiiiiiiissi",
					$null,
					$input["receptor_id"],
					$estado,
					$input["neto"],
					$input["iva"],
					$input["total"],
					$DscRcgGlobalValorDR,
					$otro,
					$otro,
					$fe,
					$input["exento"],
					$DscRcgGlobalTpoMov,
					$DscRcgGlobalTpoValor,
					$region);

				if($stmt->execute())
				{	
						$ultimo_id = $stmt->insert_id;
						$this->insertarDetalle($input,$ultimo_id,$referencia,$res,$folio,$region);
						return array("respuesta" => true,"id" => $stmt->insert_id);
					}else{
						echo $stmt->error;
					}
				}else{
					return false;
				}
			}catch (Exception $e) {
				return $e->getMessage();
			}
		}

	/**
	* Método que permite agregar los productos a una cotizacion a partir de la creacion de una Factura Electrónica
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param Array $input Informacion del formulario
	* @param Integer $id ID de la cotizacion generada
	* @param String $referencia Etiqueta unico que identifica cada documento generado en el sistema. Ej: F100T33
	* @param Object $res Respuesta de la subida automatica al Servicio de Impuestos Internos
	* @param Integer $folio Folio del documento emitodo
	* @param Integer $region Region generadora del DTE
	**/
		private function insertarDetalle($input,$id,$referencia,$res,$folio,$region)
		{
			try {


				$objDbConnect = new db_connect();
				$null = NULL;
				$query = "INSERT INTO sii_detalle_cotizacion VALUES(?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $objDbConnect->getConnection()->prepare($query);
				$estado = 1;
				$descuento = 0;

				if($stmt)
				{

					for ($i=1; $i <= $input["totalElementos"]; $i++) {
						if($input["sii_item"][$i] <> "")
						{
							$sii_item = $input["sii_item"][$i];
							$sii_tipo=$input["sii_tipo"][$i];
							$sii_producto_qty = $input["sii_producto_qty"][$i];
							$sii_producto_costo = $input["sii_producto_costo"][$i];
							$sii_producto_desc=$input["sii_producto_desc"][$i];
							$montoDescuento=$input["montoDescuento"][$i];
							$subtotal = $input["var1"][$i];
							$umedida = $input["sii_umedida"][$i];

							$stmt->bind_param("isiiiiiiiis",
								$null,
								$sii_item,
								$id,
								$sii_producto_qty,
								$estado,
								$sii_producto_desc,
								$subtotal,
								$montoDescuento,
								$sii_producto_costo,
								$sii_tipo,
								$umedida);
						}else{
							echo $stmt->error;
						}
						$stmt->execute();
					}
					self::nuevoDTE($input,$referencia,$res,$id,$folio,$region);
				}else{
					return false;
				}
			}catch (Exception $e) {
				return $e->getMessage();
			}
		}

	/**
	* Método que permite generar la estructura de un DTE 
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param Array $input Informacion del formulario
	* @param Integer $id ID de la cotizacion generada
	* @param String $referencia Etiqueta unico que identifica cada documento generado en el sistema. Ej: F100T33
	* @param Object $res Respuesta de la subida automatica al Servicio de Impuestos Internos
	* @param Integer $folio Folio del documento emitodo
	* @param Integer $region Region generadora del DTE
	**/
		public function nuevoDTE($input,$referencia,$res,$id,$folio,$region)
		{
			try {
				$f_emision = explode("-",$input["dcto_fecha_emision"]);
				$fecha = explode(" ", $res->TIMESTAMP);
				$objCotizacion = new Cotizacion();
				$detalleCotizacion = $this->getCotizacion($id);
				$objDbConnect = new db_connect();
				$null = NULL;
				$fecha = explode(" ", $res->TIMESTAMP);
				$query = "INSERT INTO sii_dte VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $objDbConnect->getConnection()->prepare($query);
				$ruta = "Documentos/".$input["sii_tipo_dcto"]."/".$f_emision[0]."/".$f_emision["1"]."/";
				$gd_estado = ($input["sii_tipoDespacho"] <> "") ? $input["sii_tipoDespacho"] : NULL;
				$gd_traslado = ($input["sii_indTraslado"] <> "") ? $input["sii_indTraslado"] : NULL;
				$origen = 3;
				if($stmt)
				{
					$stmt->bind_param("issssssiiiiiiiississi",
						$null,
						$input["sii_tipo_dcto"],
						$ruta,
						$referencia,
						$res->TRACKID,
						$fecha[0],
						$fecha[1],
						$res->STATUS,
						$folio,
						$input["receptor_id"],
						$id,
						$input["neto"],
						$input["iva"],
						$input["total"],
						$input["exento"],
						$null,
						$gd_traslado,
						$region,
						$null,
						$null,
						$origen);

					if($stmt->execute())
					{
						return $this->insertarDetalle2($id,$stmt->insert_id);
					}else{
						echo $stmt->error;
					}
				}else{
					return false;
				}
			}catch (Exception $e) {
				return $e->getMessage();
			}
		}

	/**
	* Método que permite agregar los productos a un DTE a partir de la creacion de una Factura Electrónica
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Boolean
	* @param Array $input Informacion del formulario
	* @param Integer $cotizacion_id ID de la cotizacion generada
	* @param Integer $ultimo_id ID del DTE generado
	**/
		private function insertarDetalle2($cotizacion_id,$ultimo_id)
		{
			try {
				$exito = 0;

				$objDbConnect = new db_connect();
				$null = NULL;
				$query = "INSERT INTO sii_detalle_dte VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
				$stmt = $objDbConnect->getConnection()->prepare($query);

				$detalleCotizacion = $this->getDetalleCotizacion($cotizacion_id);
				if($stmt)
				{
					foreach ($detalleCotizacion as $key => $value) {
						$stmt->bind_param("isiiiiiiiiss",
							$null,
							$value["detalle_producto_id"],
							$ultimo_id,
							$value["detalle_cantidad"],
							$value["detalle_estado"],
							$value["detalle_descuento"],
							$value["detalle_subtotal"],
							$value["detalle_descuento_monto"],
							$value["detalle_unitario"],
							$value["detalle_indexe"],
							$value["detalle_umedida"],
							$null
							);
						if($stmt->execute())
						{
							$exito++;
						}
					}

					if($exito == count($detalleCotizacion))
					{
						return true;
					}else{
						return false;
					}

				}else{
					return false;
				}


			}catch (Exception $e) {
				return $e->getMessage();
			}		
		}

	}
	?>