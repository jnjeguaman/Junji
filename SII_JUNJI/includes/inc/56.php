<?php
require_once("class.xml.php");
require_once("class.CAF.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
require_once("class.dte.php");
require_once("class.documentos.php");
require_once("class.empresa.php");
require_once("class.cotizacion.php");

/**
 * Clase para trabajar con las Notas de Débito Electronicas
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class NotaDebito
{
	private $cotizacion;
	private $siiDatos;
	private $timestamp;
	private $referencia;

	private $TED;
	private $Caratula;
	private $Detalle;
	private $DTE;

	private $token;
	private $Documento;
	private $tipo_dcto;
	private $folio;

	private $DscRcgGlobal;
	private $CodRef;

	private $client = NULL;
	private $wsdl_url = array(0 => "https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL",1 => "https://palena.sii.cl/DTEWS/GetTokenFromSeed.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);

	//0 : CERTIFICACION, 1 : PRODUCCION
	private $ambiente = 0;
	function __construct($input)
	{
		$this->siiDatos = $input;
		$this->cotizacion = $input["dte_id"];
		$this->tipo_dcto = $input["tipo_dcto"];
		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);
		$resCAF = $objCAF->getCAF();
		$this->folio = $resCAF[1]["folio_actual"] + 1;
		$this->timestamp = date('Y-m-d\TH:i:s');
		$this->referencia = "F".$this->folio."T".$this->tipo_dcto;
		if($this->siiDatos["CodRef"] == 2)
		{
			$this->actualizaCliente($this->siiDatos);
		}

		if($input["CodRef"] == 3)
		{
			$this->CodRef = 3;//CORRIGE MONTOS
		}else if($input["CodRef"] == 4)
		{
			$this->CodRef = 11;//ANULA DOCUMENTO CON LOS MONTOS INCLUIDOS
		}else if($input["CodRef"] == 5)
		{
			$this->CodRef = 12;//ANULA DOCUMENTO SOLO TEXTO
		}

		$objFirma = new FirmaElectronica();
		$esValido = $objFirma->validaUsuario($this->siiDatos["emisor_region"],56,$this->siiDatos["emisor_rut"]);
		if(!$esValido[1]["esValido"])
		{
			echo json_encode(array("Respuesta" => false,"Mensaje" => "Usuario no autorizado a firmar el DTE solicitado"));
			exit;
		}
	}

	/**
	* Funcion que permite modificar la informacion del cliente solo cuando el CodRef sea 2
	* @return Boolean
	* @param Array con los datos del cliente a actualizar
	**/
	public function actualizaCliente($input)
	{
		try {
			$objDbConnect = new db_connect();
			$null = NULL;
			$query = "UPDATE sii_cliente SET cliente_empresa = ?, cliente_rut = ?, cliente_dv = ?, cliente_direccion = ?, cliente_region = ?, cliente_comuna = ?, cliente_giro = ? WHERE cliente_id = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);

			if($stmt)
			{
				$stmt->bind_param("ssssiisi",$input["RznSocRecep"],$input["RUTRecep"],$input["RUTRecepDv"],$input["DirRecep"],$input["CmnaRecep"],$input["CiudadRecep"],$input["GiroRecep"],$input["cliente_id"]);

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
	* Funcion principal que llama a los otros métodos para la creacion del DTE correspondiente
	* que sera enviado automaticamente al S.I.I.
	* @return boolean
	**/
	public function GenerarXML()
	{

		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);
		$resFolio = $objCAF->validaFolio($this->folio,$this->tipo_dcto,$this->siiDatos["emisor_region"]);
		if($resFolio["Respuesta"] == false)
		{
			return array("Respuesta" => false,"Mensaje" => $resFolio["Mensaje"]);
		}
		
		self::GeneraCaratula();
		self::GeneraTED();
		self::GeneraDetalle();
		if($this->siiDatos["DscRcgGlobal"] == "on")
		{
			if($this->siiDatos["DscRcgGlobalTpoMov"] != "" && $this->siiDatos["DscRcgGlobalTpoValor"] != "" && $this->siiDatos["DscRcgGlobalValorDR"] != "")
			{
				self::generaDctoGlobal();
			}
		}
		self::GeneraDocumento();
		self::Timbrar();
		return self::EnvioDTE();
	}

	/**
	* Metodo que agrega al XML un descuento o recargo segun corresponda
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	*/
	public function generaDctoGlobal()
	{
		$DscRcgGlobal = new XML();
		$DscRcgGlobal->generate([
			"DscRcgGlobal" => [
			"NroLinDR" => 1,
			"TpoMov" => $this->siiDatos["DscRcgGlobalTpoMov"],
			"GlosaDR" => "RECARGO GLOBAL ITEMS AFECTOS",
			"TpoValor" => $this->siiDatos["DscRcgGlobalTpoValor"],
			"ValorDR" => $this->siiDatos["DscRcgGlobalValorDR"],
			]
			]);

		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$DscRcgGlobal->saveXML()))."</DATA>";
		$this->DscRcgGlobal = $xml;
	}

	/**
	* Método que permite timbrar el documento dado
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	public function Timbrar(){
		$TED = new XML();
		$TED->loadXML(utf8_encode($this->TED));

		$Documento = new XML();
		$Documento->loadXML(utf8_encode($this->Documento));
		$parent = $Documento->getElementsByTagName("Documento")->item(0);

		$Documento->generate(['TmstFirma'=>$this->timestamp], $parent);

		$arr = array("<DATA>","</DATA>");
		$objFirma = new FirmaElectronica();
		$xml = $objFirma->firmarXML(trim(str_replace($arr,'',$Documento->saveXML())), '#'.$this->referencia, "Documento");
		return $xml;
	}

	/**
	* Método que permite generar la estructura XML del documento
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraDocumento()
	{
		$DscRcgGlobal = new XML();
		$DscRcgGlobal->loadXML($this->DscRcgGlobal);

		$Detalle = new XML();
		$Detalle->loadXML($this->Detalle);
		
		$Ted = new XML();
		$Ted->loadXML(utf8_encode($this->TED));

		$objDocumentos = new Documentos();
		$detalleDTE = $objDocumentos->getDetalleDTE($this->siiDatos["dte_id"]);

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);



		if($this->siiDatos["DscRcgGlobal"] == "on")
		{

			if($this->siiDatos["DscRcgGlobalTpoMov"] <> "" && $this->siiDatos["DscRcgGlobalTpoValor"] <> "" && $this->siiDatos["DscRcgGlobalValorDR"] <> "")
			{
			//DESCUENTO
				if($this->siiDatos["DscRcgGlobalTpoMov"] == "D")
				{
					if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
					{
						$neto = $this->siiDatos["cotizacion_neto"] - (round($this->siiDatos["cotizacion_neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
					}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
					{
						$neto = $this->siiDatos["cotizacion_neto"] - $this->siiDatos["DscRcgGlobalValorDR"];
					}else{
						$neto = $this->siiDatos["cotizacion_neto"];
					}
				// RECARGO
				}else{
					if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
					{
						$neto = $this->siiDatos["cotizacion_neto"] + (round($this->siiDatos["cotizacion_neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
					}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
					{
						$neto = $this->siiDatos["cotizacion_neto"] + $this->siiDatos["DscRcgGlobalValorDR"];
					}else{
						$neto = $this->siiDatos["cotizacion_neto"];
					}
				}
			}else{
				$neto = $this->siiDatos["cotizacion_neto"];
			}
		}else{
			$neto = $this->siiDatos["cotizacion_neto"];
		}

		$Documento = new XML();
		$Documento->generate([
			"DTE" => [
			"@attributes" => [
			"version" => "1.0",
			"xmlns" => "http://www.sii.cl/SiiDte",
			],
			"Documento" =>[
			"@attributes" => [
			"ID" => $this->referencia
			],

			"Encabezado" => [
			"IdDoc" => [
			"TipoDTE" => $this->tipo_dcto,
			"Folio" => $this->folio,
			"FchEmis" => Date("Y-m-d")
			],
			"Emisor" => [
			"RUTEmisor" => $empresa[1]["empresa_rut"]."-".$empresa[1]["empresa_dv"],
			"RznSoc" => substr($empresa[1]["empresa_glosa"], 0,100),
			"GiroEmis" => substr($empresa[1]["empresa_giro"], 0,80),
			"Acteco" => $empresa[1]["empresa_acteco"],
			"CdgSIISucur" => $empresa[1]["empresa_sucursal"],
			"DirOrigen" => substr($empresa[1]["empresa_direccion"],0,70),
			"CmnaOrigen" => substr($empresa[1]["empresa_comuna"],0,20),
			"CiudadOrigen" => substr($empresa[1]["empresa_ciudad"],0,20),
			],
			"Receptor" => [
			"RUTRecep" => ($this->ambiente == 0) ? "60803000-K" : $this->siiDatos["RUTRecep"]."-".$this->siiDatos["RUTRecepDv"],
			"RznSocRecep" => substr($this->siiDatos["RznSocRecep"],0,100),
			"GiroRecep" => utf8_encode(substr($this->siiDatos["GiroRecep"],0,40)),
			"DirRecep" => substr($this->siiDatos["DirRecep"],0,70),
			"CmnaRecep" => substr($this->siiDatos["CmnaRecep2"],0,20),
			"CiudadRecep" => substr($this->siiDatos["CiudadRecep2"],0,20),
			],
			"Totales" => [
			"MntNeto" => ( ($this->CodRef == 3 || $this->CodRef == 11) && $this->siiDatos["TpoDocRef"] <> 34) ? $neto : false,
			"MntExe" => ( ($this->CodRef == 3 || $this->CodRef == 11) && $this->siiDatos["TpoDocRef"] == 34) ? $this->siiDatos["cotizacion_total"] : 0,
			"TasaIVA" => ($this->siiDatos["TpoDocRef"] <> 34) ? 19 : false,
			"IVA" => ( ($this->CodRef == 3 || $this->CodRef == 11) && $this->siiDatos["TpoDocRef"] <> 34 ) ? round($neto * 0.19) : false,
			"MntTotal" => ($this->CodRef == 3 || $this->CodRef == 11) ? ( round($neto * 0.19) + $neto + $this->siiDatos["cotizacion_exento"]) : 0,
			],
				],//Encabezado
				"Detalle" => $Detalle->getElementsByTagName("DATA")->item(0),
				"DscRcgGlobal" => ($this->siiDatos["DscRcgGlobal"] == "on") ? $DscRcgGlobal->getElementsByTagName("DscRcgGlobal")->item(0) : false,
				"Referencia" => [
				[
				"NroLinRef" => 1,
				"TpoDocRef" => "SET",
				"FolioRef" => $this->folio,
				"FchRef" => date("Y-m-d"),
				"RazonRef" => "CASO 0".$this->siiDatos["caso"],
				],
				[
				"NroLinRef" => 2,
				"TpoDocRef" => $this->siiDatos["TpoDocRef"],
				"FolioRef" =>  $this->siiDatos["FolioRef"],
				"FchRef" => $this->siiDatos["FchRef"],
				"CodRef" => ($this->CodRef == 11 || $this->CodRef == 12) ? 1 : $this->siiDatos["CodRef"],
				"RazonRef" => substr($this->siiDatos["RazonRef"],0,90),
				]
				],
				
				"TED" => $Ted->getElementsByTagName("TED")->item(0),
				// "TmstFirma" => $this->timestamp
				]//Documento
				],//DTE

				]);

		$this->Documento = self::Extrae($Documento->saveXML());
		$fp = fopen("ETAPA_1_".$this->referencia.".xml", "w+");
		fwrite($fp, self::Extrae2(self::Timbrar()));
		fclose($fp);
	}

	/**
	* Método que permite unir los XML y enviarlo automaticamente al S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return boolean
	**/
	private function EnvioDTE()
	{
		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);
		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);

		$objCotizacion = new Cotizacion();
		$cotizacion = $objCotizacion->getCotizacion($this->cotizacion);

		$EnvioDTE='<?xml version="1.0" encoding="ISO-8859-1"?>';
		$EnvioDTE.='<EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd" version="1.0">';
		$EnvioDTE.='<SetDTE ID="SetDoc">';
		$EnvioDTE.= $this->Caratula;
		$EnvioDTE.= trim(str_replace('<?xml version="1.0"?>','',self::Timbrar()));
		$EnvioDTE.="</SetDTE>";
		$EnvioDTE.="</EnvioDTE>";

		$objFirma = new FirmaElectronica();
		if(!$objFirma->verificarCaducidad())
			return array("Respuesta" => false,"Mensaje" => "Firma Electrónica Inválida");

		$xml = $objFirma->firmarXML($EnvioDTE,"#SetDoc","SetDTE",true);
		$objValidate = new Validate();

		$Schema = $objValidate->validateSCHEMA("DTE",$xml);
		$Firma = $objValidate->validateSCHEMA("DTE",$xml);

		if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Error en SCHEMA : ".$Schema);}
		if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma);}

		// echo $xml;
		// exit;
		/************* ENVIO A SII AUTOMATICO ***************/
		if($Schema == "" && $Firma == "")
		{

			$year = substr($this->timestamp, 0,4);
			$month = substr($this->timestamp, 5,2);

			$this->verificaCarpeta($this->tipo_dcto,$year,$month);
			
			$fp = fopen("../Documentos/".$this->tipo_dcto."/".$year."/".$month."/".$this->referencia.".xml","w+");
			fwrite($fp, $xml);
			fclose($fp);

			$this->token = trim($this->getToken());

			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false, "Mensaje" => "El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($this->token);
					if(trim($token->GLOSA == "Token Creado"))
					{	
						$objDTE = new DTE($this->referencia,$token->TOKEN,$this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"],$empresa[1]["empresa_rut"],$empresa[1]["empresa_dv"],$this->tipo_dcto,$year,$month);
						$res = $objDTE->enviarDTE();
						if($res->STATUS == 0)
						{
							$objDTE->nuevoDTE2($this->referencia,$this->tipo_dcto,$this->folio,$res,$this->siiDatos["cliente_id"],$this->cotizacion,$this->siiDatos);
							$objCAF->actualizarFolio($this->folio,$this->tipo_dcto,$this->siiDatos["emisor_region"]);
							return array("Respuesta" => true, "Mensaje" => $res);
						}else{
							return array("Respuesta" => false, $res);
						}
					}else{
						return array("Respuesta" => false,"Mensaje" => trim($token->GLOSA));
					}
				} catch (Exception $e) {
					return array("Respuesta" => false,"Mensaje" => "No se ha podido generar el TOKEN al S.I.I.");
				}
			}
		}else{
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en el envio del DTE : ".$Schema."\n".$Firma);
		}
	}

	/**
	* Funcion que permite la creacion de la carpeta de destino si no existe
	* @param Integer $tipoDCTO Tipo de documento
	* @param Integer $year Año solicitado
	* @param Intener $month Mes que se desea crear
	**/	
	private function verificaCarpeta($tipoDCTO,$year,$month)
	{
		try {
			$ruta = "../Documentos/".$tipoDCTO."/".$year."/$month";
			mkdir($ruta,0777,true);					
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que codificar el texto de entrada a formato ISO-8859-1 requerido por el S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return string
	**/	
	private function decode($input)
	{
		$codificacion =  mb_detect_encoding($input);
		if($codificacion == "UTF-8")
		{
			return mb_convert_encoding($input,"UTF-8","ISO-8859-1");
		}else if($codificacion == "ASCII"){
			return mb_convert_encoding($input,"UTF-8","ISO-8859-1");
		}
		return $input;

	}

	/**
	* Método que permite el detalle de los bienes y/o servicios del documento
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraDetalle()
	{
		$objDocumentos = new Documentos();
		$detalleDTE = $objDocumentos->getDetalleDTE($this->siiDatos["dte_id"]);

		$Detalle = new XML();
		$Data = new XML();
		$totalElementos = $this->siiDatos["totalElementos"];
		$cont=1;
		if($this->CodRef == 3 || $this->CodRef == 11)
		{
			for ($i=0; $i < $totalElementos; $i++) {
				if($this->siiDatos["var5"][$i] <> "")
				{
					if($this->siiDatos["var12"][$i] == "on")
					{
						$Detalle->generate([
							"Detalle" => [
							"NroLinDet" => $cont,
							"IndExe" => ($this->siiDatos["var10"][$i]["detalle_indexe"] == 1) ? 1 : false,
							"NmbItem" => self::decode($this->siiDatos["var5"][$i]),
							"QtyItem" => $this->siiDatos["var9"][$i],
							"PrcItem" => $this->siiDatos["var11"][$i],
							"DescuentoPct" => ($this->siiDatos["var1"][$i] == 0) ? false : ($this->siiDatos["var1"][$i] / 100),
							"DescuentoMonto" => ($this->siiDatos["var6"][$i] == 0) ? false : $this->siiDatos["var6"][$i],
							"MontoItem" => $this->siiDatos["var2"][$i],
							],
							]);
						$cont++;
						
					}
				}

			}

		}else{
			$Detalle->generate([
				"Detalle" => [
				"NroLinDet" => 1,
				"NmbItem" => $this->siiDatos["RazonRef"],
				"MontoItem" => 0,
				],
				]);
		}
		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$Detalle->saveXML()))."</DATA>";
		$this->Detalle = $xml;
	}

	/**
	* Método que permite generar la Carátula del documento segun el esquema
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraCaratula()
	{
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);
		$Caratula = new XML();
		$Caratula->generate([
			"Caratula" => [
			"@attributes" => [
			"version" => "1.0"
			],
			"RutEmisor" => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			"RutEnvia" => $this->siiDatos["emisor_rut"]."-".$this->siiDatos["emisor_dv"],
			"RutReceptor" => ($this->ambiente == 0) ? "60803000-K" : $this->siiDatos["RUTRecep"]."-".$this->siiDatos["RUTRecepDv"],
			"FchResol" => $datosEmpresa[1]["empresa_fecha"],
			"NroResol" => $datosEmpresa[1]["empresa_resolucion"],
			"TmstFirmaEnv" => $this->timestamp,
			"SubTotDTE" => [
			"TpoDTE" => $this->tipo_dcto,
			"NroDTE" => 1,
			]
			]
			]);

		$this->Caratula = self::Extrae($Caratula->saveXML());
	}

	/**
	* Método que permite generar el TED (Timbre Electronico del DTE)
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraTED()
	{
		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);
		$pkey = $objCAF->getPkey();

		$objCotizacion = new Cotizacion();
		$cotizacion = $objCotizacion->getCotizacion($this->cotizacion);
		$objEmpresa = new Empresa();
		$datosEmpresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);

		$objDocumentos = new Documentos();
		$detalleDTE = $objDocumentos->getDetalleDTE($this->siiDatos["dte_id"]);

		if($this->siiDatos["DscRcgGlobal"] == "on")
		{

			if($this->siiDatos["DscRcgGlobalTpoMov"] <> "" && $this->siiDatos["DscRcgGlobalTpoValor"] <> "" && $this->siiDatos["DscRcgGlobalValorDR"] <> "")
			{
			//DESCUENTO
				if($this->siiDatos["DscRcgGlobalTpoMov"] == "D")
				{
					if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
					{
						$neto = $this->siiDatos["cotizacion_neto"] - (round($this->siiDatos["cotizacion_neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
					}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
					{
						$neto = $this->siiDatos["cotizacion_neto"] - $this->siiDatos["DscRcgGlobalValorDR"];
					}else{
						$neto = $this->siiDatos["cotizacion_neto"];
					}
				// RECARGO
				}else{
					if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
					{
						$neto = $this->siiDatos["cotizacion_neto"] + (round($this->siiDatos["cotizacion_neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
					}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
					{
						$neto = $this->siiDatos["cotizacion_neto"] + $this->siiDatos["DscRcgGlobalValorDR"];
					}else{
						$neto = $this->siiDatos["cotizacion_neto"];
					}
				}
			}else{
				$neto = $this->siiDatos["cotizacion_neto"];
			}
		}else{
			$neto = $this->siiDatos["cotizacion_neto"];
		}

		$TED = new XML();
		$TED->generate([
			'TED' => [
			'@attributes' => [
			'version' => '1.0',
			],
			'DD' => [
			'RE' => $datosEmpresa[1]["empresa_rut"]."-".$datosEmpresa[1]["empresa_dv"],
			'TD' => $this->tipo_dcto,
			'F' => $this->folio,
			'FE' => Date("Y-m-d"),
			'RR' => ($this->ambiente == 0) ? "60803000-K" : $this->siiDatos["RUTRecep"]."-".$this->siiDatos["RUTRecepDv"],
			'RSR' => substr($this->siiDatos["RznSocRecep"],0, 40),
			'MNT' => ($this->CodRef == 3 || $this->CodRef == 11) ? ( round($neto * 0.19) + $neto + $this->siiDatos["cotizacion_exento"]) : 0,
			'IT1' => ($this->CodRef == 11 || $this->CodRef == 12) ? $this->siiDatos["RazonRef"] : utf8_encode($this->siiDatos["var5"][0]),
			'CAF' => $objCAF->getCAF2(),
			'TSTED' => $this->timestamp,
			],
			'FRMT' => [
			'@attributes' => [
			'algoritmo' => 'SHA1withRSA'
			],
			],

			],
			]);

		$DD = $TED->getFlattened('/TED/DD');

		$pkeyid = openssl_pkey_get_private($pkey);
		openssl_sign($DD, $signature, $pkeyid,OPENSSL_ALGO_SHA1);

		$TED->getElementsByTagName('FRMT')->item(0)->nodeValue =  base64_encode($signature);
		openssl_free_key($pkeyid);
		$this->TED = self::Extrae($TED->saveXML());
	}

	/**
	* Método que permite limpiar los XML resultantes.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function Extrae($xml)
	{
		$reemplazo = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		return trim(str_replace($reemplazo,"",$xml));
	}

	/**
	* Método que permite limpiar los XML resultantes.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function Extrae2($xml)
	{
		$reemplazo = "<?xml version=\"1.0\"?>";
		return trim(str_replace($reemplazo,"",$xml));
	}

	/**
	* Método obtener el TOKEN (semilla) desde el WebService del S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	public function getToken() {
		try {

			$this->client = $this->getConnection($this->wsdl_url[0]);
			$getSeed = $this->client->getSeed();
			$xml = simplexml_load_string($getSeed);
			$xml->registerXPathNamespace('SII', 'http://www.sii.cl/XMLSchema');
			$events = $xml->xpath('//SII:RESP_BODY' );
			$semilla = $events[0]->SEMILLA;

			return $this->GetTokenFromSeed($this->firmaSemilla($semilla));
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que permite timbrar el XML de la semilla
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	* @param XML
	**/
	private function firmaSemilla($input)
	{
		try {
			$objFIRMA = new FirmaElectronica();
			$semillaFirmada = $objFIRMA->firmarXML(
				(new XML())->generate([
					'getToken' => [
					'item' => [
					'Semilla' => $input
					]
					]
					])->saveXML());
			return $semillaFirmada;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que permite obtener el TOKEN válido como respuesta del WebService
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	* @param XML
	**/
	private function GetTokenFromSeed($signed)
	{
		try {
			$this->client = $this->getConnection($this->wsdl_url[1]);
			$response = $this->client->getToken($signed);

			$replaceArray = array("<SII:RESP_BODY>","</SII:RESP_BODY>","<SII:RESP_HDR>","</SII:RESP_HDR>");
			$response = trim(str_replace($replaceArray, "", $response));
			return $response;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	* Método que permite conectarse al WebService solicitado
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return Object
	* @param String con la URL del WebService SOAP
	**/
	private function getConnection ($wsdl) {
		try {
			return $this->client = new SoapClient($wsdl,$this->options);
		} catch (SoapFault $e) {
			throw new Exception ("La Conexion ha fallado");
		}
	}

}

?>