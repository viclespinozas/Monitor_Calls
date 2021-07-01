<?php

class xajaxTraductorN extends xajaxResponse{
	private $res;
	private $can;
	private $val;
	private $men;
    private $cadena;
	private $ldapserver;
	private $ldaprdn;
	private $ldappass;
	private $ldapconn;
	private $ldapbind;
	private $text;
	private $filas;
	private $datosUsuario;
	
	// private $IPAPP = "172.16.1.110";
	private $IPAPP = "localhost";
	private $USAPP = "root";
	private $PWAPP = ".developer09@";
	
	private $IPPBX = "172.16.1.178";
	private $USPBX = "gysmo";
	private $PWPBX = "p2rs4n";
	
	public function consultarLDAP($u,$p){
		// $obj = new xajaxResponse();
		
		/*$this->men = "OK";
		return $this->men;
		*/
		$this->ldaprdn  = $u.'@p2p.dom';
		$this->ldappass = $p;
		// $this->ldapconn = ldap_connect("172.16.1.160")
		$this->ldapconn = ldap_connect("172.29.0.253")
			or die("Could not connect to LDAP server.");

		if ($this->ldapconn) 
		{
			$this->ldapbind = ldap_bind($this->ldapconn, $this->ldaprdn, $this->ldappass);
			if ($this->ldapbind) 
			{
				$this->men = "OK";
				return $this->men;
			} 
			else
			{
				$this->men = "NO";
				return $this->men;
			}
		}
		else
		{
			$this->men = "ERROR";
			return $this->men;
		}
	}
	
	public function obtenerDatosUsuario($u){
		//$this->men = "OBTENIENDO DATOS";
		$queryu = "SELECT 
					a.id_usuario,
					a.usu_nombre,
					a.usu_tipo,
					a.usu_lenguaje,
					a.perfil_id_perfil,
					b.per_primer_nombre,
					b.per_primer_apellido,
					c.supervisor_rrhh_id_supervisor_rrhh,
					a.usu_extension,
					b.id_personal
					FROM `usuario` a
					LEFT JOIN `datos_personal_rrhh` b ON a.id_usuario = b.usuario_id_usuario
					#LEFT JOIN `supervisor_rrhh` c ON b.id_personal = c.datos_personales_id_datos_personales
					LEFT JOIN `movimiento_trabajador` c ON b.id_personal = c.datos_personal_rrhh_id_personal
					WHERE a.usu_nombre = '$u';";
		$this->datosUsuarios = $this->consultar($queryu);
		if($this->datosUsuarios)
		{
			return $this->datosUsuarios;
		}
	}
	
	public function consultar($query){
		if($link=mysql_connect("localhost","root",".developer09@"))
		{
			if(mysql_select_db("intranet",$link))
			{
				if($res = mysql_query($query,$link))
				{
					$can = mysql_num_rows($res); 
					if(($can) > 0)
					{
						$filas = mysql_num_fields($res);
						while($val = mysql_fetch_array($res))
						{
							for($i=0;$i<$filas;$i++)
							{
								$text .= $val[$i]."||"; 
							}
							$text .= "::";
						}
						mysql_close($link);
						return $text;
					}
					else
					{
						$men = "NORES";
						return $men;
					}
				}
				else
				{
					$men = "NOEXE";
					return $men;
				}
			}
			else
			{
				$men = "NODB";
				return $men;
			}
		}
		else
		{
			$men = "NOCON";
			return $men;
		}
	}	
	
	public function insertar($query){
		//$obj = new xajaxResponse();
		//return $query;
		$this->text = "";
		if($link=mysql_connect($this->IPAPP,$this->USAPP,$this->PWAPP))
		{
			if(mysql_select_db("gysmol",$link))
			{
				if($this->res = mysql_query($query,$link))
				{
					mysql_close($link);
					$this->men = "OK";
					return $this->men;
				}
				else
				{
					$this->men = "NO";
					return $this->men;
				}
			}
			else
			{
				$this->men = "NO";
				return $this->men;
			}
		}
		else
		{
			$this->men = "NO";
			return $this->men;
		}
	}
	
