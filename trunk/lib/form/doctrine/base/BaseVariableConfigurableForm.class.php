<?php

/**
 * VariableConfigurable form base class.
 *
 * @method VariableConfigurable getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseVariableConfigurableForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_variable_configurable' => new sfWidgetFormInputHidden(),
      'nombre'                   => new sfWidgetFormInputText(),
      'valor'                    => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_variable_configurable' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_variable_configurable')), 'empty_value' => $this->getObject()->get('id_variable_configurable'), 'required' => false)),
      'nombre'                   => new sfValidatorString(array('max_length' => 150)),
      'valor'                    => new sfValidatorString(array('max_length' => 150)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('variable_configurable[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'VariableConfigurable';
  }

}
