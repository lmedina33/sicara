<?php

/**
 * RefTipoElemento form base class.
 *
 * @method RefTipoElemento getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefTipoElementoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_tipo_elemento' => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(),
      'descripcion'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_ref_tipo_elemento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_tipo_elemento')), 'empty_value' => $this->getObject()->get('id_ref_tipo_elemento'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 50)),
      'descripcion'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ref_tipo_elemento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefTipoElemento';
  }

}
