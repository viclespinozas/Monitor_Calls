<?php
@session_start();
/*
********************************************************
Gysmo 
------------------------
Version  : 1.0 
Date     : 2013-05-19
Author   : Victor Espinoza 
********************************************************
You can redistribute and modify it even for commercial usage.
*/
header('Content-Type: text/html; charset=UTF-8');
include_once('../librerias/tbs/tbs_class.php');
@include('../inc/elige_opciones.inc.php');

$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('../tpl/elige_opciones.tpl');	
$nombre_usuario = $_SESSION['nombre'];
$id_usuario = $_SESSION['idtrabajador'];
switch(intval($id_usuario))
{
	case 700:
		$muestra_1 = 'none';
		$muestra_2 = 'block';
	break;
	default:
		$muestra_1 = 'none';
		$muestra_2 = 'none';
	break;
}
$TBS->Show();
?>