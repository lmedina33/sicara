<?php

class HojaVidaPdf extends FPDF {

//    $this->elemento=new RefElemento();


    function setElemento(RefElemento $elemento) {
        $this->elemento = $elemento;
    }

    function Header() {
        $this->SetFont('Arial', '', 11);
        $this->Cell(155, 4, "ESCUELA AERONÁUTICA DE COLOMBIA", 0, 1, 'C');
        $this->Image(sfProjectConfiguration::guessRootDir() . '/web/images/logoEacSmall.png', 87);
        $this->Cell(155, 4, "Dirección Administrativa", 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(155, 4, "Hoja de Vida de Recursos Físicos", 0, 1, 'C');
        $this->Cell(155, 5, "", 0, 1);
    }

    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function generar() {

        $this->AliasNbPages();
        $this->SetFont('Arial', '', 11);
        $this->SetMargins(30, 30);

        $this->AddPage();



        $this->Cell(30, 5, "Nombre:");
        $this->Cell(70, 5, $this->elemento->getNombre(), 0, 1);
        $this->Cell(30, 5, "Serial:");
        $this->Cell(70, 5, $this->elemento->getSerial(), 0, 1);
        $this->Cell(30, 5, "Serial Interno:");
        $this->Cell(70, 5, $this->elemento->getSerialInterno(), 0, 1);
        $this->Cell(30, 5, "Tipo Elemento:");
        $this->Cell(70, 5, $this->elemento->getRefTipoElemento()->getNombre(), 0, 1);
        $this->Cell(30, 5, "Marca:");
        $this->Cell(70, 5, $this->elemento->getMarca(), 0, 1);
        $this->Cell(30, 5, "Modelo:");
        $this->Cell(70, 5, $this->elemento->getModelo(), 0, 1);
        $this->Cell(30, 5, "Estado:");
        $this->Cell(70, 5, $this->elemento->getRefEstadoElemento()->getNombre(), 0, 1);

        $this->Cell(30, 5, "Prestable:");
        if ($this->elemento->getIsPrestable()) {
            $this->Cell(70, 5, "Si", 0, 1);
        } else {
            $this->Cell(70, 5, "No", 0, 1);
        }

        $this->Cell(30, 5, "Responsable:");
        $this->Cell(70, 5, $this->elemento->getUsuarioResponsable(), 0, 1);

        if ($this->elemento->getRefFotoElemento()->getFirst() != null) {
            $this->Image($this->elemento->getRefFotoElemento()->getFirst()->getPath(), 140, 60, 50, 35);
        }

        $descripcion = explode("\n", $this->elemento->getDescripcion());
        for ($i = 0; $i < count($descripcion); $i++) {
            if ($i == 0) {
                $this->Cell(30, 5, "Descripción:");
                $this->MultiCell(125, 5, $descripcion[$i], 0, 1);
            } else {
                $this->Cell(30, 5, "");
                $this->MultiCell(125, 5, $descripcion[$i], 0, 1);
            }
        }

        $lugar = $this->elemento->getRefLugar();

        $this->Cell(30, 5, "Lugar:");
        $this->Cell(125, 5, $lugar->getDescripcion(), 0, 1);
        $this->Cell(30, 5, "");
        $this->MultiCell(125, 5, $lugar->getPath(), 0, 1);
        $this->Cell(30, 5, "");
        $this->MultiCell(125, 5, "(" . $lugar->getUbicacion() . ")", 0, 1);
        $this->Cell(30, 5, "Ubicación:");
        $this->MultiCell(70, 5, $this->elemento->getUbicacion(), 0, 1);

        $this->Cell(155, 5, "", 0, 1);
        $this->Cell(155, 5, "", 'T', 1);

        $registros = $this->elemento->getRefHojaVida();

        foreach ($registros as $registro) {
            $this->SetFont('Arial', '', 9);
            $this->Cell(155, 5, "Registrado por ".$registro->getUsuarioCreador()." en ".$registro->getCreatedAt(),0,1,'R');
            $this->Cell(155, 3, "",0,1);
            $this->SetFont('Arial', '', 11);
            $this->WriteHTML(5,$registro->getDescripcion());
            $this->Ln();
            $this->Cell(155, 5, "", 'T',1);
        }
    }

}

?>
