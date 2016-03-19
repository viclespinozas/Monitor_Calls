<HTML>
<HEAD>
<TITLE>GYSMO</TITLE>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" href="../librerias/jquery/css/cupertino/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" href="../css/jquery.ui.timepicker.css" />
<script src="../librerias/jquery/js/jquery-1.9.1.js"></script>
<script src="../librerias/jquery/js/jquery-ui-1.10.3.custom.js"></script>
<script src="../librerias/jquery/js/jquery-ui-1.10.3.custom.min.js"></script>
<!--<SCRIPT type="text/javascript" src="../js/jquery.js"></SCRIPT>
<SCRIPT type="text/javascript" src="../js/jquery.layout.js"></SCRIPT>-->
<SCRIPT type="text/javascript" src="../js/jquery.layout-latest.js"></SCRIPT>
<SCRIPT type="text/javascript" src="../js/principal.js"></SCRIPT>
<script type="text/javascript" src="../js/amcharts.js" ></script> 
<script type="text/javascript" src="../js/jquery.ui.timepicker.js" ></script> 
<SCRIPT type="text/javascript">
	var outerLayout, innerLayout;

	$(document).ready( function() {
		outerLayout = $("body").layout( layoutSettings_Outer );

		var eastSelector = "body > .ui-layout-east"; // outer-east pane

		//$("<span></span>").addClass("pin-button").prependTo( eastSelector );
		//outerLayout.addPinBtn( eastSelector +" .pin-button", "east" );
		outerLayout.addPinBtn( "#tPinMenu", "east" );

		$("<span></span>").attr("id", "east-closer").prependTo( eastSelector );
		//outerLayout.addCloseBtn("#east-closer", "east");
	});

	var layoutSettings_Outer = {
		name: "outerLayout" // NO FUNCTIONAL USE, but could be used by custom code to 'identify' a layout
		// options.defaults apply to ALL PANES - but overridden by pane-specific settings
	,	defaults: {
			size:					"auto"
		,	minSize:				50
		,	paneClass:				"pane" 		// default = 'ui-layout-pane'
		,	resizerClass:			"resizer"	// default = 'ui-layout-resizer'
		,	togglerClass:			"toggler"	// default = 'ui-layout-toggler'
		,	buttonClass:			"button"	// default = 'ui-layout-button'
		,	contentSelector:		".content"	// inner div to auto-size so only it scrolls, not the entire pane!
		,	contentIgnoreSelector:	"span"		// 'paneSelector' for content to 'ignore' when measuring room for content
		,	togglerLength_open:		35			// WIDTH of toggler on north/south edges - HEIGHT on east/west edges
		,	togglerLength_closed:	35			// "100%" OR -1 = full height
		,	hideTogglerOnSlide:		true		// hide the toggler when pane is 'slid open'
		,	togglerTip_open:		"Close This Pane"
		,	togglerTip_closed:		"Open This Pane"
		,	resizerTip:				"Resize This Pane"
		//	effect defaults - overridden on some panes
		,	fxName:					"slide"		// none, slide, drop, scale
		,	fxSpeed_open:			750
		,	fxSpeed_close:			1500
		,	fxSettings_open:		{ easing: "easeInQuint" }
		,	fxSettings_close:		{ easing: "easeOutQuint" }
	}
	,	east: {
			size:					250
		,	spacing_closed:			2			// wider space when closed
		,	togglerLength_closed:	21			// make toggler 'square' - 21x21
		,	togglerAlign_closed:	"top"		// align to top of resizer
		,	togglerLength_open:		0 			// NONE - using custom togglers INSIDE east-pane
		,	togglerTip_open:		"Close East Pane"
		,	togglerTip_closed:		"Open East Pane"
		,	resizerTip_open:		"Resize East Pane"
		,	slideTrigger_open:		"mouseover"
		,	initClosed:				true
		//	override default effect, speed, and settings
		,	fxName:					"drop"
		,	fxSpeed:				"normal"
		,	fxSettings:				{ easing: "" } // nullify default easing
		}
	,	center: {
			paneSelector:			"#mainContent" 			// sample: use an ID to select pane instead of a class
		}
	};

