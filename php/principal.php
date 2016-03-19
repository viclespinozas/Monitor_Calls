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
$TBS->LoadTemplate('../tpl/index2.tpl');
$usuario = $_SESSION['nombre'];
switch(intval($_SESSION['idtrabajador']))
{
	// 636 - Jose || 733 734 - Jeimy
	case 733:
	case 734:
	case 777:
		$netasActualBCH = "none";
		$netasActualCCH = "none";
		$tabs1 = "none";
		$tabs2 = "none";
		$actualRecupero = "none";
		$actualRetencion = "none";
		$actualMulticanal = "none";
		$actualCertificacion = "none";
		$actualFide = "block";
	break;
	case 753:
		$netasActualBCH = "none";
		$netasActualCCH = "none";
		$tabs1 = "none";
		$tabs2 = "none";
		$actualRecupero = "block";
		$actualRetencion = "block";
		$actualMulticanal = "block";
		$actualCertificacion = "none";
		$actualFide = "none";
	break;
	case 636:
	case 623:
		$netasActualBCH = "none";
		$netasActualCCH = "none";
		$tabs1 = "none";
		$tabs2 = "none";
		$actualRecupero = "block";
		$actualRetencion = "block";
		$actualMulticanal = "block";
		$actualCertificacion = "block";
		$actualFide = "block";
	break;
	case 700:
	case 663:
	case 664:
		$netasActualBCH = "block";
		$netasActualCCH = "block";
		$tabs1 = "block";
		$tabs2 = "block";
		$actualRecupero = "block";
		$actualRetencion = "block";
		$actualMulticanal = "block";
		$actualCertificacion = "block";
		$actualFide = "block";
	break;
}
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