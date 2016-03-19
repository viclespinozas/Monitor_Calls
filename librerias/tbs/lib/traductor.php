<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of traductor
 *Clase para la traduccion de atributos en las diferentes paginas o modulos.
 * @author hgonzalez
 */
class traductor {
    
    public static function trans($str,$form,$reformat=false) {
        
        
     $lang = $_SESSION[$form]; 
     

    
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

}

?>