$(function() {
	$( "#tabs" ).tabs({
		  active: 0
		});
	$( "#env_bch" ).tooltip();
	$( "#pro_bch" ).tooltip();

	$( "#env_cch" ).tooltip();
	$( "#pro_cch" ).tooltip();

	$( "#env_hog" ).tooltip();
	$( "#pro_hog" ).tooltip();

	$( "#env_cro" ).tooltip();
	$( "#pro_cro" ).tooltip();

	$( "#env_onc" ).tooltip();
	$( "#pro_onc" ).tooltip();

});

function getSize(){
	if (window.innerWidth && window.innerHeight) {
	 winW = window.innerWidth;
	 winH = window.innerHeight;
	}
	document.getElementById('back-menu').style.height = winH+"px";
	document.getElementById('main_table').style.height = winH+"px";
}
function reloadContent(){
	 setTimeout(function() {
        xajax_reloadContent('DET');
      }, 300000 );
}

</SCRIPT>
<style>
#result_Extensiones { width:100%; height:350px; overflow:auto; }
#result_Departamentos { width:100%; height:425px; overflow:auto; }
#result_Tarifas { width:100%; height:410px; overflow:auto; }
#result_Usuarios { width:100%; height:315px; overflow:auto; }
#result_Reportes { width:100%; height:550px; overflow:auto; }
#result_Rutas { width:100%; height:400px; overflow:auto; }
#cuerpo { width:100%; height:490px; overflow:auto; }
#dataResumen { width:100%; height:450px; overflow:auto; }
#dataDetalle { width:100%; height:450px; overflow:auto; }
#campDetails { width:100%; height:450px; overflow:auto; }
#f_desde { width:150px; height: 40px; font-size: 18px; text-align: center;}
#f_hasta { width:150px; height: 40px; font-size: 18px; text-align: center;}
#hora_desde { width:150px; }
#hora_hasta { width:150px; }
</style>
</HEAD>
<BODY onload="getSize(); xajax_reloadContent('RES');" style="font-size:	12px;">
<form id="formGestion" name="formGestion">

