<?php

/**
 * Grupo form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GrupoForm extends BaseGrupoForm {

    public function configure() {
        $this->setWidgets(array(
            'id_grupo' => new sfWidgetFormInputHidden(),
            'nombre' => new sfWidgetFormInputText(array(),array('class'=>'validate[required]')),
            'id_periodo' => new sfWidgetFormDoctrineChoice(array('label'=>'Periodo','model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => false)),
            'certificacion_primaria' => new sfWidgetFormDoctrineChoice(array('label' => 'Certificación Primaria','model' => $this->getRelatedModelName('CertificacionDocente'), 'add_empty' => true)),
            'certificacion_secundaria' => new sfWidgetFormInputText(array('label' => 'Certificación Secundaria',)),
            'fecha_inicio' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Inicio',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: '-1:+1',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly')),
            'fecha_fin' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Finalización',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: '-1:+1',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly')),
            'observaciones' => new sfWidgetFormTextarea(),
            'codigo_asignatura' => new sfWidgetFormDoctrineChoice(array('label' => 'Asignatura','model' => $this->getRelatedModelName('Asignatura'), 'add_empty' => 'Seleccione...'),array('class'=>'validate[required]')),
            'codigo_profesor' => new sfWidgetFormDoctrineChoice(array('label' => 'Profesor','model' => $this->getRelatedModelName('Profesor'), 'add_empty' => 'Ninguno')),
            'inicio_calificacion' => new sfWidgetFormInputText(array('label' => 'Inicio de Calificación'),array('readonly' => 'readonly')),
//            'inicio_calificacion' => new sfWidgetFormJQueryDate(array(
//                'label' => 'Inicio de Calificación',
//                'image' => '/images/iconos/calendar.png',
//                'culture' => 'es',
//                'config' => "{
//                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
//                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
//                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
//                    buttonText: ['Ver Calendario...'],
//                    yearRange: '-1:+1',
//                    changeMonth: true,
//                    changeYear: true }",
//                'date_widget' => new sfWidgetFormInputText()
//                    ),
//                    array('readonly' => 'readonly')),
            'fin_calificacion' =>  new sfWidgetFormInputText(array('label' => 'Fin de Calificación'),array('readonly' => 'readonly')),
//            'fin_calificacion' => new sfWidgetFormJQueryDate(array(
//                'label' => 'Fin de Calificación',
//                'image' => '/images/iconos/calendar.png',
//                'culture' => 'es',
//                'config' => "{
//                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
//                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
//                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
//                    buttonText: ['Ver Calendario...'],
//                    yearRange: '-1:+1',
//                    changeMonth: true,
//                    changeYear: true }",
//                'date_widget' => new sfWidgetFormInputText()
//                    ),
//                    array('readonly' => 'readonly')),
        ));

        $this->setValidators(array(
            'id_grupo' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_grupo')), 'empty_value' => $this->getObject()->get('id_grupo'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 250)),
            'id_periodo' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'))),
            'certificacion_primaria' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CertificacionDocente'), 'required' => false)),
            'certificacion_secundaria' => new sfValidatorInteger(array('required' => false)),
            'fecha_inicio' => new sfValidatorDate(array('required' => false)),
            'fecha_fin' => new sfValidatorDate(array('required' => false)),
            'observaciones' => new sfValidatorString(array('required' => false)),
            'codigo_asignatura' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'))),
            'codigo_profesor' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'required' => false)),
            'inicio_calificacion' => new sfValidatorDateTime(array('required' => false)),
            'fin_calificacion' => new sfValidatorDateTime(array('required' => false)),
            
        ));

        $this->widgetSchema->setNameFormat('grupo[%s]');
    }

}
