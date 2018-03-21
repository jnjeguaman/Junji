<?php 
require_once($_SERVER["DOCUMENT_ROOT"].'/SII_JUNJI/library/PHPMailer-master/PHPMailerAutoload.php');
require_once("class.db_connect.php");
/**
* Clase que informará al administrador de sistemas el estado critico de los folios consumidos.
* @author Freddy Varas Henriquez (fvaras@pradi.cl)
*/
class Umbral
{
	private $_tipoDCTO;
	private $_region;
	function __construct($tipoDCTO,$region)
	{
		$this->_tipoDCTO = $tipoDCTO;
		$this->_region = $region;
		self::comprobacion();
	}

	/**
	* Método que realiza la comprobacion del estado de los folios consumidos por region
	* @return Integer
	**/
	public function comprobacion()
	{
		try {
			$objDbConnect = new db_connect();
			$arrayName = array();
			$max = 0;
			$query = "SELECT * FROM sii_folio WHERE folio_tipo = ? AND folio_region = ? AND folio_estado = 1";
			$stmt = $objDbConnect->getConnection()->prepare($query);
			if($stmt)
			{
				$stmt->bind_param("ii",$this->_tipoDCTO,$this->_region);
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
					$umbral1 = $arrayName[1]["folio_umbral"]; // Definido por el usuario
					$umbral2 = $arrayName[1]["folio_umbral_2"]; // Definido por el usuario
					$umbral3 = $arrayName[1]["folio_umbral_3"]; // Definido por el usuario
					
					$folios = $arrayName[1]["folio_fin"] - $arrayName[1]["folio_actual"];

					if($folios == $umbral1)
					{
						self::enviarAviso($folios,1);
					}else if($folios == $umbral2)
					{
						self::enviarAviso($folios,2);
					}else if($folios == $umbral3)
					{
						self::enviarAviso($folios,3);
					}else if($folios == 0)
					{
						self::enviarAviso(0,4);
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
	* Método que envia correo electronico de aviso al administrador
	* para solicitar folios en el Servicio de Impuestos Internos S.I.I.
	* @param Integer $region Region a solicitar folios
	* @return Boolean Respuesta de correo generado y enviado
	**/
	private function enviarAviso($folio,$umbral)
	{
		$tiposDCTOS = [
		33 => "FACTURA ELECTRÓNICA",
		34 => "FACTURA NO AFECTA O EXENTA ELECTRÓNICA",
		52 => "GUIA DE DESPACHO ELECTRÓNICA",
		56 => "NOTA DE DÉBITO ELECTRÓNICA",
		61 => "NOTA DE CRÉDITO ELECTRÓNICA"
		];

		$regiones = [
		1 => "I REGÍON",
		2 => "II REGÍON",
		3 => "III REGÍON",
		4 => "IV REGÍON",
		5 => "V REGÍON",
		6 => "VI REGÍON",
		7 => "VII REGÍON",
		8 => "VIII REGÍON",
		9 => "IX REGÍON",
		10 => "X REGION",
		11 => "XI REGÍON",
		12 => "XII REGÍON",
		13 => "REGÍON METROPOLITANA",
		14 => "DIRECCIÓN NACIONAL",
		15 => "XV REGION",
		16 => "XVI REGION"
		];

		$mensaje = "Estimad@ Administrador del sistema de facturacion electrónica SIGEJUN : <br><br>";

		$mensaje.="Se informa que <strong>".$regiones[$this->_region]."</strong> ha entrado en el umbral de avisos N° <strong>(".$umbral.")</strong> de solicitud de folios.<br>";
		$mensaje.="Actualmente quedan disponibles un total de <strong>".$folio."</strong> folios sin consumir del documento <strong>".$tiposDCTOS[$this->_tipoDCTO]."</strong><br>";
		$mensaje.="por lo que se recomienda volver a realizar dicha solicitud en el portal del Servicio de Impuestos Internos.<br>";
		$mensaje.="Atentamente, SIGEJUN - FACTURACIÓN ELECTRÓNICA";



					$mail = new PHPMailer;
					//$mail->SMTPDebug = 3;                               // Enable verbose debug output
					$mail->isSMTP();                                      // Set mailer to use SMTP
					$mail->Host = '192.168.100.34';  // Specify main and backup SMTP servers
					//$mail->SMTPAuth = true;                               // Enable SMTP authentication
					$mail->Username = 'inedis_junji@junji.cl';                 // SMTP username
					$mail->Password = '';                           // SMTP password
					// $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 25;                                    // TCP port to connect to

					$mail->setFrom('inedis_junji@junji.cl', 'SIGEJUN');
					// CORREO DE INTERCAMBIO
					// $mail->addAddress("fvaras@pradi.cl",utf8_decode("Freddy Varas Henríquez"));     // Add a recipient
					// $mail->addAddress("jvillagra@junji.cl","Juan Jose Villagra");     // Add a recipient
					$mail->addAddress("dhope@junji.cl","Denis Hope");     // Add a recipient
					
					// CORREO CONTACTO

					$mail->isHTML(true);                                  // Set email format to HTML

					$mail->Subject = mb_convert_encoding("Factura Electrónica Aviso N° ".$umbral,"ISO-8859-1");
					$mail->Body    = mb_convert_encoding($mensaje,"ISO-8859-1");
					$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

					$mail->send();
					// if(!$mail->send()){
					// 	echo json_encode(array("Respuesta" => false,"Mensaje" => "Lo sentimos ocurrio un error al enviar el correo, ERROR : ".$mail->ErrorInfo));
					// } else {
					// 	echo json_encode(array("Respuesta" => true,"Mensaje" => "Correo enviado correctamente"));
					// }
				}
			}
			?>