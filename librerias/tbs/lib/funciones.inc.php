<?php
@session_start();

// LIBRERIA AJAX 0.5
@require_once("xajax/xajax_core/xajaxAIO.inc.php");

function armarMenu(){
	$ob = new xajaxResponse();
	
	$ob->alert("XAJAX OK");
	
	return $ob;
}
$xajax = new xajax("funciones.inc.php");
$xajax->setCharEncoding('ISO-8859-1');
$xajax->registerFunction("armarMenu");
$xajax->processRequest();
?>
