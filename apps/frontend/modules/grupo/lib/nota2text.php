<?php

class Nota2Text {

    function __construct() {        
    }

    function convertir($n) {

        switch ($n) {

            case 0: return "CERO";
                break;
            case 1: return "UNO";
                break;
            case 2: return "DOS";
                break;
            case 3: return "TRES";
                break;
            case 4: return "CUATRO";
                break;
            case 5: return "CINCO";
                break;
            case 6: return "SEIS";
                break;
            case 7: return "SIETE";
                break;
            case 8: return "OCHO";
                break;
            case 9: return "NUEVE";
                break;
            case 10: return "DIEZ";
                break;
            case 11: return "ONCE";
                break;
            case 12: return "DOCE";
                break;
            case 13: return "TRECE";
                break;
            case 14: return "CATORCE";
                break;
            case 15: return "QUINCE";
                break;
            case 20: return "VEINTE";
                break;
            case 30: return "TREINTA";
                break;
            case 40: return "CUARENTA";
                break;
            case 50: return "CINCUENTA";
                break;
            case 60: return "SESENTA";
                break;
            case 70: return "SETENTA";
                break;
            case 80: return "OCHENTA";
                break;
            case 90: return "NOVENTA";
                break;
            case 100: return "CIEN";
                break;
        }

        if ($n >= 16 && $n <= 19) {
            $m = $n - 10;
            return "DIEZ Y " . $this->convertir($m);
        }

        if ($n >= 21 && $n <= 29) {
            $m = $n - 20;
            return "VEINTI" . $this->convertir($m);
        }

        if ($n >= 31 && $n <= 39) {
            $m = $n - 30;
            return "TREINTA Y " . $this->convertir($m);
        }

        if ($n >= 41 && $n <= 49) {
            $m = $n - 40;
            return "CUARENTA Y " . $this->convertir($m);
        }

        if ($n >= 51 && $n <= 59) {
            $m = $n - 50;
            return "CINCUENTA Y " . $this->convertir($m);
        }

        if ($n >= 61 && $n <= 69) {
            $m = $n - 60;
            return "SESENTA Y " . $this->convertir($m);
        }

        if ($n >= 71 && $n <= 79) {
            $m = $n - 70;
            return "SETENTA Y " . $this->convertir($m);
        }

        if ($n >= 81 && $n <= 89) {
            $m = $n - 80;
            return "OCHENTA Y " . $this->convertir($m);
        }

        if ($n >= 91 && $n <= 99) {
            $m = $n - 90;
            return "NOVENTA Y " . $this->convertir($m);
        }
    }

}
