<?php
// date_default_timezone_set('America/Santiago');
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
include_once('../librerias/tbs/tbs_class.php');
@include('../inc/principal.inc.php');
// date_default_timezone_set('America/Caracas');
$TBS = new clsTinyButStrong;
// $TBS->LoadTemplate('../tpl/principal.tpl');
$TBS->LoadTemplate('../tpl/index3.tpl');
$usuario = $_SESSION['nombre'];
switch($_SESSION['perfil'])
{
	case 1:
		$div_status = "block";
		$div_status_u = "none";
		$rep1_status = "block";
		$rep2_status = "block";
		$rep3_status = "block";
		$rep4_status = "none";
		$rep5_status = "none";
		$rep6_status = "none";
		$rep7_status = "none";
	break;
	case 2:
		$div_status = "none";
		$div_status_u = "block";
		$rep1_status = "none";
		$rep2_status = "block";
		$rep3_status = "block";
		$rep4_status = "none";
		$rep5_status = "none";
		$rep6_status = "none";
		$rep7_status = "none";
	break;
}
$TBS->Show();
?>