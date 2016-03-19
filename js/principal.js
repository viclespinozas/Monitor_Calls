$(function() {
    $( "#f_desde" ).datepicker({
      // defaultDate: "+1w",
      dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#f_hasta" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#f_hasta" ).datepicker({
      // defaultDate: "+1w",
      dateFormat: "dd/mm/yy",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#f_desde" ).datepicker( "option", "maxDate", selectedDate );
      }
    });

    $( "#fechaCargaGestion" ).datepicker({
    	dateFormat: "yymmdd"
    });
	
	$( "#fechaCargaFormatos" ).datepicker({
    	dateFormat: "yymmdd"
    });
	
	// $( "#anioResul" ).datepicker({
 //    	dateFormat: "yymmdd"
 //    });

    $('#anioResul').datepicker({
	     changeMonth: true,
	     changeYear: true,
	     showButtonPanel: true,
	     dateFormat: 'yymm',

	     onClose: function() {
	        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
	        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
	     },

	     beforeShow: function() {
	       if ((selDate = $(this).val()).length > 0) 
	       {
	          iYear = selDate.substring(selDate.length - 4, selDate.length);
	          iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), 
	                   $(this).datepicker('option', 'monthNames'));
	          $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
	          $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
	       }
	    }
	  });

    $('#anioResul2').datepicker({
	     changeMonth: true,
	     changeYear: true,
	     showButtonPanel: true,
	     dateFormat: 'yymm',

	     onClose: function() {
	        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
	        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
	     },

	     beforeShow: function() {
	       if ((selDate = $(this).val()).length > 0) 
	       {
	          iYear = selDate.substring(selDate.length - 4, selDate.length);
	          iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), 
	                   $(this).datepicker('option', 'monthNames'));
	          $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
	          $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
	       }
	    }
	  });

    $('#anioResul3').datepicker({
	     changeMonth: true,
	     changeYear: true,
	     showButtonPanel: true,
	     dateFormat: 'yymm',

	     onClose: function() {
	        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
	        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
	     },

	     beforeShow: function() {
	       if ((selDate = $(this).val()).length > 0) 
	       {
	          iYear = selDate.substring(selDate.length - 4, selDate.length);
	          iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), 
	                   $(this).datepicker('option', 'monthNames'));
	          $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
	          $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
	       }
	    }
	  });

    $( "#ciasGestionContent" ).buttonset();
    $( "#ciasFormatosContent" ).buttonset();
    $( "#estadoActualizaGestionContent" ).buttonset();


  });
