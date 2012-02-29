<?php

function getMyDate($text){
    $dia="";
    
    switch(date("w")){
        case 0: $dia="Domingo";
            break;
        case 1: $dia="Lunes";
            break;
        case 2: $dia="Martes";
            break;
        case 3: $dia="Miércoles";
            break;
        case 4: $dia="Jueves";
            break;
        case 5: $dia="Viernes";
            break;
        case 6: $dia="Sábado";
            break;
    };
    
    $mes="";
    
    switch(date("n")){
        case 1: $mes="Enero";
            break;
        case 2: $mes="Febrero";
            break;
        case 3: $mes="Marzo";
            break;
        case 4: $mes="Abril";
            break;
        case 5: $mes="Mayo";
            break;
        case 6: $mes="Junio";
            break;
        case 7: $mes="Julio";
            break;
        case 8: $mes="Agosto";
            break;
        case 9: $mes="Septiembre";
            break;
        case 10: $mes="Octubre";
            break;
        case 11: $mes="Noviembre";
            break;
        case 12: $mes="Diciembre";
            break;
    };
    
    $text=str_replace("%d%",date("j"),$text);
    $text=str_replace("%dd%",date("d"),$text);
    $text=str_replace("%D%",$dia,$text);
    
    $text=str_replace("%m%",date("n"),$text);
    $text=str_replace("%mm%",date("m"),$text);
    $text=str_replace("%M%",$mes,$text);
    
    $text=str_replace("%a%",date("Y"),$text);
    $text=str_replace("%aa%",date("y"),$text);
    
    return $text;
}

?>
