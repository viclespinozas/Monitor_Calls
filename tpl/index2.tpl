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
	$( "#tabs" ).tabs();
});

function getSize(){
	if (window.innerWidth && window.innerHeight) {
	 winW = window.innerWidth;
	 winH = window.innerHeight;
	}
	document.getElementById('back-menu').style.height = winH+"px";
}
function reloadContent(camp){
	 setTimeout(function() {
        xajax_reloadContent(camp);
      }, 300000 );
}
function reloadCP(){
	 setTimeout(function() {
        xajax_reloadContent('CALLS');
      }, 2 );
}
function ordenaLayoutOLS()
{
	var wall = new Freewall("#campLlamadas");

	wall.reset({
		selector: '.brick',
		animate: false,
		cellW: 120,
		cellH: 120,
		onResize: function() {
			wall.refresh();
		}
	});

	wall.fitWidth();
}
</SCRIPT>
<style>
#cuerpo { width:100%; height:570px; overflow:auto; font-size: 10px; }
#tabs-11 { height:500px; padding: 0px;}
#tabs { height:562px; padding: 0px;}
.ui-font-calls { font-size: 12px;}
.free-wall { }
#campLlamadas1, #campLlamadas2, #campLlamadas3  { 
	padding: 5px 0 0 0;
  	/*border: 1px solid #e2e2e2;*/
  	-webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
  	margin-bottom: 20px;
}
.item {
  color: #000;
  padding: 5px;
  background-image:url(../imagenes/menu_inactivo.png);
  border-radius: 3px;
  font-size: 14px;
}
.img-call{
	height: 16px;
}
</style>
</HEAD>
<BODY onload="getSize();" style="font-size:	10px;">
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
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #005A5A; ">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #057373; ">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5;">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5;">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5;">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5;">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="7%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #009FE5;">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold;">
									&nbsp;
									</span>
								</td>
								<td rowspan="2">&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%" rowspan="2">
									<!-- <img src="../imagenes/reload.png" height="45" onclick="xajax_reloadContent('PV');" style="cursor:pointer;"> -->
									<!-- <a href="../php/elige_opciones.php"><img src="../imagenes/ventas_pro.png" height="45"style="cursor:pointer;"></a> -->
									&nbsp;
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
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #005A5A; " id="netasActualBCH">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #057373; " id="netasActualCCH">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5;" id="proyeccionActual">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5;" id="brutasActual">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5;" id="netasActual">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5;" id="ejecutivosActual">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #009FE5;" id="ventasActual">
									&nbsp;
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold;" id="contactaActual">
									&nbsp;
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
					<div id="tabs">
					  <ul>
					    <li><a href="#tabs-11" onclick="xajax_reloadContent('CALLS');" >Llamadas</a></li>
					  </ul>
					  
					  <div id="tabs-11">
					  	<table width="80%" height="100%">
					  		<tr>
					  			<td height="5%" align="center">Sala 1</td>
					  		</tr>
					  		<tr>
					  			<td >
								  	<div id="campLlamadas1">
								  		
									</div>
					  			</td>
					  		</tr>
					  	</table>
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
<script type="text/javascript" src="../js/makeboxes.js"></script>
<script type="text/javascript" src="../js/jquery.fittext.js"></script>
<script type="text/javascript" src="../js/jquery.grid-a-licious.js"></script>
<SCRIPT type="text/javascript">
function ordenaLayout()
{
	$("#campLlamadas1").gridalicious({
        width: 110,
        gutter: 10
    });

	$("#campLlamadas2").gridalicious({
        width: 110,
        gutter: 10
    });

	$("#campLlamadas3").gridalicious({
        width: 110,
        gutter: 10
    });

}
</SCRIPT>
</HTML>