<div class="ui-layout-center">
	<div id="mainContent">
		<table width="100%" border="0" cellpadding="5" id="main_table">
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
									<span style="font-family:Verdana; font-size:16px; font-weight:bold; color: #004444;">
									TOTALES
									<BR>
									Enviado / Procesado	
									</span>
								</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #004444;">
									BANCO
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #0C6D6D;">
									CREDI
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #208181;">
									HOGAR
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #005A5A;">
									CROSS
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #002A2A;">
									ONCO
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #002A2A;">
									EDWARDS
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td rowspan="2">&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="5%" rowspan="2">
									<img src="../imagenes/reload.png" height="45" onclick="xajax_reloadContent('RES');" style="cursor:pointer;">
								</td>
								<td align="center" width="5%" rowspan="2">
									<a href="../php/logout.php"><img src="../imagenes/off.png"></a>
								</td>
							</tr>
							<tr>
								<td align="center">
									&nbsp;
								</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #004444;" id="envActualBCH">
									0/0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #0C6D6D;" id="envActualCCH">
									0/0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #208181;" id="envActualHOG">
									0/0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #005A5A;" id="envActualCRO">
									0/0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #002A2A;" id="envActualONC">
									0/0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" width="10%">
									<span style="font-family:Verdana; font-size:35px; font-weight:bold; color: #002A2A;" id="envActualEDW">
									0/0
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								
							</tr>
						</table>
					</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style="vertical-align:top;">
				<div id="cuerpo">
					<div id="tabs">
					  <ul>
					    <li><a href="#tabs-3">Resumen</a></li>
					    <li><a href="#tabs-4" onclick="xajax_reloadGestiones();">Gestiones</a></li>
					    <li><a href="#tabs-5" onclick="xajax_reloadDetalles();">Detalles</a></li>
					    <li><a href="#tabs-6" onclick="generaFormatos();">Formato de Archivos</a></li>
					  </ul>
					  <div id="tabs-3">
					   	<div id="dataResumen">
					   		<table class="ui-venp-table" align="center" border="0">
					   			<tr>
					   				<td>
					   					<table class="ui-venp-table-sub">
								  			<thead>
								  				<tr>
								  					<th class="ui-venp-header" colspan="4">ACE</th>
								  				</tr>
								  			</thead>
								  			<tbody>
								  				<tr>
								  					<td class="ui-venp-body ui-venp-body-p">BANCO</td>
								  					<td class="ui-venp-body ui-venp-body-p ui-venp-body-b"><span id="f_env_bch">- - -</span></td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="env_bch" title="Ventas Enviadas a Produccion">0</span>
								  					</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="pro_bch" title="Ventas Procesadas por Produccion">0</span>
								  					</td>
							  					</tr>
							  					<tr>
								  					<td class="ui-venp-body ui-venp-body-p">CREDI</td>
								  					<td class="ui-venp-body ui-venp-body-p ui-venp-body-b"><span id="f_env_cch">- - -</span></td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="env_cch" title="Ventas Enviadas a Produccion">0</span>
								  					</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="pro_cch" title="Ventas Procesadas por Produccion">0</span>
								  					</td>
							  					</tr>
							  				</tbody>
								  	    </table>
					   				</td>
					   			</tr>
					   			<tr>
					   				<td>&nbsp;</td>
					   			</tr>
					   			<tr>
					   				<td>
					   					<table class="ui-venp-table-sub">
								  			<thead>
								  				<tr>
								  					<th class="ui-venp-header" colspan="4">RSA</th>
								  				</tr>
								  			</thead>
								  			<tbody>
								  				<tr>
								  					<td class="ui-venp-body ui-venp-body-p">HOGAR</td>
								  					<td class="ui-venp-body ui-venp-body-p ui-venp-body-b"><span id="f_env_hog">- - -</span></td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="env_hog" title="Ventas Enviadas a Produccion">0</span>
							  						</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="pro_hog" title="Ventas Procesadas por Produccion">0</span>
								  					</td>
							  					</tr>
							  					<tr>
								  					<td class="ui-venp-body ui-venp-body-p">CROSS</td>
								  					<td class="ui-venp-body ui-venp-body-p ui-venp-body-b"><span id="f_env_cro">- - -</span></td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="env_cro" title="Ventas Enviadas a Produccion">0</span>
								  					</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="pro_cro" title="Ventas Procesadas por Produccion">0</span>
								  					</td>
							  					</tr>
							  				</tbody>
								  	    </table>
					   				</td>
					   			</tr>
					   			<tr>
					   				<td>&nbsp;</td>
					   			</tr>
					   			<tr>
					   				<td>
					   					<table class="ui-venp-table-sub">
								  			<thead>
								  				<tr>
								  					<th class="ui-venp-header" colspan="4">BSV</th>
								  				</tr>
								  			</thead>
								  			<tbody>
								  				<tr>
								  					<td class="ui-venp-body ui-venp-body-p">ONCO</td>
								  					<td class="ui-venp-body ui-venp-body-p ui-venp-body-b"><span id="f_env_onc">- - -</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="env_onc" title="Ventas Enviadas a Produccion">0</span>
								  					</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="pro_onc" title="Ventas Procesadas por Produccion">0</span>
								  					</td>
							  					</tr>
							  					<tr>
								  					<td class="ui-venp-body ui-venp-body-p">EDWARDS</td>
								  					<td class="ui-venp-body ui-venp-body-p ui-venp-body-b"><span id="f_env_edw">- - -</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="env_edw" title="Ventas Enviadas a Produccion">0</span>
								  					</td>
								  					<td class="ui-venp-body ui-venp-body-p">
								  						<span id="pro_edw" title="Ventas Procesadas por Produccion">0</span>
								  					</td>
							  					</tr>
							  				</tbody>
								  	    </table>
					   				</td>
					   			</tr>
					   		</table>
						</div>
					  </div>
					  <div id="tabs-4">
					  	<div id="dataGestiones">
						</div>
					  </div>
					  <div id="tabs-5">
					  	<div id="dataDetalle">
						</div>
					  </div>
					  <div id="tabs-6">
					  	<div id="dataFormatos">
						</div>
					  </div>
					</div>
				</div>
				</td>
			</tr>
			<tr>
				<td height="5%">
					<div style="width:100%; height:65px; background-image:url(../imagenes/menu_inactivo.png);" class="ui-corner-all ui-menu-shadow" align="center">
						<table border="0" width="60%" height="100%" cellspacing="1" cellpadding="0">
							<tr>
								<td align="center">
									&nbsp;
								</td>
								<td >
									<span style="font-family:Verdana; font-size:20px; font-weight:bold; color: #2779aa;">
									Fechas:
									</span>
								</td>
								<td align="center">
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #2779aa;">
									<input type="text" name="f_desde" id="f_desde" class="text ui-widget-content ui-corner-all" />
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center">
									<span style="font-family:Verdana; font-size:20px; font-weight:bold; color: #2779aa;">
									al
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td align="center" >
									<span style="font-family:Verdana; font-size:10px; font-weight:bold; color: #2779aa;">
									<input type="text" name="f_hasta" id="f_hasta" class="text ui-widget-content ui-corner-all" />
									</span>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td >
									<button id="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false" onclick="xajax_reloadContent('RES');"><span class="ui-button-text">Consultar</span></button>
								</td>
								<td>&nbsp;&nbsp;&nbsp;</td>
								<td >
									<img src="../imagenes/add.png" height="45" id="addGestion" onclick="generaGestion();" style="cursor:pointer;">
								</td>
							</tr>
						</table>
						<input type="hidden" name="val_cia_selected" id="val_cia_selected" class="text ui-widget-content ui-corner-all" />				
						<input type="hidden" name="val_fec_selected" id="val_fec_selected" class="text ui-widget-content ui-corner-all" />				
						<input type="hidden" name="val_est_selected" id="val_est_selected" class="text ui-widget-content ui-corner-all" value="2"/>				
					</div>
				</td>
			</tr>
		</tbody>
		</table>
	</div>
