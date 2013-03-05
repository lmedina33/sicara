<?php

/**
 * TipoCertificacion form base class.
 *
 * @method TipoCertificacion getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTipoCertificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_tipo_certificacion' => new sfWidgetFormInputHidden(),
      'nombre'                => new sfWidgetFormInputText(),
      'descripcion'           => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_tipo_certificacion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_tipo_certificacion')), 'empty_value' => $this->getObject()->get('id_tipo_certificacion'), 'required' => false)),
      'nombre'                => new sfValidatorString(array('max_length' => 45)),
      'descripcion'           => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tipo_certificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TipoCertificacion';
  }

}
