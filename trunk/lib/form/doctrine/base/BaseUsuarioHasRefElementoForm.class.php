<?php

/**
 * UsuarioHasRefElemento form base class.
 *
 * @method UsuarioHasRefElemento getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuarioHasRefElementoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'      => new sfWidgetFormInputHidden(),
      'id_ref_elemento' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id_usuario'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'id_ref_elemento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_elemento')), 'empty_value' => $this->getObject()->get('id_ref_elemento'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario_has_ref_elemento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsuarioHasRefElemento';
  }

}