</div>
<div id="dialog-form" title="Crear Nueva Gestion" style="display:none;">
  	<p class="validateTipsGestion"></p>
 
  		<div id="ciasGestionContent">
	  		<input type="radio" id="check1" value="1" name="ciaGestion" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="check1">ACE</label>
	  		<input type="radio" id="check2" value="2" name="ciaGestion" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="check2">BSV</label>
	  		<input type="radio" id="check3" value="3" name="ciaGestion" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="check3">RSA</label>
	  		<input type="radio" id="check4" value="4" name="ciaGestion" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="check4">CNS</label>
	  		<input type="radio" id="check5" value="5" name="ciaGestion" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="check5">CAR</label>
		</div>
  		<br>
    	<label for="fechaCargaGestion">Fecha de Carga:</label>
    	<input type="text" name="fechaCargaGestion" id="fechaCargaGestion" onclick="document.getElementById('val_fec_selected').value = this.value;" value="" class="text ui-widget-content ui-corner-all">
 
    	<!-- Allow form submission with keyboard without duplicating the dialog button -->
    	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
</div>
<div id="dialog-form-gestion" title="Actualizar Gestion" style="display:none;">
  	<p class="validateTipsActualizaGestion"></p>
 
  		<div id="estadoActualizaGestionContent">
	  		<input type="radio" id="checkA1" value="1" name="estadoActualizaGestion" onclick="document.getElementById('val_est_selected').value = this.value;"><label for="checkA1">ENVIADO</label>
	  		<input type="radio" id="checkA2" value="2" name="estadoActualizaGestion" onclick="document.getElementById('val_est_selected').value = this.value;" checked><label for="checkA2">PROCESADO</label>
		</div>
  		<br>
    	<!-- Allow form submission with keyboard without duplicating the dialog button -->
    	<!-- <input type="submit" tabindex="-1" style="position:absolute; top:-1000px"> -->
</div>
<div id="dialog-form-formatos" title="Crear Formatos" style="display:none;">
  	<p class="validateTipsFormatos"></p>
 
  		<div id="ciasFormatosContent">
	  		<input type="radio" id="checkF1" value="1" name="ciaFormatos" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="checkF1">POSTVENTA</label>
	  		<input type="radio" id="checkF2" value="2" name="ciaFormatos" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="checkF2">TLMK</label>
	  		<input type="radio" id="checkF3" value="3" name="ciaFormatos" onclick="document.getElementById('val_cia_selected').value = this.value;"><label for="checkF3">BANCA VIRTUAL</label>
		</div>
  		<br>
    	<label for="fechaCargaFormatos">Fecha de Carga:</label>
    	<input type="text" name="fechaCargaFormatos" id="fechaCargaFormatos" onclick="document.getElementById('val_fec_selected').value = this.value;" value="" class="text ui-widget-content ui-corner-all">
 
    	<!-- Allow form submission with keyboard without duplicating the dialog button -->
    	<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
