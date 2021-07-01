<!doctype html>
 
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Inicio de Sesi&oacute;n</title>
  <link rel="stylesheet" href="librerias/jquery/css/cupertino/jquery-ui-1.10.3.custom.css" />
  <script src="librerias/jquery/js/jquery-1.9.1.js"></script>
  <script src="librerias/jquery/js/jquery-ui-1.10.3.custom.js"></script>
  <script src="librerias/jquery/js/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="js/inicio_sesion.js"></script>
  <style>
    body { font-size: 14px; font-family:Arial; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; font-weight:bold; }
	.ui-inner-shadow {
		-webkit-box-shadow: 0 8px 6px -1px black;
		   -moz-box-shadow: 0 8px 6px -1px black;
				box-shadow: 0 8px 6px -1px black;
	}
  </style>
</head>
<body onload="getSize();">
<div id="main" class="ui-corner-all ui-inner-shadow" style="position:absolute; padding:10px; display:none; width:350px;">
	<div id="dialog-form" title="Iniciar Sesi&oacute;n">
	  <p class="validateTips">Introduzca nombre de usuario y contrase&ntilde;a</p>
	 
	  <form id="form" name="form">
	  <fieldset>
		<label for="usuario">Usuario:</label>
		<input type="text" name="usuario" id="usuario" class="text ui-widget-content ui-corner-all" />
		<label for="password">Contrase&ntilde;a</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
		<input type="hidden" name="intentos" id="intentos" value="0"/>
	  </fieldset>
	  <button id="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"><span class="ui-button-text">Monitor</span></button>
	  </form>
	</div>
</div>
<div id="lock_center"  class="ui-corner-all ui-inner-shadow" style="position:absolute; padding-bottom:25px; cursor:pointer;">
<img src="imagenes/lock.png" />
</div>
</body>
</html>