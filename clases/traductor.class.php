<?php

/*
********************************************************
Gysmo 
------------------------
Version  : 1.1
Date     : 2012-07-10
Web site : https://gysmo.contactop2p.com
Author   : Hector Gonzalez 
********************************************************

*/

class traductor {
    
	public function trans($str,$module,$reformat=false) {
				   
		 $lenguaje = $_SESSION['lenguaje'];
		//$lenguaje = "es";
		 if($module == "ui")
		 {
			//echo "ENTRA EN UI";
			//include("diccionario/".$lenguaje."/".$lenguaje.".".$module.".php");
			switch($lenguaje)
			{
				case "es":
					$lang = array('identifiquese_para_continuar' => 'Identifíquese antes de continuar', 'nombre_usuario' => 'Nombre de Usuario', 'contrasenia_usuario' => 'Contraseña', 'deslice_ingresar' => 'Deslice para Ingresar', 'rif' => 'J-31668080-0', 'version' => '1.1', 'datos_incorrectos' => 'Usuario y/o Contrase�a incorrectos, por favor intente nuevamente');		
				break;
				case "en":
					$lang = array('identifiquese_para_continuar' => 'Identify yourself before proceed', 'nombre_usuario' => 'Username', 'contrasenia_usuario' => 'Password', 'deslice_ingresar' => 'Slide to Enter', 'rif' => 'J-31668080-0', 'version' => '1.1', 'datos_incorrectos' => 'Usuario y/o Contrase�a incorrectos, por favor intente nuevamente');		
				break;
			}
			//$lang = obtener_array(); 
		 }
		 else
		 {
			//echo "ENTRA EN O";
			//include("../diccionario/".$lenguaje."/".$lenguaje.".".$module.".php"); 
			$lang = obtener_array(); 
		 }
		//example: include("../diccionario/es/es.ivr.php"); 
		 
		 
		 //$lang = obtener_array(); 
		 //example: $lang = array('Answer' => 'Atendida','Answer2' => 'Atendida2'); 
		  
		 

		
		$numargs = func_num_args();
		$args    = func_get_args();

		$format  = array_shift($args);

		 
		if (array_key_exists($str, $lang)){
		   
			$format = $lang[$str];
		} else {        
		   
				$format = $str;       
		   
		}

		if($reformat==true) {
			$format = charset_decode_utf8($format); // este es de verdad!
			//$format = htmlspecialchars($format,ENT_COMPAT,"UTF-8");
		} 

		if ($numargs > 1){
			$ret = vsprintf($format, $args);
			return $ret;
		}else{
			$format  = preg_replace("/%%/","%",$format);
			return $format;
		}
	}

	public function load_include($module)
	{
		@session_start();
		 
		$lenguaje = $_SESSION['lenguaje'];
		
		include("../diccionario/".$lenguaje."/".$lenguaje.".".$module.".php");
		
	   // echo $lenguaje;
		
		
	}

}

?>
