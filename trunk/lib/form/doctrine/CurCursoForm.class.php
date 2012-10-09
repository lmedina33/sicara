<?php

/**
 * CurCurso form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CurCursoForm extends BaseCurCursoForm {

    public function configure() {
        $this->setWidgets(array(
            'id_cur_curso' => new sfWidgetFormInputHidden(),
            'nombre' => new sfWidgetFormInputText(array(), array('class' => 'validate[required,maxSize[150]]')),
            'duracion' => new sfWidgetFormInputText(array('label' => 'Duración'), array('class' => 'validate[required,maxSize[50]]')),
            'horario' => new sfWidgetFormTextarea(array('label' => 'Horario de Clases')),
            'fecha_inicio' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Inicio',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-1:c+2',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly')),
            'fecha_fin' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Fin',
                'image' => '/images/iconos/calendar.png',
                'disabled' => 'true',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-1:c+2',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly')),
            'inicio_calificacion' => new sfWidgetFormJQueryDate(array(
                'label' => 'Inicio de Calificación',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-1:c+2',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly')),
            'fin_calificacion' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fin de Calificación',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'disabled' => 'true',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-1:c+2',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly')),
            'is_inscribible' => new sfWidgetFormChoice(array(
                'choices' => array('' => 'Seleccione ...','0' => 'No', '1' => 'Si'),
                'label' => 'Es Inscribible?'
            ),array('class' => 'validate[required]')),
            'id_cur_empresa' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CurEmpresa'), 'add_empty' => 'Seleccione...','label' => 'Empresa Asociada'),array('class' => 'validate[required]')),
            'codigo_profesor' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => 'Seleccione...', 'label' => 'Profesor Titular'),array('class' => 'validate[required]')),
        ));

        $this->setValidators(array(
            'id_cur_curso' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_curso')), 'empty_value' => $this->getObject()->get('id_cur_curso'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 150)),
            'duracion' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'horario' => new sfValidatorString(array('required' => false)),
            'fecha_inicio' => new sfValidatorDate(),
            'fecha_fin' => new sfValidatorDate(),
            'inicio_calificacion' => new sfValidatorDate(array('required' => false)),
            'fin_calificacion' => new sfValidatorDate(array('required' => false)),
            'is_inscribible' => new sfValidatorInteger(array('required' => false)),
            'id_cur_empresa' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CurEmpresa'))),
            'codigo_profesor' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('cur_curso[%s]');
    }

}
