<?php

/**
 * Profesor form base class.
 *
 * @method Profesor getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseProfesorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_profesor' => new sfWidgetFormInputHidden(),
      'fecha_ingreso'   => new sfWidgetFormDate(),
      'fecha_retiro'    => new sfWidgetFormDate(),
      'id_usuario'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'codigo_profesor' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_profesor')), 'empty_value' => $this->getObject()->get('codigo_profesor'), 'required' => false)),
      'fecha_ingreso'   => new sfValidatorDate(array('required' => false)),
      'fecha_retiro'    => new sfValidatorDate(array('required' => false)),
      'id_usuario'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('profesor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profesor';
  }

}
