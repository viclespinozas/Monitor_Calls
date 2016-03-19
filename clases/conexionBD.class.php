<?php
// pg_connect("host=172.30.59.217 port=5432 dbname=camaleon user=postgres password=password");
function consultar($query){
	if($link=pg_connect("host=172.30.174.217 port=5432 dbname=camaleon user=postgres password=password"))
	{
		if($res = pg_query($link,$query))
		{
			$can = pg_num_rows($res); 
			if(($can) > 0)
			{
				$filas = pg_num_fields($res);
				while($val = pg_fetch_array($res))
				{
					for($i=0;$i<$filas;$i++)
					{
						$text .= $val[$i]."||"; 
					}
					$text .= "::";
				}
				pg_close($link);
				return $text;
			}
			else
			{
				$men = "NO";
				return $men;
			}
		}
		else
		{
			$men = "NO";
			return $men;
		}
	}
	else
	{
		$men = "NO";
		return $men;
	}
}
function insertar($query){
	if($link=pg_connect("host=172.30.174.217 port=5432 dbname=camaleon user=postgres password=password"))
	{
		if($res = pg_query($link,$query))
		{
			pg_close($link);
			$men = "OK";
			return $men;
		}
		else
		{
			$men = "NO";
			return $men;
		}
	}
	else
	{
		$men = "NO";
		return $men;
	}
}
function consultar_tlmk($query){
	if($link=pg_connect("host=172.30.174.218 port=5432 dbname=camaleon user=postgres password=password"))
	{
		if($res = pg_query($link,$query))
		{
			$can = pg_num_rows($res); 
			if(($can) > 0)
			{
				$filas = pg_num_fields($res);
				while($val = pg_fetch_array($res))
				{
					for($i=0;$i<$filas;$i++)
					{
						$text .= $val[$i]."||"; 
					}
					$text .= "::";
				}
				pg_close($link);
				return $text;
			}
			else
			{
				$men = "NO";
				return $men;
			}
		}
		else
		{
			$men = "NO";
			return $men;
		}
	}
	else
	{
		$men = "NO";
		return $men;
	}
}
function insertar_tlmk($query){
	if($link=pg_connect("host=172.30.174.218 port=5432 dbname=camaleon user=postgres password=password"))
	{
		if($res = pg_query($link,$query))
		{
			pg_close($link);
			$men = "OK";
			return $men;
		}
		else
		{
			$men = "NO";
			return $men;
		}
	}
	else
	{
		$men = "NO";
		return $men;
	}
}	
?>