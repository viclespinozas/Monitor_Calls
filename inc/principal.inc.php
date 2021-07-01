<?php
@session_start();
date_default_timezone_set('America/Santiago');
// LIBRERIA AJAX 0.5
@include("../clases/astman.php");
@require_once("../clases/PHPExcel.php");
@require_once("../librerias/xajax/xajax_core/xajaxAIO.inc.php");
@include("../clases/conexionBD.class.php");

//RECARGA DE APLICACIÓN
function reloadContent($camp){
	$ob = new xajaxResponse;
	// $ob->alert("INICIANDO");
	// date_default_timezone_set('America/Santiago');
	$fecha = date("d-m-Y");
	$fecha .= "<br>";
	$fecha .= date("H:i:s");

	$ob->assign("fechaActual","innerHTML",$fecha);
	$_SESSION['campa'] = $camp;
	switch($camp)
	{
		/*case 'BCH':
			$sql = "SELECT COUNT(DISTINCT ws_id_usuario) FROM bancochile.ventas WHERE fecha=fmt_date(now(),'yyyymmdd');";
			$q = consultar_tlmk($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(*) as Recorridos 
					FROM bancochile.clientes 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800')
					;";
			$q2 = consultar_tlmk($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
							contacto_fono1 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono2 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono3 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono4 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono5 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono6 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							ws_idunico IN (SELECT 
											idunico 
										   FROM bancochile.gestiones_telefonos 
										   WHERE fecha::int = fmt_date(now(), 'yyyymmdd') 
										   AND ws_idunico = idunico 
										   AND contacto IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') ) 
							THEN 1 ELSE 0 END) 
					FROM bancochile.clientes 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800')
					;";
			$q3 = consultar_tlmk($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM bancochile.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 ;";
			$q4 = consultar_tlmk($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ob->assign("ventasActual","innerHTML",$ventas);
			// --------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(*) FROM bancochile.ventas WHERE fmt_date(fecha, 'yyyymm') ='".date('Ym')."' and estado_venta in ('OK','RECUPERADA');";
			$q5 = consultar_tlmk($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$ob->assign("netasActual","innerHTML",$netas5);
			// --------------------------------------------------------------------------------------------------------------------
		break;
		case 'CCH':
			$sql = "SELECT COUNT(DISTINCT ws_id_usuario) FROM credichile_ventas.ventas WHERE fecha=fmt_date(now(),'yyyymmdd');";
			$q = consultar_tlmk($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(*) as Recorridos 
					FROM credichile_ventas.clientes 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800')
					;";
			$q2 = consultar_tlmk($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
							contacto_fono1 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono2 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono3 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono4 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono5 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							contacto_fono6 IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') or 
							ws_idunico IN (SELECT 
											idunico 
										   FROM credichile_ventas.gestiones_telefonos 
										   WHERE fecha::int = fmt_date(now(), 'yyyymmdd') 
										   AND ws_idunico = idunico 
										   AND contacto IN ('ACEPTA','CONTACTO TERCERO','MANIF. INT / INDECISO','RECHAZA') ) 
							THEN 1 ELSE 0 END) 
					FROM credichile_ventas.clientes 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800')
					;";
			$q3 = consultar_tlmk($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM credichile_ventas.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 ;";
			$q4 = consultar_tlmk($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(*) FROM credichile_ventas.ventas WHERE fmt_date(fecha, 'yyyymm') ='".date('Ym')."' and estado_venta in ('OK','RECUPERADA');";
			$q5 = consultar_tlmk($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$ob->assign("netasActual","innerHTML",$netas5);
			// --------------------------------------------------------------------------------------------------------------------
		break;*/
		//FIDELIZACION ----------------------------------------------------------------------------------------------------------------
		case 'PV':
			$sql = "SELECT
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM fidelizacion.ventas WHERE fecha=fmt_date(now(),'yyyymmdd'))
					||'/'||
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM fidelizacion.cargas WHERE ws_fecha_sistema = fmt_date(now(),'dd/mm/yyyy') and ws_id_usuario::integer not in (718,771,776,800))
					;";
			$q = consultar($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(ws_id_usuario) as Recorridos 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800','718','771')
					;";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
							contacto_fono1 = 'Efectivo' or 
							contacto_fono2 = 'Efectivo' or 
							contacto_fono3 = 'Efectivo' or 
							contacto_fono4 = 'Efectivo' or 
							contacto_fono5 = 'Efectivo' or 
							contacto_fono6 = 'Efectivo' or 
							ws_idunico IN (SELECT 
											idunico 
										   FROM fidelizacion.gestiones_telefonos 
										   WHERE fmt_date(fecha,'yyyymmdd')::int between now() and now() 
										   AND ws_idunico = idunico 
										   AND contacto = 'Efectivo' ) 
							THEN 1 ELSE 0 END) 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800','718','771')
					;";
			$q3 = consultar($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$color = ((intval($contactos_rut / $recorridos)) > 55)?'green':'red';
			$contactabilidad = '<span style="color:'.$color.'">'.$contactabilidad.'</span>';
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM fidelizacion.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 ;";
			$q4 = consultar($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta = 'OK';";
			$q5 = consultar($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$ob->assign("netasActual","innerHTML",$netas5);
			// -------------------------------------------------------------------------------------------------------------------
			$sql55 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."';";
			$q55 = consultar($sql55);
			if($q55 != "NO")
			{
				$datos55 = explode("||", $q55);
				$brutas55 = $datos55[0];
			}
			$ob->assign("brutasActual","innerHTML",$brutas55);
			// -------------------------------------------------------------------------------------------------------------------
			//DIAS HABILES DEL MES
			$sql9 = "SELECT count(*) 
					FROM generate_series(0, ('".date('Y/m/t')."'::date - '".date('Y/m/')."01'::date::date)) i
					WHERE date_part('dow', '".date('Y/m/')."01'::date::date + i) NOT IN (0,6);";
			$q9 = consultar($sql9);
			if($q9 != "NO")
			{
				$datos9 = explode("||", $q9);
				$diasHabiles9 = $datos9[0];
				$diasHabiles9 = $diasHabiles9 - 1 ;
			}
			//DIAS TRABAJADOS DEL MES
			$sql91 = "SELECT COUNT(DISTINCT ws_fecha_sistema)
						FROM fidelizacion.cargas c
						WHERE campana IN ('1_Ano_Vigencia_".date('Ym')."01'
						,'1_Ano_Vigencia_Generales_".date('Ym')."01'
						,'2_Anos_Vigencia_".date('Ym')."01'
						,'2_Anos_Vigencia_Grales_".date('Ym')."01'
						,'4_Meses_Vigencia_".date('Ym')."01'
						,'Nuevos_Clientes_".date('Ym')."01'
						,'Nuevos_Productos_".date('Ym')."01'
						,'Referidos_02".date('mY')."'
						) ;";
			$q91 = consultar($sql91);
			if($q91 != "NO")
			{
				$datos91 = explode("||", $q91);
				$diasTrabajados91 = $datos91[0];
			}
			//PROYECCION
			$proyeccion = intval(($brutas55 * $diasHabiles9) / $diasTrabajados91);
			$ob->assign("proyeccionActual","innerHTML",$proyeccion);
			// -----------------------------------------------------------------------------------------------------------------
			$sql10 = 'SELECT 
					campana as "Campaña"
					,trim(a.ciudad) as "Región"
					,count(ws_idunico) as "Disponibles Sin Gestion"
					FROM fidelizacion.cargas a 
					WHERE ws_fecha_carga = \''.date('Ym').'01\'--a.campana IN (SELECT base FROM fidelizacion.bases where estadocarga= \'Activa\')
					and ws_marca = \'disp\'
					and ws_prioridad <= 0
					and a.campana not in (
						\'Renovacion_Asociados_Creditos_Noviembre_2015\'
						,\'BDD_Beneficiarios_Superan_Edad_20150901\'
						,\'Especial_IRAM_20151001\'
						,\'Renovacion_Asociados_Creditos_Octubre_2015\'
					)
					GROUP BY campana,a.ciudad
					ORDER BY campana,a.ciudad';
			$q10 = consultar($sql10);
			$i = 1;
			$rec_temp = 0;
			// $ob->alert($q10);
			if($q10 != "NO")
			{
				$campTemp = '';
				$datos10 = explode("::", $q10);
				foreach($datos10 as $x)
				{
					$datos10_1 = explode("||", $x);
					$campVal = $datos10_1[0];
					$regiVal = $datos10_1[1];
					$cantVal = $datos10_1[2];
					
					// $ob->alert("CAMP -> ".$campVal." - REG -> ".$regiVal." - DISP -> ".$cantVal);
					if(empty($campTemp))
					{
						$ob->script("document.getElementById('campVal".$i."').value = '".$campVal."';");
						switch($regiVal)
						{
							case 'AREA METROPOLITANA':		
								$ob->script("document.getElementById('".$i."regiRMVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantRMVal').value = '".$cantVal."';");	
							break;
							case 'PRIMERA REGION':
								$ob->script("document.getElementById('".$i."regiIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIVal').value = '".$cantVal."';");			
							break;
							case 'SEGUNDA REGION':
								$ob->script("document.getElementById('".$i."regiIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIIVal').value = '".$cantVal."';");			
							break;
							case 'TERCERA REGION':
								$ob->script("document.getElementById('".$i."regiIIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIIIVal').value = '".$cantVal."';");
							break;
							case 'CUARTA REGION':
								$ob->script("document.getElementById('".$i."regiIVVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIVVal').value = '".$cantVal."';");
							break;
							case 'QUINTA REGION':
								$ob->script("document.getElementById('".$i."regiVVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVVal').value = '".$cantVal."';");
							break;
							case 'SEXTA REGION':
								$ob->script("document.getElementById('".$i."regiVIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIVal').value = '".$cantVal."';");
							break;
							case 'SEPTIMA REGION':
								$ob->script("document.getElementById('".$i."regiVIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIIVal').value = '".$cantVal."';");
							break;
							case 'OCTAVA REGION':
								$ob->script("document.getElementById('".$i."regiVIIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIIIVal').value = '".$cantVal."';");
							break;
							case 'NOVENA REGION':
								$ob->script("document.getElementById('".$i."regiIXVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIXVal').value = '".$cantVal."';");
							break;
							case 'DECIMA REGION':
								$ob->script("document.getElementById('".$i."regiXVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXVal').value = '".$cantVal."';");
							break;
							case 'DECIMA PRIMERA REGION':
								$ob->script("document.getElementById('".$i."regiXIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXIVal').value = '".$cantVal."';");
							break;
							case 'DECIMA SEGUNDA REGION':
								$ob->script("document.getElementById('".$i."regiXIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXIIVal').value = '".$cantVal."';");
							break;
						}

					}
					elseif($campTemp == $campVal)
					{
						switch($regiVal)
						{
							case 'AREA METROPOLITANA':		
								$ob->script("document.getElementById('".$i."regiRMVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantRMVal').value = '".$cantVal."';");	
							break;
							case 'PRIMERA REGION':
								$ob->script("document.getElementById('".$i."regiIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIVal').value = '".$cantVal."';");			
							break;
							case 'SEGUNDA REGION':
								$ob->script("document.getElementById('".$i."regiIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIIVal').value = '".$cantVal."';");			
							break;
							case 'TERCERA REGION':
								$ob->script("document.getElementById('".$i."regiIIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIIIVal').value = '".$cantVal."';");
							break;
							case 'CUARTA REGION':
								$ob->script("document.getElementById('".$i."regiIVVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIVVal').value = '".$cantVal."';");
							break;
							case 'QUINTA REGION':
								$ob->script("document.getElementById('".$i."regiVVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVVal').value = '".$cantVal."';");
							break;
							case 'SEXTA REGION':
								$ob->script("document.getElementById('".$i."regiVIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIVal').value = '".$cantVal."';");
							break;
							case 'SEPTIMA REGION':
								$ob->script("document.getElementById('".$i."regiVIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIIVal').value = '".$cantVal."';");
							break;
							case 'OCTAVA REGION':
								$ob->script("document.getElementById('".$i."regiVIIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIIIVal').value = '".$cantVal."';");
							break;
							case 'NOVENA REGION':
								$ob->script("document.getElementById('".$i."regiIXVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIXVal').value = '".$cantVal."';");
							break;
							case 'DECIMA REGION':
								$ob->script("document.getElementById('".$i."regiXVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXVal').value = '".$cantVal."';");
							break;
							case 'DECIMA PRIMERA REGION':
								$ob->script("document.getElementById('".$i."regiXIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXIVal').value = '".$cantVal."';");
							break;
							case 'DECIMA SEGUNDA REGION':
								$ob->script("document.getElementById('".$i."regiXIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXIIVal').value = '".$cantVal."';");
							break;
						}
					}
					else
					{
						$i = $i+1;
						$ob->script("document.getElementById('campVal".$i."').value = '".$campVal."';");
						switch($regiVal)
						{
							case 'AREA METROPOLITANA':		
								$ob->script("document.getElementById('".$i."regiRMVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantRMVal').value = '".$cantVal."';");	
							break;
							case 'PRIMERA REGION':
								$ob->script("document.getElementById('".$i."regiIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIVal').value = '".$cantVal."';");			
							break;
							case 'SEGUNDA REGION':
								$ob->script("document.getElementById('".$i."regiIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIIVal').value = '".$cantVal."';");			
							break;
							case 'TERCERA REGION':
								$ob->script("document.getElementById('".$i."regiIIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIIIVal').value = '".$cantVal."';");
							break;
							case 'CUARTA REGION':
								$ob->script("document.getElementById('".$i."regiIVVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIVVal').value = '".$cantVal."';");
							break;
							case 'QUINTA REGION':
								$ob->script("document.getElementById('".$i."regiVVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVVal').value = '".$cantVal."';");
							break;
							case 'SEXTA REGION':
								$ob->script("document.getElementById('".$i."regiVIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIVal').value = '".$cantVal."';");
							break;
							case 'SEPTIMA REGION':
								$ob->script("document.getElementById('".$i."regiVIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIIVal').value = '".$cantVal."';");
							break;
							case 'OCTAVA REGION':
								$ob->script("document.getElementById('".$i."regiVIIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantVIIIVal').value = '".$cantVal."';");
							break;
							case 'NOVENA REGION':
								$ob->script("document.getElementById('".$i."regiIXVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantIXVal').value = '".$cantVal."';");
							break;
							case 'DECIMA REGION':
								$ob->script("document.getElementById('".$i."regiXVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXVal').value = '".$cantVal."';");
							break;
							case 'DECIMA PRIMERA REGION':
								$ob->script("document.getElementById('".$i."regiXIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXIVal').value = '".$cantVal."';");
							break;
							case 'DECIMA SEGUNDA REGION':
								$ob->script("document.getElementById('".$i."regiXIIVal').value = '".$regiVal."';");	
								$ob->script("document.getElementById('".$i."cantXIIVal').value = '".$cantVal."';");
							break;
						}
					}

					$campTemp = $campVal;
				}
			}

			$ob->script("cargarResumenPV();");
			$ob->script("reloadContent('PV');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		case 'DET':
			$sql = "SELECT
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM fidelizacion.ventas WHERE fecha=fmt_date(now(),'yyyymmdd'))
					||'/'||
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM fidelizacion.cargas WHERE ws_fecha_sistema = fmt_date(now(),'dd/mm/yyyy') and ws_id_usuario::integer not in (718,771,776,800))
					;";
			$q = consultar($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(ws_id_usuario) as Recorridos 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800','718','771')
					;";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
							contacto_fono1 = 'Efectivo' or 
							contacto_fono2 = 'Efectivo' or 
							contacto_fono3 = 'Efectivo' or 
							contacto_fono4 = 'Efectivo' or 
							contacto_fono5 = 'Efectivo' or 
							contacto_fono6 = 'Efectivo' or 
							ws_idunico IN (SELECT 
											idunico 
										   FROM fidelizacion.gestiones_telefonos 
										   WHERE fmt_date(fecha,'yyyymmdd')::int between now() and now() 
										   AND ws_idunico = idunico 
										   AND contacto = 'Efectivo' ) 
							THEN 1 ELSE 0 END) 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800','718','771')
					;";
			$q3 = consultar($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$color = (intval($contactabilidad) > 50)?'green':'red';
			$contactabilidad = '<span style="color:'.$color.'">'.$contactabilidad.'</span>';
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM fidelizacion.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 ;";
			$q4 = consultar($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta = 'OK';";
			$q5 = consultar($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$ob->assign("netasActual","innerHTML",$netas5);
			$sql55 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."';";
			$q55 = consultar($sql55);
			if($q55 != "NO")
			{
				$datos55 = explode("||", $q55);
				$brutas55 = $datos55[0];
			}
			$ob->assign("brutasActual","innerHTML",$brutas55);
			// $sql51 = "SELECT COUNT(cod_venta) FROM bancochile.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q51 = consultar_tlmk($sql51);
			// if($q51 != "NO")
			// {
			// 	$datos51 = explode("||", $q51);
			// 	$netas51 = $datos51[0];
			// }
			// $ob->assign("netasActualBCH","innerHTML",$netas51);
			// $sql52 = "SELECT COUNT(cod_venta) FROM credichile_ventas.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q52 = consultar_tlmk($sql52);
			// if($q52 != "NO")
			// {
			// 	$datos52 = explode("||", $q52);
			// 	$netas52 = $datos52[0];
			// }
			// $ob->assign("netasActualCCH","innerHTML",$netas52);
			// -------------------------------------------------------------------------------------------------------------------
			//DIAS HABILES DEL MES
			$sql9 = "SELECT count(*) 
					FROM generate_series(0, ('".date('Y/m/t')."'::date - '".date('Y/m/')."01'::date::date)) i
					WHERE date_part('dow', '".date('Y/m/')."01'::date::date + i) NOT IN (0,6);";
			$q9 = consultar($sql9);
			if($q9 != "NO")
			{
				$datos9 = explode("||", $q9);
				$diasHabiles9 = $datos9[0];
				$diasHabiles9 = $diasHabiles9 - 1 ;
			}
			//DIAS TRABAJADOS DEL MES
			$sql91 = "SELECT COUNT(DISTINCT ws_fecha_sistema)
						FROM fidelizacion.cargas c
						WHERE campana IN ('1_Ano_Vigencia_".date('Ym')."01'
						,'1_Ano_Vigencia_Generales_".date('Ym')."01'
						,'2_Anos_Vigencia_".date('Ym')."01'
						,'2_Anos_Vigencia_Grales_".date('Ym')."01'
						,'4_Meses_Vigencia_".date('Ym')."01'
						,'Nuevos_Clientes_".date('Ym')."01'
						,'Nuevos_Productos_".date('Ym')."01'
						,'Referidos_02".date('mY')."'
						) ;";
			$q91 = consultar($sql91);
			if($q91 != "NO")
			{
				$datos91 = explode("||", $q91);
				$diasTrabajados91 = $datos91[0];
			}
			//PROYECCION
			$proyeccion = intval(($brutas55 * $diasHabiles9) / $diasTrabajados91);
			$ob->assign("proyeccionActual","innerHTML",$proyeccion);
			// -------------------------------------------------------------------------------------------------------------------
			$sql6 = "SELECT 
					REPLACE(SUBSTRING(campana,1,length(campana)-9),'ñ','n')::text as campana
					,(SELECT COUNT(ws_idunico) FROM fidelizacion.cargas WHERE (campana = c.campana )) as base_cargada
					,(SELECT COUNT(ws_id_usuario) FROM fidelizacion.cargas WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN ".date('Ym')."01 AND fmt_date(now(), 'yyyymmdd')::int AND (campana = c.campana)) as Rut_Trabajado_Discador_Ejecutivo
					,(SELECT COUNT(ws_id_usuario) FROM fidelizacion.cargas WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int AND ws_id_usuario <> 800 AND (campana = c.campana)) as Rut_Trabajado_Ejecutivo
					--,(SELECT COUNT(DISTINCT (gt.idunico)) FROM fidelizacion.gestiones_telefonos gt WHERE fmt_date(gt.fecha, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int 
					--    AND gt.gestion IN (SELECT tipo_contacto FROM fidelizacion.tipificacion where estado_contacto = 'Efectivo')
					--    AND idunico IN (SELECT ws_idunico FROM fidelizacion.cargas WHERE campana = c.campana )) as contactos_efectivos
					,(SELECT 
						SUM(CASE WHEN 
								contacto_fono1 = 'Efectivo' or 
								contacto_fono2 = 'Efectivo' or 
								contacto_fono3 = 'Efectivo' or 
								contacto_fono4 = 'Efectivo' or 
								contacto_fono5 = 'Efectivo' or 
								contacto_fono6 = 'Efectivo' or 
								ws_idunico IN (SELECT 
												idunico 
											   FROM fidelizacion.gestiones_telefonos 
											   WHERE fmt_date(fecha,'yyyymmdd')::int between now() and now() 
											   AND ws_idunico = idunico 
											   AND contacto = 'Efectivo' ) 
								THEN 1 ELSE 0 END) 
						FROM fidelizacion.cargas 
						WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
						AND ws_id_usuario NOT IN ('800','718','771')
						AND campana = c.campana ) as contactos_efectivos
					,(SELECT COUNT(DISTINCT cod_venta) FROM fidelizacion.ventas WHERE idunico IN 
					    (SELECT ws_idunico FROM fidelizacion.cargas WHERE ws_id_usuario != 800 AND fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int AND (campana = c.campana))
					    AND fmt_date(fecha, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int  
					) as Ventas
					FROM fidelizacion.cargas c
					WHERE campana IN ('1_Ano_Vigencia_".date('Ym')."01'
					,'1_Ano_Vigencia_Generales_".date('Ym')."01'
					,'2_Anos_Vigencia_".date('Ym')."01'
					,'2_Anos_Vigencia_Grales_".date('Ym')."01'
					,'4_Meses_Vigencia_".date('Ym')."01'
					,'Nuevos_Clientes_".date('Ym')."01'
					,'Nuevos_Productos_".date('Ym')."01'
					,'Referidos_02".date('mY')."'
					) 
					GROUP BY c.campana 
					ORDER BY c.campana";
			$q6 = consultar($sql6);
			// $ob->alert($q6);
			if($q6 != "NO")
			{
				$datos6 = explode("::", $q6);
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Campa&ntilde;a</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT IVR/Ejec.</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT Ejec.</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contactabilidad</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Ventas</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Efic. %</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$campana = str_replace("_"," ",$datos6_2[0]);
						$cargado = $datos6_2[1];
						$rutIvrEjec = $datos6_2[2];
						$rutEjec = $datos6_2[3];
						$contEfect = $datos6_2[4];
						$ventasNet = $datos6_2[5];
						$rutIvrEjecPOR = number_format((($rutIvrEjec / $cargado) * 100),2,".","")."%";
						$rutEjecPOR = number_format((($rutEjec / $rutIvrEjec) * 100),2,".","")."%";
						$contEfectPOR = number_format((($contEfect / $rutEjec) * 100),2,".","")."%";
						if(intval($contEfectPOR) > 55)
						{
							$color = 'green';
						}
						elseif(intval($contEfectPOR) < 15)
						{
							$color = 'red';
						}
						else
						{
							$color = '#064C75';
						}
						// $color = (intval($contEfectPOR) > 55)?'green':'#064C75';
						$eficienciaPOR = number_format((($ventasNet / $contEfect) * 100),2,".","")."%";
						$penetracionPOR = number_format((($ventasNet / $cargado) * 100),2,".","")."%";
						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$campana.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutIvrEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutIvrEjecPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjecPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$contEfect.'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="color:'.$color.'">'.$contEfectPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ventasNet.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$eficienciaPOR.'</td>
				  				</tr>';
					}

				}

				$tabla .= '</tbody>
					  	   </table>';
			}

			// BCH - CCH
			$sql7 = "SELECT
					'Peaton Protegido'::text as Nombre_Base
					,(SELECT COUNT(ws_idunico) FROM credichile_ventas.clientes WHERE ws_fecha_carga::integer =".date('Ym')."01) as base_cargada
					,(SELECT COUNT(ws_id_usuario) FROM credichile_ventas.clientes WHERE ws_fecha_carga::integer =".date('Ym')."01 AND ws_estado_registro='Finalizado') as Rut_Trabajado_Discador_Ejecutivo
					,(SELECT COUNT(ws_id_usuario) FROM credichile_ventas.clientes WHERE ws_fecha_carga::integer =".date('Ym')."01 AND ws_estado_registro='Finalizado' AND ws_id_usuario NOT IN (800) AND ws_fecha_sistema='".date('d/m/Y')."') as Rut_Trabajado_Ejecutivo
					,( 
					  SELECT COUNT(ws_idunico) FROM credichile_ventas.clientes WHERE 
						ws_fecha_carga::integer =".date('Ym')."01 
						AND 
						(
						contacto_fono1 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono2 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono3 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono4 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono5 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono6 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO')
						)
						AND ws_fecha_sistema='".date('d/m/Y')."'

					 ) as contactos_efectivos
					,(SELECT COUNT(DISTINCT cod_venta) FROM credichile_ventas.ventas WHERE 
					    idunico IN (SELECT ws_idunico FROM credichile_ventas.clientes WHERE ws_id_usuario != 800 AND ws_fecha_carga::integer =".date('Ym')."01)
					    AND fmt_date(fecha, 'yyyymmdd') BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int
					 ) as Ventas
					FROM credichile_ventas.clientes
					WHERE ws_fecha_carga::integer =".date('Ym')."01
					AND ws_marca <>'rebajado'
					AND ws_estado_registro='Finalizado' 
					GROUP BY ws_campagna
					UNION ALL
					SELECT
					'Salir Protegido'::text as Nombre_Base
					,(SELECT COUNT(ws_idunico) FROM bancochile.clientes WHERE ws_fecha_carga::integer =".date('Ym')."01) as base_cargada
					,(SELECT COUNT(ws_id_usuario) FROM bancochile.clientes WHERE ws_fecha_carga::integer =".date('Ym')."01 AND ws_estado_registro='Finalizado') as Rut_Trabajado_Discador_Ejecutivo
					,(SELECT COUNT(ws_id_usuario) FROM bancochile.clientes WHERE ws_fecha_carga::integer =".date('Ym')."01 AND ws_estado_registro='Finalizado' AND ws_id_usuario NOT IN (800) AND ws_fecha_sistema='".date('d/m/Y')."') as Rut_Trabajado_Ejecutivo
					,( 
					  SELECT COUNT(ws_idunico) FROM bancochile.clientes WHERE 
						ws_fecha_carga::integer =".date('Ym')."01 
						AND 
						(
						contacto_fono1 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono2 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono3 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono4 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono5 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO') OR 
						contacto_fono6 IN ('ACEPTA','RECHAZA','NO CALIFICA','MANIF. INT / INDECISO','VOLVER A LLAMAR','CONTACTO TERCERO')
						)
						AND ws_fecha_sistema='".date('d/m/Y')."'

					 ) as contactos_efectivos
					,(SELECT COUNT(DISTINCT cod_venta) FROM bancochile.ventas WHERE 
					    idunico IN (SELECT ws_idunico FROM bancochile.clientes WHERE ws_id_usuario != 800 AND ws_fecha_carga::integer =".date('Ym')."01)
					    AND fmt_date(fecha, 'yyyymmdd') BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int
					 ) as Ventas
					FROM bancochile.clientes
					WHERE ws_fecha_carga::integer =".date('Ym')."01
					AND ws_marca <>'rebajado'
					AND ws_estado_registro='Finalizado' 
					GROUP BY ws_campagna";
			// $q7 = consultar_tlmk($sql7);
			// $ob->alert($q6);
			$tabla2 = "";
			if($q7 != "NO")
			{
				$datos7 = explode("::", $q7);
				$tabla2 = '<br><br>
							<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Campa&ntilde;a</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT IVR/Ejec.</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT Ejec.</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contactabilidad</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Ventas</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Efic. %</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos7 as $x)
				{
					if(!empty($x))
					{
						$datos7_2 = explode("||", $x);
						$campana = $datos7_2[0];
						$cargado = $datos7_2[1];
						$rutIvrEjec = $datos7_2[2];
						$rutEjec = $datos7_2[3];
						$contEfect = $datos7_2[4];
						$ventasNet = $datos7_2[5];
						$rutIvrEjecPOR = number_format((($rutIvrEjec / $cargado) * 100),2,".","")."%";
						$rutEjecPOR = number_format((($rutEjec / $rutIvrEjec) * 100),2,".","")."%";
						$contEfectPOR = number_format((($contEfect / $rutEjec) * 100),2,".","")."%";
						if(intval($contEfectPOR) > 55)
						{
							$color = 'green';
						}
						elseif(intval($contEfectPOR) < 15)
						{
							$color = 'red';
						}
						else
						{
							$color = '#064C75';
						}
						// $color = (intval($contEfectPOR) > 55)?'green':'#064C75';
						$eficienciaPOR = number_format((($ventasNet / $contEfect) * 100),2,".","")."%";
						$penetracionPOR = number_format((($ventasNet / $cargado) * 100),2,".","")."%";
						$tabla2 .= '<tr>
				  					<td class="ui-camp-body">'.$campana.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutIvrEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutIvrEjecPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjecPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$contEfect.'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="color:'.$color.'">'.$contEfectPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ventasNet.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$eficienciaPOR.'</td>
				  				</tr>';
					}

				}

				$tabla2 .= '</tbody>
					  	   </table>';
			}
			// CCH
			$ob->assign("campDetails","innerHTML",$tabla);
			$ob->assign("campDetails2","innerHTML",$tabla2);
			$ob->script("reloadContent('DET');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		case 'EJE':
			$sql = "SELECT
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM fidelizacion.ventas WHERE fecha=fmt_date(now(),'yyyymmdd'))
					||'/'||
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM fidelizacion.cargas WHERE ws_fecha_sistema = fmt_date(now(),'dd/mm/yyyy') and ws_id_usuario::integer not in (718,771,776,800))
					;";
			$q = consultar($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(ws_id_usuario) as Recorridos 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800','718','771','776')
					AND campana IN ('1_Ano_Vigencia_".date('Ym')."01'
						,'1_Ano_Vigencia_Generales_".date('Ym')."01'
						,'2_Anos_Vigencia_".date('Ym')."01'
						,'2_Anos_Vigencia_Grales_".date('Ym')."01'
						,'4_Meses_Vigencia_".date('Ym')."01'
						,'Nuevos_Clientes_".date('Ym')."01'
						,'Nuevos_Productos_".date('Ym')."01'
						,'Referidos_02".date('mY')."'
						)
					;";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
							contacto_fono1 = 'Efectivo' or 
							contacto_fono2 = 'Efectivo' or 
							contacto_fono3 = 'Efectivo' or 
							contacto_fono4 = 'Efectivo' or 
							contacto_fono5 = 'Efectivo' or 
							contacto_fono6 = 'Efectivo' or 
							ws_idunico IN (SELECT 
											idunico 
										   FROM fidelizacion.gestiones_telefonos 
										   WHERE fmt_date(fecha,'yyyymmdd')::int between now() and now() 
										   AND ws_idunico = idunico 
										   AND contacto = 'Efectivo' ) 
							THEN 1 ELSE 0 END) 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario NOT IN ('800','718','771','776')
					AND campana IN ('1_Ano_Vigencia_".date('Ym')."01'
						,'1_Ano_Vigencia_Generales_".date('Ym')."01'
						,'2_Anos_Vigencia_".date('Ym')."01'
						,'2_Anos_Vigencia_Grales_".date('Ym')."01'
						,'4_Meses_Vigencia_".date('Ym')."01'
						,'Nuevos_Clientes_".date('Ym')."01'
						,'Nuevos_Productos_".date('Ym')."01'
						,'Referidos_02".date('mY')."'
						)
					;";
			$q3 = consultar($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$color = (intval($contactabilidad) > 50)?'green':'red';
			$contactabilidad = '<span style="color:'.$color.'">'.$contactabilidad.'</span>';
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM fidelizacion.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 ;";
			$q4 = consultar($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta = 'OK';";
			$q5 = consultar($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$ob->assign("netasActual","innerHTML",$netas5);
			$sql55 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."';";
			$q55 = consultar($sql55);
			if($q55 != "NO")
			{
				$datos55 = explode("||", $q55);
				$brutas55 = $datos55[0];
			}
			$ob->assign("brutasActual","innerHTML",$brutas55);
			$sql51 = "SELECT COUNT(cod_venta) FROM bancochile.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q51 = consultar_tlmk($sql51);
			if($q51 != "NO")
			{
				$datos51 = explode("||", $q51);
				$netas51 = $datos51[0];
			}
			$ob->assign("netasActualBCH","innerHTML",$netas51);
			$sql52 = "SELECT COUNT(cod_venta) FROM credichile_ventas.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q52 = consultar_tlmk($sql52);
			if($q52 != "NO")
			{
				$datos52 = explode("||", $q52);
				$netas52 = $datos52[0];
			}
			$ob->assign("netasActualCCH","innerHTML",$netas52);
			// -------------------------------------------------------------------------------------------------------------------
			//DIAS HABILES DEL MES
			$sql9 = "SELECT count(*) 
					FROM generate_series(0, ('".date('Y/m/t')."'::date - '".date('Y/m/')."01'::date::date)) i
					WHERE date_part('dow', '".date('Y/m/')."01'::date::date + i) NOT IN (0,6);";
			$q9 = consultar($sql9);
			if($q9 != "NO")
			{
				$datos9 = explode("||", $q9);
				$diasHabiles9 = $datos9[0];
				// $diasHabiles9 = $diasHabiles9 - 6 ;
			}
			//DIAS TRABAJADOS DEL MES
			$sql91 = "SELECT COUNT(DISTINCT ws_fecha_sistema)
						FROM fidelizacion.cargas c
						WHERE campana IN ('1_Ano_Vigencia_".date('Ym')."01'
						,'1_Ano_Vigencia_Generales_".date('Ym')."01'
						,'2_Anos_Vigencia_".date('Ym')."01'
						,'2_Anos_Vigencia_Grales_".date('Ym')."01'
						,'4_Meses_Vigencia_".date('Ym')."01'
						,'Nuevos_Clientes_".date('Ym')."01'
						,'Nuevos_Productos_".date('Ym')."01'
						,'Referidos_02".date('mY')."'
						) ;";
			$q91 = consultar($sql91);
			if($q91 != "NO")
			{
				$datos91 = explode("||", $q91);
				$diasTrabajados91 = $datos91[0];
			}
			//PROYECCION
			$proyeccion = intval(($brutas55 * $diasHabiles9) / $diasTrabajados91);
			$ob->assign("proyeccionActual","innerHTML",$proyeccion);
			// -------------------------------------------------------------------------------------------------------------------
			$sql6 = "SELECT 
					(SELECT nombre_fantasia FROM usuarios WHERE idusuario = c.ws_id_usuario) as ejecutivo
					,COUNT(ws_id_usuario) as Recorridos
					,SUM(CASE WHEN ws_agen_estado = 'AGENDA' THEN 1 ELSE 0 END) AS Agendados
					,SUM(CASE WHEN contacto_fono1 = 'Efectivo' OR contacto_fono2 = 'Efectivo' OR contacto_fono3 = 'Efectivo' OR contacto_fono4 = 'Efectivo' OR contacto_fono5 = 'Efectivo' 
					OR contacto_fono6 = 'Efectivo'  THEN 1 ELSE 0 END) as contactos_efectivos
					,(SELECT COUNT(DISTINCT cod_venta) FROM fidelizacion.ventas WHERE 
					    fmt_date(fecha, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int
					    AND ws_id_usuario = c.ws_id_usuario  
					) as \"Ventas\"
					,(max(ws_hora_sistema)::interval - min(split_part(split_part(ws_marca,' ',2),'.',1))::interval) as tiempo_online
					,(select sum(duration) from cdr_camaleon where idagente = c.ws_id_usuario and solofecha = ".date('Ymd')." )::varchar::interval as duration
					FROM fidelizacion.cargas c
					WHERE campana IN ('1_Ano_Vigencia_".date('Ym')."01'
					,'1_Ano_Vigencia_Generales_".date('Ym')."01'
					,'2_Anos_Vigencia_".date('Ym')."01'
					,'2_Anos_Vigencia_Grales_".date('Ym')."01'
					,'4_Meses_Vigencia_".date('Ym')."01'
					,'Nuevos_Clientes_".date('Ym')."01'
					,'Nuevos_Productos_".date('Ym')."01'
					,'Referidos_02".date('mY')."'
					) 
					AND fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int
					AND ws_id_usuario not in (800,718,771,776)
					AND ws_estado_registro = 'Finalizado'
					AND ws_marca NOT IN ('disp')
					GROUP BY c.ws_id_usuario 
					ORDER BY \"Ventas\" DESC";
			$q6 = consultar($sql6);
			if($q6 != "NO")
			{
				$datos6 = explode("::", $q6);
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Ejecutivo</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Recorridos</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Agendados</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contactabilidad</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Ventas</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Efic. %</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Tiempo Online</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Tiempo Conversado</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$ejecutivo = $datos6_2[0];
						$rutEjec = $datos6_2[1];
						$ageEjec = $datos6_2[2];
						$contEfect = $datos6_2[3];
						$ventasNet = $datos6_2[4];
						$tiempoOnline = $datos6_2[5];
						$tiempoConversado = $datos6_2[6];
						
						$contEfectPOR = number_format((($contEfect / $rutEjec) * 100),2,".","")."%";
						if(intval($contEfectPOR) > 55)
						{
							$color = 'green';
						}
						elseif(intval($contEfectPOR) < 15)
						{
							$color = 'red';
						}
						else
						{
							$color = '#064C75';
						}
						$eficienciaPOR = number_format((($ventasNet / $contEfect) * 100),2,".","")."%";

						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$ejecutivo.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ageEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$contEfect.'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="color:'.$color.'">'.$contEfectPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ventasNet.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$eficienciaPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$tiempoOnline.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$tiempoConversado.'</td>
				  				</tr>';
					}

				}

				$tabla .= '</tbody>
					  	   </table>';
			}

			$ob->assign("campEjecutivos","innerHTML",$tabla);
			$ob->script("reloadContent('EJE');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		//RECUPERO ----------------------------------------------------------------------------------------------------------------
		case 'RECU':
			$sql = "SELECT
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM recuperacion.ventas WHERE fecha=fmt_date(now(),'yyyymmdd'))
					||'/'||
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM recuperacion.cargas WHERE ws_fecha_sistema = fmt_date(now(),'dd/mm/yyyy'))
					;";
			$q = consultar($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(ws_id_usuario) as Recorridos 
					FROM recuperacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					;";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
						gestion_fono1 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono2 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono3 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono4 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono5 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono6 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						ws_idunico IN (SELECT 
									idunico 
								   FROM recuperacion.gestiones_telefonos 
								   WHERE fecha::int between fmt_date(now(), 'yyyymmdd')::int and fmt_date(now(), 'yyyymmdd')::int
								   AND contacto = 'CONTACTADO'
								   AND gestion <> 'Corta Llamado'
							 ) 
						THEN 1 ELSE 0 END) 
					FROM recuperacion.cargas
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					;";
			$q3 = consultar($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$color = (intval($contactabilidad) > 50)?'green':'red';
			$contactabilidad = '<span style="color:'.$color.'">'.$contactabilidad.'</span>';
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM recuperacion.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 ;";
			$q4 = consultar($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(cod_venta) FROM recuperacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta = 'OK';";
			$q5 = consultar($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$ob->assign("netasActual","innerHTML",$netas5);
			$sql55 = "SELECT COUNT(cod_venta) FROM recuperacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."';";
			$q55 = consultar($sql55);
			if($q55 != "NO")
			{
				$datos55 = explode("||", $q55);
				$brutas55 = $datos55[0];
			}
			$ob->assign("brutasActual","innerHTML",$brutas55);
			// $sql51 = "SELECT COUNT(cod_venta) FROM bancochile.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q51 = consultar_tlmk($sql51);
			// if($q51 != "NO")
			// {
			// 	$datos51 = explode("||", $q51);
			// 	$netas51 = $datos51[0];
			// }
			// $ob->assign("netasActualBCH","innerHTML",$netas51);
			// $sql52 = "SELECT COUNT(cod_venta) FROM credichile_ventas.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q52 = consultar_tlmk($sql52);
			// if($q52 != "NO")
			// {
			// 	$datos52 = explode("||", $q52);
			// 	$netas52 = $datos52[0];
			// }
			// $ob->assign("netasActualCCH","innerHTML",$netas52);
			// -------------------------------------------------------------------------------------------------------------------
			//DIAS HABILES DEL MES
			$sql9 = "SELECT count(*) 
					FROM generate_series(0, ('".date('Y/m/t')."'::date - '".date('Y/m/')."01'::date::date)) i
					WHERE date_part('dow', '".date('Y/m/')."01'::date::date + i) NOT IN (0,6);";
			$q9 = consultar($sql9);
			if($q9 != "NO")
			{
				$datos9 = explode("||", $q9);
				$diasHabiles9 = $datos9[0];
				$diasHabiles9 = $diasHabiles9 - 1 ;
			}
			//DIAS TRABAJADOS DEL MES
			$sql91 = "SELECT COUNT(DISTINCT ws_fecha_sistema)
						FROM recuperacion.cargas c
						WHERE fmt_date(ws_fecha_carga, 'yyyymm') = '".date('Ym')."' ;";
			$q91 = consultar($sql91);
			if($q91 != "NO")
			{
				$datos91 = explode("||", $q91);
				$diasTrabajados91 = $datos91[0];
			}
			//PROYECCION
			$proyeccion = intval(($brutas55 * $diasHabiles9) / $diasTrabajados91);
			$ob->assign("proyeccionActual","innerHTML",$proyeccion);
			// -------------------------------------------------------------------------------------------------------------------
			$sql6 = "SELECT 
					c.lote as campana
					,(select COUNT(e.ws_idunico) from recuperacion.cargas e WHERE e.lote = c.lote) as base_cargada_rut
					,(SELECT COUNT(e.ws_id_usuario) FROM recuperacion.cargas e WHERE e.lote = c.lote
					AND fmt_date(ws_fecha_sistema, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int
					) as Rut_Trabajado_Ejecutivo

					,(SELECT SUM(CASE WHEN (
					gestion_fono1 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
					gestion_fono2 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
					gestion_fono3 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
					gestion_fono4 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
					gestion_fono5 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
					gestion_fono6 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
					ws_idunico IN (SELECT 
						idunico 
					       FROM recuperacion.gestiones_telefonos 
					       WHERE fecha::int = fmt_date(now(), 'yyyymmdd')::int
					       AND contacto = 'CONTACTADO'
					       AND gestion <> 'Corta Llamado'
					      ) 
					) THEN 1 ELSE 0 END) FROM recuperacion.cargas WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int
					AND (lote = c.lote) ) as contactos_efectivos

					,(select SUM(CASE WHEN recupera IN ('Retractado', 'Si', 'Retracta 3ro por Incapacidad de Cliente') THEN 1 ELSE 0 END) 
					   from recuperacion.cargas a, recuperacion.seguros b where a.lote = b.lote and a.rut_cliente = b.rut_cliente and a.lote = c.lote 
					   AND fmt_date(a.ws_fecha_sistema, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int) as recuperos

					,(SELECT COUNT(DISTINCT cod_venta) FROM recuperacion.ventas WHERE idunico IN 
					(SELECT ws_idunico FROM recuperacion.cargas WHERE lote = c.lote)
					AND fmt_date(fecha, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int 
					AND cambio_plan = 'No') as Ventas

					,(SELECT COUNT(DISTINCT cod_venta) FROM recuperacion.ventas WHERE idunico IN 
					(SELECT ws_idunico FROM recuperacion.cargas WHERE lote = c.lote)
					AND fmt_date(fecha, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int 
					AND cambio_plan = 'Si') as cambioPlan

					FROM recuperacion.cargas c
					WHERE fmt_date(ws_fecha_carga, 'yyyymm') = '".date('Ym')."'
					AND fmt_date(ws_fecha_sistema, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int
					GROUP BY c.lote 
					ORDER BY c.lote";
			$q6 = consultar($sql6);
			// $ob->alert($q6);
			if($q6 != "NO")
			{
				$datos6 = explode("::", $q6);
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Lote</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT Ejec.</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contactabilidad</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Recuperos</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Ventas</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Cambios de Plan</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$lote = $datos6_2[0];
						$cargado = $datos6_2[1];
						$rutEjec = $datos6_2[2];
						$contEfect = $datos6_2[3];
						$recuperos = ($datos6_2[4] == "")?0:$datos6_2[4];
						$ventasNet = $datos6_2[5];
						$cambiosPlan = $datos6_2[6];
						$rutEjecPOR = number_format((($rutEjec / $cargado) * 100),2,".","")."%";
						$contEfectPOR = number_format((($contEfect / $rutEjec) * 100),2,".","")."%";
						if(intval($contEfectPOR) > 55)
						{
							$color = 'green';
						}
						elseif(intval($contEfectPOR) < 15)
						{
							$color = 'red';
						}
						else
						{
							$color = '#064C75';
						}
						// $color = (intval($contEfectPOR) > 55)?'green':'#064C75';
						$eficienciaPOR = number_format((($ventasNet / $contEfect) * 100),2,".","")."%";
						$penetracionPOR = number_format((($ventasNet / $cargado) * 100),2,".","")."%";
						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$lote.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjecPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$contEfect.'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="color:'.$color.'">'.$contEfectPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$recuperos.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ventasNet.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$cambiosPlan.'</td>
				  				</tr>';
					}

				}

				$tabla .= '</tbody>
					  	   </table>';
			}

			
			$ob->assign("campRecuDetails","innerHTML",$tabla);
			$ob->script("reloadContent('RECU');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		case 'EJER':
			$sql = "SELECT
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM recuperacion.ventas WHERE fecha=fmt_date(now(),'yyyymmdd'))
					||'/'||
					(SELECT COUNT(DISTINCT ws_id_usuario) FROM recuperacion.cargas WHERE ws_fecha_sistema = fmt_date(now(),'dd/mm/yyyy'))
					;";
			$q = consultar($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(ws_id_usuario) as Recorridos 
					FROM recuperacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					;";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
						gestion_fono1 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono2 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono3 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono4 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono5 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono6 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						ws_idunico IN (SELECT 
									idunico 
								   FROM recuperacion.gestiones_telefonos 
								   WHERE fecha::int between fmt_date(now(), 'yyyymmdd')::int and fmt_date(now(), 'yyyymmdd')::int
								   AND contacto = 'CONTACTADO'
								   AND gestion <> 'Corta Llamado'
							 ) 
						THEN 1 ELSE 0 END) 
					FROM recuperacion.cargas
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					;";
			$q3 = consultar($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$color = (intval($contactabilidad) > 50)?'green':'red';
			$contactabilidad = '<span style="color:'.$color.'">'.$contactabilidad.'</span>';
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM recuperacion.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 AND cambio_plan = 'No'
					 ;";
			$q4 = consultar($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(cod_venta) FROM recuperacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta = 'OK' AND cambio_plan = 'No';";
			$q5 = consultar($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$ob->assign("netasActual","innerHTML",$netas5);
			$sql55 = "SELECT COUNT(cod_venta) FROM recuperacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."';";
			$q55 = consultar($sql55);
			if($q55 != "NO")
			{
				$datos55 = explode("||", $q55);
				$brutas55 = $datos55[0];
			}
			$ob->assign("brutasActual","innerHTML",$brutas55);
			// $sql51 = "SELECT COUNT(cod_venta) FROM bancochile.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q51 = consultar_tlmk($sql51);
			// if($q51 != "NO")
			// {
			// 	$datos51 = explode("||", $q51);
			// 	$netas51 = $datos51[0];
			// }
			// $ob->assign("netasActualBCH","innerHTML",$netas51);
			// $sql52 = "SELECT COUNT(cod_venta) FROM credichile_ventas.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q52 = consultar_tlmk($sql52);
			// if($q52 != "NO")
			// {
			// 	$datos52 = explode("||", $q52);
			// 	$netas52 = $datos52[0];
			// }
			// $ob->assign("netasActualCCH","innerHTML",$netas52);
			// -------------------------------------------------------------------------------------------------------------------
			//DIAS HABILES DEL MES
			$sql9 = "SELECT count(*) 
					FROM generate_series(0, ('".date('Y/m/t')."'::date - '".date('Y/m/')."01'::date::date)) i
					WHERE date_part('dow', '".date('Y/m/')."01'::date::date + i) NOT IN (0,6);";
			$q9 = consultar($sql9);
			if($q9 != "NO")
			{
				$datos9 = explode("||", $q9);
				$diasHabiles9 = $datos9[0];
				$diasHabiles9 = $diasHabiles9 - 1 ;
			}
			//DIAS TRABAJADOS DEL MES
			$sql91 = "SELECT COUNT(DISTINCT ws_fecha_sistema)
						FROM recuperacion.cargas
						WHERE ws_fecha_carga like '".date('Ym')."%' ";
			$q91 = consultar($sql91);
			if($q91 != "NO")
			{
				$datos91 = explode("||", $q91);
				$diasTrabajados91 = $datos91[0];
			}
			//PROYECCION
			$proyeccion = intval(($brutas55 * $diasHabiles9) / $diasTrabajados91);
			$ob->assign("proyeccionActual","innerHTML",$proyeccion);
			// -------------------------------------------------------------------------------------------------------------------
			$sql6 = "SELECT 
					(SELECT nombre_fantasia FROM usuarios WHERE idusuario = c.ws_id_usuario) as ejecutivo
					,COUNT(ws_id_usuario) as Recorridos
					,SUM(CASE WHEN ws_agen_estado = 'AGENDA' THEN 1 ELSE 0 END) AS Agendados
					,SUM(CASE WHEN 
						gestion_fono1 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono2 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono3 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono4 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono5 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono6 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)')  
						-- ws_idunico IN (SELECT 
						-- 			idunico 
						-- 		   FROM recuperacion.gestiones_telefonos 
						-- 		   WHERE fecha::int between fmt_date(now(), 'yyyymmdd')::int and fmt_date(now(), 'yyyymmdd')::int
						-- 		   AND contacto = 'CONTACTADO'
						-- 		   AND gestion <> 'Corta Llamado'
						-- 	 ) 
						THEN 1 ELSE 0 END) as contactos_efectivos
					,(SELECT COUNT(DISTINCT cod_venta) FROM recuperacion.ventas WHERE 
					    fmt_date(fecha, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int
					    AND cambio_plan = 'No'
					    AND ws_id_usuario = c.ws_id_usuario  
					) as \"Ventas\"
					,SUM(CASE WHEN recupera IN ('Retractado', 'Si', 'Retracta 3ro por Incapacidad de Cliente') THEN 1 ELSE 0 END)as \"Recuperos\"
					,(SELECT COUNT(DISTINCT cod_venta) FROM recuperacion.ventas WHERE 
					    fmt_date(fecha, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int
					    AND cambio_plan = 'Si'
					    AND ws_id_usuario = c.ws_id_usuario  
					) as \"Cambio de Plan\"
					,(max(ws_hora_sistema)::interval - min(split_part(split_part(ws_marca,' ',2),'.',1))::interval) as tiempo_online
					,(select sum(duration) from cdr_camaleon where idagente = c.ws_id_usuario and solofecha = ".date('Ymd')." )::varchar::interval as duration
					
					FROM recuperacion.cargas c, recuperacion.seguros d
					WHERE ws_fecha_sistema = '".date('d/m/Y')."'
					AND c.lote = d.lote
					AND c.rut_cliente = d.rut_cliente
					GROUP BY c.ws_id_usuario 
					ORDER BY \"Ventas\" DESC";
			$q6 = consultar($sql6);
			// $ob->alert($q6);
			if($q6 != "NO")
			{
				$datos6 = explode("::", $q6);
				// $tabla = '<table class="ui-camp-table">
							// <tbody>';
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Ejecutivo</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Recorridos</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Agendados</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contactabilidad</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Recuperos</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Ventas</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Cambios de Plan</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Efic. %</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Tiempo Online</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Tiempo Conversado</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$ejecutivo = $datos6_2[0];
						$rutEjec = $datos6_2[1];
						$ageEjec = $datos6_2[2];
						$contEfect = $datos6_2[3];
						$ventasNet = $datos6_2[4];
						$recuperos = $datos6_2[5];
						$cambiosPlan = $datos6_2[6];
						$contEfectPOR = number_format((($contEfect / $rutEjec) * 100),2,".","")."%";
						if(intval($contEfectPOR) > 55)
						{
							$color = 'green';
						}
						elseif(intval($contEfectPOR) < 15)
						{
							$color = 'red';
						}
						else
						{
							$color = '#064C75';
						}
						// $color = (intval($contEfectPOR) > 55)?'green':'#064C75';
						$eficienciaPOR = number_format((($ventasNet / $contEfect) * 100),2,".","")."%";
						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$ejecutivo.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ageEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$contEfect.'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="color:'.$color.'">'.$contEfectPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$recuperos.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ventasNet.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$cambiosPlan.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$eficienciaPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[7].'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[8].'</td>
				  				</tr>';
					}

				}

				$tabla .= '</tbody>
					  	   </table>';
			}

			$ob->assign("campRecuEjecutivos","innerHTML",$tabla);
			$ob->script("reloadContent('EJER');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		//RETENCION ---------------------------------------------------------------------------------------------------------------
		case 'RETE':
			$sql = "SELECT COUNT(DISTINCT ws_id_usuario) FROM retencion.cargas WHERE ws_fecha_sistema= '".date("d/m/Y")."';";
			$q = consultar($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(ws_id_usuario) as Recorridos 
					FROM retencion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					;";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
						gestion_fono1 in ('Aceptar Llamada','Llamar al Celular') or 
						gestion_fono2 in ('Aceptar Llamada','Llamar al Celular') or 
						gestion_fono3 in ('Aceptar Llamada','Llamar al Celular') or 
						gestion_fono4 in ('Aceptar Llamada','Llamar al Celular') or 
						gestion_fono5 in ('Aceptar Llamada','Llamar al Celular') or 
						gestion_fono6 in ('Aceptar Llamada','Llamar al Celular') or 
						ws_idunico IN (SELECT 
									idunico 
								   FROM retencion.gestiones_telefonos 
								   WHERE fecha::int between fmt_date(now(), 'yyyymmdd')::int and fmt_date(now(), 'yyyymmdd')::int
								   AND contacto = 'CONTACTADO'
								   AND gestion <> 'Corta Llamado'
							 ) 
						THEN 1 ELSE 0 END) 
					FROM retencion.cargas
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					;";
			$q3 = consultar($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$color = (intval($contactabilidad) > 50)?'green':'red';
			$contactabilidad = '<span style="color:'.$color.'">'.$contactabilidad.'</span>';
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			// $sql4 = "SELECT 
			// 			COUNT(*) 
			// 		 FROM retencion.ventas 
			// 		 WHERE fecha=fmt_date(now(),'yyyymmdd') 
			// 		 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
			// 		 AND cambio_plan = 'No'
			// 		 ;";
			// $q4 = consultar($sql4);
			// if($q4 != "NO")
			// {
			// 	$datos4 = explode("||", $q4);
			// 	$ventas = $datos4[0];
			// }
			$ventas = 0;
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(cod_venta) FROM recuperacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta = 'OK' AND cambio_plan = 'No';";
			// $q5 = consultar($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$netas5 = 0;
			$ob->assign("netasActual","innerHTML",$netas5);
			$sql55 = "SELECT COUNT(cod_venta) FROM recuperacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."';";
			// $q55 = consultar($sql55);
			if($q55 != "NO")
			{
				$datos55 = explode("||", $q55);
				$brutas55 = $datos55[0];
			}
			$brutas55 = 0;
			$ob->assign("brutasActual","innerHTML",$brutas55);
			$sql51 = "SELECT COUNT(cod_venta) FROM bancochile.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q51 = consultar_tlmk($sql51);
			if($q51 != "NO")
			{
				$datos51 = explode("||", $q51);
				$netas51 = $datos51[0];
			}
			$ob->assign("netasActualBCH","innerHTML",$netas51);
			$sql52 = "SELECT COUNT(cod_venta) FROM credichile_ventas.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			// $q52 = consultar_tlmk($sql52);
			if($q52 != "NO")
			{
				$datos52 = explode("||", $q52);
				$netas52 = $datos52[0];
			}
			$ob->assign("netasActualCCH","innerHTML",$netas52);
			// -------------------------------------------------------------------------------------------------------------------
			//DIAS HABILES DEL MES
			$sql9 = "SELECT count(*) 
					FROM generate_series(0, ('".date('Y/m/t')."'::date - '".date('Y/m/')."01'::date::date)) i
					WHERE date_part('dow', '".date('Y/m/')."01'::date::date + i) NOT IN (0,6);";
			$q9 = consultar($sql9);
			if($q9 != "NO")
			{
				$datos9 = explode("||", $q9);
				$diasHabiles9 = $datos9[0];
				$diasHabiles9 = $diasHabiles9 - 1 ;
			}
			//DIAS TRABAJADOS DEL MES
			$sql91 = "SELECT COUNT(DISTINCT ws_fecha_sistema)
						FROM retencion.cargas
						WHERE ws_fecha_carga = '".date('Ym')."01' ";
			$q91 = consultar($sql91);
			if($q91 != "NO")
			{
				$datos91 = explode("||", $q91);
				$diasTrabajados91 = $datos91[0];
			}
			//PROYECCION
			$proyeccion = intval(($brutas55 * $diasHabiles9) / $diasTrabajados91);
			$ob->assign("proyeccionActual","innerHTML",$proyeccion);
			// -------------------------------------------------------------------------------------------------------------------
			$sql6 = "SELECT 
					(SELECT nombre_fantasia FROM usuarios WHERE idusuario = c.ws_id_usuario) as ejecutivo
					,COUNT(ws_id_usuario) as Recorridos
					,SUM(CASE WHEN ws_agen_estado = 'AGENDA' THEN 1 ELSE 0 END) AS Agendados
					,SUM(CASE WHEN 
						gestion_fono1 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono2 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono3 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono4 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono5 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						gestion_fono6 in ('Aceptar Llamada','Cliente Ocupado','Cliente pide volver a llamar','Llamar en la tarde (pm)','Llamar en la tarde (am)') or 
						ws_idunico IN (SELECT 
									idunico 
								   FROM recuperacion.gestiones_telefonos 
								   WHERE fecha::int between fmt_date(now(), 'yyyymmdd')::int and fmt_date(now(), 'yyyymmdd')::int
								   AND contacto = 'CONTACTADO'
								   AND gestion <> 'Corta Llamado'
							 ) 
						THEN 1 ELSE 0 END) as contactos_efectivos
					,(SELECT COUNT(DISTINCT cod_venta) FROM recuperacion.ventas WHERE 
					    fmt_date(fecha, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int
					    AND cambio_plan = 'No'
					    AND ws_id_usuario = c.ws_id_usuario  
					) as \"Ventas\"
					,SUM(CASE WHEN d.retencion IN ('Retiene') THEN 1 ELSE 0 END)as \"Retenciones\"
					,SUM(CASE WHEN gestion_retencion in ('Cambio Medio de Pago - BCH','Cambio Medio de Pago - Otros Bancos','Cambio medio pago 01') then 1 else 0 end) 
						+(select count(i.lote) from retencion.ingreso_seguros i,retencion.cargas c1 where i.ws_id_usuario = c.ws_id_usuario 
						and i.rut_cliente=c1.rut_cliente and i.lote=c1.lote 
						and fmt_date(i.ws_fecha_sistema,'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int  
						and i.gestion_retencion in ('Cambio Medio de Pago - BCH','Cambio Medio de Pago - Otros Bancos','Cambio medio pago 01') )
						as \"CMP01\"

					,sum(case when gestion_retencion in ('Compromiso de Pago','Transferencia o Deposito 05','Compromiso Pago 04','Pago Directo') then 1 else 0 end) 
						+(select count(i.lote) from retencion.ingreso_seguros i,retencion.cargas c1 where i.ws_id_usuario = c.ws_id_usuario 
						and i.rut_cliente=c1.rut_cliente and i.lote=c1.lote 
						and fmt_date(i.ws_fecha_sistema,'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int  
						and i.gestion_retencion in ('Compromiso de Pago','Transferencia o Deposito 05','Compromiso Pago 04','Pago Directo') )
						as \"COMP04\"
					,(max(ws_hora_sistema)::interval - min(split_part(split_part(ws_marca,' ',2),'.',1))::interval) as tiempo_online
					,(select sum(duration) from cdr_camaleon where idagente = c.ws_id_usuario and solofecha = ".date('Ymd')." )::varchar::interval as duration
					
					FROM retencion.cargas c, retencion.seguros d
					WHERE ws_fecha_sistema = '".date('d/m/Y')."'
					AND c.lote = d.lote
					AND c.rut_cliente = d.rut_cliente
					GROUP BY c.ws_id_usuario 
					ORDER BY \"Ventas\" DESC";
			$q6 = consultar($sql6);
			// $ob->alert($q6);
			if($q6 != "NO")
			{
				$datos6 = explode("::", $q6);
				// $tabla = '<table class="ui-camp-table">
							// <tbody>';
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Ejecutivo</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Recorridos</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Agendados</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contactabilidad</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Retenciones</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Ventas</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">CMP01</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">CMP04</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Efic. %</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Tiempo Online</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Tiempo Conversado</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$ejecutivo = $datos6_2[0];
						$rutEjec = $datos6_2[1];
						$ageEjec = $datos6_2[2];
						$contEfect = $datos6_2[3];
						$ventasNet = $datos6_2[4];
						$retenciones = $datos6_2[5];
						$cambiosPlan01 = $datos6_2[6];
						$cambiosPlan04 = $datos6_2[7];
						$contEfectPOR = number_format((($contEfect / $rutEjec) * 100),2,".","")."%";
						if(intval($contEfectPOR) > 55)
						{
							$color = 'green';
						}
						elseif(intval($contEfectPOR) < 15)
						{
							$color = 'red';
						}
						else
						{
							$color = '#064C75';
						}
						// $color = (intval($contEfectPOR) > 55)?'green':'#064C75';
						$eficienciaPOR = number_format((($ventasNet / $contEfect) * 100),2,".","")."%";
						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$ejecutivo.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ageEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$contEfect.'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="color:'.$color.'">'.$contEfectPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$retenciones.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ventasNet.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$cambiosPlan01.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$cambiosPlan04.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$eficienciaPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[8].'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[9].'</td>
				  				</tr>';
					}

				}

				$tabla .= '</tbody>
					  	   </table>';
			}

			$ob->assign("campRetencion","innerHTML",$tabla);
			$ob->script("reloadContent('RETE');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		//CERTIFICACION -----------------------------------------------------------------------------------------------------------
		case 'CERT':
			// -------------------------------------------------------------------------------------------------------------------
			$sql6 = "SELECT 
					'Fidelizacion'::varchar
					,SUM(CASE WHEN estado_venta = 'OK' THEN 1 ELSE 0 END) AS ventas_ok
					,SUM(CASE WHEN estado_venta = 'PENDIENTE' THEN 1 ELSE 0 END) AS ventas_pendiente
					,SUM(CASE WHEN estado_venta = 'PENDIENTE SUPERVISOR' THEN 1 ELSE 0 END) AS ventas_pendiente_sup
					,SUM(CASE WHEN estado_venta = 'RECHAZADO' THEN 1 ELSE 0 END) AS ventas_rechazado
					,SUM(CASE WHEN estado_venta = 'Venta No Auditada' THEN 1 ELSE 0 END) AS ventas_sin_auditar
					FROM fidelizacion.ventas
					WHERE fmt_date(fecha, 'yyyymm')::int = ".date('Ym')."
					UNION ALL
					SELECT 
					'Recuperacion Ventas'::varchar
					,SUM(CASE WHEN estado_venta = 'OK' THEN 1 ELSE 0 END) AS ventas_ok
					,SUM(CASE WHEN estado_venta = 'PENDIENTE' THEN 1 ELSE 0 END) AS ventas_pendiente
					,SUM(CASE WHEN estado_venta = 'PENDIENTE SUPERVISOR' THEN 1 ELSE 0 END) AS ventas_pendiente_sup
					,SUM(CASE WHEN estado_venta = 'RECHAZADO' THEN 1 ELSE 0 END) AS ventas_rechazado
					,SUM(CASE WHEN estado_venta = 'Venta No Auditada' THEN 1 ELSE 0 END) AS ventas_sin_auditar
					FROM recuperacion.ventas
					WHERE fmt_date(fecha, 'yyyymm')::int = ".date('Ym')."
					UNION ALL
					SELECT 
					'Recuperos'::varchar
					,SUM(CASE WHEN b.estado_calidad = 'OK' AND recupera = 'Retractado' THEN 1 ELSE 0 END) AS ventas_ok
					,SUM(CASE WHEN b.estado_calidad = 'PENDIENTE' AND recupera = 'Retractado' THEN 1 ELSE 0 END) AS ventas_pendiente
					,0 AS ventas_pendiente_sup
					,SUM(CASE WHEN b.estado_calidad = 'RECHAZADO' AND recupera = 'Retractado' THEN 1 ELSE 0 END) AS ventas_rechazado
					,SUM(CASE WHEN b.estado_calidad IS NULL AND recupera = 'Retractado' THEN 1 ELSE 0 END) AS ventas_sin_auditar
					FROM recuperacion.cargas a, recuperacion.seguros b
					WHERE recupera  IN ('Si', 'Retractado','Retracta 3ro por Incapacidad de Cliente')
					AND a.lote = b.lote
					AND a.rut_cliente = b.rut_cliente
					AND fmt_date(ws_fecha_sistema, 'yyyymm')::int = ".date('Ym')."
					UNION ALL
					SELECT 
					'Retencion'::varchar
					,SUM(CASE WHEN a.estado_calidad = 'OK' AND b.retencion = 'Retiene' THEN 1 ELSE 0 END) AS ventas_ok
					,SUM(CASE WHEN a.estado_calidad = 'PENDIENTE' AND b.retencion = 'Retiene' THEN 1 ELSE 0 END) AS ventas_pendiente
					,0 AS ventas_pendiente_sup
					,SUM(CASE WHEN a.estado_calidad = 'RECHAZADO' AND b.retencion = 'Retiene' THEN 1 ELSE 0 END) AS ventas_rechazado
					,SUM(CASE WHEN a.estado_calidad IS NULL AND b.retencion = 'Retiene' THEN 1 ELSE 0 END) AS ventas_sin_auditar
					FROM retencion.cargas a, retencion.seguros b
					WHERE b.retencion = 'Retiene'
					AND b.gestion_retencion = 'Cambio Medio de Pago - BCH'
					AND a.lote = b.lote
					AND a.rut_cliente = b.rut_cliente
					AND fmt_date(ws_fecha_sistema, 'yyyymm') = '".date('Ym')."';";
			$q6 = consultar($sql6);
			// $ob->alert($q6);
			if($q6 != "NO")
			{
				$datos6 = explode("::", $q6);
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Campa&ntilde;a</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">OK</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">PENDIENTE</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">PENDIENTE SUPERVISOR</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RECHAZADO</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">SIN AUDITAR</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$campana = $datos6_2[0];
						$ok = $datos6_2[1];
						$pendiente = $datos6_2[2];
						$pendiente_sup = $datos6_2[3];
						$rechazado = $datos6_2[4];
						$sin_auditar = $datos6_2[5];
						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$campana.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ok.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$pendiente.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$pendiente_sup.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rechazado.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$sin_auditar.'</td>
				  				</tr>';
					}

				}

				$tabla .= '</tbody>
					  	   </table>';
			}

			$ob->assign("campCertificacion","innerHTML",$tabla);
			$ob->script("reloadContent('CERT');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		//VENTAS PRODUCCION --------------------------------------------------------------------------------------------------------
		case 'RES':
			$sql = "SELECT 
					d.descripcion
					,SUM(CASE WHEN a.id_estado = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN a.id_estado = 2 THEN 1 ELSE 0 END) as env
					,SUM(CASE WHEN a.id_estado = 2 THEN 1 ELSE 0 END) as pro
					FROM ventas.gestion_pro a
					LEFT JOIN ventas.ventas_pro b ON b.id_gestion = a.id
					LEFT JOIN ventas.productos c ON c.id = b.id_producto::integer 
					LEFT JOIN ventas.campana d ON d.id = c.id_campana 
					LEFT JOIN ventas.cia e ON e.id = d.id_cia
					LEFT JOIN ventas.estado f ON f.id = a.id_estado
					WHERE fmt_date(a.fecha_envio, 'yyyymm') = fmt_date(now(), 'yyyymm')
					GROUP BY d.descripcion";
			$q = consultar_tlmk($sql);
			if($q != "NO")
			{
				$datos = explode("::", $q);
				foreach($datos as $x)
				{
					if(!empty($x))
					{
						$datos_2 = explode("||", $x);
						$campana = $datos_2[0];
						$cant_env = $datos_2[1];
						$cant_pro = $datos_2[2];
						$envActual = $cant_env."/".$cant_pro;

						switch($campana)
						{
							case 'BANCO': 		$ob->assign("envActualBCH","innerHTML",$envActual); break;
							case 'CREDI': 		$ob->assign("envActualCCH","innerHTML",$envActual); break;
							case 'ONCO': 		$ob->assign("envActualONC","innerHTML",$envActual); break;
							case 'HOGAR':		$ob->assign("envActualHOG","innerHTML",$envActual); break;
							case 'CROSS': 		$ob->assign("envActualCRO","innerHTML",$envActual); break;
							case 'EDWARDS': 	$ob->assign("envActualEDW","innerHTML",$envActual); break;
						}
					}
				}
			}
			// -----------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT 
					e.descripcion
					,d.descripcion
					,a.fecha_envio
					,SUM(CASE WHEN a.id_estado = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN a.id_estado = 2 THEN 1 ELSE 0 END) as env
					,SUM(CASE WHEN a.id_estado = 2 THEN 1 ELSE 0 END) as pro
					FROM ventas.gestion_pro a
					LEFT JOIN ventas.ventas_pro b ON b.id_gestion = a.id
					LEFT JOIN ventas.productos c ON c.id = b.id_producto::integer 
					LEFT JOIN ventas.campana d ON d.id = c.id_campana 
					LEFT JOIN ventas.cia e ON e.id = d.id_cia
					LEFT JOIN ventas.estado f ON f.id = a.id_estado
					WHERE a.fecha_envio = fmt_date(now(), 'yyyymmdd')
					GROUP BY e.descripcion,d.descripcion,a.fecha_envio";
			$q2 = consultar_tlmk($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("::", $q2);
				foreach($datos2 as $x2)
				{
					if(!empty($x2))
					{
						$datos_22 = explode("||", $x2);
						$cia = $datos_22[0];
						$campana = $datos_22[1];
						$fecha_envio = $datos_22[2];
						$cant_env = $datos_22[3];
						$cant_pro = $datos_22[4];
						$envActual = $cant_env."/".$cant_pro;

						switch($campana)
						{
							case 'BANCO':
								$ob->assign("f_env_bch","innerHTML",$fecha_envio);
								$ob->assign("env_bch","innerHTML",$cant_env);
								$ob->assign("pro_bch","innerHTML",$cant_pro);
							break;
							case 'CREDI':
								$ob->assign("f_env_cch","innerHTML",$fecha_envio);
								$ob->assign("env_cch","innerHTML",$cant_env);
								$ob->assign("pro_cch","innerHTML",$cant_pro);
							break;
							case 'ONCO':
								$ob->assign("f_env_onc","innerHTML",$fecha_envio);
								$ob->assign("env_onc","innerHTML",$cant_env);
								$ob->assign("pro_onc","innerHTML",$cant_pro);
							break;
							case 'HOGAR':
								$ob->assign("f_env_hog","innerHTML",$fecha_envio);
								$ob->assign("env_hog","innerHTML",$cant_env);
								$ob->assign("pro_hog","innerHTML",$cant_pro);
							break;
							case 'CROSS':
								$ob->assign("f_env_cro","innerHTML",$fecha_envio);
								$ob->assign("env_cro","innerHTML",$cant_env);
								$ob->assign("pro_cro","innerHTML",$cant_pro);
							break;
							case 'EDWARDS':
								$ob->assign("f_env_edw","innerHTML",$fecha_envio);
								$ob->assign("env_edw","innerHTML",$cant_env);
								$ob->assign("pro_edw","innerHTML",$cant_pro);
							break;
						}
					}
				}
			}
		break;
		//MULTICANAL
		case 'MULT':
			$sql = "SELECT COUNT(DISTINCT ws_id_usuario) FROM fidelizacion.ventas WHERE fecha=fmt_date(now(),'yyyymmdd');";
			// $q = consultar($sql);
			if($q != "NO")
			{
				$datos = explode("||", $q);
				$ejecutivos = $datos[0];
			}
			$ejecutivos = 3;
			$ob->assign("ejecutivosActual","innerHTML",$ejecutivos);
			// -----------------------------------------------------------------------------------------------------------------
			$sql2 = "SELECT COUNT(ws_id_usuario) as Recorridos 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario IN ('718','771')
					;";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$datos2 = explode("||", $q2);
				$recorridos = $datos2[0];
			}
			$sql3 = "SELECT 
					SUM(CASE WHEN 
							contacto_fono1 = 'Efectivo' or 
							contacto_fono2 = 'Efectivo' or 
							contacto_fono3 = 'Efectivo' or 
							contacto_fono4 = 'Efectivo' or 
							contacto_fono5 = 'Efectivo' or 
							contacto_fono6 = 'Efectivo' or 
							ws_idunico IN (SELECT 
											idunico 
										   FROM fidelizacion.gestiones_telefonos 
										   WHERE fmt_date(fecha,'yyyymmdd')::int between now() and now() 
										   AND ws_idunico = idunico 
										   AND contacto = 'Efectivo' ) 
							THEN 1 ELSE 0 END) 
					FROM fidelizacion.cargas 
					WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
					AND ws_id_usuario IN ('718','771')
					;";
			$q3 = consultar($sql3);
			if($q3 != "NO")
			{
				$datos3 = explode("||", $q3);
				$contactos_rut = $datos3[0];
			}
			$contactabilidad = number_format((($contactos_rut / $recorridos) * 100),2,".","")."%";
			$color = (intval($contactabilidad) > 50)?'green':'red';
			$contactabilidad = '<span style="color:'.$color.'">'.$contactabilidad.'</span>';
			$ob->assign("contactaActual","innerHTML",$contactabilidad);
			// -------------------------------------------------------------------------------------------------------------------
			$sql4 = "SELECT 
						COUNT(*) 
					 FROM fidelizacion.ventas 
					 WHERE fecha=fmt_date(now(),'yyyymmdd') 
					 AND ws_id_usuario IN (SELECT idusuario FROM usuarios) 
					 ;";
			// $q4 = consultar($sql4);
			if($q4 != "NO")
			{
				$datos4 = explode("||", $q4);
				$ventas = $datos4[0];
			}
			$ventas = 0;
			$ob->assign("ventasActual","innerHTML",$ventas);
			// -------------------------------------------------------------------------------------------------------------------
			$sql5 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta = 'OK';";
			// $q5 = consultar($sql5);
			if($q5 != "NO")
			{
				$datos5 = explode("||", $q5);
				$netas5 = $datos5[0];
			}
			$netas5 = 0;
			$ob->assign("netasActual","innerHTML",$netas5);
			$sql55 = "SELECT COUNT(cod_venta) FROM fidelizacion.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."';";
			// $q55 = consultar($sql55);
			if($q55 != "NO")
			{
				$datos55 = explode("||", $q55);
				$brutas55 = $datos55[0];
			}
			$brutas55 = 0;
			$ob->assign("brutasActual","innerHTML",$brutas55);
			$sql51 = "SELECT COUNT(cod_venta) FROM bancochile.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			$q51 = consultar_tlmk($sql51);
			if($q51 != "NO")
			{
				$datos51 = explode("||", $q51);
				$netas51 = $datos51[0];
			}
			$ob->assign("netasActualBCH","innerHTML",$netas51);
			$sql52 = "SELECT COUNT(cod_venta) FROM credichile_ventas.ventas WHERE fmt_date(fecha, 'yyyymm') = '".date('Ym')."' and estado_venta in ('OK','RECUPERADO');";
			$q52 = consultar_tlmk($sql52);
			if($q52 != "NO")
			{
				$datos52 = explode("||", $q52);
				$netas52 = $datos52[0];
			}
			$ob->assign("netasActualCCH","innerHTML",$netas52);
			// -------------------------------------------------------------------------------------------------------------------
			//DIAS HABILES DEL MES
			$sql9 = "SELECT count(*) 
					FROM generate_series(0, ('".date('Y/m/t')."'::date - '".date('Y/m/')."01'::date::date)) i
					WHERE date_part('dow', '".date('Y/m/')."01'::date::date + i) NOT IN (0,6);";
			// $q9 = consultar($sql9);
			if($q9 != "NO")
			{
				$datos9 = explode("||", $q9);
				$diasHabiles9 = $datos9[0];
				$diasHabiles9 = $diasHabiles9 - 1 ;
			}
			//DIAS TRABAJADOS DEL MES
			$sql91 = "SELECT COUNT(DISTINCT ws_fecha_sistema)
						FROM fidelizacion.cargas c
						WHERE campana IN ('1_Ano_Vigencia_".date('Ym')."01'
						,'1_Ano_Vigencia_Generales_".date('Ym')."01'
						,'2_Anos_Vigencia_".date('Ym')."01'
						,'2_Anos_Vigencia_Grales_".date('Ym')."01'
						,'4_Meses_Vigencia_".date('Ym')."01'
						,'Nuevos_Clientes_".date('Ym')."01'
						,'Nuevos_Productos_".date('Ym')."01'
						,'Referidos_02".date('mY')."'
						) ;";
			// $q91 = consultar($sql91);
			if($q91 != "NO")
			{
				$datos91 = explode("||", $q91);
				$diasTrabajados91 = $datos91[0];
			}
			//PROYECCION
			// $proyeccion = intval(($brutas55 * $diasHabiles9) / $diasTrabajados91);
			$proyeccion = 0;
			$ob->assign("proyeccionActual","innerHTML",$proyeccion);
			// -------------------------------------------------------------------------------------------------------------------
			$sql6 = "SELECT 
					REPLACE(SUBSTRING(campana,1,length(campana)-9),'ñ','n')::text as campana
					,(SELECT COUNT(ws_idunico) FROM fidelizacion.cargas WHERE (campana = c.campana )) as base_cargada
					,(SELECT COUNT(ws_id_usuario) FROM fidelizacion.cargas WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN ".date('Ym')."01 AND fmt_date(now(), 'yyyymmdd')::int AND (campana = c.campana)) as Rut_Trabajado_Discador_Ejecutivo
					,(SELECT COUNT(ws_id_usuario) FROM fidelizacion.cargas WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int AND ws_id_usuario <> 800 AND (campana = c.campana)) as Rut_Trabajado_Ejecutivo
					,(SELECT 
						SUM(CASE WHEN 
								contacto_fono1 = 'Efectivo' or 
								contacto_fono2 = 'Efectivo' or 
								contacto_fono3 = 'Efectivo' or 
								contacto_fono4 = 'Efectivo' or 
								contacto_fono5 = 'Efectivo' or 
								contacto_fono6 = 'Efectivo' or 
								ws_idunico IN (SELECT 
												idunico 
											   FROM fidelizacion.gestiones_telefonos 
											   WHERE fmt_date(fecha,'yyyymmdd')::int between now() and now() 
											   AND ws_idunico = idunico 
											   AND contacto = 'Efectivo' ) 
								THEN 1 ELSE 0 END) 
						FROM fidelizacion.cargas 
						WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
						AND ws_id_usuario IN ('718','771')
						AND campana = c.campana ) as contactos_efectivos
					,(SELECT COUNT(DISTINCT cod_venta) FROM fidelizacion.ventas WHERE idunico IN 
					    (SELECT ws_idunico FROM fidelizacion.cargas WHERE ws_id_usuario != 800 AND fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int AND (campana = c.campana))
					    AND fmt_date(fecha, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int  
					) as Ventas
					FROM fidelizacion.cargas c
					WHERE campana IN ('Renovaciones_Asociado_a_Credito_Febrero_2016') 
					GROUP BY c.campana 
					UNION ALL
					SELECT 
					ws_campagna as campana
					,(SELECT COUNT(ws_idunico) FROM multicanal.clientes_siniestro WHERE (ws_campagna = c.ws_campagna )) as base_cargada
					,(SELECT COUNT(ws_id_usuario) FROM multicanal.clientes_siniestro WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN ".date('Ym')."01 AND fmt_date(now(), 'yyyymmdd')::int AND (ws_campagna = c.ws_campagna)) as Rut_Trabajado_Discador_Ejecutivo
					,(SELECT COUNT(ws_id_usuario) FROM multicanal.clientes_siniestro WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int BETWEEN fmt_date(now(), 'yyyymmdd')::int AND fmt_date(now(), 'yyyymmdd')::int AND ws_id_usuario <> 800 AND (ws_campagna = c.ws_campagna)) as Rut_Trabajado_Ejecutivo
					,(SELECT 
						SUM(CASE WHEN 
								contacto_fono1 = 'Efectivo' or 
								contacto_fono2 = 'Efectivo' or 
								contacto_fono3 = 'Efectivo' or 
								contacto_fono4 = 'Efectivo' or 
								contacto_fono5 = 'Efectivo' or 
								contacto_fono6 = 'Efectivo' 
								THEN 1 ELSE 0 END) 
						FROM multicanal.clientes_siniestro 
						WHERE ws_fecha_sistema = '".date("d/m/Y")."' 
						AND ws_id_usuario IN ('776')
						AND ws_campagna = c.ws_campagna ) as contactos_efectivos
					,0 as Ventas
					FROM multicanal.clientes_siniestro c
					WHERE ws_campagna IN ('BDD_Pago_de_Siniestros_Enero_2016') 
					GROUP BY c.ws_campagna";
			$q6 = consultar($sql6);
			// $ob->alert($q6);
			if($q6 != "NO")
			{
				$datos6 = explode("::", $q6);
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Campa&ntilde;a</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT IVR/Ejec.</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT Ejec.</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contactabilidad</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">%</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Ventas</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Efic. %</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Pen. %</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$campana = str_replace("_"," ",$datos6_2[0]);
						$cargado = $datos6_2[1];
						$rutIvrEjec = $datos6_2[2];
						$rutEjec = $datos6_2[3];
						$contEfect = $datos6_2[4];
						$ventasNet = $datos6_2[5];
						$rutIvrEjecPOR = number_format((($rutIvrEjec / $cargado) * 100),2,".","")."%";
						$rutEjecPOR = number_format((($rutEjec / $rutIvrEjec) * 100),2,".","")."%";
						$contEfectPOR = number_format((($contEfect / $rutEjec) * 100),2,".","")."%";
						if(intval($contEfectPOR) > 55)
						{
							$color = 'green';
						}
						elseif(intval($contEfectPOR) < 15)
						{
							$color = 'red';
						}
						else
						{
							$color = '#064C75';
						}
						// $color = (intval($contEfectPOR) > 55)?'green':'#064C75';
						$eficienciaPOR = number_format((($ventasNet / $contEfect) * 100),2,".","")."%";
						$penetracionPOR = number_format((($ventasNet / $cargado) * 100),2,".","")."%";
						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$campana.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutIvrEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutIvrEjecPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjec.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$rutEjecPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$contEfect.'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="color:'.$color.'">'.$contEfectPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$ventasNet.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$eficienciaPOR.'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$penetracionPOR.'</td>
				  				</tr>';
					}

				}

				$tabla .= '</tbody>
					  	   </table>';
			}
			
			// CCH
			$ob->assign("campMulticanal","innerHTML",$tabla);
			// $ob->assign("campDetails2","innerHTML",$tabla2);
			$ob->script("reloadContent('MULT');");
			// -------------------------------------------------------------------------------------------------------------------
		break;
		//LLAMADAS -----------------------------------------------------------------------------------------------------------------
		case 'CALLS':
			$obast = new AstMan();

			$inicio = $obast->Login();
			
			//HABLANDO
			$data2 = $obast->Query("Action: Command\r\nCommand: core show channels verbose\r\n\r\n");
			if($data2)
			{
				$cadena = "";
				$value_start = strpos($data2, "Response: Follows\r\n") + 19;
				$value_calls = strpos($data2, "active channels\r\n") + 1;
				$value_stop = strpos($data2, "--END COMMAND--\r\n", $value_start);
				if ($value_start > 18)
				{
					$valor = substr($data2, $value_start, $value_stop - $value_start);
				}

				$lines = explode("\n", $valor);
				foreach($lines as $line)
				{
					$line = str_replace(" ","-",$line);
					$lines2 = explode("-", $line);
					foreach($lines2 as $x2)
					{
						if(strlen($x2) > 1)
						{
							$cadena .= $x2."||";
						}
					}
					$cadena .= "::";
				}

				
				$anexoTmp = "";
				$lines3 = explode("::", $cadena);
			}

			//CONECTADOS
			$estadoEjecutivos = $obast->Query("Action: Command\r\nCommand: sip show peers\r\n\r\n");
			if($estadoEjecutivos)
			{
				$cadenaEjecutivos = "";
				$tabla1 = '';
				$tabla2 = '';
				$tabla3 = '';
				$value_startE = strpos($estadoEjecutivos, "Response: Follows\r\n") + 19;
				$value_stopE = strpos($estadoEjecutivos, "--END COMMAND--\r\n", $value_startE);
				if ($value_startE > 18)
				{
					$valorEjecutivos = substr($estadoEjecutivos, $value_startE, $value_stopE - $value_startE);
				}
			}

			$linesEjecutivos = explode("\n", $valorEjecutivos);
			foreach($linesEjecutivos as $lineE)
			{
				$lineE = str_replace(" ","-",$lineE);
				$linesEjecutivos2 = explode("-", $lineE);
				foreach($linesEjecutivos2 as $xE2)
				{
					if(strlen($xE2) > 5)
					{
						$cadenaEjecutivos .= $xE2."||";
					}
				}
				$cadenaEjecutivos .= "::";
			}

			$lines4E = explode("::", $cadenaEjecutivos);	
			foreach($lines4E as $xE3)
			{
				// echo $x3."<br>";
				$valor = "";
				$duracionA = "";
				$fonoA = "";
				$lines4E2 = explode("||", $xE3);
				$anexo = substr($lines4E2[0],0,4);
				$anexoI = substr($anexo, 0,1);
				$ip = $lines4E2[1];
				$estado = ($lines4E2[2]=="UNKNOWN")?"NA":"OK";
				$color = ($lines4E2[2] == 'UNKNOWN')?'#C9C7C7':'green';
				$estado2 = ($color == '#C9C7C7')?'OFFLINE':'ONLINE';
				$color = ($estado2 == 'ONLINE')?'#F78C12':$color;

				if(intval($anexo) >= 8859 && intval($anexo) <= 8860)
				// if(intval($anexo) >= 8817 && intval($anexo) <= 8826)
				{
					foreach($lines3 as $x3)
					{
						$lines31 = explode("||", $x3);
						$anexoCalling = substr($lines31[0],4,4);
						$anexoI = substr($anexo, 0,1);
						$fono = $lines31[3];
						$duracion = ($lines31[2] == "camaleon")?$lines31[8]:$lines31[8];

						if(intval($anexoCalling) >= 8859 && intval($anexo) <= 8860)
						// if(intval($anexoCalling) >= 8817 && intval($anexoCalling) <= 8826)
						{
							if(intval($anexoCalling) == intval($anexo))
							{
								$valor = "Hablando";
								$color = "green";
								$duracionA = $duracion;
								$fonoA = $fono;
							}
						}
					}
					if(!empty($valor))
					{
						$tabla1 .= '	<div class="item ui-menu-shadow" onclick="xajax_escuchaAnexo('.$anexo.');">
										<div onclick="xajax_escuchaAnexo('.$anexo.');" style="cursor:pointer;">	
											<span style="font-weight:bold; color:'.$color.' " onclick="xajax_escuchaAnexo('.$anexo.');">'.$anexo.'</span><span id="spy'.$anexo.'" style="color:'.$color.' "> ('.$valor.')</span>&nbsp;
											<br>
											<span style="font-weight:bold;" onclick="xajax_escuchaAnexo('.$anexo.');">'.$fonoA.'</span><span> ('.$duracionA.')</span>
										</div>
									</div>

								  ';
					}
					else
					{
						$tabla1 .= '<div class="item ui-menu-shadow">
										<div>	
											<span style="font-weight:bold; color:'.$color.' ">'.$anexo.'</span><span style="color:'.$color.' "> ('.$estado2.')</span>
										</div>
									</div>

								  ';
					}
				}
				
			}
			
			// $ob->assign("campConectados","innerHTML",$tabla2);
			$ob->assign("campLlamadas1","innerHTML",$tabla1);
			$ob->script("ordenaLayout();");
			$ob->script("reloadCP();");
		break;
		case 'ALOIVR':
			// $tabla_res = '	<table class="ui-camp-table">
			// 		  			<thead>
			// 		  				<tr>
			// 		  					<th class="ui-camp-header" width="35%" colspan="2">Alo IVR Entregado</th>
			// 		  				</tr>
			// 		  			</thead>
			// 		  			<tbody>';
			// $sql = "SELECT COUNT(*) FROM fidelizacion.cargas 
			// 		WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int
			// 		AND ws_id_usuario NOT IN (718,800,771,776)
			// 		AND ws_fecha_carga = '".date('Ym')."01'
			// 		AND ws_prioridad = -10";
			// $q = consultar($sql);
			// if($q != "NO")
			// {
			// 	$datos = explode("||", $q);
			// 	$total_alo_ivr = $datos[0];
			// }

			// $tabla_res .= '			<tr>
			// 							<td>'.$total_alo_ivr.'</td>
			// 						</tr>
			// 					</tbody>
			// 				</table>
			// 				<br>';

			$sql2 = "SELECT 
			 		CASE WHEN contacto_fono1 is null THEN 'En Blanco' ELSE contacto_fono1 END  
					,COUNT(*)
					FROM fidelizacion.cargas 
					WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int
					AND ws_id_usuario NOT IN (718,800,771,776)
					AND ws_fecha_carga = '".date('Ym')."01'
					AND ws_prioridad = -10
					GROUP BY contacto_fono1
					ORDER BY COUNT(*) desc";
			$q2 = consultar($sql2);
			if($q2 != "NO")
			{
				$totalEfectivo = 0;
				$tabla_res = '	<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header">Tipificacion</th>
					  					<th class="ui-camp-header">Cant.</th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				$datos2 = explode("::", $q2);
				foreach($datos2 as $x)
				{
					if(!empty($x))
					{
						$datos2_2 = explode("||", $x);
						$contacto = $datos2_2[0];
						$cant = $datos2_2[1];
						$cantTotal += $cant;
						$totalEfectivo = ($contacto == 'Efectivo')?$totalEfectivo+$cant:$totalEfectivo+0;
						$tabla_res .= '	<tr>
											<td class="ui-camp-body">'.$contacto.'</td>
											<td class="ui-camp-body ui-camp-body-p">'.$cant.'</td>
										</tr>';
					}
				}

				$conversion = number_format((($totalEfectivo / $cantTotal) * 100),2,".","")."%";
				$tabla_res .= '	<tr>
									<td class="ui-camp-body">Total</td>
									<td class="ui-camp-body ui-camp-body-p">'.$cantTotal.'</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr>
									<th class="ui-camp-header">% Conversion</th>
									<td class="ui-camp-body ui-camp-body-p">'.$conversion.'</td></tr>
								</tr>
							</tbody>
					  	   </table>';
			}
			$ob->assign("campAloIVRR","innerHTML",$tabla_res);
			//DETALLE --------------------------------------------------------------------------------------------------------------
			$objPHPExcel = new PHPExcel();

			$objPHPExcel->getProperties()->setCreator("Victor Espinoza")
		                                 ->setLastModifiedBy("Victor Espinoza")
		                                 ->setTitle("ALO IVR")
		                                 ->setSubject("ALO IVR")
		                                 ->setDescription("ALO IVR")
		                                 ->setKeywords("ALO IVR")
		                                 ->setCategory("ALO IVR");

		    $objPHPExcel->getActiveSheet()->getStyle("E2")->getFont()->getColor()->setRGB('FFFFFF');
		    $objPHPExcel->getActiveSheet()->getStyle('E2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0068BF');
			
			$objPHPExcel->getActiveSheet()->getStyle("E3:K3")->getFont()->getColor()->setRGB('FFFFFF');
		    $objPHPExcel->getActiveSheet()->getStyle('E3:K3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('0068BF');

		    $objPHPExcel->getActiveSheet()->mergeCells('E2:K2'); 

		    $objPHPExcel->getActiveSheet()->setCellValue("E2", "ALOS POR IVR VS TIPIFICACIONES EJECUTIVOS");
		    $objPHPExcel->getActiveSheet()->setCellValue("E3", "Ejecutivo");
		    $objPHPExcel->getActiveSheet()->setCellValue("F3", "Efectivo");
		    $objPHPExcel->getActiveSheet()->setCellValue("G3", "Inubicable");
		    $objPHPExcel->getActiveSheet()->setCellValue("H3", "Contacto Tercero");
		    $objPHPExcel->getActiveSheet()->setCellValue("I3", "En Blanco");
		    $objPHPExcel->getActiveSheet()->setCellValue("J3", "Total");
		    $objPHPExcel->getActiveSheet()->setCellValue("K3", "Conversion");

			$sql6 = "SELECT 
						(SELECT nombre_fantasia FROM usuarios WHERE idusuario = ws_id_usuario) as ejecutivo
						,sum(CASE WHEN contacto_fono1 = 'Contacto Tercero' THEN 1 ELSE 0 END) as contacto_tercero
						,sum(CASE WHEN contacto_fono1 = 'Efectivo' THEN 1 ELSE 0 END) as efectivo
						,sum(CASE WHEN contacto_fono1 = 'Inubicable' THEN 1 ELSE 0 END) as inubicable
						,sum(CASE WHEN contacto_fono1 = '' THEN 1 ELSE 0 END) as en_blanco
						,(   (sum(CASE WHEN contacto_fono1 = 'Contacto Tercero' THEN 1 ELSE 0 END)) 
						   + (sum(CASE WHEN contacto_fono1 = 'Efectivo' THEN 1 ELSE 0 END)) 
						   + (sum(CASE WHEN contacto_fono1 = '' THEN 1 ELSE 0 END)) 
						   + (sum(CASE WHEN contacto_fono1 = 'Inubicable' THEN 1 ELSE 0 END)) ) as total
					FROM fidelizacion.cargas
					WHERE fmt_date(ws_fecha_sistema, 'yyyymmdd')::int = fmt_date(now(), 'yyyymmdd')::int
					AND ws_id_usuario NOT IN (718,800,771,776)
					AND ws_fecha_carga = '".date('Ym')."01'
					AND ws_prioridad = -10
					GROUP BY ws_id_usuario,ws_fecha_sistema
					ORDER BY ejecutivo";
			$q6 = consultar($sql6);
			// $ob->alert($q6);
			if($q6 != "NO")
			{
				$i = 4;
				$datos6 = explode("::", $q6);
				$tabla = '<table class="ui-camp-table">
					  			<thead>
					  				<tr>
					  					<th class="ui-camp-header" width="35%">Ejecutivo</th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Efectivo</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Inubicable</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Contacto Tercero</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">En Blanco</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Total</span></th>
					  					<th class="ui-camp-header"><span class="ui-camp-header-p">Conversion %</span></th>
					  				</tr>
					  			</thead>
					  			<tbody>';
				foreach($datos6 as $x)
				{
					if(!empty($x))
					{
						$datos6_2 = explode("||", $x);
						$conversion = number_format((($datos6_2[2] / $datos6_2[5]) * 100),2,".","")."%";
						switch(TRUE)
						{
							case (intval($conversion) < 50): $style = 'color:#CF0202; font-weight:bold;'; break;
							case (intval($conversion) < 60): $style = 'color:; font-weight:bold;'; break;
							case (intval($conversion) < 70): $style = 'color:; font-weight:bold;'; break;
							case (intval($conversion) < 80): $style = 'color:; font-weight:bold;'; break;
							case (intval($conversion) < 100): $style = 'color:#01A601; font-weight:bold;'; break;
							default:
								$style = 'color:; font-weight:bold;';
							break;
						}
						
						$tabla .= '<tr>
				  					<td class="ui-camp-body">'.$datos6_2[0].'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[2].'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[3].'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[1].'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[4].'</td>
				  					<td class="ui-camp-body ui-camp-body-p">'.$datos6_2[5].'</td>
				  					<td class="ui-camp-body ui-camp-body-p" style="'.$style.'">'.$conversion.'</td>
				  				</tr>';

				  		$objPHPExcel->getActiveSheet()->setCellValue("E".$i."", $datos6_2[0]);
				  		$objPHPExcel->getActiveSheet()->setCellValue("F".$i."", $datos6_2[2]);
				  		$objPHPExcel->getActiveSheet()->setCellValue("G".$i."", $datos6_2[3]);
				  		$objPHPExcel->getActiveSheet()->setCellValue("H".$i."", $datos6_2[1]);
				  		$objPHPExcel->getActiveSheet()->setCellValue("I".$i."", $datos6_2[4]);
				  		$objPHPExcel->getActiveSheet()->setCellValue("J".$i."", $datos6_2[5]);
				  		$objPHPExcel->getActiveSheet()->setCellValue('K'.$i.'', '=(G'.$i.'/J'.$i.')');
                		$objPHPExcel->getActiveSheet()->getStyle('K'.$i.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE_00);
					}
					$i += 1;
				}

				$tabla .= '</tbody>
					  	   </table>';

				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			    // $objWriter->save('../informesivr/ALO_EFECTIVO_IVR.xlsx');
			    $objWriter->save('/var/www/monitor_campaign/informesivr/ALO_EFECTIVO_IVR.xlsx');
			    $callEndTime = microtime(true);
			    $callTime = $callEndTime - $callStartTime;
			}
			
			
			$ob->assign("campAloIVRD","innerHTML",$tabla);
			// $ob->script("reloadContent('MULT');"); 

			$lista = '';
		    // $carpeta = 'C:\xampp\htdocs\BANCHILE\monitor_campaign\informesivr';
		    $carpeta = '/var/www/monitor_campaign/informesivr';
		    if(is_dir($carpeta)){
		        if($dir = opendir($carpeta)){
		            while(($archivo = readdir($dir)) !== false){
		                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
		                	if(stristr($archivo, 'FIDELIZACION')){
		                    	$lista .= '<li><a target="_blank" href="../informesivr/'.$archivo.'">'.$archivo.'</a></li>';
		                    	// $lista .= '<li><a target="_blank" href="/root/informes_banchile/pv/'.date('Ymd').'/'.$archivo.'">'.$archivo.'</a></li>';
		                    }
		                }
		            }
		            closedir($dir);
		        }
		    }

		    // ---------------------------------------------------------------------------------------------------------------------------------
		    $ob->assign("campAloIVRF","innerHTML",$lista);
		break;
	}

	return $ob;
}

function creaGestion($form,$fecha){
	$ob = new xajaxResponse;

	// $ob->alert($form["val_cia_selected"]);
	// $ob->alert($fecha);

	switch(intval($form["val_cia_selected"]))
	{
		case 1:
			$nombre_cia = "ace";
		break;
		case 2:
			$nombre_cia = "bsv";
		break;
		case 3:
			$nombre_cia = "rsa";
		break;
		case 4:
			$nombre_cia = "cns";
		break;
		case 5:
			$nombre_cia = "car";
		break;
	}

	$sql = "insert into ventas.gestion_pro
			(fecha_envio,id_estado)
			values ('".$fecha."',1);";
	$q = insertar_tlmk($sql);

	$sql2 = "copy ventas.ventas_pro (rut,dv,folio,fecha,id_producto,fecha_carga,id_gestion)
			from '/TXT/ventas_".$nombre_cia."_imp_".$fecha.".csv' WITH DELIMITER AS ',';

			delete from ventas.ventas_pro where lower(rut) = 'rut';";
	$q2 = insertar_tlmk($sql2);

	$sql3 = "update ventas.ventas_pro set id_gestion = (select id from ventas.gestion_pro order by id desc limit 1)
			where fecha_carga = '".$fecha."' and id_gestion::int = 0";
	$q3 = insertar_tlmk($sql3);

	$ob->script("darMensaje('Gestion Creada Satisfactoriamente','1')");
	return $ob;
}
function reloadGestiones(){
	$ob = new xajaxResponse;

	$sql6 = "SELECT 
			e.descripcion
			,d.descripcion
			,a.fecha_envio
			,SUM(CASE WHEN a.id_estado = 1 THEN 1 ELSE 0 END) + SUM(CASE WHEN a.id_estado = 2 THEN 1 ELSE 0 END) as env
			,SUM(CASE WHEN a.id_estado = 2 THEN 1 ELSE 0 END) as pro
			,f.descripcion
			,a.id
			FROM ventas.gestion_pro a
			LEFT JOIN ventas.ventas_pro b ON b.id_gestion = a.id
			LEFT JOIN ventas.productos c ON c.id = b.id_producto::integer 
			LEFT JOIN ventas.campana d ON d.id = c.id_campana 
			LEFT JOIN ventas.cia e ON e.id = d.id_cia
			LEFT JOIN ventas.estado f ON f.id = a.id_estado
			--WHERE fmt_date(a.fecha_envio, 'yyyymm') = fmt_date(now(), 'yyyymm')
			GROUP BY e.descripcion,d.descripcion,a.fecha_envio,f.descripcion,a.id
			ORDER BY f.descripcion,a.fecha_envio DESC";
	$q6 = consultar_tlmk($sql6);
	// $ob->alert($q6);
	if($q6 != "NO")
	{
		$datos6 = explode("::", $q6);
		$tabla = '<table class="ui-camp-table">
			  			<thead>
			  				<tr>
			  					<th class="ui-camp-header" width="35%">Compa&ntilde;&iacute;a</th>
			  					<th class="ui-camp-header"><span class="ui-camp-header-p">Campa&ntilde;a</span></th>
			  					<th class="ui-camp-header"><span class="ui-camp-header-p">Fecha de Env&iacute;o</span></th>
			  					<th class="ui-camp-header"><span class="ui-camp-header-p">Enviadas</span></th>
			  					<th class="ui-camp-header"><span class="ui-camp-header-p">Procesadas</span></th>
			  					<th class="ui-camp-header"><span class="ui-camp-header-p">Estado Final</span></th>
			  				</tr>
			  			</thead>
			  			<tbody>';
		foreach($datos6 as $x)
		{
			if(!empty($x))
			{
				$datos6_2 = explode("||", $x);
				$cia = $datos6_2[0];
				$campana = $datos6_2[1];
				$fechaEnvio = $datos6_2[2];
				$cantEnv = $datos6_2[3];
				$cantPro = $datos6_2[4];
				$estado = $datos6_2[5];
				$idGestion = $datos6_2[6];
				if($estado == 'PROCESADO')
				{
					$color = 'green';
				}
				else
				{
					$color = 'red';
				}
				$tabla .= '<tr>
		  					<td class="ui-camp-body"><span onclick="actualizaGestion('.$idGestion.')" style="cursor: pointer;">'.$cia.'</span></td>
		  					<td class="ui-camp-body ui-camp-body-p"><span onclick="actualizaGestion('.$idGestion.')" style="cursor: pointer;">'.$campana.'</span></td>
		  					<td class="ui-camp-body ui-camp-body-p"><span onclick="actualizaGestion('.$idGestion.')" style="cursor: pointer;">'.$fechaEnvio.'</span></td>
		  					<td class="ui-camp-body ui-camp-body-p"><span onclick="actualizaGestion('.$idGestion.')" style="cursor: pointer;">'.$cantEnv.'</span></td>
		  					<td class="ui-camp-body ui-camp-body-p"><span onclick="actualizaGestion('.$idGestion.')" style="cursor: pointer;">'.$cantPro.'</span></td>
		  					<td class="ui-camp-body ui-camp-body-p"><span onclick="actualizaGestion('.$idGestion.')" style="cursor: pointer; color:'.$color.'">'.$estado.'</span></td>
		  				</tr>';
			}

		}

		$tabla .= '</tbody>
			  	   </table>';
	}

	$ob->assign("dataGestiones","innerHTML",$tabla);
	// $ob->script("reloadContent('EJE');");

	return $ob;
}
function actualizaGestion($form,$idGestion){
	$ob = new xajaxResponse;

	$estado = $form['val_est_selected'];
	$sql = "UPDATE ventas.gestion_pro SET id_estado = ".$estado." WHERE id IN (".$idGestion.");";
	// $ob->alert($sql);
	$q = insertar_tlmk($sql);

	$ob->script("darMensaje('Gestion Actualizada Satisfactoriamente','1')");

	return $ob;
}
function reloadDetalles(){
	$ob = new xajaxResponse;

	$sql6 = "SELECT 
			e.descripcion
			,d.descripcion
			,b.folio
			,b.rut
			,b.dv
			,b.fecha
			,a.fecha_envio
			,f.descripcion
			FROM ventas.gestion_pro a
			LEFT JOIN ventas.ventas_pro b ON b.id_gestion = a.id
			LEFT JOIN ventas.productos c ON c.id = b.id_producto::integer 
			LEFT JOIN ventas.campana d ON d.id = c.id_campana 
			LEFT JOIN ventas.cia e ON e.id = d.id_cia
			LEFT JOIN ventas.estado f ON f.id = a.id_estado
			WHERE fmt_date(a.fecha_envio, 'yyyymm') = fmt_date(now(), 'yyyymm')
			GROUP BY e.descripcion,d.descripcion,b.folio,b.rut,b.dv,b.fecha,a.fecha_envio,f.descripcion
			ORDER BY d.descripcion,a.fecha_envio DESC";
	$q6 = consultar_tlmk($sql6);
	// $ob->alert($q6);
	if($q6 != "NO")
	{
		$datos6 = explode("::", $q6);
		$ciaTmp = "";
		$divAccordion = '<div id="accordion">';
		foreach($datos6 as $x)
		{
			if(!empty($x))
			{
				$datos6_2 = explode("||", $x);
				$cia = $datos6_2[0];
				$campana = $datos6_2[1];
				$folio = $datos6_2[2];
				$rut = $datos6_2[3];
				$dv = $datos6_2[4];
				$fechaVenta = $datos6_2[5];
				$fechaEnvio = $datos6_2[6];
				$estado = $datos6_2[7];
				if($estado == 'PROCESADO')
				{
					$color = 'green';
				}
				else
				{
					$color = 'red';
				}

				if(empty($ciaTmp))
				{
					$divAccordion .= '<h3>'.$cia.'</h3>
										<div>
											<table class="ui-camp-table">
								  			<thead>
								  				<tr>
								  					<th class="ui-camp-header" width="35%">Campa&ntilde;a</th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Folio</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">DV</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Fecha Venta</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Fecha de Env&iacute;o</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Estado</span></th>
								  				</tr>
								  			</thead>
								  			<tbody>
								  			<tr>
							  					<td class="ui-camp-body">'.$campana.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$folio.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$rut.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$dv.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$fechaVenta.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$fechaEnvio.'</td>
							  					<td class="ui-camp-body ui-camp-body-p"><span style="color: '.$color.'">'.$estado.'</span></td>
							  				</tr>
								';
				}
				elseif($ciaTmp == $cia)
				{
					$divAccordion .= '		<tr>
							  					<td class="ui-camp-body">'.$campana.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$folio.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$rut.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$dv.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$fechaVenta.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$fechaEnvio.'</td>
							  					<td class="ui-camp-body ui-camp-body-p"><span style="color: '.$color.'">'.$estado.'</span></td>
							  				</tr>';
				}
				else
				{
					$divAccordion .= '		</tbody>
											</table>
										</div>
										<h3>'.$cia.'</h3>
										<div>
											<table class="ui-camp-table">
								  			<thead>
								  				<tr>
								  					<th class="ui-camp-header" width="35%">Campa&ntilde;a</th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Folio</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">RUT</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">DV</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Fecha Venta</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Fecha de Env&iacute;o</span></th>
								  					<th class="ui-camp-header"><span class="ui-camp-header-p">Estado</span></th>
								  				</tr>
								  			</thead>
								  			<tbody>
								  			<tr>
							  					<td class="ui-camp-body">'.$campana.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$folio.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$rut.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$dv.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$fechaVenta.'</td>
							  					<td class="ui-camp-body ui-camp-body-p">'.$fechaEnvio.'</td>
							  					<td class="ui-camp-body ui-camp-body-p"><span style="color: '.$color.'">'.$estado.'</span></td>
							  				</tr>';
				}

				$ciaTmp = $cia;
			}

		}

		$divAccordion .= '</tbody>
			  	   </table>
			  	   </div>';
	}

	$ob->assign("dataDetalle","innerHTML",$divAccordion);
	$ob->script("creaAccordion();");

	return $ob;
}
function reloadFormatos($form,$fecha){
	$ob = new xajaxResponse;

	switch(intval($form["val_cia_selected"]))
	{
		case 1:
			$servicio = "PVS";
		break;
		case 2:
			$servicio = "TLMK";
		break;
		case 3:
			$servicio = "BV";
		break;
	}

	$sql2 = "SET client_encoding to 'latin1';
			 copy ventas.borrador_pro (fecha_grab_en_sistema,
			  negocio,
			  codigo_cia,
			  tipo_de_seguro,
			  codigo_prod,
			  fecha_venta,
			  fecha_venta_2,
			  rut,
			  dv,
			  folio,
			  contar_f,
			  fecha_nacimiento,
			  fecha_nacimiento_2,
			  nombres,
			  nombres_com_clte,
			  direccion_envio_poliza,
			  num_calle_despacho,
			  num_dpto,
			  villa_poblacion,
			  comuna,
			  direccion_com,
			  rut_asegurado,
			  dv_asegurado,
			  nombre_asegurado,
			  apellidos_asegurados,
			  nombres_com_aseg,
			  fecha_de_nac,
			  estado,
			  fecha_ing_pws,
			  rut_vendedor,
			  dv_ven,
			  canal_de_venta,
			  cambio_de_plan,
			  nombre_plan,
			  valor_uf,
			  cod_producto_scs,
			  cod_plan_scs,
			  poliza,
			  cui,
			  fecha_creacion,
			  fecha_carga)
			from '/TXT/BORRADOR_".$servicio."_".$fecha.".txt';

			delete from ventas.borrador_pro where lower(negocio) = 'negocio';";
	$q2 = insertar_tlmk($sql2);

	switch($servicio)
	{
		case 'PVS':
		break;
		case 'TLMK':
			$sql3 = "select distinct codigo_cia from ventas.borrador_pro where fecha_carga = '".$fecha."'
				and folio not in (select folio from ventas.ventas_pro)
				order by codigo_cia";
			$q3 = consultar_tlmk($sql3);

		    $objPHPExcel = new PHPExcel();

			if($q3 != "NO")
			{
				$data = explode("::", $q3);
				foreach($data as $x)
				{
					if(!empty($x))
					{
						$data_2 = explode("||",$x);
						$codigo_cia = $data_2[0];
						// $ob->alert($codigo_cia);
						switch($codigo_cia)
						{
							case 'ACE':
								// VENTAS S
							    $objPHPExcel->getProperties()->setCreator("Victor Espinoza")
							                                 ->setLastModifiedBy("Victor Espinoza")
							                                 ->setTitle("ACE Salir Protegido, Peaton Protegido (Ventas S)")
							                                 ->setSubject("Ventas S")
							                                 ->setDescription("Ventas S")
							                                 ->setKeywords("Ventas S")
							                                 ->setCategory("Ventas S");

							    $objPHPExcel->getActiveSheet()->getStyle("A1:H1")->getFont()->getColor()->setRGB('000000');
							    $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FDE9D9');

							    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

							    $objPHPExcel->getActiveSheet()->setCellValue("A1", "FECHA VENTA");
							    $objPHPExcel->getActiveSheet()->setCellValue("B1", "FOLIO");
							    $objPHPExcel->getActiveSheet()->setCellValue("C1", "RUT");
							    $objPHPExcel->getActiveSheet()->setCellValue("D1", "DV");
							    $objPHPExcel->getActiveSheet()->setCellValue("E1", "TIPO SEGURO");
							    $objPHPExcel->getActiveSheet()->setCellValue("F1", "ESTADO");
							    $objPHPExcel->getActiveSheet()->setCellValue("G1", "BCH/CCH");
							    $objPHPExcel->getActiveSheet()->setCellValue("H1", "FECHA DE ENVIO");

							    $sql4 = "select 
										fecha_venta_2,folio::varchar,rut,dv,tipo_de_seguro,'S'::varchar
										,(case when negocio = 'TLMK S3' then 'Banco Chile' else 'Credi Chile' end) as negocio 
										from ventas.borrador_pro where fecha_carga = '".$fecha."'
										and folio not in (select folio from ventas.ventas_pro)
										and codigo_cia = '".$codigo_cia."'
										order by codigo_cia,negocio,folio";
								$q4 = consultar_tlmk($sql4);

								if($q4 != "NO")
								{
									$i = 2;
									$data4 = explode("::", $q4);
									foreach($data4 as $x4)
									{
										if(!empty($x4))
										{
											$data_42 = explode("||",$x4);
											$fecha_venta = $data_42[0];
											$folio = $data_42[1];
											$rut = $data_42[2];
											$dv = $data_42[3];
											$tipo_seguro = $data_42[4];
											$estado = $data_42[5];
											$negocio = $data_42[6];
											$fecha_envio = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);

											$objPHPExcel->getActiveSheet()->setCellValue('A'.$i.'', $fecha_venta);
										    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i.'', $folio);
										    // $objPHPExcel->getActiveSheet()->getStyle('B'.$i.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
										    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i.'', $rut);
										    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i.'', $dv);
										    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i.'', $tipo_seguro);
										    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i.'', $estado);
										    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i.'', $negocio);
										    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i.'', $fecha_envio);
										}
										$i += 1;
									}
								}

								$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
							    $objWriter->save('../formatos/ACE_Ventas_S_'.$fecha.'.xlsx');
							    // $objWriter->save('/root/informes_banchile/pv/'.date("Ymd").'/gestion_diaria_'.$nombre_documento.'.xlsx');
							    $callEndTime = microtime(true);
							    $callTime = $callEndTime - $callStartTime;

							    //------------------------------------------------------------------------------------------------------------
							    //VENTAS PARA CARGAR EN SISTEMA
							    $objPHPExcel2 = new PHPExcel();
							    $objPHPExcel2->getActiveSheet()->getStyle("A1:G1")->getFont()->getColor()->setRGB('000000');
							    $objPHPExcel2->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FDE9D9');

							    $objPHPExcel2->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

							    $objPHPExcel2->getActiveSheet()->setCellValue("A1", "rut");
							    $objPHPExcel2->getActiveSheet()->setCellValue("B1", "dv");
							    $objPHPExcel2->getActiveSheet()->setCellValue("C1", "folio");
							    $objPHPExcel2->getActiveSheet()->setCellValue("D1", "fecha_venta");
							    $objPHPExcel2->getActiveSheet()->setCellValue("E1", "id_producto");
							    $objPHPExcel2->getActiveSheet()->setCellValue("F1", "fecha_carga");
							    $objPHPExcel2->getActiveSheet()->setCellValue("G1", "id_gestion");

							    $sql4 = "select 
										rut,dv,folio,fecha_venta_2
										,(case when negocio = 'TLMK S3' then 1 else 2 end) as id_producto  
										from ventas.borrador_pro where fecha_carga = '".$fecha."'
										and folio not in (select folio from ventas.ventas_pro)
										and codigo_cia = '".$codigo_cia."'
										order by codigo_cia,negocio,folio";
								$q4 = consultar_tlmk($sql4);

								if($q4 != "NO")
								{
									$i = 2;
									$data4 = explode("::", $q4);
									foreach($data4 as $x4)
									{
										if(!empty($x4))
										{
											$data_42 = explode("||",$x4);
											$rut = $data_42[0];
											$dv = $data_42[1];
											$folio = $data_42[2];
											$fecha_venta = $data_42[3];
											$id_producto = $data_42[4];
											$fecha_envio = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);
											$id_gestion = 0;

											$objPHPExcel2->getActiveSheet()->setCellValue('A'.$i.'', $rut);
										    $objPHPExcel2->getActiveSheet()->setCellValue('B'.$i.'', $dv);
										    $objPHPExcel2->getActiveSheet()->setCellValue('C'.$i.'', $folio);
										    // $objPHPExcel2->getActiveSheet()->getStyle('C'.$i.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
										    $objPHPExcel2->getActiveSheet()->setCellValue('D'.$i.'', $fecha_venta);
										    $objPHPExcel2->getActiveSheet()->setCellValue('E'.$i.'', $id_producto);
										    $objPHPExcel2->getActiveSheet()->setCellValue('F'.$i.'', $fecha);
										    $objPHPExcel2->getActiveSheet()->setCellValue('G'.$i.'', $id_gestion);
										}
										$i += 1;
									}
								}

								$objWriter = new PHPExcel_Writer_CSV($objPHPExcel2);
							    $objWriter->setDelimiter(';');
							    $objWriter->setEnclosure('');
							    $objWriter->setLineEnding("\r\n");
							    $objWriter->setSheetIndex(0);
							    $objWriter->save('../formatos/ventas_ace_imp_'.$fecha.'.csv');
							    // $objWriter->save('/root/informes_banchile/pv/'.date("Ymd").'/gestion_diaria_'.$nombre_documento.'.xlsx');
							    $callEndTime = microtime(true);
							    $callTime = $callEndTime - $callStartTime;
							break;
							case 'BSV':
								// VENTAS S
							    $objPHPExcel->getProperties()->setCreator("Victor Espinoza")
							                                 ->setLastModifiedBy("Victor Espinoza")
							                                 ->setTitle("BSV Oncologico Familiar TLMK CCH (Ventas S)")
							                                 ->setSubject("Ventas S")
							                                 ->setDescription("Ventas S")
							                                 ->setKeywords("Ventas S")
							                                 ->setCategory("Ventas S");

							    $objPHPExcel->getActiveSheet()->getStyle("A1:Q1")->getFont()->getColor()->setRGB('000000');
							    $objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FDE9D9');

							    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);	

							    $objPHPExcel->getActiveSheet()->setCellValue("A1", "RUT");				$objPHPExcel->getActiveSheet()->setCellValue("B1", "DV");
							    $objPHPExcel->getActiveSheet()->setCellValue("C1", "FOLIO");			$objPHPExcel->getActiveSheet()->setCellValue("D1", "FECHA CREACION");
							    $objPHPExcel->getActiveSheet()->setCellValue("E1", "RUT VENDEDOR");		$objPHPExcel->getActiveSheet()->setCellValue("F1", "DV VENDEDOR");
							    $objPHPExcel->getActiveSheet()->setCellValue("G1", "CUI VENDEDOR");		$objPHPExcel->getActiveSheet()->setCellValue("H1", "NEGOCIO (CANAL TMK)");
							    $objPHPExcel->getActiveSheet()->setCellValue("I1", "COD PRODUCTO SCS");	$objPHPExcel->getActiveSheet()->setCellValue("J1", "COD PLAN SCS");
							    $objPHPExcel->getActiveSheet()->setCellValue("K1", "TIPO PRODUCTO");	$objPHPExcel->getActiveSheet()->setCellValue("L1", "PRODUCTO");
							    $objPHPExcel->getActiveSheet()->setCellValue("M1", "NOMBRE PLAN");		$objPHPExcel->getActiveSheet()->setCellValue("N1", "COMPAÑIA");
							    $objPHPExcel->getActiveSheet()->setCellValue("O1", "POLIZA COL");		$objPHPExcel->getActiveSheet()->setCellValue("P1", "ESTADO");
							    $objPHPExcel->getActiveSheet()->setCellValue("Q1", "FECHA ENVIO");	

							    $sql4 = "select 
										rut,dv,folio,fecha_venta_2,rut_vendedor,dv_ven,0::int,negocio,cod_producto_scs,cod_plan_scs
										,tipo_de_seguro,tipo_de_seguro,nombre_plan,codigo_cia,poliza,'S'::varchar
										from ventas.borrador_pro where fecha_carga = '".$fecha."'
										and folio not in (select folio from ventas.ventas_pro)
										and codigo_cia = '".$codigo_cia."'
										order by codigo_cia,negocio,folio";
								$q4 = consultar_tlmk($sql4);

								if($q4 != "NO")
								{
									$i = 2;
									$data4 = explode("::", $q4);
									foreach($data4 as $x4)
									{
										if(!empty($x4))
										{
											$data_42 = explode("||",$x4);
											$fecha_envio = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);

											$objPHPExcel->getActiveSheet()->setCellValue('A'.$i.'', $data_42[0]);
										    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i.'', $data_42[1]);
										    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i.'', $data_42[2]);
										    // $objPHPExcel->getActiveSheet()->getStyle('C'.$i.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
										    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i.'', $data_42[3]);
										    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i.'', $data_42[4]);
										    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i.'', $data_42[5]);
										    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i.'', $data_42[6]);
										    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i.'', $data_42[7]);
										    $objPHPExcel->getActiveSheet()->setCellValue('I'.$i.'', $data_42[8]);
										    $objPHPExcel->getActiveSheet()->setCellValue('J'.$i.'', $data_42[9]);
										    $objPHPExcel->getActiveSheet()->setCellValue('K'.$i.'', $data_42[10]);
										    $objPHPExcel->getActiveSheet()->setCellValue('L'.$i.'', $data_42[11]);
										    $objPHPExcel->getActiveSheet()->setCellValue('M'.$i.'', $data_42[12]);
										    $objPHPExcel->getActiveSheet()->setCellValue('N'.$i.'', $data_42[13]);
										    $objPHPExcel->getActiveSheet()->setCellValue('O'.$i.'', $data_42[14]);
										    $objPHPExcel->getActiveSheet()->setCellValue('P'.$i.'', $data_42[15]);
										    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$i.'', $fecha_envio);
										}
										$i += 1;
									}
								}

								$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
							    $objWriter->save('../formatos/BSV_Ventas_S_'.$fecha.'.xlsx');
							    // $objWriter->save('/root/informes_banchile/pv/'.date("Ymd").'/gestion_diaria_'.$nombre_documento.'.xlsx');
							    $callEndTime = microtime(true);
							    $callTime = $callEndTime - $callStartTime;

							    //------------------------------------------------------------------------------------------------------------
							    //VENTAS PARA CARGAR EN SISTEMA
							    $objPHPExcel2 = new PHPExcel();
							    $objPHPExcel2->getActiveSheet()->getStyle("A1:G1")->getFont()->getColor()->setRGB('000000');
							    $objPHPExcel2->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FDE9D9');

							    $objPHPExcel2->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

							    $objPHPExcel2->getActiveSheet()->setCellValue("A1", "rut");
							    $objPHPExcel2->getActiveSheet()->setCellValue("B1", "dv");
							    $objPHPExcel2->getActiveSheet()->setCellValue("C1", "folio");
							    $objPHPExcel2->getActiveSheet()->setCellValue("D1", "fecha_venta");
							    $objPHPExcel2->getActiveSheet()->setCellValue("E1", "id_producto");
							    $objPHPExcel2->getActiveSheet()->setCellValue("F1", "fecha_carga");
							    $objPHPExcel2->getActiveSheet()->setCellValue("G1", "id_gestion");

							    $sql4 = "select 
										rut,dv,folio,fecha_venta_2
										,5::int as id_producto  
										from ventas.borrador_pro where fecha_carga = '".$fecha."'
										and folio not in (select folio from ventas.ventas_pro)
										and codigo_cia = '".$codigo_cia."'
										order by codigo_cia,negocio,folio";
								$q4 = consultar_tlmk($sql4);

								if($q4 != "NO")
								{
									$i = 2;
									$data4 = explode("::", $q4);
									foreach($data4 as $x4)
									{
										if(!empty($x4))
										{
											$data_42 = explode("||",$x4);
											$rut = $data_42[0];
											$dv = $data_42[1];
											$folio = $data_42[2];
											$fecha_venta = $data_42[3];
											$id_producto = $data_42[4];
											$fecha_envio = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);
											$id_gestion = 0;

											$objPHPExcel2->getActiveSheet()->setCellValue('A'.$i.'', $rut);
										    $objPHPExcel2->getActiveSheet()->setCellValue('B'.$i.'', $dv);
										    $objPHPExcel2->getActiveSheet()->setCellValue('C'.$i.'', $folio);
										    // $objPHPExcel2->getActiveSheet()->getStyle('C'.$i.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
										    $objPHPExcel2->getActiveSheet()->setCellValue('D'.$i.'', $fecha_venta);
										    $objPHPExcel2->getActiveSheet()->setCellValue('E'.$i.'', $id_producto);
										    $objPHPExcel2->getActiveSheet()->setCellValue('F'.$i.'', $fecha);
										    $objPHPExcel2->getActiveSheet()->setCellValue('G'.$i.'', $id_gestion);
										}
										$i += 1;
									}
								}

								$objWriter = new PHPExcel_Writer_CSV($objPHPExcel2);
							    $objWriter->setDelimiter(';');
							    $objWriter->setEnclosure('');
							    $objWriter->setLineEnding("\r\n");
							    $objWriter->setSheetIndex(0);
							    $objWriter->save('../formatos/ventas_bsv_imp_'.$fecha.'.csv');
							    // $objWriter->save('/root/informes_banchile/pv/'.date("Ymd").'/gestion_diaria_'.$nombre_documento.'.xlsx');
							    $callEndTime = microtime(true);
							    $callTime = $callEndTime - $callStartTime;
							break;
							case 'RYA':
								// VENTAS S
							    $objPHPExcel->getProperties()->setCreator("Victor Espinoza")
							                                 ->setLastModifiedBy("Victor Espinoza")
							                                 ->setTitle("RSA Hogar Seguro Plus II (Ventas S)")
							                                 ->setSubject("Ventas S")
							                                 ->setDescription("Ventas S")
							                                 ->setKeywords("Ventas S")
							                                 ->setCategory("Ventas S");

							    $objPHPExcel->getActiveSheet()->getStyle("A1:S1")->getFont()->getColor()->setRGB('000000');
							    $objPHPExcel->getActiveSheet()->getStyle('A1:S1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FDE9D9');

							    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
							    $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);	$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);	
							    $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);

							    $objPHPExcel->getActiveSheet()->setCellValue("A1", "TIPO DE SEGURO");				
							    $objPHPExcel->getActiveSheet()->setCellValue("B1", "FECHA VENTA");
							    $objPHPExcel->getActiveSheet()->setCellValue("C1", "RUT CONTRATANTE");			
							    $objPHPExcel->getActiveSheet()->setCellValue("D1", "DV CONTRATANTE");
							    $objPHPExcel->getActiveSheet()->setCellValue("E1", "FOLIO");		
							    $objPHPExcel->getActiveSheet()->setCellValue("F1", "FECHA NAC CONTRATANTE");
							    $objPHPExcel->getActiveSheet()->setCellValue("G1", "NOMBRE COMPLETO CONTRATANTE");		
							    $objPHPExcel->getActiveSheet()->setCellValue("H1", "DIRECCION COMPLETA PARA ENVIO DE POLIZA");
							    $objPHPExcel->getActiveSheet()->setCellValue("I1", "RUT ASEGURADO");	
							    $objPHPExcel->getActiveSheet()->setCellValue("J1", "DV ASEGURADO");
							    $objPHPExcel->getActiveSheet()->setCellValue("K1", "FECHA NAC ASEGURADO");	
							    $objPHPExcel->getActiveSheet()->setCellValue("L1", "NOMBRE COMPLETO ASEGURADO");
							    $objPHPExcel->getActiveSheet()->setCellValue("M1", "NOMBRE VENDEDOR");		
							    $objPHPExcel->getActiveSheet()->setCellValue("N1", "RUT VENDEDOR");
							    $objPHPExcel->getActiveSheet()->setCellValue("O1", "DV VENDEDOR");		
							    $objPHPExcel->getActiveSheet()->setCellValue("P1", "CANAL TELEMARKETING");
							    $objPHPExcel->getActiveSheet()->setCellValue("Q1", "ESTADO");	
							    $objPHPExcel->getActiveSheet()->setCellValue("R1", "BCH/CCH");	
							    $objPHPExcel->getActiveSheet()->setCellValue("S1", "FECHA ENVIO");	

							    $sql4 = "select 
										tipo_de_seguro,fecha_venta_2,rut,dv,folio,fecha_nacimiento_2,nombres,direccion_com,rut_asegurado,dv_asegurado,fecha_de_nac,nombres_com_aseg
										,''::varchar,rut_vendedor,dv_ven,canal_de_venta,'S'::varchar,'Banco Chile'::varchar
										from ventas.borrador_pro where fecha_carga = '".$fecha."'
										and folio not in (select folio from ventas.ventas_pro)
										and codigo_cia = '".$codigo_cia."'
										order by codigo_cia,negocio,folio";
								$q4 = consultar_tlmk($sql4);

								if($q4 != "NO")
								{
									$i = 2;
									$data4 = explode("::", $q4);
									foreach($data4 as $x4)
									{
										if(!empty($x4))
										{
											$data_42 = explode("||",$x4);
											$fecha_envio = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);

											$objPHPExcel->getActiveSheet()->setCellValue('A'.$i.'', $data_42[0]);
										    $objPHPExcel->getActiveSheet()->setCellValue('B'.$i.'', $data_42[1]);
										    $objPHPExcel->getActiveSheet()->setCellValue('C'.$i.'', $data_42[2]);
										    $objPHPExcel->getActiveSheet()->setCellValue('D'.$i.'', $data_42[3]);
										    $objPHPExcel->getActiveSheet()->setCellValue('E'.$i.'', $data_42[4]);
										    // $objPHPExcel->getActiveSheet()->getStyle('E'.$i.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
										    $objPHPExcel->getActiveSheet()->setCellValue('F'.$i.'', $data_42[5]);
										    $objPHPExcel->getActiveSheet()->setCellValue('G'.$i.'', $data_42[6]);
										    $objPHPExcel->getActiveSheet()->setCellValue('H'.$i.'', $data_42[7]);
										    $objPHPExcel->getActiveSheet()->setCellValue('I'.$i.'', $data_42[8]);
										    $objPHPExcel->getActiveSheet()->setCellValue('J'.$i.'', $data_42[9]);
										    $objPHPExcel->getActiveSheet()->setCellValue('K'.$i.'', $data_42[10]);
										    $objPHPExcel->getActiveSheet()->setCellValue('L'.$i.'', $data_42[11]);
										    $objPHPExcel->getActiveSheet()->setCellValue('M'.$i.'', $data_42[12]);
										    $objPHPExcel->getActiveSheet()->setCellValue('N'.$i.'', $data_42[13]);
										    $objPHPExcel->getActiveSheet()->setCellValue('O'.$i.'', $data_42[14]);
										    $objPHPExcel->getActiveSheet()->setCellValue('P'.$i.'', $data_42[15]);
										    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$i.'', $data_42[16]);
										    $objPHPExcel->getActiveSheet()->setCellValue('R'.$i.'', $data_42[17]);
										    $objPHPExcel->getActiveSheet()->setCellValue('S'.$i.'', $fecha_envio);
										}
										$i += 1;
									}
								}

								$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
							    $objWriter->save('../formatos/RSA_Ventas_S_'.$fecha.'.xlsx');
							    // $objWriter->save('/root/informes_banchile/pv/'.date("Ymd").'/gestion_diaria_'.$nombre_documento.'.xlsx');
							    $callEndTime = microtime(true);
							    $callTime = $callEndTime - $callStartTime;

							    //------------------------------------------------------------------------------------------------------------
							    //VENTAS PARA CARGAR EN SISTEMA
							    $objPHPExcel2 = new PHPExcel();
							    $objPHPExcel2->getActiveSheet()->getStyle("A1:G1")->getFont()->getColor()->setRGB('000000');
							    $objPHPExcel2->getActiveSheet()->getStyle('A1:G1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FDE9D9');

							    $objPHPExcel2->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
							    $objPHPExcel2->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

							    $objPHPExcel2->getActiveSheet()->setCellValue("A1", "rut");
							    $objPHPExcel2->getActiveSheet()->setCellValue("B1", "dv");
							    $objPHPExcel2->getActiveSheet()->setCellValue("C1", "folio");
							    $objPHPExcel2->getActiveSheet()->setCellValue("D1", "fecha_venta");
							    $objPHPExcel2->getActiveSheet()->setCellValue("E1", "id_producto");
							    $objPHPExcel2->getActiveSheet()->setCellValue("F1", "fecha_carga");
							    $objPHPExcel2->getActiveSheet()->setCellValue("G1", "id_gestion");

							    $sql4 = "select 
										rut,dv,folio,fecha_venta_2
										,3::int as id_producto  
										from ventas.borrador_pro where fecha_carga = '".$fecha."'
										and folio not in (select folio from ventas.ventas_pro)
										and codigo_cia = '".$codigo_cia."'
										order by codigo_cia,negocio,folio";
								$q4 = consultar_tlmk($sql4);

								if($q4 != "NO")
								{
									$i = 2;
									$data4 = explode("::", $q4);
									foreach($data4 as $x4)
									{
										if(!empty($x4))
										{
											$data_42 = explode("||",$x4);
											$rut = $data_42[0];
											$dv = $data_42[1];
											$folio = $data_42[2];
											$fecha_venta = $data_42[3];
											$id_producto = $data_42[4];
											$fecha_envio = substr($fecha,6,2)."/".substr($fecha,4,2)."/".substr($fecha,0,4);
											$id_gestion = 0;

											$objPHPExcel2->getActiveSheet()->setCellValue('A'.$i.'', $rut);
										    $objPHPExcel2->getActiveSheet()->setCellValue('B'.$i.'', $dv);
										    $objPHPExcel2->getActiveSheet()->setCellValue('C'.$i.'', $folio);
										    // $objPHPExcel2->getActiveSheet()->getStyle('C'.$i.'')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
										    $objPHPExcel2->getActiveSheet()->setCellValue('D'.$i.'', $fecha_venta);
										    $objPHPExcel2->getActiveSheet()->setCellValue('E'.$i.'', $id_producto);
										    $objPHPExcel2->getActiveSheet()->setCellValue('F'.$i.'', $fecha);
										    $objPHPExcel2->getActiveSheet()->setCellValue('G'.$i.'', $id_gestion);
										}
										$i += 1;
									}
								}

								$objWriter = new PHPExcel_Writer_CSV($objPHPExcel2);
							    $objWriter->setDelimiter(';');
							    $objWriter->setEnclosure('');
							    $objWriter->setLineEnding("\r\n");
							    $objWriter->setSheetIndex(0);
							    $objWriter->save('../formatos/ventas_rsa_imp_'.$fecha.'.csv');
							    // $objWriter->save('/root/informes_banchile/pv/'.date("Ymd").'/gestion_diaria_'.$nombre_documento.'.xlsx');
							    $callEndTime = microtime(true);
							    $callTime = $callEndTime - $callStartTime;
							break;
						}
					}
				}
			}
		break;
		case 'BV':
		break;
	}
		

	// $ob->script("darMensaje('Gestion Creada Satisfactoriamente','1')");

	$lista = '';
    $carpeta = 'C:\xampp\htdocs\BANCHILE\monitor_campaign\formatos';
    if(is_dir($carpeta)){
        if($dir = opendir($carpeta)){
            while(($archivo = readdir($dir)) !== false){
                if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
                    $lista .= '<li><a target="_blank" href="../formatos/'.$archivo.'">'.$archivo.'</a></li>';
                }
            }
            closedir($dir);
        }
    }

    // ---------------------------------------------------------------------------------------------------------------------------------
    $ob->assign("dataFormatos","innerHTML",$lista);
    $ob->script("activaLista();");

	return $ob;
}
function escuchaAnexo($anexo){
	$ob = new xajaxResponse;

	$anexoE = "SIP/".$anexo;

	$obast = new AstMan();

	$inicio = $obast->Login();

	$data2 = $obast->Query("Action: Originate\r\nChannel: SIP/9999\r\nApplication: ChanSpy\r\nData: ".$anexoE."\r\nTimeout: 30000\r\n\r\n");
	if($data2)
	{
		$ob->assign("spy".$anexo."","innerHTML","Escuchando...");
	}

	return $ob;
}
$xajax = new xajax();
$xajax->setCharEncoding('UTF-8');
$xajax->registerFunction("cargaExtensiones");
$xajax->registerFunction("guardaRegistroExtensiones");
$xajax->registerFunction("editarExtensiones");
$xajax->registerFunction("eliminarExtensiones");
$xajax->registerFunction("cargaDepartamentos");
$xajax->registerFunction("guardaRegistroDepartamento");
$xajax->registerFunction("editarDepartamentos");
$xajax->registerFunction("eliminarDepartamentos");
$xajax->registerFunction("cargaRutas");
$xajax->registerFunction("guardaRegistroRutas");
$xajax->registerFunction("editarRutas");
$xajax->registerFunction("eliminarRutas");
$xajax->registerFunction("cargaUsuarios");
$xajax->registerFunction("guardaRegistroUsuarios");
$xajax->registerFunction("editarUsuarios");
$xajax->registerFunction("eliminarUsuarios");
$xajax->registerFunction("cargaTarifas");
$xajax->registerFunction("guardaRegistroTarifas");
$xajax->registerFunction("editarTarifas");
$xajax->registerFunction("eliminarTarifas");
$xajax->registerFunction("generaReporte");
$xajax->registerFunction("creaFechas");
$xajax->registerFunction("guardaRegistroCambiarContrasena");
$xajax->registerFunction("reloadContent");
$xajax->registerFunction("creaGestion");
$xajax->registerFunction("reloadDetalles");
$xajax->registerFunction("reloadGestiones");
$xajax->registerFunction("actualizaGestion");
$xajax->registerFunction("reloadFormatos");
$xajax->registerFunction("escuchaAnexo");
$xajax->processRequest();

$xajax->printJavascript('../librerias/xajax/');
?>