<?php

/**
 * Pensum form base class.
 *
 * @method Pensum getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePensumForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_pensum'    => new sfWidgetFormInputHidden(),
      'nombre'           => new sfWidgetFormInputText(),
      'nota_aprobatoria' => new sfWidgetFormInputText(),
      'is_inscribible'   => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'codigo_pensum'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_pensum')), 'empty_value' => $this->getObject()->get('codigo_pensum'), 'required' => false)),
      'nombre'           => new sfValidatorString(array('max_length' => 250)),
      'nota_aprobatoria' => new sfValidatorNumber(array('required' => false)),
      'is_inscribible'   => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('pensum[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pensum';
  }

}
