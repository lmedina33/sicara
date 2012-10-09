<?php

/**
 * CurFormulario form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CurFormularioForm extends BaseCurFormularioForm {

    public function configure() {
        $this->setWidgets(array(
            'id_cur_formulario' => new sfWidgetFormInputHidden(),
            'direccion' => new sfWidgetFormInputText(
                    array('label' => 'Dirección de la Empresa'),
                    array('class' => 'validate[required]')),
            'dependencia' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[required, maxSize[100]]')),
            'cargo' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[required, maxSize[100]]')),
            'telefono' => new sfWidgetFormInputText(
                    array('label' => 'Teléfono Empresarial'),
                    array('class' => 'validate[required, maxSize[45]]')),
            'horario' => new sfWidgetFormInputText(array('label' => 'Horario Laboral')),
            'licencia_basica1' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]')),
            'numero_licencia1' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[20]]', 'size' => '7')),
            'habilitacion1' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]', 'size' => '30')),
            'fecha_expedicion1' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Expedición',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'fecha_repaso1' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Repaso',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'licencia_basica2' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]')),
            'numero_licencia2' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[20]]', 'size' => '7')),
            'habilitacion2' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]', 'size' => '30')),
            'fecha_expedicion2' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Expedición',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'fecha_repaso2' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Repaso',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'licencia_basica3' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]')),
            'numero_licencia3' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[20]]', 'size' => '7')),
            'habilitacion3' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]', 'size' => '30')),
            'fecha_expedicion3' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Expedición',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'fecha_repaso3' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Repaso',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'licencia_basica4' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]')),
            'numero_licencia4' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[20]]', 'size' => '7')),
            'habilitacion4' => new sfWidgetFormInputText(
                    array(),
                    array('class' => 'validate[maxSize[45]]', 'size' => '30')),
            'fecha_expedicion4' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Expedición',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'fecha_repaso4' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Repaso',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: 'c-100:c-0',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('readonly' => 'readonly', 'size' => '10')),
            'id_cur_inscrito' => new sfWidgetFormInputHidden(),
            'id_cur_curso' => new sfWidgetFormInputHidden(),
            'captcha' => new sfWidgetCaptchaGD(array('label' => 'Código de Confirmación')),
        ));

        $this->setValidators(array(
            'id_cur_formulario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_formulario')), 'empty_value' => $this->getObject()->get('id_cur_formulario'), 'required' => false)),
            'direccion' => new sfValidatorString(),
            'dependencia' => new sfValidatorString(array('max_length' => 100)),
            'cargo' => new sfValidatorString(array('max_length' => 100)),
            'telefono' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'horario' => new sfValidatorString(array('required' => false)),
            'licencia_basica1' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'numero_licencia1' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'habilitacion1' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'fecha_expedicion1' => new sfValidatorDate(array('required' => false)),
            'fecha_repaso1' => new sfValidatorDate(array('required' => false)),
            'licencia_basica2' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'numero_licencia2' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'habilitacion2' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'fecha_expedicion2' => new sfValidatorDate(array('required' => false)),
            'fecha_repaso2' => new sfValidatorDate(array('required' => false)),
            'licencia_basica3' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'numero_licencia3' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'habilitacion3' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'fecha_expedicion3' => new sfValidatorDate(array('required' => false)),
            'fecha_repaso3' => new sfValidatorDate(array('required' => false)),
            'licencia_basica4' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'numero_licencia4' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'habilitacion4' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'fecha_expedicion4' => new sfValidatorDate(array('required' => false)),
            'fecha_repaso4' => new sfValidatorDate(array('required' => false)),
            'id_cur_inscrito' => new sfValidatorPass(),
//            'id_cur_inscrito' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_inscrito')), 'empty_value' => $this->getObject()->get('id_cur_inscrito'), 'required' => false)),
//            'id_cur_curso' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_curso')), 'empty_value' => $this->getObject()->get('id_cur_curso'), 'required' => false)),
            'id_cur_curso' => new sfValidatorPass(),
            'captcha' => new sfCaptchaGDValidator(array('length' => 4)),
        ));

        $this->widgetSchema->setNameFormat('cur_formulario[%s]');
    }

}
