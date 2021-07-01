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

$TBS = new clsTinyButStrong;
if(intval($_SESSION['profile']) == 1)
{
	$TBS->LoadTemplate('../tpl/barraProgreso.tpl');
}
else
{
	$TBS->LoadTemplate('../tpl/barraProgreso2.tpl');	
}
$nombre_usuario = $_SESSION['nombre'];
$id_usuario = $_SESSION['idtrabajador'];
$TBS->Show();
?>