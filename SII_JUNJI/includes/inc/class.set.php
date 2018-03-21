<?php
require_once("class.db_connect.php");
require_once("class.xml.php");
require_once("class.FirmaElectronica.php");
require_once("class.validate.php");
require_once("class.empresa.php");
/**
* 
*/

ini_set("display_errors", 0);
class SetDePrueba
{
	private $timestamp;
	private $datos;
	function __construct($datos)
	{
		$this->timestamp = date('Y-m-d\TH:i:s');
		$this->datos = $datos;
	}


	public function GenerarXML()
	{
		$DTE = array(
			1 => "ETAPA_1_F390T33",
			2 => "ETAPA_1_F391T33",
			3 => "ETAPA_1_F392T33",
			4 => "ETAPA_1_F393T33",
			5 => "ETAPA_1_F220T61",
			6 => "ETAPA_1_F221T61",
			7 => "ETAPA_1_F222T61",
			8 => "ETAPA_1_F85T56"
			);

		$dataDTE = "";
		foreach ($DTE as $key => $value) {
			$dataDTE.=file_get_contents($value.".xml");
		}

		// $Caratula = self::GeneraCaratula();
		/*$xml='<?xml version="1.0" encoding="ISO-8859-1"?><EnvioDTE version="1.0" xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd"><SetDTE ID="SetDoc">';*/
		$xml='<?xml version="1.0" encoding="ISO-8859-1"?>';
		$xml.='<EnvioDTE xmlns="http://www.sii.cl/SiiDte" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sii.cl/SiiDte EnvioDTE_v10.xsd" version="1.0">';
		$xml.='<SetDTE ID="SetDoc">';
		$xml.=self::GeneraCaratula();
		$xml.=$dataDTE;
		$xml.="</SetDTE>";
		$xml.="</EnvioDTE>";

		$objValidate = new Validate();
		$objFirma = new FirmaElectronica();
		if(!$objFirma->verificarCaducidad())
			return array("Respuesta" => false,"Mensaje" => "Firma Electrónica Inválida");
		
		$setFIRMADO = $objFirma->firmarXML($xml,"#SetDoc","SetDTE",true);
		$Schema = $objValidate->validateSCHEMA("DTE",$setFIRMADO);
		$Firma = $objValidate->validateSCHEMA("DTE",$setFIRMADO);
		if($Schema <> ""){return array("Respuesta" => false,"Mensaje" => "Error en SCHEMA : ".$Schema);}
		if($Firma <> ""){return array("Respuesta" => false,"Mensaje" => "Error en FIRMA : ".$Firma);}

		$fp = fopen("SET_DTE.xml", "w+");
		fwrite($fp, $setFIRMADO);
		fclose($fp);
		return array("Respuesta" => true,"Mensaje" => "SET generado con exito!");

	}


	private function getDocumentos()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_dte";
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

	private function GeneraCaratula()
	{
		$objEmpresa = new Empresa();
		$empresa = $objEmpresa->getEmpresa($this->datos["usuario_region"]);
		$Caratula='<Caratula version="1.0"><RutEmisor>'.$empresa[1]["empresa_rut"].'-'.$empresa[1]["empresa_dv"].'</RutEmisor><RutEnvia>'.$this->datos["emisor_rut"].'-'.$this->datos["emisor_dv"].'</RutEnvia><RutReceptor>60803000-K</RutReceptor><FchResol>'.$empresa[1]["empresa_fecha"].'</FchResol><NroResol>0</NroResol><TmstFirmaEnv>'.$this->timestamp.'</TmstFirmaEnv><SubTotDTE><TpoDTE>33</TpoDTE><NroDTE>4</NroDTE></SubTotDTE><SubTotDTE><TpoDTE>61</TpoDTE><NroDTE>3</NroDTE></SubTotDTE><SubTotDTE><TpoDTE>56</TpoDTE><NroDTE>1</NroDTE></SubTotDTE></Caratula>';
		return $Caratula;
	}


	private function Extrae($xml)
	{
		$reemplazo = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
		return trim(str_replace($reemplazo,"",$xml));
	}


	private function Extrae2($xml)
	{
		$reemplazo = "<?xml version=\"1.0\"?>";
		return trim(str_replace($reemplazo,"",$xml));
	}

}
?>