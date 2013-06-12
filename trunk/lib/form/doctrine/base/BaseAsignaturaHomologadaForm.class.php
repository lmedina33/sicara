<?php

/**
 * AsignaturaHomologada form base class.
 *
 * @method AsignaturaHomologada getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsignaturaHomologadaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_asignatura_homologada' => new sfWidgetFormInputHidden(),
      'nombre'                   => new sfWidgetFormInputText(),
      'calificacion'             => new sfWidgetFormInputText(),
      'nota_aprobatoria'         => new sfWidgetFormInputText(),
      'porcentaje'               => new sfWidgetFormInputText(),
      'codigo_asignatura'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'), 'add_empty' => true)),
      'institucion_origen'       => new sfWidgetFormInputText(),
      'programa_origen'          => new sfWidgetFormInputText(),
      'observaciones'            => new sfWidgetFormTextarea(),
      'is_oficializado'          => new sfWidgetFormInputText(),
      'id_homologacion'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Homologacion'), 'add_empty' => false)),
      'id_sf_guard_user'         => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_asignatura_homologada' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_asignatura_homologada')), 'empty_value' => $this->getObject()->get('id_asignatura_homologada'), 'required' => false)),
      'nombre'                   => new sfValidatorString(array('max_length' => 255)),
      'calificacion'             => new sfValidatorNumber(array('required' => false)),
      'nota_aprobatoria'         => new sfValidatorNumber(array('required' => false)),
      'porcentaje'               => new sfValidatorNumber(array('required' => false)),
      'codigo_asignatura'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'), 'required' => false)),
      'institucion_origen'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'programa_origen'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'observaciones'            => new sfValidatorString(),
      'is_oficializado'          => new sfValidatorInteger(array('required' => false)),
      'id_homologacion'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Homologacion'))),
      'id_sf_guard_user'         => new sfValidatorInteger(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('asignatura_homologada[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AsignaturaHomologada';
  }

}