function crearFechasReportes(){

	//$("#fecha_hasta").datepicker();
	//$("#fecha_desde").datepicker();

	//$( "#disponibilidad_asignacion" ).datepicker();
	
	var currentTime = new Date();
	var startDateFrom = new Date(currentTime.getFullYear(),0,1);
	$("#fecha_hasta").datepicker({ dateFormat: "yy-mm-dd",
		//defaultDate: new Date(),
		changeMonth: true,
		changeYear: true,
		//minDate : startDateFrom,
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesMin: ['Dom', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		onSelect: function (selectedDate) {
			$("#fecha_desde").datepicker("option", "maxDate", selectedDate);
		}
	});
	
	$("#fecha_desde").datepicker({
		dateFormat: "yy-mm-dd",
		//defaultDate: new Date(),
		changeMonth: true,
		changeYear: true,
		//minDate : startDateFrom,
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		dayNamesMin: ['Dom', 'Lu', 'Ma', 'Mi', 'Je', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		onSelect: function (selectedDate) {
			$("#fecha_hasta").datepicker("option", "minDate", selectedDate);
		}
	});
	
	$("#hora_hasta").timepicker();
	$("#hora_desde").timepicker();
	$( "#radio" ).buttonset();
	xajax_creaFechas();
}
function showContent(con_div,res_div){

	//alert(div);
	var content = $( "#last_content" );
	var result = $( "#last_result" );
	var content_hide;
	var result_hide;
	
	//OCULTO EL GRÁFICO
	$( "#cuerpo" ).hide('slow');
	
	if(content.val().length == 0 && result.val().length == 0)
	{
		content.val( con_div );
		result.val( res_div );
		$( "#"+con_div+"" ).show();
		$( "#"+res_div+"" ).attr("style","display:block");
	}
	else
	{
		content_hide = $( "#last_content" ).val();
		result_hide = $( "#last_result" ).val();
		
		$( "#"+content_hide+"" ).hide('slow');
		$( "#"+result_hide+"" ).hide('slow');
		
		$( "#"+con_div+"" ).show();
		$( "#"+res_div+"" ).attr("style","display:block");
		
		content.val( con_div );
		result.val( res_div );
	}
}
function validarExtensiones(){
	
	var numero_extension = $( "#numero_extension" ),
		nombre_visualizacion = $( "#nombre_visualizacion" ),
		contrasena = $( "#contrasena" ),
		protocolo = $( "#protocolo" ).val(),
		g711ulaw = document.getElementById('g711ulaw'),
		g711alaw = document.getElementById('g711alaw'),
		g723 = document.getElementById('g723'),
		gsm = document.getElementById('gsm'),
		tips = $( ".resultados" );
		
	function updateTips( t, o ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 2500 );
		o.removeClass( "ui-state-error", 2500 );
      }, 1000 );
    }
	
	function checkvalue(o,n) {
		if ( o.val().length == 0 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
	
	function checkRegexp( o, regexp, n ) 
	{
		if ( !( regexp.test( o.val() ) ) ) 
		{
			o.addClass( "ui-state-error" );
			updateTips( n,o );
			return false;
		} 
		else 
		{
			o.removeClass( "ui-state-error" );
			return true;
		}
	}
	
	var bValid = true;
	
	bValid = bValid && checkvalue( numero_extension, "El numero de extension no debe estar en blanco");
	bValid = bValid && checkRegexp( numero_extension, /^[0-9]+$/i, "El numero de extension debe contener caracteres solo numericos" );
	//bValid = bValid && checkvalue( nombre_visualizacion, "El nombre de visualizacion no debe estar en blanco");
	bValid = bValid && checkvalue( contrasena, "La contrasena no debe estar en blanco");
	
	if(bValid)
	{
	    //alert("VALIDADO");
	    xajax_guardaRegistroExtensiones(xajax.getFormValues('form'));
	}
}
function limpiarExtensiones(){
	var numero_extension = $( "#numero_extension" ),
		nombre_visualizacion = $( "#nombre_visualizacion" ),
		contrasena = $( "#contrasena" );
	
	numero_extension.val('');
	nombre_visualizacion.val('');
	contrasena.val('');
}
function validarDepartamento(){
	var nombre_departamento = $( "#nombre_departamento" ),
		tips = $( ".resultados_dptos" );
		
	function updateTips( t, o ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 2500 );
		o.removeClass( "ui-state-error", 2500 );
      }, 1000 );
    }
	
	function checkvalue(o,n) {
		if ( o.val().length == 0 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
	
	var bValid = true;
	
	bValid = bValid && checkvalue( nombre_departamento, "El nombre de departamento no debe estar en blanco");
	
	if(bValid)
	{
	    //alert("VALIDADO");
	    xajax_guardaRegistroDepartamento(xajax.getFormValues('form'));
	}
}
function limpiarDepartamento(){
	var nombre_departamento = $( "#nombre_departamento" );
	
	nombre_departamento.val('');
}
function validarRutas(){
	var nombre_ruta_saliente = $( "#nombre_ruta_saliente" ),
		prefijo = $( "#prefijo" ),
		patron = $( "#patron" ),
		tips = $( ".resultados_rutas" );
		
	function updateTips( t, o ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 2500 );
		o.removeClass( "ui-state-error", 2500 );
      }, 1000 );
    }
	
	function checkvalue(o,n) {
		if ( o.val().length == 0 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
	
	var bValid = true;
	
	bValid = bValid && checkvalue( nombre_ruta_saliente, "El nombre de la ruta no debe estar en blanco");
	bValid = bValid && checkvalue( patron, "El nombre de la ruta no debe estar en blanco");
	
	if(bValid)
	{
	    //alert("VALIDADO");
	    xajax_guardaRegistroRutas(xajax.getFormValues('form'));
	}
}
function limpiarRutas(){
	var nombre_ruta_saliente = $( "#nombre_ruta_saliente" );
	var prefijo = $( "#prefijo" );
	var patron = $( "#patron" );
	
	nombre_ruta_saliente.val('');
	prefijo.val('');
	patron.val('');
}
function validarUsuario(){
	var nombres_usuario = $( "#nombres_usuario" ),
		apellidos_usuario = $( "#apellidos_usuario" ),
		cedula_usuario = $( "#cedula_usuario" ),
		email_usuario = $( "#email_usuario" ),
		telefono_usuario = $( "#telefono_usuario" ),
		movil_usuario = $( "#movil_usuario" ),
		username_usuario = $( "#username_usuario" ),
		password_usuario = $( "#password_usuario" ),
		perfil_usuario = $( "#perfil_usuario" ),
		lista_extensiones = $( "#lista_extensiones" ),
		tips = $( ".resultados_usuarios" );
		
	function updateTips( t, o ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 2500 );
		o.removeClass( "ui-state-error", 2500 );
      }, 1000 );
    }
	
	function checkvalue(o,n) {
		if ( o.val().length == 0 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
	
	function checkvalue2(o,n) {
		if ( o.val().length <= 6 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
	
	function checkRegexp( o, regexp, n ){
		if ( !( regexp.test( o.val() ) ) ) 
		{
			o.addClass( "ui-state-error" );
			updateTips( n,o );
			return false;
		} 
		else 
		{
			o.removeClass( "ui-state-error" );
			return true;
		}
	}
	
	var bValid = true;
	
	bValid = bValid && checkvalue( nombres_usuario, "Los Nombres no deben estar en blanco");
	bValid = bValid && checkvalue( apellidos_usuario, "Los Apellidos no deben estar en blanco");
	bValid = bValid && checkvalue( cedula_usuario, "El numero de cedula no deben estar en blanco");
	bValid = bValid && checkRegexp( cedula_usuario, /^[0-9]+$/i, "El numero de cedula debe contener caracteres solo numericos" );
	bValid = bValid && checkvalue2( cedula_usuario, "Debe ingresar un numero de cedula valido");
	bValid = bValid && checkRegexp( email_usuario, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "Debe ingresar una direccion de correo valida usuario@dominio.com" );
	bValid = bValid && checkRegexp( telefono_usuario, /^[0-9]+$/i, "El numero de telefono debe contener caracteres solo numericos");
	bValid = bValid && checkRegexp( movil_usuario, /^[0-9]+$/i, "El numero de movil debe contener caracteres solo numericos");
	bValid = bValid && checkvalue( username_usuario, "El Nombre de usuario no debe estar en blanco");
	bValid = bValid && checkvalue( password_usuario, "La contrasena no debe estar en blanco");
	if(bValid)
	{
	    //alert("VALIDADO");
	    xajax_guardaRegistroUsuarios(xajax.getFormValues('form'));
	}
}
function limpiarUsuario(){
	var nombres_usuario = $( "#nombres_usuario" ),
		apellidos_usuario = $( "#apellidos_usuario" ),
		cedula_usuario = $( "#cedula_usuario" ),
		email_usuario = $( "#email_usuario" ),
		telefono_usuario = $( "#telefono_usuario" ),
		movil_usuario = $( "#movil_usuario" ),
		username_usuario = $( "#username_usuario" ),
		password_usuario = $( "#password_usuario" ),
		perfil_usuario = $( "#perfil_usuario" );
		
		nombres_usuario.val('');
		apellidos_usuario.val('');
		cedula_usuario.val('');
		email_usuario.val('');
		telefono_usuario.val('');
		movil_usuario.val('');
		username_usuario.val('');
		password_usuario.val('');
}
function validartarifa(){
	var nombre_ruta = $( "#nombre_ruta" ),
		descripcion_tarifa = $( "#descripcion_tarifa" ),
		valor_tarifa = $( "#valor_tarifa" ),
		tips = $( ".resultados_tarifas" );
		
	function updateTips( t, o ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 2500 );
		o.removeClass( "ui-state-error", 2500 );
      }, 1000 );
    }
	
	function checkvalue(o,n) {
		if ( o.val().length == 0 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
	
	function checkRegexp( o, regexp, n ) 
	{
		if ( !( regexp.test( o.val() ) ) ) 
		{
			o.addClass( "ui-state-error" );
			updateTips( n,o );
			return false;
		} 
		else 
		{
			o.removeClass( "ui-state-error" );
			return true;
		}
	}
	
	var bValid = true;
	
	bValid = bValid && checkvalue( descripcion_tarifa, "La descripcion no debe estar en blanco");
	bValid = bValid && checkvalue( nombre_ruta, "Debe seleccionar una ruta valida");
	bValid = bValid && checkvalue( valor_tarifa, "El monto de la tarifa no debe estar en blanco");
	bValid = bValid && checkRegexp( valor_tarifa, /^[0-9]+(\,[0-9]{2})?$/i, "Debe ingresar un monto valido ej. 120,50" );
	
	if(bValid)
	{
	    //alert("VALIDADO");
	    xajax_guardaRegistroTarifas(xajax.getFormValues('form'));
	}
}
function limpiarTarifa(){
	var nombre_ruta = $( "#nombre_ruta" );
	var valor_tarifa = $( "#valor_tarifa" );
	var descripcion_tarifa = $( "#descripcion_tarifa" );
	
	descripcion_tarifa.val('');
	valor_tarifa.val('');
}
function validarReporte(){
	var fecha_desde = $( "#fecha_desde" ),
		fecha_hasta = $( "#fecha_hasta" ),
		hora_desde = $( "#hora_desde" ),
		hora_hasta = $( "#hora_hasta" ),
		tips = $( ".resultados_reportes" );
		
	function updateTips( t, o ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 2500 );
		o.removeClass( "ui-state-error", 2500 );
      }, 1000 );
    }
	
	function checkvalue(o,n) {
		if ( o.val().length == 0 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
	
	function checkRegexp( o, regexp, n ) 
	{
		if ( !( regexp.test( o.val() ) ) ) 
		{
			o.addClass( "ui-state-error" );
			updateTips( n,o );
			return false;
		} 
		else 
		{
			o.removeClass( "ui-state-error" );
			return true;
		}
	}
	
	function checkDate( o1, o2 )
	{
		if( o2.val() < o1.val() )
		{
			o2.addClass( "ui-state-error" );
			updateTips( "La Hora de Finalizacion no puede ser Menor a la Hora de Inicio" );
			return false;
		}
		else
		{
			o2.removeClass( "ui-state-error" );
			document.getElementById('resultados_sal').style.display = 'none';
			return true;
		}
	}
	
	var bValid = true;
	
	bValid = bValid && checkvalue( fecha_desde, "La fecha de inicio no debe estar en blanco");
	bValid = bValid && checkvalue( fecha_hasta, "La fecha de finalizacion no debe estar en blanco");
	bValid = bValid && checkvalue( hora_desde, "La hora inicial no debe estar en blanco");
	bValid = bValid && checkvalue( hora_hasta, "La hora final no debe estar en blanco");
	//bValid = bValid && checkRegexp( hora_desde, /^([0-9]{2})+(\:[0-9]{2})+(\:[0-9]{2})?$/i, "Debe ingresar una hora valida, ej: 10:30:00" );
	
	if(bValid)
	{
	    //alert("VALIDADO");
		
		$( "#content_Reportes" ).hide('slow');
	    xajax_generaReporte(xajax.getFormValues('form'));
	}
}
function selectReport(id){
	var report = document.getElementById(id).checked,
		val,
		cant = parseInt(document.getElementById('cant_report').value);
		
	if(report == true)
	{
		val = cant + 1;
		document.getElementById('cant_report').value = val;
	}
	else
	{
		val = cant - 1;
		document.getElementById('cant_report').value = val;
	}
}
function limpiarReporte(){

}
function cambiarContrasena(){
$( "#dialogCambiarContrasena" ).attr("style","display:block");
	var nueva_contrasena = $( "#nueva_contrasena" ),
		id_usuario = $( "#id_usuario" ).val(),
	  tips = $( ".validateTipsCambioContrasena" );
 
	function updateTips( t ) {
	  tips
		.text( t )
		.addClass( "ui-state-highlight" );
	  setTimeout(function() {
		tips.removeClass( "ui-state-highlight", 1500 );
	  }, 500 );
	}
	
	function checkLength( o, n ) {
	  if ( o.val() == 0 ) {
		o.addClass( "ui-state-error" );
		updateTips( n, o );
		return false;
	  } else {
		return true;
	  }
	}
	
	function checkvalue2(o,n) {
		if ( o.val().length <= 5 ) {
				o.addClass( "ui-state-error" );
				updateTips( n,o );
				return false;
		} else {
				return true;
		}
	}
 
 
	$( "#dialogCambiarContrasena" ).dialog({
	  autoOpen: true,
	  height: 210,
	  width: 350,
	  modal: true,
	  buttons: {
		"Actualizar": function() {
		  var bValid = true;
 
		  bValid = bValid && checkLength( nueva_contrasena, "La contrasena no debe estar en blanco" );
		  bValid = bValid && checkvalue2( nueva_contrasena, "La contrasena debe contener 6 o mas caracteres");
 
		  if ( bValid ) {
			xajax_guardaRegistroCambiarContrasena(nueva_contrasena.val(),id_usuario);
		  }
		}
	  }
	});
}
function createChart(data,titulo,cols){

	var chartData = data;
	var chart = new AmCharts.AmSerialChart();
	chart.dataProvider = chartData;
	chart.categoryField = "country";
	chart.startDuration = 2;
	// change balloon text color                
	chart.balloon.color = "#000000";
	chart.depth3D = 10;
    chart.angle = 20;

	// AXES
	// category
	var categoryAxis = chart.categoryAxis;
	categoryAxis.gridAlpha = 0;
	categoryAxis.axisAlpha = 0;
	categoryAxis.labelsEnabled = false;

	// value
	var valueAxis = new AmCharts.ValueAxis();
	valueAxis.gridAlpha = 0;
	valueAxis.axisAlpha = 0;
	valueAxis.labelsEnabled = false;
	valueAxis.minimum = 0;
	//valueAxis.title = "Cantidad de Llamadas"
	valueAxis.title = titulo
	chart.addValueAxis(valueAxis);

	switch(cols)
	{
		case 1:
			// GRAPH
			var graph = new AmCharts.AmGraph();
			graph.balloonText = "[[category]]: [[value]]";
			graph.valueField = "monto";
			graph.descriptionField = "short";
			graph.type = "column";
			graph.lineAlpha = 0;
			graph.fillAlphas = 1;
			graph.fillColors = ["#33FF00", "#00CC00"];
			graph.labelText = "[[description]]";
			graph.balloonText = "[[category]]: BsF [[value]]";
			chart.addGraph(graph);
		break;
		case 2:
			// GRAPH
			var graph = new AmCharts.AmGraph();
			graph.balloonText = "[[category]]: [[value]]";
			graph.valueField = "abandonadas";
			graph.descriptionField = "short";
			graph.type = "column";
			graph.lineAlpha = 0;
			graph.fillAlphas = 1;
			//graph.fillColors = ["#BFE3FE", "#00477D"];
			//graph.fillColors = ["#FF6600", "#FED980"];
			graph.fillColors = ["#FF3300", "#FF9900"];
			graph.labelText = "[[description]]";
			graph.balloonText = "[[category]]: [[value]] Abandonadas";
			chart.addGraph(graph);
			
			var graph2 = new AmCharts.AmGraph();
			graph2.balloonText = "[[category]]: [[value]]";
			graph2.valueField = "atendidas";
			graph2.descriptionField = "short";
			graph2.type = "column";
			graph2.lineAlpha = 0;
			graph2.fillAlphas = 1;
			//graph2.fillColors = ["#BFFEBF", "#008E00"];
			graph2.fillColors = ["#33FF00", "#00CC00"];
			graph2.labelText = "[[description]]";
			graph2.balloonText = "[[category]]: [[value]] Atendidas";
			chart.addGraph(graph2);
		break;
	}

	// WRITE
	chart.write("result_reports_graphics");
}
function darMensaje( m, s ){
	alert(m); 
	if(s == 1)
	{
		location.reload();
	}
}

function generaGestion()
{
	// alert("Abriendo nueva gestion");

	var cia = $( "#ciaGestion" ),
		fecha_carga = $( "#fechaCargaGestion" ),
		allFields = $( [] ).add( cia ).add( fecha_carga ),
		tips = $( ".validateTipsGestion" );
	 
	function updateTips( t ) {
	  tips
		.text( t )
		.addClass( "ui-state-highlight" );
	  setTimeout(function() {
		tips.removeClass( "ui-state-highlight", 1500 );
	  }, 500 );
	}
 
	function checkLength( o, n ) {
	  if ( o.val().length == 0 ) {
		o.addClass( "ui-state-error" );
		updateTips(  n + " en blanco, por favor verifique." );
		return false;
	  } else {
		return true;
	  }
	}
 
	$( "#dialog-form" ).dialog({
      resizable: false,
      width:350,
      height:300,
      modal: true,
      buttons: {
        Crear: function() {
          	var bValid = true;
          	allFields.removeClass( "ui-state-error" );

			bValid = bValid && checkLength( fecha_carga, "Fecha de Carga" );
		 
			if ( bValid ) {
			  xajax_creaGestion(xajax.getFormValues('formGestion'),fecha_carga.val());
			  $( this ).dialog( "close" );
			}
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
}

function actualizaGestion(id)
{
	// alert("Abriendo nueva gestion");
	// alert(id);

	var estado = $( "#estadoActualizaGestion" ),
		tips = $( ".validateTipsActualizaGestion" );
	 
	function updateTips( t ) {
	  tips
		.text( t )
		.addClass( "ui-state-highlight" );
	  setTimeout(function() {
		tips.removeClass( "ui-state-highlight", 1500 );
	  }, 500 );
	}
 
	function checkLength( o, n ) {
	  if ( o.val().length == 0 ) {
		o.addClass( "ui-state-error" );
		updateTips(  n + " en blanco, por favor verifique." );
		return false;
	  } else {
		return true;
	  }
	}
 
	$( "#dialog-form-gestion" ).dialog({
      resizable: false,
      width:350,
      height:200,
      modal: true,
      buttons: {
        Actualizar: function() {
          	 xajax_actualizaGestion(xajax.getFormValues('formGestion'),id);
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
}

function creaAccordion()
{
	$( "#accordion" ).accordion({
      heightStyle: "content",
      active: false,
      collapsible: true
    });
}

function activaLista()
{
	$( "#tabs" ).tabs({
		  active: 3
		});
}

function activaListaResultantes(p)
{
	$( "#tabs2" ).tabs({
		  active: p
		});
}

function generaFormatos()
{
	// alert("Abriendo nueva gestion");

	var cia = $( "#ciaFormatos" ),
		fecha_carga = $( "#fechaCargaFormatos" ),
		allFields = $( [] ).add( cia ).add( fecha_carga ),
		tips = $( ".validateTipsFormatos" );
	 
	function updateTips( t ) {
	  tips
		.text( t )
		.addClass( "ui-state-highlight" );
	  setTimeout(function() {
		tips.removeClass( "ui-state-highlight", 1500 );
	  }, 500 );
	}
 
	function checkLength( o, n ) {
	  if ( o.val().length == 0 ) {
		o.addClass( "ui-state-error" );
		updateTips(  n + " en blanco, por favor verifique." );
		return false;
	  } else {
		return true;
	  }
	}
 
	$( "#dialog-form-formatos" ).dialog({
      resizable: false,
      width:450,
      height:300,
      modal: true,
      buttons: {
        Crear: function() {
          	var bValid = true;
          	allFields.removeClass( "ui-state-error" );

			bValid = bValid && checkLength( fecha_carga, "Fecha de Carga" );
		 
			if ( bValid ) {
			  xajax_reloadFormatos(xajax.getFormValues('formGestion'),fecha_carga.val());
			  $( this ).dialog( "close" );
			}
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
}
