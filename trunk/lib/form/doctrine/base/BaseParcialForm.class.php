<?php

/**
 * Parcial form base class.
 *
 * @method Parcial getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseParcialForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_parcial'            => new sfWidgetFormInputHidden(),
      'porcentaje'            => new sfWidgetFormInputText(),
      'calificacion'          => new sfWidgetFormInputText(),
      'id_asignatura_cursada' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AsignaturaCursada'), 'add_empty' => false)),
      'id_calificador'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_parcial'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_parcial')), 'empty_value' => $this->getObject()->get('id_parcial'), 'required' => false)),
      'porcentaje'            => new sfValidatorNumber(),
      'calificacion'          => new sfValidatorNumber(array('required' => false)),
      'id_asignatura_cursada' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AsignaturaCursada'))),
      'id_calificador'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
    ));

    $this->widgetSchema->setNameFormat('parcial[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parcial';
  }

}
