<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Inicio de Sesi&oacute;n</title>
<link rel="stylesheet" href="../librerias/jquery/css/cupertino/jquery-ui-1.10.3.custom.css" />
  <script src="../librerias/jquery/js/jquery-1.9.1.js"></script>
  <script src="../librerias/jquery/js/jquery-ui-1.10.3.custom.js"></script>
  <script src="../librerias/jquery/js/jquery-ui-1.10.3.custom.min.js"></script>
<script>
var inc = 0;

function incrementaBarra(){
	$( "#cargando" ).hide();
	$( "#progressbar" ).progressbar({
		value: inc
	});
	
	inc += (inc>100)?70:2;
	
}

 var tInc = setInterval('incrementaBarra()',100);
 
 setTimeout(function(){window.location='../php/principal.php'},1000);
</script>
<style>
.ui-progressbar-value { background-image: url(../librerias/jquery/css/cupertino/images/ui-bg_diagonals-thick_90_eeeeee_40x40.png); }
</style>
</head>
<body>
<div id="cargando" style="position:fixed; top:1px; left:2px;">Cargando... Por Favor Espere</div>
<center>
<div style="position:absolute; top:200px; left:200px; width:75%; height: 20px;" class="ui-text">
Conectando con: <span id="name" class="ui-text-bold">[onshow.nombre_usuario]</span>
<div style="width: 50%;" id="progressbar"></div>
</div>
</center>
</body>
</html>	