<?php

class FormularioInscripcionPdf extends FPDF {

//    FormularioInscripcion $this->elemento=new FormularioInscripcion();


    function setElemento(FormularioInscripcion $elemento) {
        $this->elemento = $elemento;
    }

    function Header() {
        $this->Image(sfProjectConfiguration::guessRootDir() .'/web/images/logoEac.png', 13, 35, 55);
        $this->SetFont('times', '', 11);
        
        $this->Cell(45, 4, 'ESCUELA AERONÁUTICA DE COLOMBIA', '', 0, 'L');
        $this->Cell(145, 4, 'DIRECTIVAS DE INSTRUCCIÓN', '', 1, 'R');
        
        $this->Cell(45, 4, 'E.A.C.', '', 0, 'R');
        $this->Cell(145, 4, '', '', 1);
        
        $this->Cell(195, 1, '', 'B', 1);
        $this->Cell(195, 3, '', '', 1);
        
        $this->SetFont('times', '', 11);
        $this->Cell(195, 4, '2.1.1.2  Formato para Cursos Básicos', '', 1);
        $this->Cell(195, 3, '', '', 1);
        
        $this->SetFont('times', 'B', 11);

        $this->Cell(195, 1, '', 'LTR', 1);
        $this->Cell(70, 4, '', 'L', 0);
        $this->Cell(125, 4, 'ESCUELA AERONÁUTICA DE COLOMBIA', 'R', 1, 'L');

        $this->Cell(75, 4, '', 'L', 0);
        $this->SetFont('times', '', 10);
        $this->Cell(120, 4, 'CENTRO DE INSTRUCCIÓN AERONÁUTICA', 'R', 1, 'L');

        $this->SetFont('times', '', 8);
        $this->Cell(64, 3.5, '', 'L', 0);
        $this->Cell(131, 3.5, 'INSTITUCIÓN DE EDUCACIÓN PARA EL TRABAJO Y EL DESARROLLO HUMANO', 'R', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 4, '', 'L', 0);
        $this->Cell(35, 4, 'INSCRIPCIÓN No.: ', 'LT', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(40, 4, $this->elemento->getNumero() . '     ', 'TR', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 4, '', 'LB', 0);
        $this->Cell(45, 4, 'FECHA DE INSCRIPCIÓN: ', 'LB', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(30, 4, date('d-m-Y',strtotime($this->elemento->getUpdatedAt())), 'BR', 1);
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
        $this->SetMargins(10,15,5);   
	$this->SetAutoPageBreak(true,10);
	$this->AliasNbPages();
        $this->AddPage();
        
        
        $this->SetFont('times', 'B', 11);
        $this->Cell(195, 4, '', '', 1);
        $this->Cell(195, 4, 'INFORMACIÓN PERSONAL', '', 1, 'C');
        $this->Cell(195, 1, '', '', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(50, 4, 'PRIMER APELLIDO:', 'LTR', 0, 'L');
        $this->Cell(50, 4, 'SEGUNDO APELLIDO:', 'TR', 0, 'L');
        $this->Cell(60, 4, 'NOMBRES:', 'TR', 0, 'L');
        $this->Cell(35, 4, '', 'TR', 1);

        $this->Cell(50, 0, '', 'LR', 0);
        $this->Cell(50, 0, '', 'R', 0);
        $this->Cell(60, 0, '', 'R', 0);
        $this->Cell(35, 0, '', 'R', 1);

        $this->SetFont('times', '', 10);
        $this->Cell(50, 4, $this->elemento->getPrimerApellido(), 'LR', 0, 'L');
        $this->Cell(50, 4, $this->elemento->getSegundoApellido(), 'R', 0);
        $this->Cell(60, 4, $this->elemento->getPrimerNombre().' '.$this->elemento->getSegundoNombre(), 'R', 0);
        $this->Cell(35, 4, '', 'R', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(55, 4, 'DOCUMENTO DE IDENTIDAD:', 'LTR', 0, 'L');
        $this->Cell(60, 4, 'LUGAR Y FECHA DE', 'TR', 0, 'L');
        $this->Cell(45, 4, 'TRABAJA', 'TR', 0, 'L');
        $this->Cell(35, 4, '', 'R', 1);

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
            $this->Image($this->elemento->getFotoPath(), 172, 65, 30, 35);
        }else{
            $this->Cell(35, 4, 'FOTO RECIENTE', 'R', 1, 'C');
        }

        $this->Cell(55, 4, '', 'LR', 0);
        $this->Cell(60, 4, 'Municipio/Ciudad:', 'R', 0, 'L');
        $this->Cell(10, 4, 'Si:', 0, 0, 'L');
        $this->Cell(5, 3, ($this->elemento->getEsTrabajador() ? 'X' : ''), 'LTBR', 0);
        $this->Cell(30, 4, '', 'R', 0);
        $this->Cell(35, 4, '', 'R', 1);

        $this->Cell(15, 4, 'C.C.', 'L', 0);
        $this->Cell(5, 3, (($this->elemento->getIdTipoDocumento()=='2') ? 'X' : ''), 'LTBR', 0);
        $this->Cell(35, 4, '', 'R', 0);
        $this->SetFont('times', '', 10);
        $this->Cell(60, 4, $this->elemento->getLugarNacimiento(), 'R', 0);
        $this->SetFont('times', 'B', 10);
        $this->Cell(10, 4, 'No:', 0, 0, 'L');
        $this->Cell(5, 3, ($this->elemento->getEsTrabajador() ? '' : 'X'), 'LTBR', 0);
        $this->Cell(30, 4, '', 'R', 0);
        $this->Cell(35, 4, '', 'R', 1);

        $this->Cell(15, 4, 'T.I.', 'L', 0, 'L');
        $this->Cell(5, 3, (($this->elemento->getIdTipoDocumento()=='1') ? 'X' : ''), 'LTBR', 0);
        $this->Cell(35, 4, '', 'R', 0);
        $this->Cell(60, 4, 'Fecha: ', 'R', 0, 'L');
        $this->Cell(45, 4, 'LIBRETA MILITAR:', 'RT', 0, 'L');
        $this->Cell(35, 4, '', 'R', 1);

        $this->Cell(55, 4, '', 'LR', 0);
        $this->SetFont('times', '', 10);
        $this->Cell(60, 4, date('d-m-Y',strtotime($this->elemento->getFechaNacimiento())), 'R', 0);
        $this->SetFont('times', 'B', 10);
        $this->Cell(45, 4, '', 'R', 0);
        $this->Cell(35, 4, '', 'R', 1);

        $this->Cell(10, 4, 'Otro:', 'LB', 0, '');
        $this->SetFont('times', '', 10);
        $this->Cell(45, 4, ( ($this->elemento->getIdTipoDocumento()!='1' && $this->elemento->getIdTipoDocumento()!='2') ? $this->elemento->getTipoDocumento()->getNombre() : ''), 'RB', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(10, 4, '', 'B', 0, '');
        $this->SetFont('times', '', 10);
        $this->Cell(50, 4, '', 'BR', 0, 'L');
        $this->Cell(45, 4, $this->elemento->getLibretaMilitar(), 'BR', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(35, 4, '', 'BR', 1);

        $this->Cell(60, 4, 'TELEFONO / CELULAR:', 'L', 0, 'L');
        $this->Cell(70, 4, 'DIRECCIÓN:', 'L', 0, 'L');
        $this->Cell(65, 4, 'CORREO ELECTRÓNICO:', 'LR', 1, 'L');

        $this->Cell(60, 0, '', 'L', 0, 'L');
        $this->Cell(70, 0, '', 'L', 0, 'L');
        $this->Cell(65, 0, '', 'LR', 1, 'L');

        $this->SetFont('times', '', 10);
        $this->Cell(60, 4, $this->elemento->getTelefono1() . ' / ' . $this->elemento->getTelefono2(), 'LB', 0, 'L');
        $this->Cell(70, 4, $this->elemento->getDireccion(), 'LB', 0, 'L');
        $this->Cell(65, 4, $this->elemento->getCorreo(), 'LRB', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(195, 4, 'COMO SE ENTERÓ DE LA E.A.C.?', 'LR', 1);

        $this->SetFont('times', '', 10);
        $this->Cell(195, 4, $this->elemento->getConocio(), 'LRB', 1, 'l');

        $this->SetFont('times', 'B', 10);
        $this->Cell(195, 4, 'COMO CANCELARÁ USTED EL VALOR DE SU MATRÍCULA?', 'LR', 1, 'l');

        $this->Cell(195, 0, '', 'LR', 1);

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

        $this->SetFont('times', 'B', 11);
        $this->Cell(195, 4, '', '', 1);
        $this->Cell(195, 4, 'INFORMACIÓN ACADÉMICA', '', 1, 'C');
        $this->Cell(195, 1, '', '', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 4, 'ESTUDIO', 'LTB', 0, 'C');
        $this->SetFont('times', 'B', 6);
        $this->Cell(12, 4, 'EN CURSO', 'LTB', 0, 'C');
        $this->Cell(16, 4, 'AÑO FIN', 'LTB', 0, 'C');
        $this->SetFont('times', 'B', 10);
        $this->Cell(47, 4, 'TITULO RECIBIDO', 'LTB', 0, 'C');
        $this->Cell(56, 4, 'INSTITUCIÓN', 'LTB', 0, 'C');
        $this->Cell(39, 4, 'CIUDAD/MUNICIPIO', 'LTBR', 1, 'C');

        $this->Cell(25, 4, 'BASICA', 'LTB', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 4, '--', 'LTB', 0, 'C');
        $this->Cell(16, 4, $this->elemento->getEduBasicaAno(), 'LTB', 0, 'C');
        $this->Cell(47, 4, '--', 'LTB', 0, 'C');
        $this->Cell(56, 4, $this->elemento->getEduBasicaInstitucion(), 'LTB', 0, 'C');
        $this->Cell(39, 4, $this->elemento->getEduBasicaLugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 4, 'MEDIA', 'LTB', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 4, (($this->elemento->getEduMediaEnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 4, $this->elemento->getEduMediaAno(), 'LTB', 0, 'C');
        $this->Cell(47, 4, $this->elemento->getEduMediaTitulo(), 'LTB', 0, 'C');
        $this->Cell(56, 4, $this->elemento->getEduMediaInstitucion(), 'LTB', 0, 'C');
        $this->Cell(39, 4, $this->elemento->getEduMediaLugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 4, 'EDUCACIÓN', 'LT', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 4, (($this->elemento->getEduSuperior1EnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 4, $this->elemento->getEduSuperior1Ano(), 'LTB', 0, 'C');
        $this->Cell(47, 4, $this->elemento->getEduSuperior1Titulo(), 'LTB', 0, 'C');
        $this->Cell(56, 4, $this->elemento->getEduSuperior1Institucion(), 'LTB', 0, 'C');
        $this->Cell(39, 4, $this->elemento->getEduSuperior1Lugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 4, 'SUPERIOR', 'L', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 4, (($this->elemento->getEduSuperior2EnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 4, $this->elemento->getEduSuperior2Ano(), 'LTB', 0, 'C');
        $this->Cell(47, 4, $this->elemento->getEduSuperior2Titulo(), 'LTB', 0, 'C');
        $this->Cell(56, 4, $this->elemento->getEduSuperior2Institucion(), 'LTB', 0, 'C');
        $this->Cell(39, 4, $this->elemento->getEduSuperior2Lugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', '', 6);
        $this->Cell(25, 4, '(Técnico, Profesional, ...)', 'LB', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(12, 4, (($this->elemento->getEduSuperior3EnCurso() == '1') ? 'X':''), 'LTB', 0, 'C');
        $this->Cell(16, 4, $this->elemento->getEduSuperior3Ano(), 'LTB', 0, 'C');
        $this->Cell(47, 4, $this->elemento->getEduSuperior3Titulo(), 'LTB', 0, 'C');
        $this->Cell(56, 4, $this->elemento->getEduSuperior3Institucion(), 'LTB', 0, 'C');
        $this->Cell(39, 4, $this->elemento->getEduSuperior3Lugar(), 'LTBR', 1, 'C');

        $this->SetFont('times', 'B', 11);
        $this->Cell(195, 4, '', '', 1);
        $this->Cell(195, 4, 'INFORMACIÓN DE INSCRIPCIÓN', '', 1, 'C');
        $this->Cell(195, 1, '', '', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(25, 4, 'PROGRAMA:', 'LT', 0, 'L');
        $this->Cell(105, 4, '', 'TR', 0, 'L');
        $this->Cell(65, 4, '', 'LTR', 1, 'C');

        $this->SetFont('times', '', 10);
        $this->Cell(130, 4, $this->elemento->getPeriodoAcademico()->getPensum()->getNombre(), 'LBR', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(65, 4, '', 'LR', 1, 'C');

        $this->Cell(42, 7, 'PERIODO ACADÉMICO:', 'LB', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(15, 7, $this->elemento->getPeriodoAcademico()->getPeriodo(), 'B', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(10, 7, '', 'B', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(15, 7, '', 'B', 0, 'L');
        $this->SetFont('times', 'B', 10);
        $this->Cell(20, 7, 'JORNADA:', 'B', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(28, 7, $this->elemento->getJornada()->getNombre(), 'BR', 0, 'L');
        $this->Cell(65, 7, '___________________________________', 'R', 1, 'C');

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
        $this->Cell(195, 7, '', 0, 1);
        $this->Cell(195, 7, '', 0, 1);

        $this->Image(sfProjectConfiguration::guessRootDir() .'/web/images/logoEacSmall.png', 12, 204, 27);
        $this->x = $this->lMargin;
        $this->SetFont('times', 'B', 11);
        $this->Cell(20);
        $this->Cell(175, 5, 'DESPRENDIBLE DE INSCRIPCIÓN ESCUELA AERONÁUTICA DE COLOMBIA', 0, 1, 'C');
        $this->Cell(195, 1, '', 0, 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(45, 4, 'PRIMER APELLIDO', 'LTR', 0, 'L');
        $this->Cell(45, 4, 'SEGUNDO APELLIDO', 'TR', 0, 'L');
        $this->Cell(65, 4, 'NOMBRES', 'TR', 0, 'L');
        $this->Cell(40, 4, 'DOC. IDENTIDAD', 'TR', 1, 'L');

//        $this->Cell(45, 2, '', 'LR', 0, 'L');
//        $this->Cell(45, 2, '', 'R', 0, 'L');
//        $this->Cell(65, 2, '', 'R', 0, 'L');
//        $this->Cell(40, 2, '', 'R', 1, 'L');

        $this->SetFont('times', '', 10);
        $this->Cell(45, 4, $this->elemento->getPrimerApellido(), 'LR', 0, 'L');
        $this->Cell(45, 4, $this->elemento->getSegundoApellido(), 'R', 0, 'L');
        $this->Cell(65, 4, $this->elemento->getPrimerNombre().' '.$this->elemento->getSegundoNombre(), 'R', 0, 'L');
        $this->Cell(40, 4, $this->elemento->getDocumento(), 'R', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(100, 4, 'PROGRAMA', 'LTR', 0, 'L');
        $this->Cell(50, 4, 'FECHA ENTREVISTA', 'TR', 0, 'L');
        $this->Cell(45, 4, 'HORA ENTREVISTA', 'TR', 1, 'L');

        $this->Cell(100, 2, '', 'LR', 0, 'L');
        $this->SetFont('times', '', 6);
        $this->Cell(50, 2, 'Espacio Reservado para la E.A.C.', 'R', 0, 'L');
        $this->Cell(45, 2, 'Espacio Reservado para la E.A.C.', 'R', 1, 'L');

        $this->SetFont('times', '', 10);
        $this->Cell(100, 4, $this->elemento->getPeriodoAcademico()->getPensum()->getNombre(), 'BLR', 0, 'L');
        $this->Cell(50, 4, '', 'BR', 0, 'L');
        $this->Cell(45, 4, '', 'BR', 1, 'L');

        $this->Cell(120, 3, '', 'LTR', 0);
        $this->Cell(75, 3, '', 'LTR', 1);

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 4, '', 'LR', 0);
        $this->Cell(35, 4, 'INSCRIPCIÓN No.:', '', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(40, 4, $this->elemento->getNumero(), 'R', 1, 'L');

        $this->Cell(120, 4, '__________________________________________', 'LR', 0, 'C');
        $this->Cell(75, 4, '', 'R', 1, 'L');

        $this->SetFont('times', 'B', 10);
        $this->Cell(120, 4, 'FIRMA Y SELLO ADMISIONES E.A.C.', 'LBR', 0, 'C');
        $this->Cell(45, 4, 'FECHA DE INSCRIPCIÓN:', 'B', 0, 'L');
        $this->SetFont('times', '', 10);
        $this->Cell(30, 4, date('d-m-Y',strtotime($this->elemento->getCreatedAt())), 'BR', 1, 'L');
        
        $this->Cell(195, 7, '', 'B', 1);
        $this->Cell(195, 1, '', '', 1);
        $this->Cell(195, 4, 'Página C.7', '', 1, 'R');
        $this->Cell(195, 4, 'Revisión 001', '', 1, 'R');
        $this->Cell(195, 4, '01 de Septiembre de 2011', '', 1, 'R');

    }

}

?>
