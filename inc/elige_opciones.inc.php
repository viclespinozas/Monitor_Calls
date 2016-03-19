<?php
@session_start();
date_default_timezone_set('America/Santiago');
// LIBRERIA AJAX 0.5
@require_once("../clases/PHPExcel.php");
@require_once("../librerias/xajax/xajax_core/xajaxAIO.inc.php");
@include("../clases/conexionBD.class.php");
function cargaCampanas($fecha,$idcampana)
{
	$ob = new xajaxResponse;

	switch(intval($idcampana))
	{
		case 0:
			$sql = "SELECT distinct campana from fidelizacion.cargas where ws_fecha_carga = '".$fecha."01'";
			$q = consultar($sql);
			if($q != "NO")
			{
				$lista = "<select id='campana' name='campana'>";
				$data = explode("::", $q);
				foreach($data as $x)
				{
					if(!empty($x))
					{
						$data_2 = explode("||", $x);
						$campana = $data_2[0];
						$lista .= "<option value='".$campana."'>".str_replace($fecha."01","",(str_replace("_"," ",$campana)))."</option>";
					}
				}
				$lista .= "</select>";
				$lista .= '<br><br>
						   <input type="button" value="Consultar" class="ui-button ui-state-default ui-corner-all" onclick="xajax_generaResultante(document.getElementById(\'campana\').value,\''.$idcampana.'\')";">
						    &nbsp;&nbsp;
						    <input type="button" value="Consultar Todas las Campañas" class="ui-button ui-state-default ui-corner-all" onclick="xajax_generaResultante(\'ALL||'.$fecha.'\',\''.$idcampana.'\')";">
						    <br><br>
						   ';
			}
			$ob->assign("listaCampanas","innerHTML",$lista);
		break;
		case 1:
			$sql = "SELECT distinct lote from recuperacion.cargas where ws_fecha_carga like '".$fecha."%' AND length(lote) = 4";
			$q = consultar($sql);
			if($q != "NO")
			{
				$lista = "<select id='campana2' name='campana2'>";
				$data = explode("::", $q);
				foreach($data as $x)
				{
					if(!empty($x))
					{
						$data_2 = explode("||", $x);
						$campana = $data_2[0];
						$lista .= "<option value='".$campana."'>".str_replace($fecha."01","",(str_replace("_"," ",$campana)))."</option>";
					}
				}
				$lista .= "</select>";
				$lista .= '<br><br>
						   <input type="button" value="Consultar" class="ui-button ui-state-default ui-corner-all" onclick="xajax_generaResultante(document.getElementById(\'campana2\').value,\''.$idcampana.'\')";">
						    &nbsp;&nbsp;
						    <input type="button" value="Consultar Todas las Campañas" class="ui-button ui-state-default ui-corner-all" onclick="xajax_generaResultante(\'ALL||'.$fecha.'\',\''.$idcampana.'\')";">
						    <br><br>
						   ';
			}
			$ob->assign("listaCampanas2","innerHTML",$lista);
		break;
		case 2:
			$sql = "SELECT distinct lote FROM retencion.cargas WHERE ws_fecha_carga LIKE '".$fecha."%' AND length(lote) <= 3";
			$q = consultar($sql);
			if($q != "NO")
			{
				$lista = "<select id='campana3' name='campana3'>";
				$data = explode("::", $q);
				foreach($data as $x)
				{
					if(!empty($x))
					{
						$data_2 = explode("||", $x);
						$campana = $data_2[0];
						$lista .= "<option value='".$campana."'>".$campana."</option>";
					}
				}
				$lista .= "</select>";
				$lista .= '<br><br>
						   <input type="button" value="Consultar" class="ui-button ui-state-default ui-corner-all" onclick="xajax_generaResultante(document.getElementById(\'campana3\').value,\''.$idcampana.'\')";">
						    &nbsp;&nbsp;
						    <input type="button" value="Consultar Todas las Campañas" class="ui-button ui-state-default ui-corner-all" onclick="xajax_generaResultante(\'ALL||'.$fecha.'\',\''.$idcampana.'\')";">
						    <br><br>
						   ';
			}
			$ob->assign("listaCampanas3","innerHTML",$lista);
		break;
	}

	

	return $ob;
}
function generaResultante($campana,$id){
	$ob = new xajaxResponse;
	// $ob->alert("ENTRA");
	
	
	$camp = "";
	if(stristr($campana, "||"))
	{
		$camp=explode("||",$campana);
		$campana = $camp[0];
		$fecha = $camp[1];
		// $ob->alert($campana);
		// $ob->alert($fecha);
	}	
	
	switch($campana)
	{
		case 'ALL':
			
			switch(intval($id))
			{
				case 0:
					$objPHPExcel = new PHPExcel();

					$objPHPExcel->getProperties()->setCreator("Victor Espinoza")
				                                 ->setLastModifiedBy("Victor Espinoza")
				                                 ->setTitle("RESULTANTES")
				                                 ->setSubject("RESULTANTES")
				                                 ->setDescription("RESULTANTES")
				                                 ->setKeywords("RESULTANTES")
				                                 ->setCategory("RESULTANTES");

				    $objPHPExcel->getActiveSheet()->getStyle("A1:BP1")->getFont()->getColor()->setRGB('FFFFFF');
				    $objPHPExcel->getActiveSheet()->getStyle('A1:BP1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0068BF');

				    $objPHPExcel->getActiveSheet()->setCellValue("A1", "CAMPAÑA");						$objPHPExcel->getActiveSheet()->setCellValue("B1", "RUT CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("C1", "DV CLIENTE");					$objPHPExcel->getActiveSheet()->setCellValue("D1", "NOMBRE CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("E1", "DIRECCIÓN");					$objPHPExcel->getActiveSheet()->setCellValue("F1", "CIUDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("G1", "COMUNA");						$objPHPExcel->getActiveSheet()->setCellValue("H1", "FECHA DE NAC");
					$objPHPExcel->getActiveSheet()->setCellValue("I1", "EDAD");							$objPHPExcel->getActiveSheet()->setCellValue("J1", "SEXO");
				    $objPHPExcel->getActiveSheet()->setCellValue("K1", "SEGMENTO");						$objPHPExcel->getActiveSheet()->setCellValue("L1", "EDO. CIVIL");
				    $objPHPExcel->getActiveSheet()->setCellValue("M1", "IND FUNCIONARIO");				$objPHPExcel->getActiveSheet()->setCellValue("N1", "NRO SEGURO");
				    $objPHPExcel->getActiveSheet()->setCellValue("O1", "FECHA INICIO SEGURO");			$objPHPExcel->getActiveSheet()->setCellValue("P1", "FECHA TERMINO SEGURO");
					$objPHPExcel->getActiveSheet()->setCellValue("Q1", "RAMO");							$objPHPExcel->getActiveSheet()->setCellValue("R1", "TIPO PRODUCTO");
				    $objPHPExcel->getActiveSheet()->setCellValue("S1", "PLAN PRODUCTO");				$objPHPExcel->getActiveSheet()->setCellValue("T1", "CANAL VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("U1", "PRIMA ANUAL");					$objPHPExcel->getActiveSheet()->setCellValue("V1", "MONEDA");
				    $objPHPExcel->getActiveSheet()->setCellValue("W1", "CUOTAS");						$objPHPExcel->getActiveSheet()->setCellValue("X1", "FORMA DE PAGO");
					$objPHPExcel->getActiveSheet()->setCellValue("Y1", "MEDIO DE PAGO");				$objPHPExcel->getActiveSheet()->setCellValue("Z1", "MONTO CUOTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AA1", "POLIZA INDIVIDUAL");			$objPHPExcel->getActiveSheet()->setCellValue("AB1", "CODIGO CIA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AC1", "MARCA VENTA");					$objPHPExcel->getActiveSheet()->setCellValue("AD1", "ID UNICO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AE1", "MES");							$objPHPExcel->getActiveSheet()->setCellValue("AF1", "FECHA CARGA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AG1", "ESTADO REGISTRO");				$objPHPExcel->getActiveSheet()->setCellValue("AH1", "FECHA ULTIMA GESTION");
					$objPHPExcel->getActiveSheet()->setCellValue("AI1", "HORA ULTIMA GESTION");			$objPHPExcel->getActiveSheet()->setCellValue("AJ1", "NUM INTENTOS");
				    $objPHPExcel->getActiveSheet()->setCellValue("AK1", "DURACION ULTIMA GESTION");		$objPHPExcel->getActiveSheet()->setCellValue("AL1", "EJECUTIVO CALIDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("AM1", "ESTADO CALIDAD");				$objPHPExcel->getActiveSheet()->setCellValue("AN1", "FIDELIZADO TABLA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AO1", "GESTION FIDELIZACION");		$objPHPExcel->getActiveSheet()->setCellValue("AP1", "FECHA FIDELIZACION");
					$objPHPExcel->getActiveSheet()->setCellValue("AQ1", "FIDELIZADO");					$objPHPExcel->getActiveSheet()->setCellValue("AR1", "DETALLE");
				    $objPHPExcel->getActiveSheet()->setCellValue("AS1", "MOTIVO");						$objPHPExcel->getActiveSheet()->setCellValue("AT1", "CAMNIO MP");
				    $objPHPExcel->getActiveSheet()->setCellValue("AU1", "BANCO");						$objPHPExcel->getActiveSheet()->setCellValue("AV1", "CUENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AW1", "COPIA POLIZA");				$objPHPExcel->getActiveSheet()->setCellValue("AX1", "DIR ENVIO");
					$objPHPExcel->getActiveSheet()->setCellValue("AY1", "CIUDAD ENVIO");				$objPHPExcel->getActiveSheet()->setCellValue("AZ1", "COMUNA ENVIO");
				    $objPHPExcel->getActiveSheet()->setCellValue("BA1", "VENTA TABLA");					$objPHPExcel->getActiveSheet()->setCellValue("BB1", "GESTION DE VENTA TABLA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BC1", "VENTA");						$objPHPExcel->getActiveSheet()->setCellValue("BD1", "GESTION DE VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BE1", "CANT VENTAS");					$objPHPExcel->getActiveSheet()->setCellValue("BF1", "CANT VENTAS OK");
					$objPHPExcel->getActiveSheet()->setCellValue("BG1", "FONO GESTION PRINCIPAL");		$objPHPExcel->getActiveSheet()->setCellValue("BH1", "CONTACTO PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BI1", "ESTADO CONTACTO PRINCIPAL");	$objPHPExcel->getActiveSheet()->setCellValue("BJ1", "TIPO CONTACTO PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BK1", "ESTADO TELEFONICO PRINCIPAL");	$objPHPExcel->getActiveSheet()->setCellValue("BL1", "FECHA GESTION PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BM1", "HORA GESTION PRINCIPAL");		$objPHPExcel->getActiveSheet()->setCellValue("BN1", "EJECUTIVO GESTOR");
				    $objPHPExcel->getActiveSheet()->setCellValue("BO1", "CORREO ELECTRONICO");			$objPHPExcel->getActiveSheet()->setCellValue("BP1", "OBSERVACION GESTION");
					
				    $sql = "SELECT 
							  campana 
							, marca_bbdd 
							, rut_cliente 
							, dv_cliente 
							, split_part(cltbas_nombre,'/',3)||' '||split_part(cltbas_nombre,'/',1)||' '||split_part(cltbas_nombre,'/',2) 
							, direccion 
							, ciudad 
							, comuna 
							, r.registra_correo 
							, fec_nacim, edad, sexo, segmento, estado_civil
							, ind_funcionario, nro_seguro, fecha_inicio_seguro
							, fecha_termino_seguro, ramo, tipo_producto, plan_producto, canal_venta
							, prima_anual, moneda, cuotas, forma_de_pago, medio_de_pago, monto_cuota
							, poliza_indiv, codigo_cia, marca_venta_1
							, ws_idunico 
							, ws_campagna 
							, ws_fecha_carga 
							, ws_estado_registro 
							, ws_fecha_sistema 
							, ws_hora_sistema 
							, ws_num_intentos 
							, ws_tmo_script 
							,(SELECT nombre_fantasia FROM usuarios WHERE idusuario = id_calidad) 
							, estado_calidad 
							, fidelizado 
							, gestion_fidelizacion 
							, fecha_fidelizacion 
							, (CASE WHEN ((gestion_fidelizacion != '' or gestion_fidelizacion != null) )
								THEN (select distinct fidelizacion from fidelizacion.tipificacion where conforme = gestion_fidelizacion)
								ELSE (select (case when b.estado_telefonico = 'Volver a Llamar' then 'No Fidelizado' else b.fidelizacion end) from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE WHEN ((gestion_fidelizacion != '' or gestion_fidelizacion != null) )
								THEN (select distinct detalle from fidelizacion.tipificacion where conforme = gestion_fidelizacion)
								ELSE (select (case when b.estado_telefonico = 'Volver a Llamar' then 'Volver a Llamar' else b.detalle end) from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE 
								WHEN ((gestion_fidelizacion != '' or gestion_fidelizacion != null) and gestion_fidelizacion != 'Si')
								  THEN (select distinct motivo from fidelizacion.tipificacion where conforme = gestion_fidelizacion)
								WHEN gestion_fidelizacion = 'Si'
								  THEN 'Fidelizado OK'
								ELSE ''
							   END) 
							, (SELECT estado  FROM retencion.a_cambio_mp where cod = cambio_mp) 
							, banco 
							, numero_producto 
							, (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol)
							, case when (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol) = 'Si-Misma direccion' then direccion else direccionn end 
							, case when (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol) = 'Si-Misma direccion' then ciudad else ciudadd end 
							, case when (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol) = 'Si-Misma direccion' then comuna else comunaa end 
							, venta 
							, gestion_venta 
							, (CASE WHEN ((gestion_venta != '' or gestion_venta != null) )
								THEN (select distinct venta from fidelizacion.tipificacion where motivo = gestion_venta)
								WHEN (select count(cod_venta) from fidelizacion.ventas where rut_cliente = r.rut_cliente and idunico = r.ws_idunico) > 0
								THEN 'Venta'
								ELSE (select (case when (b.estado_telefonico = 'Volver a Llamar' or b.estado_telefonico = 'Aceptar Llamada') then 'No Venta' else b.venta end) 
									from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE WHEN ((gestion_venta != '' or gestion_venta != null) )
								THEN (select distinct motivo from fidelizacion.tipificacion where motivo = gestion_venta)
								WHEN (select count(cod_venta) from fidelizacion.ventas where rut_cliente = r.rut_cliente and idunico = r.ws_idunico) > 0
								THEN 'Venta'
								ELSE (select (case when (b.estado_telefonico = 'Aceptar Llamada') then '' --'Rechaza Venta'
										when (b.estado_telefonico = 'Volver a Llamar') then 'Volver a Llamar'
										else b.motivo end) 
									from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(cod_venta) 
									from fidelizacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico)
							   END) 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(cod_venta) 
									from fidelizacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico and estado_venta = 'OK')
							   END) 
							, (select a.telefono 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select b.contacto 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select b.estado_contacto 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select b.tipo_contacto 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1)
							, (select b.estado_telefonico 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select fmt_date(a.fecha,'dd/mm/yyyy') 
							  from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							  where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							  order by b.peso  
							  asc limit 1) 
							, (select a.hora 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (SELECT nombre_fantasia from usuarios where idusuario = r.ws_id_usuario) 
							FROM fidelizacion.cargas AS r
							WHERE r.ws_fecha_carga = '".$fecha."01' ORDER BY r.campana,fmt_date(ws_fecha_sistema, 'yyyymmdd'), ws_hora_sistema";
					$q = consultar($sql);
					if($q != "NO")
					{
						$i = 2;
						$data = explode("::",$q);
						foreach($data as $x)
						{
							if(!empty($x))
							{
								$data_2 = explode("||",$x);
								$objPHPExcel->getActiveSheet()->setCellValue("A".$i."", $data_2[0]);	$objPHPExcel->getActiveSheet()->setCellValue("B".$i."", $data_2[1]);
							    $objPHPExcel->getActiveSheet()->setCellValue("C".$i."", $data_2[2]);	$objPHPExcel->getActiveSheet()->setCellValue("D".$i."", $data_2[3]);
							    $objPHPExcel->getActiveSheet()->setCellValue("E".$i."", $data_2[4]);	$objPHPExcel->getActiveSheet()->setCellValue("F".$i."", $data_2[5]);
							    $objPHPExcel->getActiveSheet()->setCellValue("G".$i."", $data_2[6]);	$objPHPExcel->getActiveSheet()->setCellValue("H".$i."", $data_2[7]);
								$objPHPExcel->getActiveSheet()->setCellValue("I".$i."", $data_2[8]);	$objPHPExcel->getActiveSheet()->setCellValue("J".$i."", $data_2[9]);
							    $objPHPExcel->getActiveSheet()->setCellValue("K".$i."", $data_2[10]);	$objPHPExcel->getActiveSheet()->setCellValue("L".$i."", $data_2[11]);
							    $objPHPExcel->getActiveSheet()->setCellValue("M".$i."", $data_2[12]);	$objPHPExcel->getActiveSheet()->setCellValue("N".$i."", $data_2[13]);
							    $objPHPExcel->getActiveSheet()->setCellValue("O".$i."", $data_2[14]);	$objPHPExcel->getActiveSheet()->setCellValue("P".$i."", $data_2[15]);
								$objPHPExcel->getActiveSheet()->setCellValue("Q".$i."", $data_2[16]);	$objPHPExcel->getActiveSheet()->setCellValue("R".$i."", $data_2[17]);
							    $objPHPExcel->getActiveSheet()->setCellValue("S".$i."", $data_2[18]);	$objPHPExcel->getActiveSheet()->setCellValue("T".$i."", $data_2[19]);
							    $objPHPExcel->getActiveSheet()->setCellValue("U".$i."", $data_2[20]);	$objPHPExcel->getActiveSheet()->setCellValue("V".$i."", $data_2[21]);
							    $objPHPExcel->getActiveSheet()->setCellValue("W".$i."", $data_2[22]);	$objPHPExcel->getActiveSheet()->setCellValue("X".$i."", $data_2[23]);
								$objPHPExcel->getActiveSheet()->setCellValue("Y".$i."", $data_2[24]);	$objPHPExcel->getActiveSheet()->setCellValue("Z".$i."", $data_2[25]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AA".$i."", $data_2[26]);	$objPHPExcel->getActiveSheet()->setCellValue("AB".$i."", $data_2[27]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AC".$i."", $data_2[28]);	$objPHPExcel->getActiveSheet()->setCellValue("AD".$i."", $data_2[29]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AE".$i."", $data_2[30]);	$objPHPExcel->getActiveSheet()->setCellValue("AF".$i."", $data_2[31]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AG".$i."", $data_2[32]);	$objPHPExcel->getActiveSheet()->setCellValue("AH".$i."", $data_2[33]);
								$objPHPExcel->getActiveSheet()->setCellValue("AI".$i."", $data_2[34]);	$objPHPExcel->getActiveSheet()->setCellValue("AJ".$i."", $data_2[35]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AK".$i."", $data_2[36]);	$objPHPExcel->getActiveSheet()->setCellValue("AL".$i."", $data_2[37]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AM".$i."", $data_2[38]);	$objPHPExcel->getActiveSheet()->setCellValue("AN".$i."", $data_2[39]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AO".$i."", $data_2[40]);	$objPHPExcel->getActiveSheet()->setCellValue("AP".$i."", $data_2[41]);
								$objPHPExcel->getActiveSheet()->setCellValue("AQ".$i."", $data_2[42]);	$objPHPExcel->getActiveSheet()->setCellValue("AR".$i."", $data_2[43]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AS".$i."", $data_2[44]);	$objPHPExcel->getActiveSheet()->setCellValue("AT".$i."", $data_2[45]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AU".$i."", $data_2[46]);	$objPHPExcel->getActiveSheet()->setCellValue("AV".$i."", $data_2[47]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AW".$i."", $data_2[48]);	$objPHPExcel->getActiveSheet()->setCellValue("AX".$i."", $data_2[49]);
								$objPHPExcel->getActiveSheet()->setCellValue("AY".$i."", $data_2[50]);	$objPHPExcel->getActiveSheet()->setCellValue("AZ".$i."", $data_2[51]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BA".$i."", $data_2[52]);	$objPHPExcel->getActiveSheet()->setCellValue("BB".$i."", $data_2[53]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BC".$i."", $data_2[54]);	$objPHPExcel->getActiveSheet()->setCellValue("BD".$i."", $data_2[55]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BE".$i."", $data_2[56]);	$objPHPExcel->getActiveSheet()->setCellValue("BF".$i."", $data_2[57]);
								$objPHPExcel->getActiveSheet()->setCellValue("BG".$i."", $data_2[58]);	$objPHPExcel->getActiveSheet()->setCellValue("BH".$i."", $data_2[59]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BI".$i."", $data_2[60]);	$objPHPExcel->getActiveSheet()->setCellValue("BJ".$i."", $data_2[61]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BK".$i."", $data_2[62]);	$objPHPExcel->getActiveSheet()->setCellValue("BL".$i."", $data_2[63]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BM".$i."", $data_2[64]);	$objPHPExcel->getActiveSheet()->setCellValue("BN".$i."", $data_2[65]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BO".$i."", $data_2[66]);	$objPHPExcel->getActiveSheet()->setCellValue("BP".$i."", $data_2[67]);
								
							}
							$i += 1;
						}
					}


				    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				    // $objWriter->save('../resultantes/BDD_RESULTANTE_FIDELIZACION.xlsx');
				    $objWriter->save('/var/www/monitor_campaign/resultantes/BDD_RESULTANTE_FIDELIZACION.xlsx');
				    $callEndTime = microtime(true);
				    $callTime = $callEndTime - $callStartTime;
				break;
				case 1:
					$loteI = 0;
					$loteF = 0;
					$sql2 = "SELECT
							(SELECT min(lote) FROM recuperacion.cargas WHERE ws_fecha_carga LIKE '".$fecha."%' AND length(lote) = 4) as min
							,(SELECT max(lote) FROM recuperacion.cargas WHERE ws_fecha_carga LIKE '".$fecha."%' AND length(lote) = 4) as max";
					$q2 = consultar($sql2);
					if($q2 != "NO")
					{
						$data = explode("||", $q2);
						$loteI=$data[0];
						$loteF=$data[1];
					}

					$objPHPExcel = new PHPExcel();

					$objPHPExcel->getProperties()->setCreator("Victor Espinoza")
				                                 ->setLastModifiedBy("Victor Espinoza")
				                                 ->setTitle("RESULTANTE")
				                                 ->setSubject("RESULTANTE")
				                                 ->setDescription("RESULTANTE")
				                                 ->setKeywords("RESULTANTE")
				                                 ->setCategory("RESULTANTE");

				    $objPHPExcel->getActiveSheet()->getStyle("A1:CA1")->getFont()->getColor()->setRGB('FFFFFF');
				    $objPHPExcel->getActiveSheet()->getStyle('A1:CA1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0068BF');

				    $objPHPExcel->getActiveSheet()->setCellValue("A1", "CAMPAÑA");						$objPHPExcel->getActiveSheet()->setCellValue("B1", "RUT CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("C1", "DV CLIENTE");					$objPHPExcel->getActiveSheet()->setCellValue("D1", "NOMBRE CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("E1", "DIRECCIÓN");					$objPHPExcel->getActiveSheet()->setCellValue("F1", "CIUDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("G1", "COMUNA");						$objPHPExcel->getActiveSheet()->setCellValue("H1", "CORREO ELECTRONICO");
					$objPHPExcel->getActiveSheet()->setCellValue("I1", "NRO SEGURO");					$objPHPExcel->getActiveSheet()->setCellValue("J1", "RAMO");
				    $objPHPExcel->getActiveSheet()->setCellValue("K1", "TIPO PRODUCTO");				$objPHPExcel->getActiveSheet()->setCellValue("L1", "PLAN PRODUCTO");
				    $objPHPExcel->getActiveSheet()->setCellValue("M1", "SEXO");							$objPHPExcel->getActiveSheet()->setCellValue("N1", "ESTADO CIVIL");
				    $objPHPExcel->getActiveSheet()->setCellValue("O1", "FECHA NAC CLIENTE");			$objPHPExcel->getActiveSheet()->setCellValue("P1", "FORMA DE PAGO");
					$objPHPExcel->getActiveSheet()->setCellValue("Q1", "MEDIO DE PAGO");				$objPHPExcel->getActiveSheet()->setCellValue("R1", "BANCO PAGO");
				    $objPHPExcel->getActiveSheet()->setCellValue("S1", "ESTADO MEDIO PAGO");			$objPHPExcel->getActiveSheet()->setCellValue("T1", "CUOTAS MOROSAS");
				    $objPHPExcel->getActiveSheet()->setCellValue("U1", "FECHA CUOTA MOROSA");			$objPHPExcel->getActiveSheet()->setCellValue("V1", "MOTIVO");
				    $objPHPExcel->getActiveSheet()->setCellValue("W1", "FECHA CARTA");					$objPHPExcel->getActiveSheet()->setCellValue("X1", "PONDERADOR");
					$objPHPExcel->getActiveSheet()->setCellValue("Y1", "FECHA GENERACION LOTE");		$objPHPExcel->getActiveSheet()->setCellValue("Z1", "FECHA INICIO SEGURO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AA1", "FECHA TERMINO SEGURO");		$objPHPExcel->getActiveSheet()->setCellValue("AB1", "CODIGO CIA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AC1", "MONTO CUOTA");					$objPHPExcel->getActiveSheet()->setCellValue("AD1", "MONEDA CUOTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AE1", "RUT ASEGURADO");				$objPHPExcel->getActiveSheet()->setCellValue("AF1", "DV ASEGURADO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AG1", "NOMBRE ASEGURADO");			$objPHPExcel->getActiveSheet()->setCellValue("AH1", "APELLIDO PATERNO ASEGURADO");
					$objPHPExcel->getActiveSheet()->setCellValue("AI1", "APELLIDO PATERNO ASEGURADO");	$objPHPExcel->getActiveSheet()->setCellValue("AJ1", "FECHA NAC ASEGURADO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AK1", "EDAD ASEGURADO");				$objPHPExcel->getActiveSheet()->setCellValue("AL1", "CANAL VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AM1", "NOMBRE EJECUTIVO");			$objPHPExcel->getActiveSheet()->setCellValue("AN1", "NOMBRE OFICINA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AO1", "NACIONALIDAD CLIENTE");		$objPHPExcel->getActiveSheet()->setCellValue("AP1", "SEGMENTO CLIENTE");
					$objPHPExcel->getActiveSheet()->setCellValue("AQ1", "ORIGEN CLIENTE");				$objPHPExcel->getActiveSheet()->setCellValue("AR1", "TOTAL CUOTAS");
				    $objPHPExcel->getActiveSheet()->setCellValue("AS1", "POLIZA");						$objPHPExcel->getActiveSheet()->setCellValue("AT1", "CUOTA MAS MOROSA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AU1", "MOTIVO ELIMINACION");			$objPHPExcel->getActiveSheet()->setCellValue("AV1", "ID UNICO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AW1", "FECHA CARGA");					$objPHPExcel->getActiveSheet()->setCellValue("AX1", "ESTADO REGISTRO");
					$objPHPExcel->getActiveSheet()->setCellValue("AY1", "FECHA ULTIMA GESTION");		$objPHPExcel->getActiveSheet()->setCellValue("AZ1", "HORA ULTIMA GESTION");
				    $objPHPExcel->getActiveSheet()->setCellValue("BA1", "NUM INTENTOS");				$objPHPExcel->getActiveSheet()->setCellValue("BB1", "DURACION ULTIMA GESTION");
				    $objPHPExcel->getActiveSheet()->setCellValue("BC1", "EJECUTIVO CALIDAD");			$objPHPExcel->getActiveSheet()->setCellValue("BD1", "ESTADO CALIDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("BE1", "RECUPERADO TABLA");			$objPHPExcel->getActiveSheet()->setCellValue("BF1", "RECUPERADO");
					$objPHPExcel->getActiveSheet()->setCellValue("BG1", "CAMBIO MP");					$objPHPExcel->getActiveSheet()->setCellValue("BH1", "BANCO");
				    $objPHPExcel->getActiveSheet()->setCellValue("BI1", "CUENTA");						$objPHPExcel->getActiveSheet()->setCellValue("BJ1", "COPIA POLIZA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BK1", "DIR ENVIO");					$objPHPExcel->getActiveSheet()->setCellValue("BL1", "CIUDAD ENVIO");
				    $objPHPExcel->getActiveSheet()->setCellValue("BM1", "COMUNA ENVIO");				$objPHPExcel->getActiveSheet()->setCellValue("BN1", "VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BO1", "MOTIVO NO VENTA");				$objPHPExcel->getActiveSheet()->setCellValue("BP1", "CANT VENTAS");
				    $objPHPExcel->getActiveSheet()->setCellValue("BQ1", "CANT VENTAS OK");				$objPHPExcel->getActiveSheet()->setCellValue("BR1", "FONO GESTION PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BS1", "CONTACTO PRINCIPAL");			$objPHPExcel->getActiveSheet()->setCellValue("BT1", "TIPO CONTACTO PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BU1", "ESTADO TELEFONICO PRINCIPAL");	$objPHPExcel->getActiveSheet()->setCellValue("BV1", "FECHA GESTION PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BW1", "HORA GESTION PRINCIPAL");		$objPHPExcel->getActiveSheet()->setCellValue("BX1", "EJECUTIVO GESTOR");
				    $objPHPExcel->getActiveSheet()->setCellValue("BY1", "MOTIVO NO VENTA/ELIMINACION");	$objPHPExcel->getActiveSheet()->setCellValue("BZ1", "ALERTA MP");
				    $objPHPExcel->getActiveSheet()->setCellValue("CA1", "MOTIVO ELIMINACION MP");			
					
				    $sql = "SELECT 
							  r.lote 
							, r.rut_cliente 
							, r.dv_cliente 
							, r.nombre_completo||' '||r.apellido_paterno_titular||' '||r.apellido_materno_titular 
							, r.direccion 
							, r.ciudad 
							, r.comuna 
							, r.registra_correo 
							, s.nro_seguro, s.ramo, s.tipo_producto, s.plan_producto, s.sexo, s.estado_civil, s.fecha_nacimiento_cliente, s.forma_de_pago, s.medio_de_pago, s.banco_pago
							, s.estado_medio_pago, s.cuotas_morosas, s.fecha_cuota_morosa, s.motivo, s.fecha_carta, s.ponderador, s.fecha_generacion_lote, s.fecha_inicio_seguro, s.fecha_termino_seguro
							, s.codigo_cia, s.monto_cuota, s.moneda_cuota, s.rut_asegurado, s.dv_asegurado, s.nombre_asegurado, s.apellido_paterno_asegurado, s.apellido_materno_asegurado
							, s.fecha_nacimiento_asegurado, s.edad_asegurado, s.canal_de_venta, s.nombre_ejecutivo, s.nombre_oficina, s.nacionalidad_cliente, s.segmento_cliente, s.origen_cliente
							, s.total_cuotas, s.poliza, s.cuota_mas_morosa, s.motivo_eliminacion
							, r.ws_idunico 
							, r.ws_fecha_carga 
							, r.ws_estado_registro 
							, r.ws_fecha_sistema 
							, r.ws_hora_sistema 
							, r.ws_num_intentos 
							, r.ws_tmo_script
							,(SELECT nombre_fantasia FROM usuarios WHERE idusuario = s.id_calidad) 
							, s.estado_calidad 
							, s.recupera 
							, (case when ws_fecha_sistema is null then ''
							        when (s.recupera = '' or s.recupera = 'No' or s.recupera is null) then 'No Retractado' 
							        when (s.recupera = 'Si') then 'Retractado' else s.recupera
							   end) 
							, (SELECT estado FROM retencion.a_cambio_mp where cod = s.cambio_mp) 
							, s.banco 
							, s.numero_producto 
							, s.copia_pol 
							, case when copia_pol = 'Si-Misma direccion' then r.direccion else s.direccion end 
							, case when copia_pol = 'Si-Misma direccion' then r.ciudad else s.ciudad end 
							, case when copia_pol = 'Si-Misma direccion' then r.comuna else s.comuna end 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN ''
								WHEN (select count(cod_venta) from recuperacion.ventas where rut_cliente = r.rut_cliente and idunico = r.ws_idunico) > 0
								THEN 'Venta'
								ELSE 'No Venta'
							   END) 
							, s.motivo_eliminacion   
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(distinct cod_venta) 
									from recuperacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico)
							   END) 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(distinct cod_venta) 
									from recuperacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico and estado_venta = 'OK')
							   END) 
							, (select a.telefono 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select b.contacto_r 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select b.tipo_contacto_r 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select b.estado_telefonico 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select fmt_date(a.fecha,'dd/mm/yyyy') 
							  from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							  where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							  order by b.peso  
							  asc limit 1) 
							, (select a.hora 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1)  
							, (SELECT nombre_fantasia from usuarios where idusuario = r.ws_id_usuario) 
							, s.motivo_eliminacion 
							, r.obs_alerta 
							, r.ap_motivo_eliminacion_obs 
							FROM recuperacion.cargas AS r, recuperacion.seguros AS s
							WHERE r.lote between ".$loteI." and ".$loteF." 
							AND r.lote = s.lote
							AND r.rut_cliente = s.rut_cliente
							order by fmt_date(ws_fecha_sistema, 'yyyymmdd'), ws_hora_sistema;";
					$q = consultar($sql);
					if($q != "NO")
					{
						$i = 2;
						$data = explode("::",$q);
						foreach($data as $x)
						{
							if(!empty($x))
							{
								$data_2 = explode("||",$x);
								$objPHPExcel->getActiveSheet()->setCellValue("A".$i."", $data_2[0]);	$objPHPExcel->getActiveSheet()->setCellValue("B".$i."", $data_2[1]);
							    $objPHPExcel->getActiveSheet()->setCellValue("C".$i."", $data_2[2]);	$objPHPExcel->getActiveSheet()->setCellValue("D".$i."", $data_2[3]);
							    $objPHPExcel->getActiveSheet()->setCellValue("E".$i."", $data_2[4]);	$objPHPExcel->getActiveSheet()->setCellValue("F".$i."", $data_2[5]);
							    $objPHPExcel->getActiveSheet()->setCellValue("G".$i."", $data_2[6]);	$objPHPExcel->getActiveSheet()->setCellValue("H".$i."", $data_2[7]);
								$objPHPExcel->getActiveSheet()->setCellValue("I".$i."", $data_2[8]);	$objPHPExcel->getActiveSheet()->setCellValue("J".$i."", $data_2[9]);
							    $objPHPExcel->getActiveSheet()->setCellValue("K".$i."", $data_2[10]);	$objPHPExcel->getActiveSheet()->setCellValue("L".$i."", $data_2[11]);
							    $objPHPExcel->getActiveSheet()->setCellValue("M".$i."", $data_2[12]);	$objPHPExcel->getActiveSheet()->setCellValue("N".$i."", $data_2[13]);
							    $objPHPExcel->getActiveSheet()->setCellValue("O".$i."", $data_2[14]);	$objPHPExcel->getActiveSheet()->setCellValue("P".$i."", $data_2[15]);
								$objPHPExcel->getActiveSheet()->setCellValue("Q".$i."", $data_2[16]);	$objPHPExcel->getActiveSheet()->setCellValue("R".$i."", $data_2[17]);
							    $objPHPExcel->getActiveSheet()->setCellValue("S".$i."", $data_2[18]);	$objPHPExcel->getActiveSheet()->setCellValue("T".$i."", $data_2[19]);
							    $objPHPExcel->getActiveSheet()->setCellValue("U".$i."", $data_2[20]);	$objPHPExcel->getActiveSheet()->setCellValue("V".$i."", $data_2[21]);
							    $objPHPExcel->getActiveSheet()->setCellValue("W".$i."", $data_2[22]);	$objPHPExcel->getActiveSheet()->setCellValue("X".$i."", $data_2[23]);
								$objPHPExcel->getActiveSheet()->setCellValue("Y".$i."", $data_2[24]);	$objPHPExcel->getActiveSheet()->setCellValue("Z".$i."", $data_2[25]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AA".$i."", $data_2[26]);	$objPHPExcel->getActiveSheet()->setCellValue("AB".$i."", $data_2[27]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AC".$i."", $data_2[28]);	$objPHPExcel->getActiveSheet()->setCellValue("AD".$i."", $data_2[29]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AE".$i."", $data_2[30]);	$objPHPExcel->getActiveSheet()->setCellValue("AF".$i."", $data_2[31]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AG".$i."", $data_2[32]);	$objPHPExcel->getActiveSheet()->setCellValue("AH".$i."", $data_2[33]);
								$objPHPExcel->getActiveSheet()->setCellValue("AI".$i."", $data_2[34]);	$objPHPExcel->getActiveSheet()->setCellValue("AJ".$i."", $data_2[35]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AK".$i."", $data_2[36]);	$objPHPExcel->getActiveSheet()->setCellValue("AL".$i."", $data_2[37]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AM".$i."", $data_2[38]);	$objPHPExcel->getActiveSheet()->setCellValue("AN".$i."", $data_2[39]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AO".$i."", $data_2[40]);	$objPHPExcel->getActiveSheet()->setCellValue("AP".$i."", $data_2[41]);
								$objPHPExcel->getActiveSheet()->setCellValue("AQ".$i."", $data_2[42]);	$objPHPExcel->getActiveSheet()->setCellValue("AR".$i."", $data_2[43]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AS".$i."", $data_2[44]);	$objPHPExcel->getActiveSheet()->setCellValue("AT".$i."", $data_2[45]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AU".$i."", $data_2[46]);	$objPHPExcel->getActiveSheet()->setCellValue("AV".$i."", $data_2[47]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AW".$i."", $data_2[48]);	$objPHPExcel->getActiveSheet()->setCellValue("AX".$i."", $data_2[49]);
								$objPHPExcel->getActiveSheet()->setCellValue("AY".$i."", $data_2[50]);	$objPHPExcel->getActiveSheet()->setCellValue("AZ".$i."", $data_2[51]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BA".$i."", $data_2[52]);	$objPHPExcel->getActiveSheet()->setCellValue("BB".$i."", $data_2[53]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BC".$i."", $data_2[54]);	$objPHPExcel->getActiveSheet()->setCellValue("BD".$i."", $data_2[55]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BE".$i."", $data_2[56]);	$objPHPExcel->getActiveSheet()->setCellValue("BF".$i."", $data_2[57]);
								$objPHPExcel->getActiveSheet()->setCellValue("BG".$i."", $data_2[58]);	$objPHPExcel->getActiveSheet()->setCellValue("BH".$i."", $data_2[59]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BI".$i."", $data_2[60]);	$objPHPExcel->getActiveSheet()->setCellValue("BJ".$i."", $data_2[61]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BK".$i."", $data_2[62]);	$objPHPExcel->getActiveSheet()->setCellValue("BL".$i."", $data_2[63]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BM".$i."", $data_2[64]);	$objPHPExcel->getActiveSheet()->setCellValue("BN".$i."", $data_2[65]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BO".$i."", $data_2[66]);	$objPHPExcel->getActiveSheet()->setCellValue("BP".$i."", $data_2[67]);
								
							}
							$i += 1;
						}
					}


				    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				    // $objWriter->save('../resultantes/BDD_RESULTANTE_RECUPERACION.xlsx');
				    $objWriter->save('/var/www/monitor_campaign/resultantes/BDD_RESULTANTE_RECUPERACION.xlsx');
				    $callEndTime = microtime(true);
				    $callTime = $callEndTime - $callStartTime;
				break;
				case 2:
				break;
			}
		break;
		default:
			switch(intval($id)) 
			{
				case 0:
					$objPHPExcel = new PHPExcel();

					$objPHPExcel->getProperties()->setCreator("Victor Espinoza")
				                                 ->setLastModifiedBy("Victor Espinoza")
				                                 ->setTitle("RESULTANTES")
				                                 ->setSubject("RESULTANTES")
				                                 ->setDescription("RESULTANTES")
				                                 ->setKeywords("RESULTANTES")
				                                 ->setCategory("RESULTANTES");

				    $objPHPExcel->getActiveSheet()->getStyle("A1:BP1")->getFont()->getColor()->setRGB('FFFFFF');
				    $objPHPExcel->getActiveSheet()->getStyle('A1:BP1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0068BF');

				    $objPHPExcel->getActiveSheet()->setCellValue("A1", "CAMPAÑA");						$objPHPExcel->getActiveSheet()->setCellValue("B1", "RUT CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("C1", "DV CLIENTE");					$objPHPExcel->getActiveSheet()->setCellValue("D1", "NOMBRE CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("E1", "DIRECCIÓN");					$objPHPExcel->getActiveSheet()->setCellValue("F1", "CIUDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("G1", "COMUNA");						$objPHPExcel->getActiveSheet()->setCellValue("H1", "FECHA DE NAC");
					$objPHPExcel->getActiveSheet()->setCellValue("I1", "EDAD");							$objPHPExcel->getActiveSheet()->setCellValue("J1", "SEXO");
				    $objPHPExcel->getActiveSheet()->setCellValue("K1", "SEGMENTO");						$objPHPExcel->getActiveSheet()->setCellValue("L1", "EDO. CIVIL");
				    $objPHPExcel->getActiveSheet()->setCellValue("M1", "IND FUNCIONARIO");				$objPHPExcel->getActiveSheet()->setCellValue("N1", "NRO SEGURO");
				    $objPHPExcel->getActiveSheet()->setCellValue("O1", "FECHA INICIO SEGURO");			$objPHPExcel->getActiveSheet()->setCellValue("P1", "FECHA TERMINO SEGURO");
					$objPHPExcel->getActiveSheet()->setCellValue("Q1", "RAMO");							$objPHPExcel->getActiveSheet()->setCellValue("R1", "TIPO PRODUCTO");
				    $objPHPExcel->getActiveSheet()->setCellValue("S1", "PLAN PRODUCTO");				$objPHPExcel->getActiveSheet()->setCellValue("T1", "CANAL VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("U1", "PRIMA ANUAL");					$objPHPExcel->getActiveSheet()->setCellValue("V1", "MONEDA");
				    $objPHPExcel->getActiveSheet()->setCellValue("W1", "CUOTAS");						$objPHPExcel->getActiveSheet()->setCellValue("X1", "FORMA DE PAGO");
					$objPHPExcel->getActiveSheet()->setCellValue("Y1", "MEDIO DE PAGO");				$objPHPExcel->getActiveSheet()->setCellValue("Z1", "MONTO CUOTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AA1", "POLIZA INDIVIDUAL");			$objPHPExcel->getActiveSheet()->setCellValue("AB1", "CODIGO CIA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AC1", "MARCA VENTA");					$objPHPExcel->getActiveSheet()->setCellValue("AD1", "ID UNICO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AE1", "MES");							$objPHPExcel->getActiveSheet()->setCellValue("AF1", "FECHA CARGA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AG1", "ESTADO REGISTRO");				$objPHPExcel->getActiveSheet()->setCellValue("AH1", "FECHA ULTIMA GESTION");
					$objPHPExcel->getActiveSheet()->setCellValue("AI1", "HORA ULTIMA GESTION");			$objPHPExcel->getActiveSheet()->setCellValue("AJ1", "NUM INTENTOS");
				    $objPHPExcel->getActiveSheet()->setCellValue("AK1", "DURACION ULTIMA GESTION");		$objPHPExcel->getActiveSheet()->setCellValue("AL1", "EJECUTIVO CALIDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("AM1", "ESTADO CALIDAD");				$objPHPExcel->getActiveSheet()->setCellValue("AN1", "FIDELIZADO TABLA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AO1", "GESTION FIDELIZACION");		$objPHPExcel->getActiveSheet()->setCellValue("AP1", "FECHA FIDELIZACION");
					$objPHPExcel->getActiveSheet()->setCellValue("AQ1", "FIDELIZADO");					$objPHPExcel->getActiveSheet()->setCellValue("AR1", "DETALLE");
				    $objPHPExcel->getActiveSheet()->setCellValue("AS1", "MOTIVO");						$objPHPExcel->getActiveSheet()->setCellValue("AT1", "CAMNIO MP");
				    $objPHPExcel->getActiveSheet()->setCellValue("AU1", "BANCO");						$objPHPExcel->getActiveSheet()->setCellValue("AV1", "CUENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AW1", "COPIA POLIZA");				$objPHPExcel->getActiveSheet()->setCellValue("AX1", "DIR ENVIO");
					$objPHPExcel->getActiveSheet()->setCellValue("AY1", "CIUDAD ENVIO");				$objPHPExcel->getActiveSheet()->setCellValue("AZ1", "COMUNA ENVIO");
				    $objPHPExcel->getActiveSheet()->setCellValue("BA1", "VENTA TABLA");					$objPHPExcel->getActiveSheet()->setCellValue("BB1", "GESTION DE VENTA TABLA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BC1", "VENTA");						$objPHPExcel->getActiveSheet()->setCellValue("BD1", "GESTION DE VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BE1", "CANT VENTAS");					$objPHPExcel->getActiveSheet()->setCellValue("BF1", "CANT VENTAS OK");
					$objPHPExcel->getActiveSheet()->setCellValue("BG1", "FONO GESTION PRINCIPAL");		$objPHPExcel->getActiveSheet()->setCellValue("BH1", "CONTACTO PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BI1", "ESTADO CONTACTO PRINCIPAL");	$objPHPExcel->getActiveSheet()->setCellValue("BJ1", "TIPO CONTACTO PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BK1", "ESTADO TELEFONICO PRINCIPAL");	$objPHPExcel->getActiveSheet()->setCellValue("BL1", "FECHA GESTION PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BM1", "HORA GESTION PRINCIPAL");		$objPHPExcel->getActiveSheet()->setCellValue("BN1", "EJECUTIVO GESTOR");
				    $objPHPExcel->getActiveSheet()->setCellValue("BO1", "CORREO ELECTRONICO");			$objPHPExcel->getActiveSheet()->setCellValue("BP1", "OBSERVACION GESTION");
					
				    $sql = "SELECT 
							  campana 
							, marca_bbdd 
							, rut_cliente 
							, dv_cliente 
							, split_part(cltbas_nombre,'/',3)||' '||split_part(cltbas_nombre,'/',1)||' '||split_part(cltbas_nombre,'/',2) 
							, direccion 
							, ciudad 
							, comuna 
							, r.registra_correo 
							, fec_nacim, edad, sexo, segmento, estado_civil
							, ind_funcionario, nro_seguro, fecha_inicio_seguro
							, fecha_termino_seguro, ramo, tipo_producto, plan_producto, canal_venta
							, prima_anual, moneda, cuotas, forma_de_pago, medio_de_pago, monto_cuota
							, poliza_indiv, codigo_cia, marca_venta_1
							, ws_idunico 
							, ws_campagna 
							, ws_fecha_carga 
							, ws_estado_registro 
							, ws_fecha_sistema 
							, ws_hora_sistema 
							, ws_num_intentos 
							, ws_tmo_script 
							,(SELECT nombre_fantasia FROM usuarios WHERE idusuario = id_calidad) 
							, estado_calidad 
							, fidelizado 
							, gestion_fidelizacion 
							, fecha_fidelizacion 
							, (CASE WHEN ((gestion_fidelizacion != '' or gestion_fidelizacion != null) )
								THEN (select distinct fidelizacion from fidelizacion.tipificacion where conforme = gestion_fidelizacion)
								ELSE (select (case when b.estado_telefonico = 'Volver a Llamar' then 'No Fidelizado' else b.fidelizacion end) from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE WHEN ((gestion_fidelizacion != '' or gestion_fidelizacion != null) )
								THEN (select distinct detalle from fidelizacion.tipificacion where conforme = gestion_fidelizacion)
								ELSE (select (case when b.estado_telefonico = 'Volver a Llamar' then 'Volver a Llamar' else b.detalle end) from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE 
								WHEN ((gestion_fidelizacion != '' or gestion_fidelizacion != null) and gestion_fidelizacion != 'Si')
								  THEN (select distinct motivo from fidelizacion.tipificacion where conforme = gestion_fidelizacion)
								WHEN gestion_fidelizacion = 'Si'
								  THEN 'Fidelizado OK'
								ELSE ''
							   END) 
							, (SELECT estado  FROM retencion.a_cambio_mp where cod = cambio_mp) 
							, banco 
							, numero_producto 
							, (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol)
							, case when (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol) = 'Si-Misma direccion' then direccion else direccionn end 
							, case when (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol) = 'Si-Misma direccion' then ciudad else ciudadd end 
							, case when (SELECT estado  FROM retencion.a_copia_pol where cod = copia_pol) = 'Si-Misma direccion' then comuna else comunaa end 
							, venta 
							, gestion_venta 
							, (CASE WHEN ((gestion_venta != '' or gestion_venta != null) )
								THEN (select distinct venta from fidelizacion.tipificacion where motivo = gestion_venta)
								WHEN (select count(cod_venta) from fidelizacion.ventas where rut_cliente = r.rut_cliente and idunico = r.ws_idunico) > 0
								THEN 'Venta'
								ELSE (select (case when (b.estado_telefonico = 'Volver a Llamar' or b.estado_telefonico = 'Aceptar Llamada') then 'No Venta' else b.venta end) 
									from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE WHEN ((gestion_venta != '' or gestion_venta != null) )
								THEN (select distinct motivo from fidelizacion.tipificacion where motivo = gestion_venta)
								WHEN (select count(cod_venta) from fidelizacion.ventas where rut_cliente = r.rut_cliente and idunico = r.ws_idunico) > 0
								THEN 'Venta'
								ELSE (select (case when (b.estado_telefonico = 'Aceptar Llamada') then '' --'Rechaza Venta'
										when (b.estado_telefonico = 'Volver a Llamar') then 'Volver a Llamar'
										else b.motivo end) 
									from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
									where a.idunico = r.ws_idunico 
									and a.gestion = b.estado_telefonico 
									order by b.peso asc limit 1)
							   END) 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(cod_venta) 
									from fidelizacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico)
							   END) 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(cod_venta) 
									from fidelizacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico and estado_venta = 'OK')
							   END) 
							, (select a.telefono 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select b.contacto 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select b.estado_contacto 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select b.tipo_contacto 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1)
							, (select b.estado_telefonico 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (select fmt_date(a.fecha,'dd/mm/yyyy') 
							  from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							  where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							  order by b.peso  
							  asc limit 1) 
							, (select a.hora 
							   from fidelizacion.gestiones_telefonos as a, fidelizacion.tipificacion as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_telefonico
							   order by b.peso
							   asc limit 1) 
							, (SELECT nombre_fantasia from usuarios where idusuario = r.ws_id_usuario) 
							FROM fidelizacion.cargas AS r
							WHERE campana in ('".$campana."') ORDER BY r.campana,fmt_date(ws_fecha_sistema, 'yyyymmdd'), ws_hora_sistema";
					$q = consultar($sql);
					// $ob->alert($q);
					if($q != "NO")
					{
						$i = 2;
						$data = explode("::",$q);
						foreach($data as $x)
						{
							if(!empty($x))
							{
								$data_2 = explode("||",$x);
								$objPHPExcel->getActiveSheet()->setCellValue("A".$i."", $data_2[0]);	$objPHPExcel->getActiveSheet()->setCellValue("B".$i."", $data_2[1]);
							    $objPHPExcel->getActiveSheet()->setCellValue("C".$i."", $data_2[2]);	$objPHPExcel->getActiveSheet()->setCellValue("D".$i."", $data_2[3]);
							    $objPHPExcel->getActiveSheet()->setCellValue("E".$i."", $data_2[4]);	$objPHPExcel->getActiveSheet()->setCellValue("F".$i."", $data_2[5]);
							    $objPHPExcel->getActiveSheet()->setCellValue("G".$i."", $data_2[6]);	$objPHPExcel->getActiveSheet()->setCellValue("H".$i."", $data_2[7]);
								$objPHPExcel->getActiveSheet()->setCellValue("I".$i."", $data_2[8]);	$objPHPExcel->getActiveSheet()->setCellValue("J".$i."", $data_2[9]);
							    $objPHPExcel->getActiveSheet()->setCellValue("K".$i."", $data_2[10]);	$objPHPExcel->getActiveSheet()->setCellValue("L".$i."", $data_2[11]);
							    $objPHPExcel->getActiveSheet()->setCellValue("M".$i."", $data_2[12]);	$objPHPExcel->getActiveSheet()->setCellValue("N".$i."", $data_2[13]);
							    $objPHPExcel->getActiveSheet()->setCellValue("O".$i."", $data_2[14]);	$objPHPExcel->getActiveSheet()->setCellValue("P".$i."", $data_2[15]);
								$objPHPExcel->getActiveSheet()->setCellValue("Q".$i."", $data_2[16]);	$objPHPExcel->getActiveSheet()->setCellValue("R".$i."", $data_2[17]);
							    $objPHPExcel->getActiveSheet()->setCellValue("S".$i."", $data_2[18]);	$objPHPExcel->getActiveSheet()->setCellValue("T".$i."", $data_2[19]);
							    $objPHPExcel->getActiveSheet()->setCellValue("U".$i."", $data_2[20]);	$objPHPExcel->getActiveSheet()->setCellValue("V".$i."", $data_2[21]);
							    $objPHPExcel->getActiveSheet()->setCellValue("W".$i."", $data_2[22]);	$objPHPExcel->getActiveSheet()->setCellValue("X".$i."", $data_2[23]);
								$objPHPExcel->getActiveSheet()->setCellValue("Y".$i."", $data_2[24]);	$objPHPExcel->getActiveSheet()->setCellValue("Z".$i."", $data_2[25]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AA".$i."", $data_2[26]);	$objPHPExcel->getActiveSheet()->setCellValue("AB".$i."", $data_2[27]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AC".$i."", $data_2[28]);	$objPHPExcel->getActiveSheet()->setCellValue("AD".$i."", $data_2[29]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AE".$i."", $data_2[30]);	$objPHPExcel->getActiveSheet()->setCellValue("AF".$i."", $data_2[31]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AG".$i."", $data_2[32]);	$objPHPExcel->getActiveSheet()->setCellValue("AH".$i."", $data_2[33]);
								$objPHPExcel->getActiveSheet()->setCellValue("AI".$i."", $data_2[34]);	$objPHPExcel->getActiveSheet()->setCellValue("AJ".$i."", $data_2[35]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AK".$i."", $data_2[36]);	$objPHPExcel->getActiveSheet()->setCellValue("AL".$i."", $data_2[37]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AM".$i."", $data_2[38]);	$objPHPExcel->getActiveSheet()->setCellValue("AN".$i."", $data_2[39]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AO".$i."", $data_2[40]);	$objPHPExcel->getActiveSheet()->setCellValue("AP".$i."", $data_2[41]);
								$objPHPExcel->getActiveSheet()->setCellValue("AQ".$i."", $data_2[42]);	$objPHPExcel->getActiveSheet()->setCellValue("AR".$i."", $data_2[43]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AS".$i."", $data_2[44]);	$objPHPExcel->getActiveSheet()->setCellValue("AT".$i."", $data_2[45]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AU".$i."", $data_2[46]);	$objPHPExcel->getActiveSheet()->setCellValue("AV".$i."", $data_2[47]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AW".$i."", $data_2[48]);	$objPHPExcel->getActiveSheet()->setCellValue("AX".$i."", $data_2[49]);
								$objPHPExcel->getActiveSheet()->setCellValue("AY".$i."", $data_2[50]);	$objPHPExcel->getActiveSheet()->setCellValue("AZ".$i."", $data_2[51]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BA".$i."", $data_2[52]);	$objPHPExcel->getActiveSheet()->setCellValue("BB".$i."", $data_2[53]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BC".$i."", $data_2[54]);	$objPHPExcel->getActiveSheet()->setCellValue("BD".$i."", $data_2[55]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BE".$i."", $data_2[56]);	$objPHPExcel->getActiveSheet()->setCellValue("BF".$i."", $data_2[57]);
								$objPHPExcel->getActiveSheet()->setCellValue("BG".$i."", $data_2[58]);	$objPHPExcel->getActiveSheet()->setCellValue("BH".$i."", $data_2[59]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BI".$i."", $data_2[60]);	$objPHPExcel->getActiveSheet()->setCellValue("BJ".$i."", $data_2[61]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BK".$i."", $data_2[62]);	$objPHPExcel->getActiveSheet()->setCellValue("BL".$i."", $data_2[63]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BM".$i."", $data_2[64]);	$objPHPExcel->getActiveSheet()->setCellValue("BN".$i."", $data_2[65]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BO".$i."", $data_2[66]);	$objPHPExcel->getActiveSheet()->setCellValue("BP".$i."", $data_2[67]);
								
							}
							$i += 1;
						}
					}


				    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				    // $objWriter->save('../resultantes/BDD_RESULTANTE_FIDELIZACION.xlsx');
				    $objWriter->save('/var/www/monitor_campaign/resultantes/BDD_RESULTANTE_FIDELIZACION.xlsx');
				    $callEndTime = microtime(true);
				    $callTime = $callEndTime - $callStartTime;
				break;
				case 1:
					$loteI=$campana;
					$loteF=$campana;
					$objPHPExcel = new PHPExcel();

					$objPHPExcel->getProperties()->setCreator("Victor Espinoza")
				                                 ->setLastModifiedBy("Victor Espinoza")
				                                 ->setTitle("RESULTANTE")
				                                 ->setSubject("RESULTANTE")
				                                 ->setDescription("RESULTANTE")
				                                 ->setKeywords("RESULTANTE")
				                                 ->setCategory("RESULTANTE");

				    $objPHPExcel->getActiveSheet()->getStyle("A1:CA1")->getFont()->getColor()->setRGB('FFFFFF');
				    $objPHPExcel->getActiveSheet()->getStyle('A1:CA1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0068BF');

				    $objPHPExcel->getActiveSheet()->setCellValue("A1", "CAMPAÑA");						$objPHPExcel->getActiveSheet()->setCellValue("B1", "RUT CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("C1", "DV CLIENTE");					$objPHPExcel->getActiveSheet()->setCellValue("D1", "NOMBRE CLIENTE");
				    $objPHPExcel->getActiveSheet()->setCellValue("E1", "DIRECCIÓN");					$objPHPExcel->getActiveSheet()->setCellValue("F1", "CIUDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("G1", "COMUNA");						$objPHPExcel->getActiveSheet()->setCellValue("H1", "CORREO ELECTRONICO");
					$objPHPExcel->getActiveSheet()->setCellValue("I1", "NRO SEGURO");					$objPHPExcel->getActiveSheet()->setCellValue("J1", "RAMO");
				    $objPHPExcel->getActiveSheet()->setCellValue("K1", "TIPO PRODUCTO");				$objPHPExcel->getActiveSheet()->setCellValue("L1", "PLAN PRODUCTO");
				    $objPHPExcel->getActiveSheet()->setCellValue("M1", "SEXO");							$objPHPExcel->getActiveSheet()->setCellValue("N1", "ESTADO CIVIL");
				    $objPHPExcel->getActiveSheet()->setCellValue("O1", "FECHA NAC CLIENTE");			$objPHPExcel->getActiveSheet()->setCellValue("P1", "FORMA DE PAGO");
					$objPHPExcel->getActiveSheet()->setCellValue("Q1", "MEDIO DE PAGO");				$objPHPExcel->getActiveSheet()->setCellValue("R1", "BANCO PAGO");
				    $objPHPExcel->getActiveSheet()->setCellValue("S1", "ESTADO MEDIO PAGO");			$objPHPExcel->getActiveSheet()->setCellValue("T1", "CUOTAS MOROSAS");
				    $objPHPExcel->getActiveSheet()->setCellValue("U1", "FECHA CUOTA MOROSA");			$objPHPExcel->getActiveSheet()->setCellValue("V1", "MOTIVO");
				    $objPHPExcel->getActiveSheet()->setCellValue("W1", "FECHA CARTA");					$objPHPExcel->getActiveSheet()->setCellValue("X1", "PONDERADOR");
					$objPHPExcel->getActiveSheet()->setCellValue("Y1", "FECHA GENERACION LOTE");		$objPHPExcel->getActiveSheet()->setCellValue("Z1", "FECHA INICIO SEGURO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AA1", "FECHA TERMINO SEGURO");		$objPHPExcel->getActiveSheet()->setCellValue("AB1", "CODIGO CIA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AC1", "MONTO CUOTA");					$objPHPExcel->getActiveSheet()->setCellValue("AD1", "MONEDA CUOTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AE1", "RUT ASEGURADO");				$objPHPExcel->getActiveSheet()->setCellValue("AF1", "DV ASEGURADO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AG1", "NOMBRE ASEGURADO");			$objPHPExcel->getActiveSheet()->setCellValue("AH1", "APELLIDO PATERNO ASEGURADO");
					$objPHPExcel->getActiveSheet()->setCellValue("AI1", "APELLIDO PATERNO ASEGURADO");	$objPHPExcel->getActiveSheet()->setCellValue("AJ1", "FECHA NAC ASEGURADO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AK1", "EDAD ASEGURADO");				$objPHPExcel->getActiveSheet()->setCellValue("AL1", "CANAL VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AM1", "NOMBRE EJECUTIVO");			$objPHPExcel->getActiveSheet()->setCellValue("AN1", "NOMBRE OFICINA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AO1", "NACIONALIDAD CLIENTE");		$objPHPExcel->getActiveSheet()->setCellValue("AP1", "SEGMENTO CLIENTE");
					$objPHPExcel->getActiveSheet()->setCellValue("AQ1", "ORIGEN CLIENTE");				$objPHPExcel->getActiveSheet()->setCellValue("AR1", "TOTAL CUOTAS");
				    $objPHPExcel->getActiveSheet()->setCellValue("AS1", "POLIZA");						$objPHPExcel->getActiveSheet()->setCellValue("AT1", "CUOTA MAS MOROSA");
				    $objPHPExcel->getActiveSheet()->setCellValue("AU1", "MOTIVO ELIMINACION");			$objPHPExcel->getActiveSheet()->setCellValue("AV1", "ID UNICO");
				    $objPHPExcel->getActiveSheet()->setCellValue("AW1", "FECHA CARGA");					$objPHPExcel->getActiveSheet()->setCellValue("AX1", "ESTADO REGISTRO");
					$objPHPExcel->getActiveSheet()->setCellValue("AY1", "FECHA ULTIMA GESTION");		$objPHPExcel->getActiveSheet()->setCellValue("AZ1", "HORA ULTIMA GESTION");
				    $objPHPExcel->getActiveSheet()->setCellValue("BA1", "NUM INTENTOS");				$objPHPExcel->getActiveSheet()->setCellValue("BB1", "DURACION ULTIMA GESTION");
				    $objPHPExcel->getActiveSheet()->setCellValue("BC1", "EJECUTIVO CALIDAD");			$objPHPExcel->getActiveSheet()->setCellValue("BD1", "ESTADO CALIDAD");
				    $objPHPExcel->getActiveSheet()->setCellValue("BE1", "RECUPERADO TABLA");			$objPHPExcel->getActiveSheet()->setCellValue("BF1", "RECUPERADO");
					$objPHPExcel->getActiveSheet()->setCellValue("BG1", "CAMBIO MP");					$objPHPExcel->getActiveSheet()->setCellValue("BH1", "BANCO");
				    $objPHPExcel->getActiveSheet()->setCellValue("BI1", "CUENTA");						$objPHPExcel->getActiveSheet()->setCellValue("BJ1", "COPIA POLIZA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BK1", "DIR ENVIO");					$objPHPExcel->getActiveSheet()->setCellValue("BL1", "CIUDAD ENVIO");
				    $objPHPExcel->getActiveSheet()->setCellValue("BM1", "COMUNA ENVIO");				$objPHPExcel->getActiveSheet()->setCellValue("BN1", "VENTA");
				    $objPHPExcel->getActiveSheet()->setCellValue("BO1", "MOTIVO NO VENTA");				$objPHPExcel->getActiveSheet()->setCellValue("BP1", "CANT VENTAS");
				    $objPHPExcel->getActiveSheet()->setCellValue("BQ1", "CANT VENTAS OK");				$objPHPExcel->getActiveSheet()->setCellValue("BR1", "FONO GESTION PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BS1", "CONTACTO PRINCIPAL");			$objPHPExcel->getActiveSheet()->setCellValue("BT1", "TIPO CONTACTO PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BU1", "ESTADO TELEFONICO PRINCIPAL");	$objPHPExcel->getActiveSheet()->setCellValue("BV1", "FECHA GESTION PRINCIPAL");
				    $objPHPExcel->getActiveSheet()->setCellValue("BW1", "HORA GESTION PRINCIPAL");		$objPHPExcel->getActiveSheet()->setCellValue("BX1", "EJECUTIVO GESTOR");
				    $objPHPExcel->getActiveSheet()->setCellValue("BY1", "MOTIVO NO VENTA/ELIMINACION");	$objPHPExcel->getActiveSheet()->setCellValue("BZ1", "ALERTA MP");
				    $objPHPExcel->getActiveSheet()->setCellValue("CA1", "MOTIVO ELIMINACION MP");			
					
				    $sql = "SELECT 
							  r.lote 
							, r.rut_cliente 
							, r.dv_cliente 
							, r.nombre_completo||' '||r.apellido_paterno_titular||' '||r.apellido_materno_titular 
							, r.direccion 
							, r.ciudad 
							, r.comuna 
							, r.registra_correo 
							, s.nro_seguro, s.ramo, s.tipo_producto, s.plan_producto, s.sexo, s.estado_civil, s.fecha_nacimiento_cliente, s.forma_de_pago, s.medio_de_pago, s.banco_pago
							, s.estado_medio_pago, s.cuotas_morosas, s.fecha_cuota_morosa, s.motivo, s.fecha_carta, s.ponderador, s.fecha_generacion_lote, s.fecha_inicio_seguro, s.fecha_termino_seguro
							, s.codigo_cia, s.monto_cuota, s.moneda_cuota, s.rut_asegurado, s.dv_asegurado, s.nombre_asegurado, s.apellido_paterno_asegurado, s.apellido_materno_asegurado
							, s.fecha_nacimiento_asegurado, s.edad_asegurado, s.canal_de_venta, s.nombre_ejecutivo, s.nombre_oficina, s.nacionalidad_cliente, s.segmento_cliente, s.origen_cliente
							, s.total_cuotas, s.poliza, s.cuota_mas_morosa, s.motivo_eliminacion
							, r.ws_idunico 
							, r.ws_fecha_carga 
							, r.ws_estado_registro 
							, r.ws_fecha_sistema 
							, r.ws_hora_sistema 
							, r.ws_num_intentos 
							, r.ws_tmo_script
							,(SELECT nombre_fantasia FROM usuarios WHERE idusuario = s.id_calidad) 
							, s.estado_calidad 
							, s.recupera 
							, (case when ws_fecha_sistema is null then ''
							        when (s.recupera = '' or s.recupera = 'No' or s.recupera is null) then 'No Retractado' 
							        when (s.recupera = 'Si') then 'Retractado' else s.recupera
							   end) 
							, (SELECT estado FROM retencion.a_cambio_mp where cod = s.cambio_mp) 
							, s.banco 
							, s.numero_producto 
							, s.copia_pol 
							, case when copia_pol = 'Si-Misma direccion' then r.direccion else s.direccion end 
							, case when copia_pol = 'Si-Misma direccion' then r.ciudad else s.ciudad end 
							, case when copia_pol = 'Si-Misma direccion' then r.comuna else s.comuna end 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN ''
								WHEN (select count(cod_venta) from recuperacion.ventas where rut_cliente = r.rut_cliente and idunico = r.ws_idunico) > 0
								THEN 'Venta'
								ELSE 'No Venta'
							   END) 
							, s.motivo_eliminacion   
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(distinct cod_venta) 
									from recuperacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico)
							   END) 
							, (CASE 
								WHEN ws_fecha_sistema is null 
								THEN NULL
								ELSE (select count(distinct cod_venta) 
									from recuperacion.ventas 
									where rut_cliente = r.rut_cliente and idunico = r.ws_idunico and estado_venta = 'OK')
							   END) 
							, (select a.telefono 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select b.contacto_r 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select b.tipo_contacto_r 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select b.estado_telefonico 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1) 
							, (select fmt_date(a.fecha,'dd/mm/yyyy') 
							  from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							  where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							  order by b.peso  
							  asc limit 1) 
							, (select a.hora 
							   from recuperacion.gestiones_telefonos as a, recuperacion.recuperacion_tipificaciones as b 
							   where a.idunico = r.ws_idunico 
							   and a.gestion = b.estado_contacto
							   order by b.peso
							   asc limit 1)  
							, (SELECT nombre_fantasia from usuarios where idusuario = r.ws_id_usuario) 
							, s.motivo_eliminacion 
							, r.obs_alerta 
							, r.ap_motivo_eliminacion_obs 
							FROM recuperacion.cargas AS r, recuperacion.seguros AS s
							WHERE r.lote between ".$loteI." and ".$loteF." 
							AND r.lote = s.lote
							AND r.rut_cliente = s.rut_cliente
							order by fmt_date(ws_fecha_sistema, 'yyyymmdd'), ws_hora_sistema;";
					$q = consultar($sql);
					// $ob->alert($q);
					if($q != "NO")
					{
						$i = 2;
						$data = explode("::",$q);
						foreach($data as $x)
						{
							if(!empty($x))
							{
								$data_2 = explode("||",$x);
								$objPHPExcel->getActiveSheet()->setCellValue("A".$i."", $data_2[0]);	$objPHPExcel->getActiveSheet()->setCellValue("B".$i."", $data_2[1]);
							    $objPHPExcel->getActiveSheet()->setCellValue("C".$i."", $data_2[2]);	$objPHPExcel->getActiveSheet()->setCellValue("D".$i."", $data_2[3]);
							    $objPHPExcel->getActiveSheet()->setCellValue("E".$i."", $data_2[4]);	$objPHPExcel->getActiveSheet()->setCellValue("F".$i."", $data_2[5]);
							    $objPHPExcel->getActiveSheet()->setCellValue("G".$i."", $data_2[6]);	$objPHPExcel->getActiveSheet()->setCellValue("H".$i."", $data_2[7]);
								$objPHPExcel->getActiveSheet()->setCellValue("I".$i."", $data_2[8]);	$objPHPExcel->getActiveSheet()->setCellValue("J".$i."", $data_2[9]);
							    $objPHPExcel->getActiveSheet()->setCellValue("K".$i."", $data_2[10]);	$objPHPExcel->getActiveSheet()->setCellValue("L".$i."", $data_2[11]);
							    $objPHPExcel->getActiveSheet()->setCellValue("M".$i."", $data_2[12]);	$objPHPExcel->getActiveSheet()->setCellValue("N".$i."", $data_2[13]);
							    $objPHPExcel->getActiveSheet()->setCellValue("O".$i."", $data_2[14]);	$objPHPExcel->getActiveSheet()->setCellValue("P".$i."", $data_2[15]);
								$objPHPExcel->getActiveSheet()->setCellValue("Q".$i."", $data_2[16]);	$objPHPExcel->getActiveSheet()->setCellValue("R".$i."", $data_2[17]);
							    $objPHPExcel->getActiveSheet()->setCellValue("S".$i."", $data_2[18]);	$objPHPExcel->getActiveSheet()->setCellValue("T".$i."", $data_2[19]);
							    $objPHPExcel->getActiveSheet()->setCellValue("U".$i."", $data_2[20]);	$objPHPExcel->getActiveSheet()->setCellValue("V".$i."", $data_2[21]);
							    $objPHPExcel->getActiveSheet()->setCellValue("W".$i."", $data_2[22]);	$objPHPExcel->getActiveSheet()->setCellValue("X".$i."", $data_2[23]);
								$objPHPExcel->getActiveSheet()->setCellValue("Y".$i."", $data_2[24]);	$objPHPExcel->getActiveSheet()->setCellValue("Z".$i."", $data_2[25]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AA".$i."", $data_2[26]);	$objPHPExcel->getActiveSheet()->setCellValue("AB".$i."", $data_2[27]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AC".$i."", $data_2[28]);	$objPHPExcel->getActiveSheet()->setCellValue("AD".$i."", $data_2[29]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AE".$i."", $data_2[30]);	$objPHPExcel->getActiveSheet()->setCellValue("AF".$i."", $data_2[31]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AG".$i."", $data_2[32]);	$objPHPExcel->getActiveSheet()->setCellValue("AH".$i."", $data_2[33]);
								$objPHPExcel->getActiveSheet()->setCellValue("AI".$i."", $data_2[34]);	$objPHPExcel->getActiveSheet()->setCellValue("AJ".$i."", $data_2[35]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AK".$i."", $data_2[36]);	$objPHPExcel->getActiveSheet()->setCellValue("AL".$i."", $data_2[37]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AM".$i."", $data_2[38]);	$objPHPExcel->getActiveSheet()->setCellValue("AN".$i."", $data_2[39]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AO".$i."", $data_2[40]);	$objPHPExcel->getActiveSheet()->setCellValue("AP".$i."", $data_2[41]);
								$objPHPExcel->getActiveSheet()->setCellValue("AQ".$i."", $data_2[42]);	$objPHPExcel->getActiveSheet()->setCellValue("AR".$i."", $data_2[43]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AS".$i."", $data_2[44]);	$objPHPExcel->getActiveSheet()->setCellValue("AT".$i."", $data_2[45]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AU".$i."", $data_2[46]);	$objPHPExcel->getActiveSheet()->setCellValue("AV".$i."", $data_2[47]);
							    $objPHPExcel->getActiveSheet()->setCellValue("AW".$i."", $data_2[48]);	$objPHPExcel->getActiveSheet()->setCellValue("AX".$i."", $data_2[49]);
								$objPHPExcel->getActiveSheet()->setCellValue("AY".$i."", $data_2[50]);	$objPHPExcel->getActiveSheet()->setCellValue("AZ".$i."", $data_2[51]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BA".$i."", $data_2[52]);	$objPHPExcel->getActiveSheet()->setCellValue("BB".$i."", $data_2[53]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BC".$i."", $data_2[54]);	$objPHPExcel->getActiveSheet()->setCellValue("BD".$i."", $data_2[55]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BE".$i."", $data_2[56]);	$objPHPExcel->getActiveSheet()->setCellValue("BF".$i."", $data_2[57]);
								$objPHPExcel->getActiveSheet()->setCellValue("BG".$i."", $data_2[58]);	$objPHPExcel->getActiveSheet()->setCellValue("BH".$i."", $data_2[59]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BI".$i."", $data_2[60]);	$objPHPExcel->getActiveSheet()->setCellValue("BJ".$i."", $data_2[61]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BK".$i."", $data_2[62]);	$objPHPExcel->getActiveSheet()->setCellValue("BL".$i."", $data_2[63]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BM".$i."", $data_2[64]);	$objPHPExcel->getActiveSheet()->setCellValue("BN".$i."", $data_2[65]);
							    $objPHPExcel->getActiveSheet()->setCellValue("BO".$i."", $data_2[66]);	$objPHPExcel->getActiveSheet()->setCellValue("BP".$i."", $data_2[67]);
								
							}
							$i += 1;
						}
					}


				    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				    // $objWriter->save('../resultantes/BDD_RESULTANTE_RECUPERACION.xlsx');
				    $objWriter->save('/var/www/monitor_campaign/resultantes/BDD_RESULTANTE_RECUPERACION.xlsx');
				    $callEndTime = microtime(true);
				    $callTime = $callEndTime - $callStartTime;
				break;
				case 2:
				break;
			}
		break;
	}	

	switch(intval($id)) 
	{	
		case 0:
			$lista = '';
		    // $carpeta = 'C:\xampp\htdocs\BANCHILE\monitor_campaign\resultantes';
		    $carpeta = '/var/www/monitor_campaign/resultantes';
		    if(is_dir($carpeta)){
		        if($dir = opendir($carpeta)){
		            while(($archivo = readdir($dir)) !== false){
		                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
		                	if(stristr($archivo, 'FIDELIZACION')){
		                    	$lista .= '<li><a target="_blank" href="../resultantes/'.$archivo.'">'.$archivo.'</a></li>';
		                    	// $lista .= '<li><a target="_blank" href="/root/informes_banchile/pv/'.date('Ymd').'/'.$archivo.'">'.$archivo.'</a></li>';
		                    }
		                }
		            }
		            closedir($dir);
		        }
		    }

		    // ---------------------------------------------------------------------------------------------------------------------------------
		    $ob->assign("listaArchivosCampanas","innerHTML",$lista);
		    $ob->script("activaListaResultantes(".$id.");");
		break;
		case 1:
			$lista = '';
		    // $carpeta = 'C:\xampp\htdocs\BANCHILE\monitor_campaign\resultantes';
		    $carpeta = '/var/www/monitor_campaign/resultantes';
		    if(is_dir($carpeta)){
		        if($dir = opendir($carpeta)){
		            while(($archivo = readdir($dir)) !== false){
		                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
		                	if(stristr($archivo, 'RECUPERACION')){
		                    	$lista .= '<li><a target="_blank" href="../resultantes/'.$archivo.'">'.$archivo.'</a></li>';
		                	}
		                }
		            }
		            closedir($dir);
		        }
		    } 

		    // ---------------------------------------------------------------------------------------------------------------------------------
		    $ob->assign("listaArchivosCampanas2","innerHTML",$lista);
		    $ob->script("activaListaResultantes(".$id.");");
		break;
		case 2:
		break;
	}
	
	return $ob;
}
$xajax = new xajax();
$xajax->setCharEncoding('UTF-8');
$xajax->registerFunction("cargaCampanas");
$xajax->registerFunction("generaResultante");
$xajax->processRequest();

$xajax->printJavascript('../librerias/xajax/');
?>