	public function actualizar($query){
		// $obj = new xajaxResponse();
		//return $query;
		$this->text = "";
		if($link=mysql_connect($this->IPAPP,$this->USAPP,$this->PWAPP))
		{
			if(mysql_select_db("gysmol",$link))
			{
				if($this->res = mysql_query($query,$link))
				{
					@mysql_close($link);
					$this->men = "OK";
					return $this->men;
				}
				else
				{
					@mysql_close($link);
					$this->men = "NO";
					return $this->men;
				}
			}
			else
			{
				@mysql_close($link);
				$this->men = "NO";
				return $this->men;
			}
			@mysql_close($link);
		}
		else
		{
			$this->men = "NO";
			return $this->men;
		}
	}
	
	public function consultarPBX($query){
		//$obj = new xajaxResponse();
		//return $query;
		$this->text = "";
		// if($link=mysql_connect("172.16.1.110","gysmo","p2rs4n"))
		if($link=mysql_connect($this->IPPBX, $this->USPBX, $this->PWPBX))
		{
			if(mysql_select_db("gysmo_cc",$link))
			{
			
				if($this->res = mysql_query($query,$link))
				{
					$this->can = mysql_num_rows($this->res); 
					if(($this->can) > 0)
					{
						$this->filas = mysql_num_fields($this->res);
						while($this->val = mysql_fetch_array($this->res))
						{
							for($i=0;$i<($this->filas);$i++)
							{
								$this->text .= $this->val[$i]."||"; 
							}
							$this->text .= "::";
						}
						@mysql_close($link);
						return $this->text;
					}
					else
					{
						@mysql_close($link);
						$this->men = "NO";
						return $this->men;
					}
				}
				@mysql_close($link);
			}
			else
			{
				$this->men = "NO";
				return $this->men;
			}
		}
		else
		{
			$this->men = "NO";
			return $this->men;
		}
	}
	
	public function insertarPBX($query){
		// $obj = new xajaxResponse();
		//return $query;
		$this->text = "";
		// if($link=mysql_connect("172.16.1.110","gysmo","p2rs4n"))
		if($link=mysql_connect($this->IPPBX, $this->USPBX, $this->PWPBX))
		{
			if(mysql_select_db("gysmo_cc",$link))
			{
				if($this->res = mysql_query($query,$link))
				{
					if(!mysql_insert_id($this->res)){
						$this->men = intval(mysql_insert_id($this->res));
					}else $this->men = "OK";
					
					@mysql_close($link);
					return $this->men;
				}
				else
				{
					@mysql_close($link);
					$this->men = "NO";
                                        return $this->men;
                                                                               
				}
			}
			else
			{
				@mysql_close($link);
				$this->men = "NO";
				return $this->men;
			}
			@mysql_close($link);
		}
		else
		{
			$this->men = "NO";
			return $this->men;
		}
	}
	
	public function actualizarPBX($query){
		// $obj = new xajaxResponse();
		//return $query;
		$this->text = "";
		// if($link=mysql_connect("172.16.1.110","gysmo","p2rs4n"))
		if($link=mysql_connect($this->IPPBX, $this->USPBX, $this->PWPBX))
		{
			if(mysql_select_db("gysmo_cc",$link))
			{
				if($this->res = mysql_query($query,$link))
				{
					@mysql_close($link);
					$this->men = "OK";
					return $this->men;
				}
				else
				{
					@mysql_close($link);
					$this->men = "NO";
					return $this->men;
				}
			}
			else
			{
				@mysql_close($link);
				$this->men = "NO";
				return $this->men;
			}
			@mysql_close($link);
		}
		else
		{
			$this->men = "NO";
			return $this->men;
		}
	}

	public function obtenerCantidadRegistros(){
		return $this->can;
	}
	
}

class xajaxResponseDB extends xajaxTraductorN {
    
	public function trans_word($str,$module,$reformat=false) {
				   
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

	public function load_include_module($module)
	{
		@session_start();
		 
		$lenguaje = $_SESSION['lenguaje'];
		
		include("../diccionario/".$lenguaje."/".$lenguaje.".".$module.".php");
		

		
		
	}

}
?>
