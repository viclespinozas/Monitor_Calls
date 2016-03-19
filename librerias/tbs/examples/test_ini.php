<?php

include_once('tbs_class.php');
@require_once("../lib/xajax/xajax_core/xajaxAIO.inc.php");

// AJAX
$xajax = new xajax("../lib/funciones.inc.php");
$xajax->setCharEncoding('ISO-8859-1');
$xajax->registerFunction("armarMenu");
$xajax->printJavascript('../lib/xajax/');

$TBS = new clsTinyButStrong;
$TBS->LoadTemplate('test.tpl');
$TBS->Show();
?>