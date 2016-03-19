<?php

/**
 * Description of traductor
 *Clase para el análisis de tweets, positivos, negativos o neutros.
 * @author vespinoza
 */
class tweetmoanalyzer {
    
	private $minTweetLength = 1; //min token length for it to be taken into consideration
	private $maxTweetLength = 15; //max token length for it to be taken into consideration
	private $classes = array('positivo', 'negativo', 'neutro'); // Private array with the two classes, pos/neg

    public static function clasify($text,$lontweet) {
        
		//ME CONECTO A LA BD///////////////////////////////////
		$link=mysql_connect("localhost","gysmo","Appsp2p!");
		mysql_select_db("gysmo",$link);
		///////////////////////////////////////////////////////
		
		$scores = array();
		//RECORRO EL ARREGLO POR SENTIMIENTOS
		foreach($classes as $sent)
		{
			$scores[$sent] = 0;
			//VERIFICO LA CANTIDAD DE CARACTERES DEL TWEET
			if($lontweet > 15)
			{
				//SEPARO EL TWEET POR PALABRAS
				$temp2 = explode(" ", $text);
				$lontemp = count($temp2);
				//echo $lontemp."<br>";
				for($i=0;$i<$lontemp;$i++)
				{
					//echo $temp2[$i]."<br>";
					$sql = "SELECT a.nombre_categoria,b.palabra FROM `p2p_tm_categorias` a LEFT JOIN `p2p_tm_palabras_clave` b ON a.idcategoria = b.idcategoria WHERE a.nombre_categoria = '$sent' AND b.palabra = '$temp2[$i]'; ";
					//echo $sql."<br>";
					$res = mysql_query($sql);
					$can = mysql_num_rows($res);
					if($can > 0)
					{
						$scores[$sent] ++;
					}
					else
					{
						$scores[$sent] += 0;
					}
				}
			}
			else
			{
				$resul = "ignore";
				return $resul;
			}
		}
		
		 
		//$text = strtoupper($text);
		return $scores;
		
	}//Close categorise Function

}
?>
