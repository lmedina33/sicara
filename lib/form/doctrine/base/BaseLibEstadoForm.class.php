<?php

/**
 * LibEstado form base class.
 *
 * @method LibEstado getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLibEstadoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_lib_estado' => new sfWidgetFormInputHidden(),
      'nombre'        => new sfWidgetFormInputText(),
      'descripcion'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_lib_estado' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_lib_estado')), 'empty_value' => $this->getObject()->get('id_lib_estado'), 'required' => false)),
      'nombre'        => new sfValidatorString(array('max_length' => 45)),
      'descripcion'   => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lib_estado[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibEstado';
  }

}
