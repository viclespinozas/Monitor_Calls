<?php
@session_start();

// LIBRERIA AJAX 0.5
@require_once("librerias/xajax/xajax_core/xajaxAIO.inc.php");
@include("clases/conexionBD.class.php");

function validaUsuario($form,$p){
	$ob = new xajaxResponse();
	$usuario = $form['usuario'];
	$password = $form['password'];
	$intento = $form['intentos'];;
	
	$intentos = $intento + 1;
	$ob->script("document.getElementById('intentos').value = $intentos;");
	$sql = "SELECT
			idusuario,	
			login,
			nombre_fantasia as Nombre
			FROM usuarios
			WHERE login = '$usuario' 
			AND password = md5('$password')
			;";
	$q = consultar($sql);
	// $ob->alert($q);
	if($q != "NO")
	{
		$datos = explode("||", $q);
		$id_trabajador = $datos[0];
		$username = $datos[1];
		$tipo = 1;
		$nombre = $datos[2];
		$correo = $datos[0];
		$perfil = 1;
		$estado = 1;
		$extension = 1;
		
		switch($estado)
		{
			case 1:
				$_SESSION['idtrabajador'] = $id_trabajador;
				$_SESSION['auth_user'] = $username;
				$_SESSION['tipo'] = $tipo;
				$_SESSION['nombre'] = $nombre;
				$_SESSION['correo'] = $correo;
				$_SESSION['perfil'] = $perfil;
				$_SESSION['extension'] = $extension;
				$_SESSION['profile'] = $p;
				
				$msj = "Inicio de Sesion Satisfactorio";
				guardaAuditoria('Login','NOTICE',$msj);
				$ob->script("document.location='php/cargar_usuario.php';");
			break;
			case 2:
				$msj = "Usuario bloqueado";
				guardaAuditoria('Login','WARNING',$msj);
				$script = '$( ".validateTips" )
					.text( \'Su usuario se encuentra bloqueado, contacte al administrador\' )
					.addClass( "ui-state-highlight" );
				  setTimeout(function() {
					$( ".validateTips" ).removeClass( "ui-state-highlight", 1500 );
				  }, 500 );';
				$ob->script($script);
			break;
		}
		
		
	}
	else
	{
		
		if($intento >= 3)
		{
			$msj = "Maximo de intentos para usuario '$usuario' y password '$password' ";
			guardaAuditoria('Login','ERROR',$msj);
			$script = "xajax_guardaRegistroIntentosMaximos('$usuario');";
			$ob->script($script);
			$script = '$( ".validateTips" )
						.text( \'Maximo de Intentos alcanzado, su usuario será bloqueado\' )
						.addClass( "ui-state-highlight" );
					  setTimeout(function() {
						$( ".validateTips" ).removeClass( "ui-state-highlight", 1500 );
					  }, 500 );';
			$ob->script($script);
		}
		else
		{
			$msj = "Inicio de Sesion Fallido con user '$usuario' y password '$password' ";
			guardaAuditoria('Login','ERROR',$msj);
			$script = '$( ".validateTips" )
						.text( \'Usuario y/o Contraseña incorrectos\' )
						.addClass( "ui-state-highlight" );
					  setTimeout(function() {
						$( ".validateTips" ).removeClass( "ui-state-highlight", 1500 );
					  }, 500 );';
			$ob->script($script);
		}
	}

	return $ob;  
}
function guardaRegistroIntentosMaximos($usuario){
	$ob = new xajaxResponse;
	
	$sql = "UPDATE usuario SET usu_estado = 2 WHERE usu_username = '$usuario';";
	$res = insertar($sql);
	
	return $ob;
}
function guardaAuditoria($modulo,$query,$acciones){

	$sql = "INSERT INTO auditoria VALUES (Null,'$modulo',NOW(),'$query','$acciones','$_SESSION[idtrabajador]');";
	$res = insertar($sql);
	
}

$xajax = new xajax();
$xajax->setCharEncoding('UTF-8');
$xajax->registerFunction("validaUsuario");
$xajax->registerFunction("guardaRegistroIntentosMaximos");
$xajax->processRequest();

$xajax->printJavascript('librerias/xajax/');
?>