<?php

/**
 * TipoDocumento form base class.
 *
 * @method TipoDocumento getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoDocumentoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_tipo_documento' => new sfWidgetFormInputHidden(),
      'nombre'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_tipo_documento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_documento')), 'empty_value' => $this->getObject()->get('id_tipo_documento'), 'required' => false)),
      'nombre'            => new sfValidatorString(array('max_length' => 45)),
    ));

    $this->widgetSchema->setNameFormat('tipo_documento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoDocumento';
  }

}
