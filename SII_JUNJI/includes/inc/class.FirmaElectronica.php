<?php
require_once("class.xml.php");
require_once("class.autorizado.php");
/**
* Clase que permite trabajar con el certificado digital del usuario
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class FirmaElectronica
{
	private $limite = 64;
	private $pkey;
	private $cert;
	private $data;

	function __construct($rut,$dv)
	{
		$informacionUsuario = self::getDatosUsuario($rut,$dv);
		$contenido = file_get_contents(dirname(__FILE__)."/".$informacionUsuario[1]["usuario_ruta_certificado"]);
		openssl_pkcs12_read($contenido, $certs, base64_decode($informacionUsuario[1]["usuario_certificado_password"]));
		$this->pkey = $certs["pkey"];
		$this->cert = $certs["cert"];
		$this->data = openssl_x509_parse($this->cert);
	}

	/**
	* Método que permite obtener la ruta del certificado y su contraseña
	* @param String $rut RUT del usuario
	* @param String $dv Digito verificador
	* @return Array Datos obtenidos de la consulta
	**/
	private function getDatosUsuario($rut,$dv){
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_usuario where usuario_rut = ? and usuario_dv = ?";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("is",$rut,$dv);
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

	public function validaUsuario($region,$dcto,$rut)
	{
		$objAutorizado = new Autorizado($region,$dcto,$rut);
		return $objAutorizado->validaUsuario();
	}
	
	/**
	* Método que valida la caducidad firma electronica al momento de firmar un documento
	* @return Boolean
	**/
	public function verificarCaducidad()
	{
		$hoy = date("Y-m-d H:i:s");
		$desde = date("Y-m-d H:i:s", $this->data["validFrom_time_t"]);
		$hasta = date("Y-m-d H:i:s", $this->data["validTo_time_t"]);

		if($hoy >= $desde && $hoy <= $hasta)
			return true;
		return false;
	}

	/**
	* Función que permite obtener la llave privada del certificado digital
	* @return String
	**/
	public function getPkey()
	{
		return $this->pkey;
	}

	/**
	* Función que permite la firma de datos
	* @param String $data Datos que se desean firmar
	* @param String $signature_alg Algoritmo que se empleará para firmar (Por defecto SHA1)
	* @return String $signature Firma digital en los datos en base64
	**/
	public function sign($data, $signature_alg = OPENSSL_ALGO_SHA1)
	{
		$signature = null;
		if (openssl_sign($data, $signature, $this->pkey, $signature_alg)==false) {
			return 'No fue posible firmar los datos';
		}
		return base64_encode($signature);
	}

	/**
	* Funcion para firmar el XML
	* Referencia : http://www.di-mgt.com.au/xmldsig2.html
	* @param XML $xml Datos en formato XML que se quiere firmar
	* @param String $reference Referencia a la que hace la firma
	* @return XML firmado digitalmente o false si no se pudo firmar
	**/
	public function firmarXML($xml, $reference = '', $tag = null, $xmlns_xsi = false)
	{
		$doc = new XML();
		$doc->loadXML($xml);

		// crear nodo para la firma
		$Signature = $doc->importNode((new XML())->generate([
			'Signature' => [
			'@attributes' => [
			'xmlns' => 'http://www.w3.org/2000/09/xmldsig#',
			],
			'SignedInfo' => [
			'@attributes' => [
			'xmlns' => 'http://www.w3.org/2000/09/xmldsig#',
			'xmlns:xsi' => $xmlns_xsi ? 'http://www.w3.org/2001/XMLSchema-instance' : false,
			],
			'CanonicalizationMethod' => [
			'@attributes' => [
			'Algorithm' => 'http://www.w3.org/TR/2001/REC-xml-c14n-20010315',
			],
			],
			'SignatureMethod' => [
			'@attributes' => [
			'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#rsa-sha1',
			],
			],
			'Reference' => [
			'@attributes' => [
			'URI' => $reference,
			],
			'Transforms' => [
			'Transform' => [
			'@attributes' => [
			'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#enveloped-signature',
			],
			],
			],
			'DigestMethod' => [
			'@attributes' => [
			'Algorithm' => 'http://www.w3.org/2000/09/xmldsig#sha1',
			],
			],
			'DigestValue' => null,
			],
			],
			'SignatureValue' => null,
			'KeyInfo' => [
			'KeyValue' => [
			'RSAKeyValue' => [
			'Modulus' => null,
			'Exponent' => null,
			],
			],
			'X509Data' => [
			'X509Certificate' => null,
			],
			],
			],
			
			])->documentElement, true);
			// calcular DigestValue
		if ($tag) {
			$item = $doc->documentElement->getElementsByTagName($tag)->item(0);
			if (!$item) {
				return 'No fue posible obtener el nodo con el tag '.$tag;
			}
			$digest = base64_encode(sha1($item->C14N(), true));
		} else {
			$digest = base64_encode(sha1($doc->C14N(), true));
		}
		$Signature->getElementsByTagName('DigestValue')->item(0)->nodeValue = $digest;
			// calcular SignatureValue
		$SignedInfo = $doc->saveHTML($Signature->getElementsByTagName('SignedInfo')->item(0));
		$firma = $this->sign($SignedInfo);
		if (!$firma)
			return false;
		$signature = wordwrap($firma, $this->limite, "\n", true);
			// reemplazar valores en la firma de
		$Signature->getElementsByTagName('SignatureValue')->item(0)->nodeValue = $signature;
		$Signature->getElementsByTagName('Modulus')->item(0)->nodeValue = $this->getModulus();
		$Signature->getElementsByTagName('Exponent')->item(0)->nodeValue = $this->getExponent();
		$Signature->getElementsByTagName('X509Certificate')->item(0)->nodeValue = $this->getCertificate(true);
			// agregar y entregar firma
		$doc->documentElement->appendChild($Signature);

		return $doc->saveXML();
	}

	/**
	* Método que obtiene el módulo de la clave privada
	* @return String Módulo en base64
	**/
	public function getModulus()
	{
		$details = openssl_pkey_get_details(openssl_pkey_get_private($this->pkey));
		return wordwrap(base64_encode($details['rsa']['n']), $this->limite, "\n", true);
	}

	/**
	* Método que obtiene el exponente publico de la clave privada
	* @return String Módulo en base64
	**/
	public function getExponent()
	{
		$details = openssl_pkey_get_details(openssl_pkey_get_private($this->pkey));
		return wordwrap(base64_encode($details['rsa']['e']), $this->limite, "\n", true);
	}

	/**
	* Funcion que entrega el certificado de la firma electronica
	* @return Contenido del certificado, clave pública del certificado digital, en base64
	**/
	public function getCertificate($clean = false)
	{
		if ($clean) {
			return trim(str_replace(
				['-----BEGIN CERTIFICATE-----', '-----END CERTIFICATE-----'],
				'',
				$this->cert
				));
		} else {
			return wordwrap($this->cert,$this->limite,"\n",true);
		}
	}

	/**
     * Método que verifica la validez de la firma de un XML utilizando RSA y SHA1
     * @param xml_data Archivo XML que se desea validar
     * @return =true si la firma del documento XML es válida o =false si no lo es
     **/
	public function verifyXML($xml_data, $tag = null)
	{
		$doc = new XML();
		$doc->loadXML($xml_data);
        // preparar datos que se verificarán
		$SignaturesElements = $doc->documentElement->getElementsByTagName('Signature');
		$Signature = $doc->documentElement->removeChild($SignaturesElements->item($SignaturesElements->length-1));
		$SignedInfo = $Signature->getElementsByTagName('SignedInfo')->item(0);
		$SignedInfo->setAttribute('xmlns', $Signature->getAttribute('xmlns'));
		$signed_info = $doc->saveHTML($SignedInfo);
		$signature = $Signature->getElementsByTagName('SignatureValue')->item(0)->nodeValue;
		$pub_key = $Signature->getElementsByTagName('X509Certificate')->item(0)->nodeValue;

        // verificar firma
		if (!$this->verify($signed_info, $signature, $pub_key))
			return false;
        // verificar digest
		$digest_original = $Signature->getElementsByTagName('DigestValue')->item(0)->nodeValue;
		if ($tag) {
			$digest_calculado = base64_encode(sha1($doc->documentElement->getElementsByTagName($tag)->item(0)->C14N(), true));
		} else {
			$digest_calculado = base64_encode(sha1($doc->C14N(), true));
		}
		return $digest_original == $digest_calculado;
	}

	/**
     * Método que verifica la firma digital de datos
     * @param data Datos que se desean verificar
     * @param signature Firma digital de los datos en base64
     * @param pub_key Certificado digital, clave pública, de la firma
     * @param signature_alg Algoritmo que se usó para firmar (por defect SHA1)
     * @return =true si la firma está ok, =false si está mal o no se pudo determinar
     **/
	public function verify($data, $signature, $pub_key = null, $signature_alg = OPENSSL_ALGO_SHA1)
	{
		if ($pub_key === null)
			$pub_key = $this->cert;
		$pub_key = $this->normalizeCert($pub_key);
		return openssl_verify($data, base64_decode($signature), $pub_key, $signature_alg) == 1 ? true : false;
	}

	/**
     * Método que agrega el inicio y fin de un certificado (clave pública)
     * @param cert Certificado que se desea normalizar
     * @return Certificado con el inicio y fin correspondiente
     **/
	private function normalizeCert($cert)
	{
		if (strpos($cert, '-----BEGIN CERTIFICATE-----')===false) {
			$body = trim($cert);
			$cert = '-----BEGIN CERTIFICATE-----'."\n";
			$cert .= wordwrap($body, $this->limite, "\n", true)."\n";
			$cert .= '-----END CERTIFICATE-----'."\n";
		}
		return $cert;
	}
}
?>
