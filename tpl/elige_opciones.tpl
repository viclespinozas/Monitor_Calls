<HTML>
<HEAD>
<TITLE>GYSMO</TITLE>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" href="../librerias/jquery/css/cupertino/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" href="../css/jquery.ui.timepicker.css" />
<script src="../librerias/jquery/js/jquery-1.9.1.js"></script>
<script src="../librerias/jquery/js/jquery-ui-1.10.3.custom.js"></script>
<script src="../librerias/jquery/js/jquery-ui-1.10.3.custom.min.js"></script>
<SCRIPT type="text/javascript" src="../js/jquery.layout-latest.js"></SCRIPT>
<SCRIPT type="text/javascript" src="../js/principal.js"></SCRIPT>
<script type="text/javascript" src="../js/amcharts.js" ></script> 
<script type="text/javascript" src="../js/jquery.ui.timepicker.js" ></script> 
<SCRIPT type="text/javascript">
$(function() {
	$( "#tabs2" ).tabs({
		  active: 0
		});
});
function getSize(){
	if (window.innerWidth && window.innerHeight) {
	 winW = window.innerWidth;
	 winH = window.innerHeight;
	}
	document.getElementById('back-menu').style.height = winH+"px";
}
</SCRIPT>
<style>
#cuerpo { width:100%; height:565px; overflow:auto; font-size: 14px; }
#campDetails { width:100%; height:255px; overflow:auto; }
.ui-datepicker-calendar {
    display: none;
}​
</style>
</HEAD>
<BODY onload="getSize();" style="font-size:	12px;">
<form id="form" name="form">

<div class="ui-layout-center">
	<div id="mainContent">
		<table width="100%" border="0" cellpadding="5">
		<thead>
			<tr>
				<th>
					<div style="width:100%; height:65px; background-image:url(../imagenes/menu_inactivo.png);" class="ui-corner-all ui-menu-shadow" align="center">
						<table border="0" width="100%" height="100%" cellspacing="1" cellpadding="0">
							<tr>
								<td align="center">
									&nbsp;
								</td>
								<td rowspan="2">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold;" id="fechaActual">
									21-05-2015 16:24:51
									</span>
								</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #005A5A; display:[onshow.muestra_1];">
									BCH
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #057373; display:[onshow.muestra_1];">
									CCH
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];">
									PROYECCION
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];">
									BRUTAS
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];">
									NETAS
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];">
									EJECUTIVOS
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="7%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];">
									VENTAS AL DIA
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; display:[onshow.muestra_1];">
									CONTACTABILIDAD
									</span>
								</td>
								<td rowspan="2">&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%" rowspan="2">
									<a href="../php/principal.php"><img src="../imagenes/reports.png" height="45"style="cursor:pointer;"></a>
								</td>
								<td align="center" width="5%" rowspan="2">
									<a href="../php/logout.php"><img src="../imagenes/off.png"></a>
								</td>
							</tr>
							<tr>
								<td align="center">
									&nbsp;
								</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #005A5A; display:[onshow.muestra_1];" id="netasActualBCH">
									0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #057373; display:[onshow.muestra_1];" id="netasActualCCH">
									0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];" id="proyeccionActual">
									0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];" id="brutasActual">
									0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];" id="netasActual">
									0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];" id="ejecutivosActual">
									0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5; display:[onshow.muestra_1];" id="ventasActual">
									0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; display:[onshow.muestra_1];" id="contactaActual">
									00.0%
									</span>
								</td>
								
							</tr>
						</table>
					</div>
					<input type="hidden" id="last_content" name="last_content" value="">
					<input type="hidden" id="last_result" name="last_result" value="">
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="vertical-align:top;">
					<div id="cuerpo">
						<div id="tabs2">
						  <ul>
						    <li><a href="#tabs-1">Fidelizci&oacute;n</a></li>
						    <li><a href="#tabs-2">Recuperaci&oacute;n</a></li>
						  	<li><a href="#tabs-3">Retenci&oacute;n</a></li>
						    <li><a href="#tabs-4">Retenci&oacute;n PYME</a></li>
						    <li><a href="#tabs-5">Multicanal</a></li>
						  </ul>
						  <div id="tabs-1">
						  	<br>
						  	<table>
						  		<tr>
						  			<td>Fecha:</td>
						  			<td><input type="text" id="anioResul" name="anioResul" ></td>
						  			<td>&nbsp;</td>
						  			<td><img src="../imagenes/reload.png" height="25" onclick="xajax_cargaCampanas(document.getElementById('anioResul').value,'0');" style="cursor:pointer;"></td>
						  		</tr>
						  	</table>
						  	<br>
						   	<div id="listaCampanas"></div>

						   	<div id="listaArchivosCampanas"></div>
						  </div>
						  <div id="tabs-2">
						  	<br>
						  	<table>
						  		<tr>
						  			<td>Fecha:</td>
						  			<td><input type="text" id="anioResul2" name="anioResul2" ></td>
						  			<td>&nbsp;</td>
						  			<td><img src="../imagenes/reload.png" height="25" onclick="xajax_cargaCampanas(document.getElementById('anioResul2').value,'1');" style="cursor:pointer;"></td>
						  		</tr>
						  	</table>
						  	<br>
						   	<div id="listaCampanas2"></div>

						   	<div id="listaArchivosCampanas2"></div>
						  </div>
						  <div id="tabs-3">
						  	<br>
						  	<table>
						  		<tr>
						  			<td>Fecha:</td>
						  			<td><input type="text" id="anioResul3" name="anioResul3" ></td>
						  			<td>&nbsp;</td>
						  			<td><img src="../imagenes/reload.png" height="25" onclick="xajax_cargaCampanas(document.getElementById('anioResul3').value,'2');" style="cursor:pointer;"></td>
						  		</tr>
						  	</table>
						  	<br>
						   	<div id="listaCampanas3"></div>

						   	<div id="listaArchivosCampanas3"></div>
						  </div>
						  <div id="tabs-4">
						  </div>
						  <div id="tabs-5">
						  </div>
					</div>
					</div>
				</td>
			</tr>
		</tbody>
		</table>
	</div>
</div>
</form>
</BODY>
</HTML>