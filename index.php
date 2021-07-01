<?php
date_default_timezone_set('America/Santiago');
@session_start();
$_SESSION['lenguaje'] = "es";
/*
********************************************************
GYSMO
------------------------
Version  : 1.0 
Date     : 2013-06-09
Author   : Victor Espinoza 
********************************************************
You can redistribute and modify it even for commercial usage.
*/
header('Content-Type: text/html; charset=UTF-8');
include_once('librerias/tbs/tbs_class.php');
@include('inc/index.inc.php');

//TINY BUT STRONG
$TBS = new clsTinyButStrong;

$TBS->LoadTemplate('tpl/index.tpl');

$TBS->Show();
?>