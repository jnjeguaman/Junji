<?php
require_once("mail/class.phpmailer.php");


//SERVIDOR DE CORREO SMTP
		$mail = new PHPMailer;
		
		$body             = file_get_contents('mail/examples/contents.html');
		$body             = eregi_replace("[\]",'',$body);

		$mail->isSMTP();
		$mail->Host = '192.168.100.34';
		// $mail->SMTPAuth = true;
		$mail->Username = 'inedis_junji@junji.cl';                 // SMTP username
		$mail->Password = '';                           // SMTP password
		// $mail->SMTPSecure = 'tls';
		$mail->Port = 25;

		$mail->SMTPDebug  = 1;

		$mail->setFrom('inedis_junji@junji.cl', 'INEDIS');
		$mail->addAddress("fvaras@pradi.cl", "Carlos Herrera");
		// $mail->AddCC("fvaras@pradi.cl","Freddy Varas");

		$mail->isHTML(true);

		$mail->Subject = 'Prueba N° 2';
		$mail->Body    = "Hola Mundo";
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
			echo "Mensaje Enviado...";
		}

		if(mail("fvaras@pradi.cl", "Prueba N° 2", "Testint"))
		{
			echo "Correo Enviado...";
		}else{
			echo "No se ha podido enviar...";
		}

?>