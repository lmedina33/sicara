<?php

/**
 * Asignatura form base class.
 *
 * @method Asignatura getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsignaturaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_asignatura'  => new sfWidgetFormInputHidden(),
      'nombre'             => new sfWidgetFormInputText(),
      'intensidad_horaria' => new sfWidgetFormInputText(),
      'is_practica'        => new sfWidgetFormInputText(),
      'id_semestre'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'), 'add_empty' => false)),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'codigo_asignatura'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_asignatura')), 'empty_value' => $this->getObject()->get('codigo_asignatura'), 'required' => false)),
      'nombre'             => new sfValidatorString(array('max_length' => 250)),
      'intensidad_horaria' => new sfValidatorInteger(),
      'is_practica'        => new sfValidatorInteger(array('required' => false)),
      'id_semestre'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'))),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('asignatura[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asignatura';
  }

}
