<?php

class FormularioInscripcionPdf extends FPDF {

//    FormularioInscripcion $this->elemento=new FormularioInscripcion();


    function setElemento(FormularioInscripcion $elemento) {
        $this->elemento = $elemento;
    }

    function Header() {
        $this->Image(sfProjectConfiguration::guessRootDir() .'/web/images/logoEac.png', 18, 12, 55);
        $this->SetFont('times', 'B', 12);

        $this->Cell(195, 2, '', 'LTR', 1);
        $this->Cell(70, 5, '', 'L', 0);
        $this->Cell(125, 5, 'ESCUELA AERONÁUTICA DE COLOMBIA', 'R', 1, 'L');

        $this->Cell(75, 5, '', 'L', 0);
        $this->SetFont('times', '', 10.5);
        $this->Cell(120, 5, 'CENTRO DE INSTRUCCIÓN AERONÁUTICA', 'R', 1, 'L');

        $this->SetFont('times', '', 8);
        $this->Cell(64, 3.5, '', 'L', 0);
        $this->Cell(131, 3.5, 'INSTITUCIÓN DE EDUCACIÓN PARA EL TRABAJO Y EL DESARROLLO HUMANO', 'R', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 6, '', 'L', 0);
        $this->Cell(35, 6, 'INSCRIPCIÓN No.: ', 'LT', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(40, 6, $this->elemento->getNumero() . '     ', 'TR', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 6.5, '', 'LB', 0);
        $this->Cell(45, 6.5, 'FECHA DE INSCRIPCIÓN: ', 'LB', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(30, 6.5, date('d-m-Y',strtotime($this->elemento->getCreatedAt())), 'BR', 1);
    }

//    function Footer() {
//        // Posición: a 1,5 cm del final
//        $this->SetY(-15);
//        // Arial italic 8
//        $this->SetFont('Arial', 'I', 8);
//        // Número de página
//        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
//    }
    

    function generar() {
        $this->SetFont('Arial', '', 11);
        $this->SetMargins(15,10,5);   
	$this->SetAutoPageBreak(true,10);
	$this->AliasNbPages();
        $this->AddPage();
        
        
        $this->SetFont('times', 'B', 12);
        $this->Cell(195, 3, '', '', 1);
        $this->Cell(195, 5, 'INFORMACIÓN PERSONAL', '', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(50, 5, 'PRIMER APELLIDO:', 'LTR', 0, 'L');
        $this->Cell(50, 5, 'SEGUNDO APELLIDO:', 'TR', 0, 'L');
        $this->Cell(60, 5, 'NOMBRES:', 'TR', 0, 'L');
        $this->Cell(35, 5, '', 'TR', 1);

        $this->Cell(50, 2, '', 'LR', 0);
        $this->Cell(50, 2, '', 'R', 0);
        $this->Cell(60, 2, '', 'R', 0);
        $this->Cell(35, 2, '', 'R', 1);

        $this->SetFont('times', '', 10);
        $this->Cell(50, 5, $this->elemento->getPrimerApellido(), 'LR', 0, 'L');
        $this->Cell(50, 5, $this->elemento->getSegundoApellido(), 'R', 0);
        $this->Cell(60, 5, $this->elemento->getPrimerNombre().' '.$this->elemento->getSegundoNombre(), 'R', 0);
        $this->Cell(35, 5, '', 'R', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(55, 5, 'DOCUMENTO DE IDENTIDAD:', 'LTR', 0, 'L');
        $this->Cell(60, 5, 'LUGAR Y FECHA DE', 'TR', 0, 'L');
        $this->Cell(45, 5, 'TRABAJA', 'TR', 0, 'L');
        $this->Cell(35, 5, '', 'R', 1);

        $this->Cell(55, 4, '', 'LR', 0);
        $this->Cell(60, 4, 'NACIMIENTO:', 'R', 0, 'L');
        $this->Cell(45, 4, 'ACTUALMENTE?', 'R', 0, 'L');
        $this->Cell(35, 4, '', 'R', 1);

        $this->Cell(10, 4, 'No.:', 'L', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(45, 4, $this->elemento->getDocumento(), 'R', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(60, 4, '', 'R', 0);
        $this->Cell(45, 4, '', 'R', 0);
        
        if($this->elemento->getFotoPath()!=null && $this->elemento->getFotoPath()!=""){
            $this->Cell(35, 4, '', 'R', 1, 'C');
            $this->Image($this->elemento->getFotoPath(), 177, 49, 25, 30);
        }else{
            $this->Cell(35, 4, 'FOTO RECIENTE', 'R', 1, 'C');
        }

        $this->Cell(55, 5, '', 'LR', 0);
        $this->Cell(60, 5, 'Municipio/Ciudad:', 'R', 0, 'L');
        $this->Cell(10, 5, 'Si:', 0, 0, 'L');
        $this->Cell(5, 4, ($this->elemento->getEsTrabajador() ? 'X' : ''), 'LTBR', 0);
        $this->Cell(30, 5, '', 'R', 0);
        $this->Cell(35, 5, '', 'R', 1);

        $this->Cell(15, 5, 'C.C.', 'L', 0);
        $this->Cell(5, 4, (($this->elemento->getIdTipoDocumento()=='2') ? 'X' : ''), 'LTBR', 0);
        $this->Cell(35, 5, '', 'R', 0);
        $this->SetFont('times', '', 10);
        $this->Cell(60, 5, $this->elemento->getLugarNacimiento(), 'R', 0);
        $this->SetFont('times', 'B', 10);
        $this->Cell(10, 5, 'No:', 0, 0, 'L');
        $this->Cell(5, 4, ($this->elemento->getEsTrabajador() ? '' : 'X'), 'LTBR', 0);
        $this->Cell(30, 5, '', 'R', 0);
        $this->Cell(35, 5, '', 'R', 1);

        $this->Cell(15, 5, 'T.I.', 'L', 0, 'L');
        $this->Cell(5, 4, (($this->elemento->getIdTipoDocumento()=='1') ? 'X' : ''), 'LTBR', 0);
        $this->Cell(35, 5, '', 'R', 0);
        $this->Cell(60, 5, 'Fecha: ', 'R', 0, 'L');
        $this->Cell(45, 5, 'LIBRETA MILITAR:', 'RT', 0, 'L');
        $this->Cell(35, 5, '', 'R', 1);

        $this->Cell(55, 5, '', 'LR', 0);
        $this->SetFont('times', '', 10);
        $this->Cell(60, 5, date('d-m-Y',strtotime($this->elemento->getFechaNacimiento())), 'R', 0);
        $this->SetFont('times', 'B', 10);
        $this->Cell(45, 5, '', 'R', 0);
        $this->Cell(35, 5, '', 'R', 1);

        $this->Cell(10, 5, 'Otro:', 'LB', 0, '');
        $this->SetFont('times', '', 10);
        $this->Cell(45, 5, ( ($this->elemento->getIdTipoDocumento()!='1' && $this->elemento->getIdTipoDocumento()!='2') ? $this->elemento->getTipoDocumento()->getNombre() : ''), 'RB', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(10, 5, '', 'B', 0, '');
        $this->SetFont('times', '', 10);
        $this->Cell(50, 5, '', 'BR', 0, 'L');
        $this->Cell(45, 5, $this->elemento->getLibretaMilitar(), 'BR', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(35, 5, '', 'BR', 1);

        $this->Cell(60, 5, 'TELEFONO / CELULAR:', 'L', 0, 'L');
        $this->Cell(70, 5, 'DIRECCIÓN:', 'L', 0, 'L');
        $this->Cell(65, 5, 'CORREO ELECTRÓNICO:', 'LR', 1, 'L');

        $this->Cell(60, 2, '', 'L', 0, 'L');
        $this->Cell(70, 2, '', 'L', 0, 'L');
        $this->Cell(65, 2, '', 'LR', 1, 'L');

        $this->SetFont('times', '', 10);
        $this->Cell(60, 5, $this->elemento->getTelefono1() . ' / ' . $this->elemento->getTelefono2(), 'LB', 0, 'L');
        $this->Cell(70, 5, $this->elemento->getDireccion(), 'LB', 0, 'L');
        $this->Cell(65, 5, $this->elemento->getCorreo(), 'LRB', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(195, 5, 'COMO SE ENTERÓ DE LA E.A.C.?', 'LR', 1);

        $this->SetFont('times', '', 10);
        $this->Cell(195, 5, $this->elemento->getConocio(), 'LRB', 1, 'l');

        $this->SetFont('times', 'B', 10);
        $this->Cell(195, 5, 'COMO CANCELARÁ USTED EL VALOR DE SU MATRÍCULA?', 'LR', 1, 'l');

        $this->Cell(195, 1, '', 'LR', 1);

        $this->SetFont('times', '', 10);
        $this->Cell(16, 4, 'Efectivo', 'L', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(5, 4, (($this->elemento->getIdTipoPago()=='1') ? 'X' : ''), 'LTBR', 0, 'L');
        $this->Cell(5, 4, '', '', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(20, 4, 'Financiado', '', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(5, 4, (($this->elemento->getIdTipoPago()=='2') ? 'X' : ''), 'LTBR', 0, 'L');
        $this->Cell(5, 4, '', '', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(30, 4, 'Por medio de beca', '', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(5, 4, (($this->elemento->getIdTipoPago()=='4') ? 'X' : ''), 'LTBR', 0, 'L');
        $this->Cell(5, 4, '', '', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(37, 4, 'Por medio de convenio', '', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(5, 4, (($this->elemento->getIdTipoPago()=='5') ? 'X' : ''), 'LTBR', 0, 'L');
        $this->Cell(4, 4, '', '', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(10, 4, 'Otro:', '', 0, 'L');
        $this->Cell(40, 4, (($this->elemento->getIdTipoPago()!='1' && $this->elemento->getIdTipoPago()!='2' && $this->elemento->getIdTipoPago()!='4' && $this->elemento->getIdTipoPago()!='5')  ? $this->elemento->getTipoPago()->getNombre() : ''), 'B', 0, 'L');
        $this->Cell(3, 4, '', 'R', 1, 'L');

        $this->Cell(195, 1, '', 'LBR', 1);

        $this->SetFont('times', 'B', 12);
        $this->Cell(195, 3, '', '', 1);
        $this->Cell(195, 5, 'INFORMACIÓN ACADÉMICA', '', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 6, 'ESTUDIO', 'LTB', 0, 'C');
        $this->SetFont('times', 'B', 6);
        $this->Cell(12, 6, 'EN CURSO', 'LTB', 0, 'C');
        $this->Cell(16, 6, 'AÑO FIN', 'LTB', 0, 'C');
        $this->SetFont('times', 'B', 10);
        $this->Cell(47, 6, 'TITULO RECIBIDO', 'LTB', 0, 'C');
        $this->Cell(56, 6, 'INSTITUCIÓN', 'LTB', 0, 'C');
        $this->Cell(39, 6, 'CIUDAD/MUNICIPIO', 'LTBR', 1, 'C');

        $this->Cell(25, 6, 'BASICA', 'LTB', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 6, '--', 'LTB', 0, 'C');
        $this->Cell(16, 6, $this->elemento->getEduBasicaAno(), 'LTB', 0, 'C');
        $this->Cell(47, 6, '--', 'LTB', 0, 'C');
        $this->Cell(56, 6, $this->elemento->getEduBasicaInstitucion(), 'LTB', 0, 'C');
        $this->Cell(39, 6, $this->elemento->getEduBasicaLugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 6, 'MEDIA', 'LTB', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 6, (($this->elemento->getEduMediaEnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 6, $this->elemento->getEduMediaAno(), 'LTB', 0, 'C');
        $this->Cell(47, 6, $this->elemento->getEduMediaTitulo(), 'LTB', 0, 'C');
        $this->Cell(56, 6, $this->elemento->getEduMediaInstitucion(), 'LTB', 0, 'C');
        $this->Cell(39, 6, $this->elemento->getEduMediaLugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 6, 'EDUCACIÓN', 'LT', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 6, (($this->elemento->getEduSuperior1EnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 6, $this->elemento->getEduSuperior1Ano(), 'LTB', 0, 'C');
        $this->Cell(47, 6, $this->elemento->getEduSuperior1Titulo(), 'LTB', 0, 'C');
        $this->Cell(56, 6, $this->elemento->getEduSuperior1Institucion(), 'LTB', 0, 'C');
        $this->Cell(39, 6, $this->elemento->getEduSuperior1Lugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 6, 'SUPERIOR', 'L', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 6, (($this->elemento->getEduSuperior2EnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 6, $this->elemento->getEduSuperior2Ano(), 'LTB', 0, 'C');
        $this->Cell(47, 6, $this->elemento->getEduSuperior2Titulo(), 'LTB', 0, 'C');
        $this->Cell(56, 6, $this->elemento->getEduSuperior2Institucion(), 'LTB', 0, 'C');
        $this->Cell(39, 6, $this->elemento->getEduSuperior2Lugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', '', 6);
        $this->Cell(25, 6, '(Técnico, Profesional, ...)', 'LB', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 6, (($this->elemento->getEduSuperior3EnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 6, $this->elemento->getEduSuperior3Ano(), 'LTB', 0, 'C');
        $this->Cell(47, 6, $this->elemento->getEduSuperior3Titulo(), 'LTB', 0, 'C');
        $this->Cell(56, 6, $this->elemento->getEduSuperior3Institucion(), 'LTB', 0, 'C');
        $this->Cell(39, 6, $this->elemento->getEduSuperior3Lugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 12);
        $this->Cell(195, 3, '', '', 1);
        $this->Cell(195, 5, 'INFORMACIÓN DE INSCRIPCIÓN', '', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 5, 'PROGRAMA:', 'LT', 0, 'L');
        $this->Cell(105, 5, '', 'TR', 0, 'L');
        $this->Cell(65, 5, '', 'LTR', 1, 'C');

        $this->SetFont('times', '', 10);
        $this->Cell(130, 5, $this->elemento->getPeriodoAcademico()->getPensum()->getNombre(), 'LBR', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(65, 5, '', 'LR', 1, 'C');

        $this->Cell(42, 10, 'PERIODO ACADÉMICO:', 'LB', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(15, 10, $this->elemento->getPeriodoAcademico()->getPeriodo(), 'B', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(10, 10, '', 'B', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(15, 10, '', 'B', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(20, 10, 'JORNADA:', 'B', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(28, 10, $this->elemento->getJornada()->getNombre(), 'BR', 0, 'L');
        $this->Cell(65, 10, '___________________________________', 'R', 1, 'C');

        $this->Cell(130, 2, '', 'LR', 0, 'L');
        $this->Cell(65, 2, '', 'LR', 1, 'L');

        $this->SetFont('times', 'B', 10);

        $this->Cell(130, 4, 'OBSERVACIONES:', 'LR', 0, 'L');
        $this->Cell(65, 4, 'FIRMA DEL ASPIRANTE', 'LR', 1, 'C');

        $this->SetFont('times', '', 6);
        $this->Cell(130, 2, 'Espacio Reservado para la E.A.C.', 'LBR', 0);
        $this->Cell(65, 2, '', 'LBR', 1);

        $this->x = 0;
        for ($i = 0; $i < 22; $i++) {
            $this->Cell(5, 5, '', 'B', 0);
            $this->Cell(5, 5, '', 0, 0);
        }
        $this->Cell(195, 5, '', 0, 1);
        $this->Cell(195, 5, '', 0, 1);

        $this->Image(sfProjectConfiguration::guessRootDir() .'/web/images/logoEacSmall.png', 15, 216, 27);
        $this->x = $this->lMargin;
        $this->SetFont('times', 'B', 12);
        $this->Cell(20);
        $this->Cell(175, 5, 'DESPRENDIBLE DE INSCRIPCIÓN ESCUELA AERONÁUTICA DE COLOMBIA', 0, 1, 'C');
        $this->Cell(195, 2, '', 0, 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(45, 5, 'PRIMER APELLIDO', 'LTR', 0, 'L');
        $this->Cell(45, 5, 'SEGUNDO APELLIDO', 'TR', 0, 'L');
        $this->Cell(65, 5, 'NOMBRES', 'TR', 0, 'L');
        $this->Cell(40, 5, 'DOC. IDENTIDAD', 'TR', 1, 'L');

        $this->Cell(45, 2, '', 'LR', 0, 'L');
        $this->Cell(45, 2, '', 'R', 0, 'L');
        $this->Cell(65, 2, '', 'R', 0, 'L');
        $this->Cell(40, 2, '', 'R', 1, 'L');

        $this->SetFont('times', '', 10);
        $this->Cell(45, 5, $this->elemento->getPrimerApellido(), 'LR', 0, 'L');
        $this->Cell(45, 5, $this->elemento->getSegundoApellido(), 'R', 0, 'L');
        $this->Cell(65, 5, $this->elemento->getPrimerNombre().' '.$this->elemento->getSegundoNombre(), 'R', 0, 'L');
        $this->Cell(40, 5, $this->elemento->getDocumento(), 'R', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(100, 5, 'PROGRAMA', 'LTR', 0, 'L');
        $this->Cell(50, 5, 'FECHA ENTREVISTA', 'TR', 0, 'L');
        $this->Cell(45, 5, 'HORA ENTREVISTA', 'TR', 1, 'L');

        $this->Cell(100, 2, '', 'LR', 0, 'L');
        $this->SetFont('times', '', 6);
        $this->Cell(50, 2, 'Espacio Reservado para la E.A.C.', 'R', 0, 'L');
        $this->Cell(45, 2, 'Espacio Reservado para la E.A.C.', 'R', 1, 'L');

        $this->SetFont('times', '', 10);
        $this->Cell(100, 5, $this->elemento->getPeriodoAcademico()->getPensum()->getNombre(), 'BLR', 0, 'L');
        $this->Cell(50, 5, '', 'BR', 0, 'L');
        $this->Cell(45, 5, '', 'BR', 1, 'L');

        $this->Cell(120, 3, '', 'LTR', 0);
        $this->Cell(75, 3, '', 'LTR', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 5, '', 'LR', 0);
        $this->Cell(35, 5, 'INSCRIPCIÓN No.:', '', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(40, 5, $this->elemento->getNumero(), 'R', 1, 'L');

        $this->Cell(120, 5, '__________________________________________', 'LR', 0, 'C');
        $this->Cell(75, 5, '', 'R', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 5, 'FIRMA Y SELLO ADMISIONES E.A.C.', 'LBR', 0, 'C');
        $this->Cell(45, 5, 'FECHA DE INSCRIPCIÓN:', 'B', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(30, 5, date('d-m-Y',strtotime($this->elemento->getCreatedAt())), 'BR', 1, 'L');

    }

}

?>
