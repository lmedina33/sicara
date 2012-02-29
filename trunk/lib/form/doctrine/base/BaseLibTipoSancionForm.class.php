<?php

/**
 * LibTipoSancion form base class.
 *
 * @method LibTipoSancion getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLibTipoSancionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_lib_tipo_sancion' => new sfWidgetFormInputHidden(),
      'nombre'              => new sfWidgetFormInputText(),
      'descripcion'         => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_lib_tipo_sancion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_lib_tipo_sancion')), 'empty_value' => $this->getObject()->get('id_lib_tipo_sancion'), 'required' => false)),
      'nombre'              => new sfValidatorString(array('max_length' => 50)),
      'descripcion'         => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lib_tipo_sancion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibTipoSancion';
  }

}
