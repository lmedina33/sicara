<?php

/**
 * TipoSangre form base class.
 *
 * @method TipoSangre getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoSangreForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_tipo_sangre' => new sfWidgetFormInputHidden(),
      'nombre'         => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_tipo_sangre' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_sangre')), 'empty_value' => $this->getObject()->get('id_tipo_sangre'), 'required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 5)),
    ));

    $this->widgetSchema->setNameFormat('tipo_sangre[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoSangre';
  }

}
