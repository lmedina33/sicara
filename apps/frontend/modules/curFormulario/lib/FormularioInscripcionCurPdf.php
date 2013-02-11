<?php

class FormularioInscripcionCurPdf extends FPDF {

//    FormularioInscripcion $this->elemento=new FormularioInscripcion();


    function setElemento(CurFormulario $elemento) {
        $this->elemento = $elemento;
    }

    function Header() {
        
        $this->SetFont('times', '', 10);
        
        $this->Cell(100, 5, 'ESCUELA AERONÁUTICA DE COLOMBIA', 0, 0, 'L');
        $this->Cell(80, 5, 'DIRECTIVAS DE INSTRUCCIÓN', 0, 1, 'R');
        $this->Cell(70, 5, 'E.A.C.', 0, 1, 'C');
        
        $this->Cell(180, 3, '', 'T', 1, 'C');
        
        $this->Cell(15, 5, '2.', 0, 0, 'L');
        $this->Cell(70, 5, 'Formatos', 0, 1, 'L');
        $this->Cell(15, 5, '2.1.', 0, 0, 'L');
        $this->Cell(70, 5, 'Formatos para admisiones', 0, 1, 'L');
        $this->Cell(15, 5, '2.1.1', 0, 0, 'L');
        $this->Cell(70, 5, 'Formato de Inscripción', 0, 1, 'L');
        $this->Cell(15, 5, '2.1.1.1', 0, 0, 'L');
        $this->Cell(70, 5, 'Formato para Cursos Especiales y Recurrentes', 0, 1, 'L');
        
        $this->Cell(180, 3, '', 0, 1, 'C');
        
        $this->SetFont('times', 'B', 13);
        
        $this->SetFont('times', 'B', 12);
        $this->Cell(180, 5, 'FORMATO DE INSCRIPCIÓN', 0, 1, 'C');
        
    }    

