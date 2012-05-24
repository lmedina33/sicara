<?php

/**
 * RefTipoLugar form base class.
 *
 * @method RefTipoLugar getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefTipoLugarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_tipo_lugar' => new sfWidgetFormInputHidden(),
      'nombre'            => new sfWidgetFormInputText(),
      'descripcion'       => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_ref_tipo_lugar' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_tipo_lugar')), 'empty_value' => $this->getObject()->get('id_ref_tipo_lugar'), 'required' => false)),
      'nombre'            => new sfValidatorString(array('max_length' => 50)),
      'descripcion'       => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ref_tipo_lugar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefTipoLugar';
  }

}
