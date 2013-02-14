<?php

/**
 * FormularioInscripcion form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FormularioInscripcionForm extends BaseFormularioInscripcionForm {
    private $isUpdate;
    
    public function __construct($object = null, $options = array(), $CSRFSecret = null, $isUpdate = true) {
        $this->isUpdate = $isUpdate;
        parent::__construct($object, $options, $CSRFSecret);
    }

    public function configure() {
        
        $widgets=array(
            'id_formulario_inscripcion' => new sfWidgetFormInputHidden(),
            'numero' => new sfWidgetFormInputHidden(),
            'codigo' => new sfWidgetFormInputHidden(),
            'primer_nombre' => new sfWidgetFormInputText(
                    array('label' => 'Primer Nombre'),
                    array('class' => 'validate[required,maxSize[45]]')),
            'segundo_nombre' => new sfWidgetFormInputText(
                    array('label' => 'Segundo Nombre'),
                    array('class' => 'validate[maxSize[45]]')),
            'primer_apellido' => new sfWidgetFormInputText(
                    array('label' => 'Primer Apellido'),
                    array('class' => 'validate[required,maxSize[45]]')),
            'segundo_apellido' => new sfWidgetFormInputText(
                    array('label' => 'Segundo Apellido'),
                    array('class' => 'validate[maxSize[45]]')),
            'documento' => new sfWidgetFormInputText(
                    array('label' => 'Documento de Identidad'),
                    array('class' => 'validate[required,custom[onlyNumberSp],maxSize[20]]')),
            'genero' => new sfWidgetFormChoice(array('choices' => array(0 => 'Femenino', 1 => 'Masculino'), 'label' => 'Género')),
            'id_tipo_sangre' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoSangre'), 'add_empty' => false, 'label' => 'Tipo de Sangre')),
            'id_tipo_documento' => new sfWidgetFormDoctrineChoice(array('label' => 'Tipo de Documento de Identidad','model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => 'Seleccione...'),
                    array('class' => 'validate[required]')),
            'lugar_expedicion' => new sfWidgetFormInputText(
                    array('label' => 'Lugar de Expedición'),
                    array('class' => 'validate[required,maxSize[200]]')),
            'lugar_nacimiento' => new sfWidgetFormInputText(
                    array('label' => 'Lugar de Nacimiento'),
                    array('class' => 'validate[required,maxSize[200]]')),
            'fecha_nacimiento' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Nacimiento',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    yearRange: '-100:-10',
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('class' => 'validate[required]','readonly' => 'readonly')),
            'libreta_militar' => new sfWidgetFormInputText(
                    array('label' => 'Libreta Militar'),
                    array('class' => 'validate[custom[onlyNumberSp],maxSize[25]]')),
            'foto_path' => new sfWidgetFormInputFile(array('label' => 'Foto')),
            'es_trabajador' => new sfWidgetFormChoice(array('label' => 'Trabaja Actualmente?','choices' => array('0' => 'No', '1' => 'Si'))),
            'telefono1' => new sfWidgetFormInputText(
                    array('label' => 'Teléfono Fijo'),
                    array('class' => 'validate[maxSize[25]]')),
            'telefono2' => new sfWidgetFormInputText(
                    array('label' => 'Teléfono Móvil'),
                    array('class' => 'validate[maxSize[25]]')),
            'direccion' => new sfWidgetFormInputText(
                    array('label' => 'Dirección de Residencia'),
                    array('class' => 'validate[required]')),
            'correo' => new sfWidgetFormInputText(
                    array('label' => 'Dirección de e-mail'),
                    array('class' => 'validate[custom[email],maxSize[50]]')),
            'conocio' => new sfWidgetFormInputText(
                    array('label' => 'Como conoció la Escuela?'),
                    array('class' => 'validate[maxSize[200]]')),
            'id_tipo_pago' => new sfWidgetFormDoctrineChoice(array('label' => 'Como Pagará su Matrícula?','model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => 'Seleccione...'),
                    array('class' => 'validate[required]')),
            'edu_basica_ano' => new sfWidgetFormInputText(
                    array('label' => 'Año'),
                    array('class' => 'validate[required,custom[onlyNumberSp],maxSize[4]]','size' => '6')),
            'edu_basica_institucion' => new sfWidgetFormInputText(
                    array('label' => 'Institución'),
                    array('class' => 'validate[required,maxSize[200]]','size' => '35')),
            'edu_basica_lugar' => new sfWidgetFormInputText(
                    array('label' => 'Lugar'),
                    array('class' => 'validate[required,maxSize[200]]')),
            'edu_media_en_curso' => new sfWidgetFormChoice(array('label' => 'Lo Cursa Actualmente?','choices' => array('0' => 'No', '1' => 'Si'))),
            'edu_media_ano' => new sfWidgetFormInputText(
                    array('label' => 'Año'),
                    array('class' => 'validate[required,custom[onlyNumberSp],maxSize[4]]','size' => '6')),
            'edu_media_institucion' => new sfWidgetFormInputText(
                    array('label' => 'Institución'),
                    array('class' => 'validate[required,maxSize[200]]','size' => '35')),
            'edu_media_titulo' => new sfWidgetFormInputText(
                    array('label' => 'Título Obtenido'),
                    array('class' => 'validate[required,maxSize[200]]')),
            'edu_media_lugar' => new sfWidgetFormInputText(
                    array('label' => 'Lugar'),
                    array('class' => 'validate[required,maxSize[200]]')),
            'edu_superior1_en_curso' => new sfWidgetFormChoice(array('label' => 'Lo Cursa Actualmente?','choices' => array('0' => 'No', '1' => 'Si'))),
            'edu_superior1_ano' => new sfWidgetFormInputText(
                    array('label' => 'Año'),
                    array('class' => 'validate[custom[onlyNumberSp],maxSize[4]]','size' => '6')),
            'edu_superior1_institucion' => new sfWidgetFormInputText(
                    array('label' => 'Institución'),
                    array('class' => 'validate[maxSize[200]]','size' => '35')),
            'edu_superior1_titulo' => new sfWidgetFormInputText(
                    array('label' => 'Título'),
                    array('class' => 'validate[maxSize[200]]')),
            'edu_superior1_lugar' => new sfWidgetFormInputText(
                    array('label' => 'Lugar'),
                    array('class' => 'validate[maxSize[200]]')),
            'edu_superior2_en_curso' => new sfWidgetFormChoice(array('label' => 'Lo Cursa Actualmente?','choices' => array('0' => 'No', '1' => 'Si'))),
            'edu_superior2_ano' => new sfWidgetFormInputText(
                    array('label' => 'Año'),
                    array('class' => 'validate[custom[onlyNumberSp],maxSize[4]]','size' => '6')),
            'edu_superior2_institucion' => new sfWidgetFormInputText(
                    array('label' => 'Institución'),
                    array('class' => 'validate[maxSize[200]]','size' => '35')),
            'edu_superior2_titulo' => new sfWidgetFormInputText(
                    array('label' => 'Título'),
                    array('class' => 'validate[maxSize[200]]')),
            'edu_superior2_lugar' => new sfWidgetFormInputText(
                    array('label' => 'Lugar'),
                    array('class' => 'validate[maxSize[200]]')),
            'edu_superior3_en_curso' => new sfWidgetFormChoice(array('label' => 'Lo Cursa Actualmente?','choices' => array('0' => 'No', '1' => 'Si'))),
            'edu_superior3_ano' => new sfWidgetFormInputText(
                    array('label' => 'Año'),
                    array('class' => 'validate[custom[onlyNumberSp],maxSize[4]]','size' => '6')),
            'edu_superior3_institucion' => new sfWidgetFormInputText(
                    array('label' => 'Institución'),
                    array('class' => 'validate[maxSize[200]]','size' => '35')),
            'edu_superior3_titulo' => new sfWidgetFormInputText(
                    array('label' => 'Título'),
                    array('class' => 'validate[maxSize[200]]')),
            'edu_superior3_lugar' => new sfWidgetFormInputText(
                    array('label' => 'Lugar'),
                    array('class' => 'validate[maxSize[200]]')),
            'codigo_pensum' => new sfWidgetFormInputHidden(),
            'id_periodo' => new sfWidgetFormDoctrineChoice(
                    array('label' => 'Programa al que Desea Matricularse','model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => 'Seleccione...', 'table_method' => 'getInscribibles'),
                    array('onChange' => 'changePensum()', 'class' => 'validate[required]')),
            'id_jornada' => new sfWidgetFormDoctrineChoice(array('label' => 'Jornada a la que Desea Matricularse','model' => $this->getRelatedModelName('Jornada'), 'add_empty' => 'Seleccione...', 'table_method' => 'getInscribibles'),
                    array('class' => 'validate[required]')));
        if($this->isUpdate){
            $widgets['captcha'] = new sfWidgetCaptchaGD(array('label' => 'Código de Confirmación'));
        }
        $this->setWidgets(
             $widgets
        );

        $validators = array(
            'id_formulario_inscripcion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_formulario_inscripcion')), 'empty_value' => $this->getObject()->get('id_formulario_inscripcion'), 'required' => false)),
            'numero' => new sfValidatorPass(),
            'codigo' => new sfValidatorPass(),
            'primer_nombre' => new sfValidatorString(array('max_length' => 45)),
            'segundo_nombre' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'primer_apellido' => new sfValidatorString(array('max_length' => 45)),
            'segundo_apellido' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'documento' => new sfValidatorString(array('max_length' => 20)),
            'id_tipo_documento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
            'lugar_expedicion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'lugar_nacimiento' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'fecha_nacimiento' => new sfValidatorDate(),
            'libreta_militar' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'foto_path' => new sfValidatorFile(array(
                'mime_types' => 'web_images',
                'max_size' => '512000',
                'required' => false
                ),array(
                    'max_size' => 'Este archivo es demasiado grande.'
                )),
            'es_trabajador' => new sfValidatorInteger(array('required' => false)),
            'telefono1' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'telefono2' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'direccion' => new sfValidatorString(array('required' => false)),
            'correo' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'conocio' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'id_tipo_pago' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'))),
            'edu_basica_ano' => new sfValidatorString(array('max_length' => 4)),
            'edu_basica_institucion' => new sfValidatorString(array('max_length' => 200)),
            'edu_basica_lugar' => new sfValidatorString(array('max_length' => 200)),
            'edu_media_en_curso' => new sfValidatorInteger(array('required' => false)),
            'edu_media_ano' => new sfValidatorString(array('max_length' => 4)),
            'edu_media_institucion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_media_titulo' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_media_lugar' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior1_en_curso' => new sfValidatorInteger(array('required' => false)),
            'edu_superior1_ano' => new sfValidatorString(array('max_length' => 4, 'required' => false)),
            'edu_superior1_institucion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior1_titulo' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior1_lugar' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior2_en_curso' => new sfValidatorInteger(array('required' => false)),
            'edu_superior2_ano' => new sfValidatorString(array('max_length' => 4, 'required' => false)),
            'edu_superior2_institucion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior2_titulo' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior2_lugar' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior3_en_curso' => new sfValidatorInteger(array('required' => false)),
            'edu_superior3_ano' => new sfValidatorString(array('max_length' => 4, 'required' => false)),
            'edu_superior3_institucion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior3_titulo' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'edu_superior3_lugar' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'codigo_pensum' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'))),
            'id_periodo' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'))),
            'genero' => new sfValidatorPass(),
            'id_tipo_sangre'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoSangre'), 'required' => false)),
            'id_jornada' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'))),);
        
        if($this->isUpdate){
            $validators['captcha']=new sfCaptchaGDValidator(array('length' => 4));
        }
        
        $this->setValidators(
             $validators
        );

        $this->widgetSchema->setNameFormat('formulario_inscripcion[%s]');
    }

}