    function generar() {
        $this->SetFont('Arial', '', 11);
        $this->SetMargins(20,20,20);   
	$this->SetAutoPageBreak(true,10);
	$this->AliasNbPages();
        $this->AddPage();
        
                
        $this->SetFont('times', '', 12);
        
//        Muestra Inforamción académica
        $this->Cell(180, 5, 'INFORMACIÓN ACADEMICA', 0, 1, 'C');
        $this->Cell(180, 2, '', 0, 1, 'C');
        
        $this->Cell(70, 2, '', 'LT', 0, 'L');
        $this->Cell(50, 2, '', 'LT', 0, 'L');
        $this->Cell(60, 2, '', 'LTR', 1, 'L');
        
        $this->SetFont('times', '', 11);
        $this->Cell(70, 5, 'CURSO:', 'L', 0, 'L');
        $this->Cell(50, 5, 'HORARIO:', 'L', 0, 'L');
        $this->Cell(60, 5, 'FECHA DE INICIACIÓN:', 'LR', 1, 'L');
        
        $this->Cell(70, 2, '', 'L', 0, 'L');
        $this->Cell(50, 2, '', 'L', 0, 'L');
        $this->Cell(60, 2, '', 'LR', 1, 'L');
        $this->Cell(70, 5, $this->elemento->getCurCurso()->getNombre(), 'L', 0, 'L');
        $this->Cell(50, 5, $this->elemento->getCurCurso()->getHorario(), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getCurCurso()->getFechaInicio(), 'LR', 1, 'L');
        
        $this->Cell(70, 2, '', 'L', 0, 'L');
        $this->Cell(50, 2, '', 'L', 0, 'L');
        $this->Cell(60, 2, '', 'LR', 1, 'L');
        $this->Cell(70, 5, '', 'L', 0, 'L');
        $this->Cell(50, 5, 'FECHA DE INSCRIPCIÓN:', 'L', 0, 'L');
        $this->Cell(60, 5, 'FECHA DE TERMINACIÓN:', 'LR', 1, 'L');
        
        $this->Cell(70, 2, '', 'L', 0, 'L');
        $this->Cell(50, 2, '', 'L', 0, 'L');
        $this->Cell(60, 2, '', 'LR', 1, 'L');
        $this->Cell(70, 5, '', 'L', 0, 'L');
        $this->Cell(50, 5, date('d-m-Y',strtotime($this->elemento->getCreatedAt())), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getCurCurso()->getFechaFin(), 'LR', 1, 'L');
        
        $this->Cell(70, 5, '', 'LB', 0, 'L');
        $this->Cell(50, 5, '', 'LB', 0, 'L');
        $this->Cell(60, 5, '', 'LRB', 1, 'L');
        
        $this->Cell(170, 5, '', 0, 1, 'C');
        
//        Muestra datos personales
        $this->Cell(180, 5, 'INFORMACIÓN ACADEMICA', 0, 1, 'C');
        $this->Cell(180, 2, '', 0, 1, 'C');
        
        $this->Cell(50, 2, '', 'LT', 0, 'L');
        $this->Cell(50, 2, '', 'LT', 0, 'L');
        $this->Cell(80, 2, '', 'LTR', 1, 'L');
        $this->Cell(50, 5, 'PRIMER APELLIDO:', 'L', 0, 'L');
        $this->Cell(50, 5, 'SEGUNDO APELLIDO:', 'L', 0, 'L');
        $this->Cell(80, 5, 'NOMBRE(S):', 'LR', 1, 'L');
        
        $this->Cell(50, 2, '', 'L', 0, 'L');
        $this->Cell(50, 2, '', 'L', 0, 'L');
        $this->Cell(80, 2, '', 'LR', 1, 'L');
        $this->Cell(50, 5, $this->elemento->getCurInscrito()->getPrimerApellido(), 'L', 0, 'L');
        $this->Cell(50, 5, $this->elemento->getCurInscrito()->getSegundoApellido(), 'L', 0, 'L');
        $this->Cell(80, 5, $this->elemento->getCurInscrito()->getPrimerNombre().' '.$this->elemento->getCurInscrito()->getSegundoNombre(), 'LR', 1, 'L');
        $this->Cell(50, 2, '', 'LB', 0, 'L');
        $this->Cell(50, 2, '', 'LB', 0, 'L');
        $this->Cell(80, 2, '', 'LRB', 1, 'L');
        
        $this->Cell(60, 2, '', 'L', 0, 'L');
        $this->Cell(60, 2, '', 'L', 0, 'L');
        $this->Cell(60, 2, '', 'LR', 1, 'L');
        $this->Cell(60, 5, 'DOCUMENTO DE IDENTIDAD:', 'L', 0, 'L');
        $this->Cell(60, 5, 'TELÉFONO FIJO:', 'L', 0, 'L');
        $this->Cell(60, 5, 'CELULAR:', 'LR', 1, 'L');
        
        $this->Cell(60, 5, $this->elemento->getCurInscrito()->getTipoDocumento(), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getCurInscrito()->getTelefono1(), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getCurInscrito()->getTelefono2(), 'LR', 1, 'L');
        
        $this->Cell(60, 5, 'No. '.$this->elemento->getCurInscrito()->getDocumento(), 'L', 0, 'L');
        $this->Cell(120, 5, 'CORREO ELECTRÓNICO:', 'LTR', 1, 'L');
        
        $this->Cell(60, 5, 'De: '.$this->elemento->getCurInscrito()->getLugarExpedicion(), 'LR', 0, 'L');
        $this->Cell(120, 5, $this->elemento->getCurInscrito()->getCorreo(), 'LR', 1, 'L');
        
        $this->Cell(60, 2, '', 'LB', 0, 'L');
        $this->Cell(120, 2, '', 'LRB', 1, 'L');
        
        $this->Cell(170, 5, '', 0, 1, 'C');
        
//        Información Laboral
        $this->Cell(180, 5, 'INFORMACIÓN LABORAL', 0, 1, 'C');
        $this->Cell(180, 2, '', 0, 1, 'C');
        
        $this->Cell(60, 2, '', 'LT', 0, 'L');
        $this->Cell(60, 2, '', 'LT', 0, 'L');
        $this->Cell(60, 2, '', 'LTR', 1, 'L');
        $this->Cell(60, 5, 'EMPRESA:', 'L', 0, 'L');
        $this->Cell(60, 5, 'DEPENDENCIA:', 'L', 0, 'L');
        $this->Cell(60, 5, 'TELÉFONO:', 'LR', 1, 'L');
        
        $this->Cell(60, 5, $this->elemento->getCurCurso()->getCurEmpresa(), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getDependencia(), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getTelefono(), 'LR', 1, 'L');
        $this->Cell(60, 2, '', 'LB', 0, 'L');
        $this->Cell(60, 2, '', 'LB', 0, 'L');
        $this->Cell(60, 2, '', 'LBR', 1, 'L');
        
        $this->Cell(60, 2, '', 'LT', 0, 'L');
        $this->Cell(60, 2, '', 'LT', 0, 'L');
        $this->Cell(60, 2, '', 'LTR', 1, 'L');
        $this->Cell(60, 5, 'DIRECCIÓN:', 'L', 0, 'L');
        $this->Cell(60, 5, 'CARGO:', 'L', 0, 'L');
        $this->Cell(60, 5, 'HORARIO:', 'LR', 1, 'L');
        
        $this->Cell(60, 5, $this->elemento->getDireccion(), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getCargo(), 'L', 0, 'L');
        $this->Cell(60, 5, $this->elemento->getHorario(), 'LR', 1, 'L');
        $this->Cell(60, 2, '', 'LB', 0, 'L');
        $this->Cell(60, 2, '', 'LB', 0, 'L');
        $this->Cell(60, 2, '', 'LBR', 1, 'L');
        
        $this->Cell(170, 5, '', 0, 1, 'C');
        
//        Muestra datos de licencias
        $this->Cell(180, 5, 'RELACIÓN DE LICENCIAS', 0, 1, 'C');
        $this->Cell(180, 2, '', 0, 1, 'C');

        $this->Cell(30, 2, '', 'LT', 0, 'L');
        $this->Cell(20, 2, '', 'LT', 0, 'L');
        $this->Cell(70, 2, '', 'LTR', 0, 'L');
        $this->Cell(30, 2, '', 'LTR', 0, 'L');
        $this->Cell(30, 2, '', 'LTR', 1, 'L');
        $this->Cell(30, 5, 'BÁSICA', 'L', 0, 'C');
        $this->Cell(20, 5, 'No', 'L', 0, 'C');
        $this->Cell(70, 5, 'HABLITACIÓN', 'LR', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(30, 5, 'FECHA DE', 'LR', 0, 'C');
        $this->Cell(30, 5, 'FECHA DE', 'LR', 1, 'C');
        
        $this->SetFont('times', '', 12);
        
        $this->Cell(30, 4, '', 'L', 0, 'C');
        $this->Cell(20, 4, '', 'L', 0, 'C');
        $this->Cell(70, 4, '', 'LR', 0, 'C');
        $this->SetFont('times', '', 10);
        $this->Cell(30, 4, 'EXPEDICIÓN', 'LR', 0, 'C');
        $this->Cell(30, 4, 'REPASO', 'LR', 1, 'C');
        $this->Cell(30, 2, '', 'LB', 0, 'L');
        $this->Cell(20, 2, '', 'LB', 0, 'L');
        $this->Cell(70, 2, '', 'LBR', 0, 'L');
        $this->Cell(30, 2, '', 'LBR', 0, 'L');
        $this->Cell(30, 2, '', 'LBR', 1, 'L');
        
        $this->SetFont('times', '', 10);
        
        $this->Cell(30, 5, $this->elemento->getLicenciaBasica1(), 'LB', 0, 'C');
        $this->Cell(20, 5, $this->elemento->getNumeroLicencia1(), 'LB', 0, 'C');
        $this->Cell(70, 5, $this->elemento->getHabilitacion1(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaExpedicion1(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaRepaso1(), 'LBR', 1, 'C');
        
        $this->Cell(30, 5, $this->elemento->getLicenciaBasica2(), 'LB', 0, 'C');
        $this->Cell(20, 5, $this->elemento->getNumeroLicencia2(), 'LB', 0, 'C');
        $this->Cell(70, 5, $this->elemento->getHabilitacion2(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaExpedicion2(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaRepaso2(), 'LBR', 1, 'C');
        
        $this->Cell(30, 5, $this->elemento->getLicenciaBasica3(), 'LB', 0, 'C');
        $this->Cell(20, 5, $this->elemento->getNumeroLicencia3(), 'LB', 0, 'C');
        $this->Cell(70, 5, $this->elemento->getHabilitacion3(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaExpedicion3(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaRepaso3(), 'LBR', 1, 'C');
        
        $this->Cell(30, 5, $this->elemento->getLicenciaBasica4(), 'LB', 0, 'C');
        $this->Cell(20, 5, $this->elemento->getNumeroLicencia4(), 'LB', 0, 'C');
        $this->Cell(70, 5, $this->elemento->getHabilitacion4(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaExpedicion4(), 'LBR', 0, 'C');
        $this->Cell(30, 5, $this->elemento->getFechaRepaso4(), 'LBR', 1, 'C');
        
//        Firma y cédula
        $this->Cell(170, 5, '', 0, 1, 'C');
        
        $this->Cell(15, 5, 'FIRMA:', 0, 0, 'C');
        $this->Cell(70, 5, '', 'B', 0, 'L');
        $this->Cell(50, 5, $this->elemento->getCurInscrito()->getTipoDocumento().': ', '', 0, 'R');
        $this->Cell(25, 5, $this->elemento->getCurInscrito()->getDocumento(), 'B', 1, 'L');
        
        $this->SetFont('times', '', 10);
        
        $this->Cell(180, 5, '', 'B', 1, 'L');
        $this->Cell(180, 5, 'Página C.6', 0, 1, 'R');
        $this->Cell(180, 5, 'Revisión 001', 0, 1, 'R');
        $this->Cell(180, 5, '01 de Septiembre de 2011', 0, 1, 'R');
    }

}

?>
