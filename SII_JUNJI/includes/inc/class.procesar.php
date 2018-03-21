<?php
ini_set("display_errors", 0);
require_once("class.xml.php");
require_once("class.CAF.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
require_once("class.dte.php");
require_once("class.documentos.php");
require_once("class.cotizacion.php");
require_once("class.empresa.php");
require_once("class.umbral.php");
/**
 * Clase para trabajar con la Factura Electronica que no venga de una cotización
 * @author Freddy Varas Henriquez (fvaras@pradi.cl)
 */
class Procesar
{
	private $siiDatos;
	private $timestamp;
	private $referencia;

	private $TED;
	private $Caratula;
	private $Detalle;
	private $DTE;

	private $token;
	private $Documento;

	private $folio;
	private $tipo_dcto;

	private $Referencia;

	private $client = NULL;
	private $wsdl_url = array(0 => "https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL",1 => "https://palena.sii.cl/DTEWS/GetTokenFromSeed.jws?WSDL");
	private $options = array("trace" => true,"soap_version" => SOAP_1_1,"exceptions" => true,"cache_wsdl" => WSDL_CACHE_NONE,"features" => SOAP_SINGLE_ELEMENT_ARRAYS);

	//0 : CERTIFICACION, 1 : PRODUCCION
	private $ambiente = 1;

	function __construct($input)
	{
		$this->siiDatos = $input;
		$this->tipo_dcto = $input["sii_tipo_dcto"];
		$this->timestamp = date('Y-m-d\TH:i:s');

		$objCAF = new CAF($this->tipo_dcto,$input["emisor_region"]);
		$resCAF = $objCAF->getCAF();
		if(count($resCAF) == 0)
		{
			echo json_encode(array("Respuesta" => false,"Mensaje" => "No existe CAF para documento indicado"));
			exit;
		}
		$this->folio = $resCAF[1]["folio_actual"] + 1;

		$resFolio = $objCAF->validaFolio($this->folio,$this->tipo_dcto,$this->siiDatos["emisor_region"]);
		if($resFolio["Respuesta"] == false)
		{
			echo json_encode(array("Respuesta" => false,"Mensaje" => $resFolio["Mensaje"]));
			exit;
		}

		$this->referencia = "F".$this->folio."T".$input["sii_tipo_dcto"];

		$objFirma = new FirmaElectronica($input["emisor_rut"],$input["emisor_dv"]);
		$esValido = $objFirma->validaUsuario($this->siiDatos["emisor_region"],$this->siiDatos["sii_tipo_dcto"],$this->siiDatos["emisor_rut"]);
		if(!$esValido[1]["esValido"])
		{
			echo json_encode(array("Respuesta" => false,"Mensaje" => "Usuario no autorizado a firmar el DTE solicitado"));
			exit;
		}
	}

	/**
	* Funcion que permite añadir una referencia a la factura electronica
	* @return XML
	**/
	public function GenerarReferencia()
	{
		$Referencia = new XML();
		$Referencia->generate([
			"Referencia" => [
			"NroLinRef" => 1,
			"TpoDocRef" => $this->siiDatos["TpoDocRef"],
			"FolioRef" => $this->folio,
			"FchRef" => date("Y-m-d"),
			"RazonRef" => self::decode($this->siiDatos["RazonRef"]),
			]
			]);
		// $Referencia->generate([
		// 	"Referencia" => [
		// 	"NroLinRef" => 1,
		// 	"TpoDocRef" => $this->siiDatos["TpoDocRef"],
		// 	"FolioRef" => $this->siiDatos["FolioRef"],
		// 	"FchRef" => $this->siiDatos["FchRef"],
		// 	"RazonRef" => $this->siiDatos["RazonRef"],
		// 	]
		// 	]);
		$this->Referencia = self::Extrae($Referencia->saveXML());
	}

	/**
	* Funcion principal que llama a los otros métodos para la creacion del DTE correspondiente
	* que sera enviado automaticamente al S.I.I.
	* @return boolean
	**/
	public function GenerarXML()
	{
		self::GeneraCaratula();
		self::GeneraTED();
		self::GeneraDetalle();
		if($this->siiDatos["DscRcgGlobal"] == "on")
		{			
			if($this->siiDatos["DscRcgGlobalTpoMov"] <> "" && $this->siiDatos["DscRcgGlobalTpoValor"] <> "" && $this->siiDatos["DscRcgGlobalValorDR"] <> "")
			{
				self::generaDctoGlobal();
			}
		}

		if($this->siiDatos["referencia"] == "SI")
		{
			self::GenerarReferencia();
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
		$TpoMov = $this->siiDatos["DscRcgGlobalTpoMov"];
		$TpoValor = $this->siiDatos["DscRcgGlobalTpoValor"];
		$ValorDR = $this->siiDatos["DscRcgGlobalValorDR"];

		$DscRcgGlobal = new XML();
		$DscRcgGlobal->generate([
			"DscRcgGlobal" => [
			"NroLinDR" => 1,
			"TpoMov" => $TpoMov,
			"GlosaDR" => ($TpoMov == "D") ? substr("DESCUENTO GLOBAL ITEMS AFECTOS",0,45) : substr("RECARGO GLOBAL ITEMS AFECTOS",0,45),
			"TpoValor" => $TpoValor,
			"ValorDR" => $ValorDR,
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
		$objFirma = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
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
		$Detalle = new XML();
		$Detalle->loadXML($this->Detalle);
		$Ted = new XML();
		$Ted->loadXML(utf8_encode($this->TED));

		if($this->siiDatos["DscRcgGlobal"] == "on")
		{

			if($this->siiDatos["DscRcgGlobalTpoMov"] <> "" && $this->siiDatos["DscRcgGlobalTpoValor"] <> "" && $this->siiDatos["DscRcgGlobalValorDR"] <> "")
			{
			//DESCUENTO
				if($this->siiDatos["DscRcgGlobalTpoMov"] == "D")
				{
					if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
					{
						$neto = $this->siiDatos["neto"] - (round($this->siiDatos["neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
					}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
					{
						$neto = $this->siiDatos["neto"] - $this->siiDatos["DscRcgGlobalValorDR"];
					}else{
						$neto = $this->siiDatos["neto"];
					}
				// RECARGO
				}else{
					if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
					{
						$neto = $this->siiDatos["neto"] + (round($this->siiDatos["neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
					}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
					{
						$neto = $this->siiDatos["neto"] + $this->siiDatos["DscRcgGlobalValorDR"];
					}else{
						$neto = $this->siiDatos["neto"];
					}
				}
			}else{
				$neto = $this->siiDatos["neto"];
			}
		}else{
			$neto = $this->siiDatos["neto"];
		}

		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->siiDatos["emisor_region"]);
		
		$DscRcgGlobal = new XML();
		$DscRcgGlobal->loadXML($this->DscRcgGlobal);

		$Referencia = new XML();
		$Referencia->loadXML($this->Referencia);

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
			"TipoDTE" => $this->siiDatos["sii_tipo_dcto"],
			"Folio" => $this->folio,
			"FchEmis" => $this->siiDatos["dcto_fecha_emision"],
			"TipoDespacho" => ($this->siiDatos["sii_tipo_dcto"] == 52 && $this->siiDatos["sii_tipoDespacho"] <> "") ? $this->siiDatos["sii_tipoDespacho"] : false,
			"IndTraslado" => ($this->siiDatos["sii_tipo_dcto"] == 52 && $this->siiDatos["sii_indTraslado"] <> "") ? $this->siiDatos["sii_indTraslado"] : false,
			"FchCancel" => ($this->siiDatos["sii_tipo_dcto"] == 52 && $this->siiDatos["sii_estado_pago"] == "SI") ? $this->siiDatos["sii_fecha_pago"] : false,
			],
			"Emisor" => [
			"RUTEmisor" => $this->siiDatos["sii_empresa_rut"]."-".$this->siiDatos["sii_empresa_dv"],
			"RznSoc" => substr($this->siiDatos["sii_empresa"], 0,40),
			"GiroEmis" => substr($this->siiDatos["sii_giro"], 0,40),
			"Acteco" => $empresa[1]["empresa_acteco"],
			"CdgSIISucur" => $empresa[1]["empresa_sucursal"],
			"DirOrigen" => $this->siiDatos["sii_direccion"],
			"CmnaOrigen" => $this->siiDatos["sii_comuna"],
			"CiudadOrigen" => $this->siiDatos["sii_ciudad"],
			],
			"Receptor" => [
			// "RUTRecep" => $this->siiDatos["receptor_rut"]."-".$this->siiDatos["receptor_dv"],
			"RUTRecep" => ($this->ambiente == 0) ? "60803000-K" : $this->siiDatos["receptor_rut"]."-".$this->siiDatos["receptor_dv"],
			"RznSocRecep" => $this->siiDatos["receptor_glosa"],
			"GiroRecep" => substr($this->siiDatos["receptor_giro"],0,40),
			"DirRecep" => substr($this->siiDatos["receptor_direccion"],0,70),
			"CmnaRecep" => substr($this->siiDatos["receptor_region"],0,20),
			"CiudadRecep" => substr($this->siiDatos["receptor_comuna"],0,20),
			],
			"Totales" => [
			"MntNeto" => ($this->siiDatos["sii_tipo_dcto"] == 34) ? false : $neto,
			"MntExe" => $this->siiDatos["exento"],
			"TasaIVA" => ($this->siiDatos["sii_tipo_dcto"] == 34) ? false : 19,
			"IVA" => ($this->siiDatos["sii_tipo_dcto"] == 34) ? false : round($neto * 0.19),
			"MntTotal" => $neto + (round($neto * 0.19)) + $this->siiDatos["exento"],
			],
			],
			"Detalle" => $Detalle->getElementsByTagName("DATA")->item(0),
			"DscRcgGlobal" => ($this->siiDatos["DscRcgGlobal"] == "on" && $this->siiDatos["DscRcgGlobalTpoMov"] <> "" && $this->siiDatos["DscRcgGlobalTpoValor"] <> "" && $this->siiDatos["DscRcgGlobalValorDR"] <> "") ? $DscRcgGlobal->getElementsByTagName("DATA")->item(0) : false,
			"Referencia" => (isset($this->siiDatos["referencia"]) && $this->siiDatos["referencia"] == "SI") ? $Referencia->getElementsByTagName("Referencia")->item(0) : false,
			"TED" => $Ted->getElementsByTagName("TED")->item(0),
			]
			],
			]);

		
		$arr = array("<DATA>","</DATA>");

		$this->Documento = self::Extrae($Documento->saveXML());
		// $fp = fopen("ETAPA_1_".$this->referencia.".xml", "w+");
		// fwrite($fp, self::Extrae2(self::Timbrar()));
		// fclose($fp);
	}

	/**
	* Método que permite unir los XML y enviarlo automaticamente al S.I.I.
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return boolean
	**/
	private function EnvioDTE()
	{
		$objCAF = new CAF($this->tipo_dcto,$this->siiDatos["emisor_region"]);

		$EnvioDTE='<?xml version="1.0" encoding="ISO-8859-1"?>';
		$EnvioDTE.='<EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd" version="1.0">';
		$EnvioDTE.='<SetDTE ID="SetDoc">';
		$EnvioDTE.= $this->Caratula;
		$EnvioDTE.= trim(str_replace('<?xml version="1.0"?>','',self::Timbrar()));
		$EnvioDTE.="</SetDTE>";
		$EnvioDTE.="</EnvioDTE>";

		$objFirma = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
		if(!$objFirma->verificarCaducidad())
			return array("Respuesta" => false,"Mensaje" => "Firma Electrónica Inválida");
		
		$xml = $objFirma->firmarXML($EnvioDTE,"#SetDoc","SetDTE",true);

		$objValidate = new Validate();
		$Schema = $objValidate->validateSCHEMA("DTE",$xml);
		$Firma = $objValidate->validateSCHEMA("DTE",$xml);

		if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Error en SCHEMA : ".$Schema);}
		if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma);}
		/************* ENVIO A SII AUTOMATICO ***************/

		// echo $xml;
		// exit();
		if(is_null($esValido) || $esValido == "" || $esValido == NULL)
		{
			$this->token = trim($this->getToken());

			if($this->token === "Service Temporarily Unavailable")
			{
				return array("Respuesta" => false,"Mensaje" => "El servicio no está disponible.");
			}else{
				try {
					$token = new SimpleXMLElement($this->token);
					if(trim($token->GLOSA == "Token Creado"))
					{	
						$year = substr($this->timestamp, 0,4);
						$month = substr($this->timestamp, 5,2);
						$this->verificaCarpeta($this->tipo_dcto,$year,$month);
						
						$fp = fopen("../../sistemas/archivos/SII/Documentos/".$this->tipo_dcto."/".$year."/".$month."/".$this->referencia.".xml","w+");
						fwrite($fp, $xml);
						fclose($fp);
						$objDTE = new DTE($this->referencia,$token->TOKEN,$this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"],$this->siiDatos["sii_empresa_rut"],$this->siiDatos["sii_empresa_dv"],$this->siiDatos["sii_tipo_dcto"],$year,$month);
						$res = $objDTE->enviarDTE();
						if($res->STATUS == 0)
						{
							$objUmbral = new Umbral($this->tipo_dcto,$this->siiDatos["emisor_region"]);
							
							$objCotizacion = new Cotizacion();
							$objCotizacion->crearCotizacion2($this->siiDatos,$this->referencia,$res,$this->folio,$this->siiDatos["emisor_region"]);
							$objCAF->actualizarFolio($this->folio,$this->tipo_dcto,$this->siiDatos["emisor_region"]);
							return array("Respuesta" => true, "Mensaje" => "Documento tributario electronico generado y enviado exitosamente!");
						}
					}else{
						return array("Respuesta" => false,"Mensaje" => "Error: ".$res->GLOSA);
					}
				} catch (Exception $e) {
					return array("Respuesta" => false,"Mensaje" => "Error: ".$e->getMessage());
				}
			}
		}else{
			return array("Respuesta" => false,"Mensaje" => "Ha ocurrido un error en el envio del DTE : ".$esValido);
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
			$ruta = "../../sistemas/archivos/SII/Documentos/".$tipoDCTO."/".$year."/$month";
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
		// echo $codificacion;
		if($codificacion === "UTF-8")
		{
			return mb_convert_encoding($input, "UTF-8", "ISO-8859-1");
		}else{
			return $input;
		}
		// return mb_detect_encoding($input, ['UTF-8', 'ISO-8859-1']) != 'ISO-8859-1' ? utf8_decode($input) : $input;
		// return mb_detect_encoding($input, ['UTF-8', 'ISO-8859-1']) == 'ISO-8859-1' ? utf8_encode($input) : $input;
		// if($codificacion == "UTF-8")
		// {
		// 	return mb_convert_encoding($input,"UTF-8","ISO-8859-1");
		// }else if($codificacion == "ASCII"){
		// 	return mb_convert_encoding($input,"UTF-8","ISO-8859-1");
		// }
		// return $input;
	}

	/**
	* Método que permite el detalle de los bienes y/o servicios del documento
	* @author Freddy Varas Henriquez (fvaras@pradi.cl)
	* @return XML
	**/
	private function GeneraDetalle()
	{
		$Detalle = new XML();
		$Data = new XML();
		$totalElementos = $this->siiDatos["totalElementos"];
		$cont=1;
		// $data = '1600088554';
		self::getCdgItem($data);
		for ($i=1; $i <= $totalElementos; $i++) {
			if($this->siiDatos["sii_item"][$i] <> "")
			{
				$Detalle->generate([
					"Detalle" => [
					"NroLinDet" => $cont,
					"CdgItem" => ($data <> '') ? self::getCdgItem($data)->getElementsByTagName("CdgItem")->item(0) : false,
					"IndExe" => ($this->siiDatos["sii_tipo"][$i] == 1 || $this->siiDatos["sii_tipo_dcto"] == 34) ? 1 : false,
					"NmbItem" => self::decode($this->siiDatos["sii_item"][$i]),
					"QtyItem" => $this->siiDatos["sii_producto_qty"][$i],
					"UnmdItem" => ($this->siiDatos["sii_umedida"][$i] <> '') ? substr($this->siiDatos["sii_umedida"][$i],0,4) : false,
					"PrcItem" => ($this->siiDatos["sii_tipo_dcto"] == 52 && $this->siiDatos["sii_indTraslado"] == 5) ? false : $this->siiDatos["sii_producto_costo"][$i],
					"DescuentoPct" => ($this->siiDatos["sii_producto_desc"][$i] == 0) ? false : ($this->siiDatos["sii_producto_desc"][$i] / 100),
					"DescuentoMonto" => ($this->siiDatos["montoDescuento"][$i] == 0) ? false : $this->siiDatos["montoDescuento"][$i],
					"MontoItem" => $this->siiDatos["var1"][$i],
					],
					]);
				$cont++;
			}
		}
		$xml="<DATA>".trim(str_replace("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>","",$Detalle->saveXML()))."</DATA>";
		$this->Detalle = $xml;
	}

/**
* Método que permite agregar el codigo del producto si tuviese alguno
* @param String $input Codigo a ingresar
* @return XML Resultado en formato XML
*
* TIPOS DE CODIGO
* EAN13
* PLU
* DUN14
* INT1
* INT2
* EAN128
**/
private function getCdgItem($input)
{
	$tipo = 3;
	$codificacion = [
	0 => "EAN",
	1 => "PLU",
	2 => "DUN",
	3 => "INT"
	];
	$CdgItem = new XML();
	$CdgItem->generate([
		"CdgItem" => [ 
		"TpoCodigo" => substr($codificacion[$tipo],0,10),
		"VlrCodigo" => substr($input,0,35)
		]
		]);
	return $CdgItem;
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
			"RutEmisor" => $this->siiDatos["sii_empresa_rut"]."-".$this->siiDatos["sii_empresa_dv"],
			"RutEnvia" => $this->siiDatos["emisor_rut"]."-".$this->siiDatos["emisor_dv"],
			// "RutReceptor" => ($this->ambiente == 0) ? "60803000-K" : trim($this->siiDatos["receptor_rut"])."-".trim($this->siiDatos["receptor_dv"]),
			"RutReceptor" => "60803000-K",
			"FchResol" => $datosEmpresa[1]["empresa_fecha"],
			"NroResol" => $datosEmpresa[1]["empresa_resolucion"],
			"TmstFirmaEnv" => $this->timestamp,
			"SubTotDTE" => [
			"TpoDTE" => $this->siiDatos["sii_tipo_dcto"],
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

		if($this->siiDatos["DscRcgGlobalTpoMov"] <> "" && $this->siiDatos["DscRcgGlobalTpoValor"] <> "" && $this->siiDatos["DscRcgGlobalValorDR"] <> "")
		{
			//DESCUENTO
			if($this->siiDatos["DscRcgGlobalTpoMov"] == "D")
			{
				if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
				{
					$neto = $this->siiDatos["neto"] - (round($this->siiDatos["neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
				}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
				{
					$neto = $this->siiDatos["neto"] - $this->siiDatos["DscRcgGlobalValorDR"];
				}else{
					$neto = $this->siiDatos["neto"];
				}
				// RECARGO
			}else{
				if($this->siiDatos["DscRcgGlobalTpoValor"] == "%")
				{
					$neto = $this->siiDatos["neto"] + (round($this->siiDatos["neto"] * ($this->siiDatos["DscRcgGlobalValorDR"] / 100)));
				}else if($this->siiDatos["DscRcgGlobalTpoValor"] == "$")
				{
					$neto = $this->siiDatos["neto"] + $this->siiDatos["DscRcgGlobalValorDR"];
				}else{
					$neto = $this->siiDatos["neto"];
				}
			}
		}else{
			$neto = $this->siiDatos["neto"];
		}



		$objCAF = new CAF($this->siiDatos["sii_tipo_dcto"],$this->siiDatos["emisor_region"]);
		$pkey = $objCAF->getPkey();

		$TED = new XML();
		$TED->generate([
			'TED' => [
			'@attributes' => [
			'version' => '1.0',
			],
			'DD' => [
			'RE' => $this->siiDatos["sii_empresa_rut"]."-".$this->siiDatos["sii_empresa_dv"],
			'TD' => $this->siiDatos["sii_tipo_dcto"],
			'F' => $this->folio,
			'FE' => $this->siiDatos["dcto_fecha_emision"],
			'RR' => ($this->ambiente == 0) ? "60803000-K" : $this->siiDatos["receptor_rut"]."-".$this->siiDatos["receptor_dv"],
			'RSR' => substr($this->siiDatos["receptor_glosa"],0, 40),
			'MNT' => $neto + $this->siiDatos["exento"] + (round($neto * 0.19)),
			'IT1' => substr($this->siiDatos["sii_item"][1], 0,40),
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
		$DD = str_replace('"','\"',$DD);
		// $fp = fopen("../Documentos/".$this->siiDatos["sii_tipo_dcto"]."/dd_".$this->referencia.".xml","w+");
		// fwrite($fp, $this->Extrae($TED->saveXML()));
		// fclose($fp);
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
			$objFIRMA = new FirmaElectronica($this->siiDatos["emisor_rut"],$this->siiDatos["emisor_dv"]);
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
		// echo $response."<--";
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
