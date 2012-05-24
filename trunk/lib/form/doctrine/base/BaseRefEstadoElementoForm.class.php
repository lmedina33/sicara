<?php

/**
 * RefEstadoElemento form base class.
 *
 * @method RefEstadoElemento getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefEstadoElementoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_estado_elemento' => new sfWidgetFormInputHidden(),
      'nombre'                 => new sfWidgetFormInputText(),
      'descripcion'            => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_ref_estado_elemento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_estado_elemento')), 'empty_value' => $this->getObject()->get('id_ref_estado_elemento'), 'required' => false)),
      'nombre'                 => new sfValidatorString(array('max_length' => 50)),
      'descripcion'            => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ref_estado_elemento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefEstadoElemento';
  }

}
