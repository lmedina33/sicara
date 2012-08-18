<?php

/**
 * Jornada form base class.
 *
 * @method Jornada getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseJornadaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_jornada'     => new sfWidgetFormInputHidden(),
      'nombre'         => new sfWidgetFormInputText(),
      'is_inscribible' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_jornada'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_jornada')), 'empty_value' => $this->getObject()->get('id_jornada'), 'required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 45)),
      'is_inscribible' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('jornada[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Jornada';
  }

}
