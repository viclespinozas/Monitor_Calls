<?php
	session_start();
?>
<?
	$mensaje = "MENSAJE DE PRUEBA DESDE GYSMO";
	$destinatarios = "vespinoza@contactop2p.com";
	include_once('mail/class.phpmailer.php');

	$mail             = new PHPMailer(); // defaults to using php "mail()
	//$body             = eregi_replace("[\]",'',$mensaje);
	$body             = utf8_decode($mensaje);
	$mail->From       = "no-responder@contactop2p.com";
	$mail->FromName   = "Tweetmo";
	$mail->Subject    = "Nuevo Tweet";
	$mail->AltBody    = "Para ver este mensaje, por favor active compatibilidad de vista HTML!"; // optional, comment out and test
	$mail->MsgHTML($body);
	$mail->AddAddress($accion_descripcion);
	$mail->AddBCC("vespinoza@contactop2p.com");
	$mail->Send();
	//$mail->AddBCC($soporte2,"");
	
	
	// ENVIAMOS EL CORREO ///////////////////////////////////////////////////////
	
	
		if(!$mail->Send()) {
			echo '<br><br><br><br><br><br><center><a href="javascript:history.go(-1);" style="text-decoration:none">EL MENSAJE NO HA SIDO ENVIADO, CLICK AQUI PARA CONTINUAR...</a></center>';
		}else{
			echo '<br><br><br><br><br><br><center><a href="#" style="text-decoration:none">EL MENSAJE HA SIDO ENVIADO, CLICK AQUI PARA CONTINUAR...</a></center>';		
		}
	
	/////////////////////////////////////////////////////////////////////////////
	
	//return $objResponse;
?>