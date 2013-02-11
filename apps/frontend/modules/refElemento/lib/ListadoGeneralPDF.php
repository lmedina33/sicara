<?php

class ListadoGeneralPdf extends FPDF {

//    $this->elemento=new RefElemento();


    function setElementos($elementos) {
        $this->elementos = $elementos;
    }

    function Header() {
        $this->SetFont('Arial', '', 11);
        if ($this->PageNo() == 1) {
            $this->Cell(260, 4, "ESCUELA AERONÁUTICA DE COLOMBIA", 0, 1, 'C');
            $this->Image(sfProjectConfiguration::guessRootDir() . '/web/images/logoEacSmall.png', 120);
            $this->Cell(260, 4, "Dirección Administrativa", 0, 1, 'C');
            $this->SetFont('Arial', '', 10);
            $this->Cell(260, 4, "Listado General de Recursos Físicos", 0, 1, 'C');
            $this->Cell(260, 3, "", 0, 1);
        }else{
            $this->Cell(260, 4, "ESCUELA AERONÁUTICA DE COLOMBIA", 0, 1);
            $this->Cell(260, 4, "Dirección Administrativa", 0, 1);
            $this->SetFont('Arial', '', 10);
            $this->Cell(260, 4, "Listado General de Recursos Físicos", 0, 1);
            $this->Cell(260, 3, "", 0, 1);
        }

        $this->Cell(12, 5, "#", 1, 0, "C");
        $this->Cell(25, 5, "Tipo", 1, 0, "C");
        $this->Cell(35, 5, "Serial", 1, 0, "C");
        $this->Cell(25, 5, "Serial EAC", 1, 0, "C");
        $this->Cell(40, 5, "Nombre", 1, 0, "C");
        $this->Cell(20, 5, "Marca", 1, 0, "C");
        $this->Cell(20, 5, "Modelo", 1, 0, "C");
        $this->Cell(35, 5, "Lugar", 1, 0, "C");
        $this->Cell(45, 5, "Responsable", 1, 0, "C");
        $this->Cell(20, 5, "Estado", 1, 1, "C");
    }

    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 5, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function generar() {

        $this->AliasNbPages();
        $this->SetFont('Arial', '', 11);
        $this->SetMargins(10, 10);

        $this->AddPage();



        $this->SetFont('Courier', '', 9);

        $n = 1;

        foreach ($this->elementos as $elemento) {
            $this->Cell(12, 4, $n, 1);
            $this->Cell(25, 4, substr($elemento->getRefTipoElemento()->getNombre(), 0, 11), 1);
            $this->Cell(35, 4, substr($elemento->getSerial(), 0, 17), 1);
            $this->Cell(25, 4, substr($elemento->getSerialInterno(), 0, 10), 1);
            $this->Cell(40, 4, substr($elemento->getNombre(), 0, 20), 1);
            $this->Cell(20, 4, substr($elemento->getMarca(), 0, 9), 1);
            $this->Cell(20, 4, substr($elemento->getModelo(), 0, 9), 1);
            $this->Cell(35, 4, substr($elemento->getRefLugar()->getNombre(), 0, 17), 1);
            $this->Cell(45, 4, substr($elemento->getUsuarioResponsable(), 0, 23), 1);
            $this->Cell(20, 4, substr($elemento->getRefEstadoElemento()->getNombre(), 0, 9), 1, 1);

            $n++;
        }
        
    }

}

?>
