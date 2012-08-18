<?php

/**
 * FormularioInscripcion form base class.
 *
 * @method FormularioInscripcion getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFormularioInscripcionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_formulario_inscripcion' => new sfWidgetFormInputHidden(),
      'numero'                    => new sfWidgetFormInputText(),
      'codigo'                    => new sfWidgetFormInputText(),
      'primer_nombre'             => new sfWidgetFormInputText(),
      'segundo_nombre'            => new sfWidgetFormInputText(),
      'primer_apellido'           => new sfWidgetFormInputText(),
      'segundo_apellido'          => new sfWidgetFormInputText(),
      'documento'                 => new sfWidgetFormInputText(),
      'id_tipo_documento'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => false)),
      'lugar_expedicion'          => new sfWidgetFormInputText(),
      'lugar_nacimiento'          => new sfWidgetFormInputText(),
      'fecha_nacimiento'          => new sfWidgetFormDate(),
      'libreta_militar'           => new sfWidgetFormInputText(),
      'foto_path'                 => new sfWidgetFormInputText(),
      'es_trabajador'             => new sfWidgetFormInputText(),
      'telefono1'                 => new sfWidgetFormInputText(),
      'telefono2'                 => new sfWidgetFormInputText(),
      'direccion'                 => new sfWidgetFormTextarea(),
      'correo'                    => new sfWidgetFormInputText(),
      'conocio'                   => new sfWidgetFormInputText(),
      'id_tipo_pago'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => false)),
      'edu_basica_ano'            => new sfWidgetFormInputText(),
      'edu_basica_institucion'    => new sfWidgetFormInputText(),
      'edu_basica_lugar'          => new sfWidgetFormInputText(),
      'edu_media_en_curso'        => new sfWidgetFormInputText(),
      'edu_media_ano'             => new sfWidgetFormInputText(),
      'edu_media_institucion'     => new sfWidgetFormInputText(),
      'edu_media_titulo'          => new sfWidgetFormInputText(),
      'edu_media_lugar'           => new sfWidgetFormInputText(),
      'edu_superior1_en_curso'    => new sfWidgetFormInputText(),
      'edu_superior1_ano'         => new sfWidgetFormInputText(),
      'edu_superior1_institucion' => new sfWidgetFormInputText(),
      'edu_superior1_titulo'      => new sfWidgetFormInputText(),
      'edu_superior1_lugar'       => new sfWidgetFormInputText(),
      'edu_superior2_en_curso'    => new sfWidgetFormInputText(),
      'edu_superior2_ano'         => new sfWidgetFormInputText(),
      'edu_superior2_institucion' => new sfWidgetFormInputText(),
      'edu_superior2_titulo'      => new sfWidgetFormInputText(),
      'edu_superior2_lugar'       => new sfWidgetFormInputText(),
      'edu_superior3_en_curso'    => new sfWidgetFormInputText(),
      'edu_superior3_ano'         => new sfWidgetFormInputText(),
      'edu_superior3_institucion' => new sfWidgetFormInputText(),
      'edu_superior3_titulo'      => new sfWidgetFormInputText(),
      'edu_superior3_lugar'       => new sfWidgetFormInputText(),
      'codigo_pensum'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => false)),
      'id_periodo'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => false)),
      'id_jornada'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'add_empty' => false)),
      'is_cerrado'                => new sfWidgetFormInputText(),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_formulario_inscripcion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_formulario_inscripcion')), 'empty_value' => $this->getObject()->get('id_formulario_inscripcion'), 'required' => false)),
      'numero'                    => new sfValidatorString(array('max_length' => 10)),
      'codigo'                    => new sfValidatorString(array('max_length' => 10)),
      'primer_nombre'             => new sfValidatorString(array('max_length' => 45)),
      'segundo_nombre'            => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'primer_apellido'           => new sfValidatorString(array('max_length' => 45)),
      'segundo_apellido'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'documento'                 => new sfValidatorString(array('max_length' => 20)),
      'id_tipo_documento'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
      'lugar_expedicion'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'lugar_nacimiento'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'fecha_nacimiento'          => new sfValidatorDate(),
      'libreta_militar'           => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'foto_path'                 => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'es_trabajador'             => new sfValidatorInteger(array('required' => false)),
      'telefono1'                 => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'telefono2'                 => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'direccion'                 => new sfValidatorString(array('required' => false)),
      'correo'                    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'conocio'                   => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'id_tipo_pago'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'))),
      'edu_basica_ano'            => new sfValidatorString(array('max_length' => 4)),
      'edu_basica_institucion'    => new sfValidatorString(array('max_length' => 200)),
      'edu_basica_lugar'          => new sfValidatorString(array('max_length' => 200)),
      'edu_media_en_curso'        => new sfValidatorInteger(array('required' => false)),
      'edu_media_ano'             => new sfValidatorString(array('max_length' => 4)),
      'edu_media_institucion'     => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_media_titulo'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_media_lugar'           => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior1_en_curso'    => new sfValidatorInteger(array('required' => false)),
      'edu_superior1_ano'         => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'edu_superior1_institucion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior1_titulo'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior1_lugar'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior2_en_curso'    => new sfValidatorInteger(array('required' => false)),
      'edu_superior2_ano'         => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'edu_superior2_institucion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior2_titulo'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior2_lugar'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior3_en_curso'    => new sfValidatorInteger(array('required' => false)),
      'edu_superior3_ano'         => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'edu_superior3_institucion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior3_titulo'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'edu_superior3_lugar'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'codigo_pensum'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'))),
      'id_periodo'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'))),
      'id_jornada'                => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'))),
      'is_cerrado'                => new sfValidatorInteger(array('required' => false)),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('formulario_inscripcion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FormularioInscripcion';
  }

}
