<?php

class FormatoRC005DilPdf extends FPDF {

    function setEstudiantes($elemento) {
        $this->elemento = $elemento;
    }

    function setNotas($notas) {
        $this->notas = $notas;
    }

    function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    private $pags;

    function numReg($n) {
        $m = 14;
        $pag = 1;

        while ($m < $n) {
            $m = $m + 14;
            $pag++;
        }

        $this->pags = $pag;
    }

    function Header() {
        $this->SetFont('times', 'B', 12);
        $this->Cell(250, 5, '', 'LTR', 1);
        $this->Cell(250, 3, 'ESCUELA AERONÁUTICA DE COLOMBIA', 'LR', 1, 'C');
        $this->Cell(250, 5, '', 'LR', 1);

        $this->SetFont('times', '', 11);
        $this->Cell(250, 5, 'DIRECCIÓN ACADÉMICA', 'LR', 1, 'C');
        $this->Cell(250, 5, 'REGISTRO GENERAL DE CALIFICACIONES', 'LR', 1, 'C');
        $this->Cell(250, 5, '', 'LR', 1);


        //////////////////
        $this->Cell(5, 5, '', 'L', 0);
        $this->Cell(25, 5, 'PROGRAMA:', '', 0, 'L');
        $this->Cell(210, 5, $this->grupo->getPeriodoAcademico()->getPensum(), 'B', 0, 'C');
        $this->Cell(10, 5, '', 'R', 1);

        //////////////////
        $this->Cell(5, 5, '', 'L', 0);
        $this->Cell(20, 5, 'MATERIA:', '', 0, 'L');
        $this->Cell(155, 5, $this->grupo->getAsignatura(), 'B', 0, 'C');
        $this->Cell(30, 5, 'INTENSIDAD:', '', 0, 'C');
        $this->Cell(30, 5, $this->grupo->getAsignatura()->getIntensidadHoraria(), 'B', 0, 'C');
        $this->Cell(10, 5, '', 'R', 1);

        ///////////////////
        $this->Cell(5, 5, '', 'L', 0);
        $this->Cell(22, 5, 'SEMESTRE:', '', 0, 'L');
        $this->Cell(63, 5, $this->grupo->getAsignatura()->getSemestre()->getNumero(), 'B', 0, 'C');
        $this->Cell(40, 5, 'PERIODO:', '', 0, 'C');
        $this->Cell(45, 5, $this->grupo->getPeriodoAcademico()->getPeriodo(), 'B', 0, 'C');
        $this->Cell(75, 5, '', 'R', 1);

        ///////////////////
        $this->Cell(5, 5, '', 'L', 0);
        $this->Cell(20, 5, 'DOCENTE:', '', 0, 'L');
        $this->Cell(115, 5, $this->grupo->getProfesor(), 'B', 0, 'C');
        $this->Cell(30, 5, 'LICENCIA:', '', 0, 'C');
        $this->Cell(25, 5, '', 'B', 0, 'C');
        $this->Cell(20, 5, 'IET:', '', 0, 'C');
        $this->Cell(25, 5, '', 'B', 0, 'C');
        $this->Cell(10, 5, '', 'R', 1);

        //////////////////
        $this->Cell(5, 5, '', 'L', 0);
        $this->Cell(35, 5, 'FECHA DE INICIO:', '', 0, 'L');
        $this->Cell(50, 5, $this->grupo->getFechaInicio(), 'B', 0, 'C');
        $this->Cell(50, 5, 'FECHA DE TERMINACIÓN:', '', 0, 'C');
        $this->Cell(50, 5, $this->grupo->getFechaFin(), 'B', 0, 'C');
        $this->Cell(60, 5, '', 'R', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(250, 3, '', 'LR', 1);
        $this->Cell(25, 5, 'CODIGO', 1, 0, 'C');
        $this->Cell(90, 5, 'NOMBRE Y APELLIDO', 1, 0, 'C');
        $this->SetFont('times', 'B', 6);
        $this->Cell(20, 5, 'DEFINITIVA', 1, 0, 'C');
        $this->Cell(85, 5, 'DEFINITIVA EN LETRA', 1, 0, 'C');
        $this->Cell(15, 5, 'NIVELACION', 1, 0, 'C');
        $this->Cell(15, 5, 'ASISTENCIA', 1, 1, 'C');
    }

    function Footer() {
        $this->SetY(-135);
        $this->SetFont('times', '', 10);
        $this->Cell(250, 70, '', 'LR', 1);
        $this->Cell(250, 5, 'OBSERVACIONES', 'LTR', 1, 'L');
        $this->Cell(250, 5, '', 'LR', 1);
        $this->Cell(250, 5, '', 1, 1);
        $this->Cell(250, 5, '', 1, 1);
        $this->Cell(250, 20, '', 'LTR', 1);

        $this->Cell(35, 5, '', 'L', 0);
        $this->Cell(70, 5, 'INSTRUCTOR', 'T', 0, 'C');
        $this->Cell(40, 5, '', 0, 0);
        $this->Cell(70, 5, 'REGISTRO Y CONTROL', 'T', 0, 'C');
        $this->Cell(35, 5, '', 'R', 1);
        $this->Cell(250, 5, '', 'LBR', 1);
        //Print centered page number
        $this->SetFont('times', '', 6);
        $this->Cell(20, 10, '', 0, 0);
        $this->Cell(210, 10, 'Página ' . $this->PageNo() . ' de ' . $this->pags, 0, 0, 'C');
        $this->Cell(20, 10, 'RC-005', 0, 0, 'R');
    }

    function generar() {
        $this->SetMargins(15, 20, 15);
        $this->SetAutoPageBreak(true, 60);
        $this->AliasNbPages();
        $this->AddPage();

        foreach ($this->elemento as $estudianteHas) {
            $this->SetFont('times', '', 9);
            $this->Cell(25, 5, $estudianteHas->getEstudiante()->getCodigoEstudiante(), 1, 0, 'C');
            $this->Cell(90, 5, $estudianteHas->getEstudiante()->getUsuario()->getPrimerApellido() . " " . $estudianteHas->getEstudiante()->getUsuario()->getSegundoApellido() . " " . $estudianteHas->getEstudiante()->getUsuario()->getPrimerNombre() . " " . $estudianteHas->getEstudiante()->getUsuario()->getSegundoNombre(), 1, 0, 'L');
//            $this->SetFont('times', 'B', 6);
            if (isset($this->notas[$estudianteHas->getEstudiante()->getCodigoEstudiante()])) {
                $data = $this->notas[$estudianteHas->getEstudiante()->getCodigoEstudiante()];
                $conversor = new Nota2Text();
                
                $this->Cell(20, 5, intval($data['definitiva']), 1, 0, 'C');
                $this->Cell(85, 5, $conversor->convertir(intval($data['definitiva'])), 1, 0, 'C');
                $this->Cell(15, 5, intval($data['nivelacion']), 1, 0, 'C');
                $this->Cell(15, 5, intval($data['asistencia']), 1, 1, 'C');
            } else {
                $this->Cell(20, 5, '', 1, 0, 'C');
                $this->Cell(85, 5, '', 1, 0, 'C');
                $this->Cell(15, 5, '', 1, 0, 'C');
                $this->Cell(15, 5, '', 1, 1, 'C');
            }
        }
    }

}

?>