</div>
<div class="ui-layout-east pane pane-east ui-widget-content" style="position: absolute; margin: 0px; left: auto; right: 0px; top: 95px; bottom: 0px; height: 300px; z-index: 0; width: 260px; display: block; visibility: visible;">
	<div id="back-menu" style="background-image:url(../imagenes/barra_menu2.png);">
		<div class="icon ui-state-default ui-corner-all" style="width:20px;"><span id="tPinMenu" class="ui-icon ui-icon-pin-w">pin</span></div>
		<div style="width:100%;">
			<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center" height="100px"><img src="../imagenes/p2p-logo.png"></td>
				</tr>
				<tr>
					<td style="vertical-align:top;" height="20%">
						<div id="menu_admin" style="display:[onshow.div_status];">
							<div style="width:100%; padding:5px; margin:5px; height:72px;">
								<div style="width:70px; height:70px; float:left;" align="center" class="ui-widget-content ui-corner-all" onclick="xajax_cargaExtensiones(); showContent('content_Extensiones','result_Extensiones');">
									<table width="100%" height="100%" border="0">
									<tr>
									<td align="center">
									<img src="../imagenes/phone.png" height="48" title="Extensiones"/>
									</td>
									</tr>
									</table>
								</div>&nbsp;&nbsp;&nbsp;
								<div style="width:70px; height:70px; float:left;" class="ui-widget-content ui-corner-all" onclick=" xajax_cargaDepartamentos(); showContent('content_Departamentos','result_Departamentos');">
									<table width="100%" height="100%" border="0">
									<tr>
									<td align="center">
									<img src="../imagenes/departments.png" height="48" title="Departamentos"/>
									</td>
									</tr>
									</table>
								</div>&nbsp;
								<div style="width:70px; height:70px; float:left;" class="ui-widget-content ui-corner-all" onclick="xajax_cargaRutas(); showContent('content_Rutas','result_Rutas');">
									<table width="100%" height="100%" border="0">
									<tr>
									<td align="center">
									<img src="../imagenes/routes.png" height="48" title="Rutas"/>
									</td>
									</tr>
									</table>
								</div>
							</div>
							<div style="width:100%; padding:5px; margin:5px; height:72px;">
								<div style="width:70px; height:70px; float:left;" class="ui-widget-content ui-corner-all" onclick="xajax_cargaUsuarios(); showContent('content_Usuarios','result_Usuarios');">
									<table width="100%" height="100%" border="0">
									<tr>
									<td align="center">
									<img src="../imagenes/users.png" height="48" title="Usuarios"/>
									</td>
									</tr>
									</table>
								</div>&nbsp;<!-- onclick="xajax_cargaTarifas(); showContent('content_Tarifas','result_Tarifas');" -->
								<div style="width:70px; height:70px; float:left;" class="ui-widget-content ui-corner-all" >
									<table width="100%" height="100%" border="0">
									<tr>
									<td align="center">
									<a href="../php/principal.php"><img src="../imagenes/tarifas.png" height="48" title="Tarifas"/></a>
									</td>
									</tr>
									</table>
								</div>&nbsp;
								<div style="width:70px; height:70px; float:left;" class="ui-widget-content ui-corner-all" onclick="showContent('content_Reportes','result_Reportes'); crearFechasReportes();">
									<table width="100%" height="100%" border="0">
									<tr>
									<td align="center">
									<img src="../imagenes/reports.png" height="48" title="Reportes"/>
									</td>
									</tr>
									</table>
								</div>
							</div>
						</div>
						<div id="menu_user" style="display:[onshow.div_status_u];">
							<div style="width:100%; padding:5px; margin:5px; height:72px;">
								<div style="width:70px; height:70px; float:left;" class="ui-widget-content ui-corner-all" onclick="showContent('content_Reportes','result_Reportes'); crearFechasReportes();">
									<table width="100%" height="100%" border="0">
									<tr>
									<td align="center">
									<img src="../imagenes/reports.png" height="48" title="Reportes"/>
									</td>
									</tr>
									</table>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:top;">
						<span style="font-family:Verdana; font-size:12px; font-weight:bold; color:#000;">Bienvenido [onshow.usuario]</span>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
</form>
</BODY>
</HTML>