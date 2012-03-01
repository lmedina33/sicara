<?php

/**
 * LibPrestamo form base class.
 *
 * @method LibPrestamo getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLibPrestamoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_prestamo'      => new sfWidgetFormInputHidden(),
      'id_prestamista'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'id_solicitante'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_3'), 'add_empty' => false)),
      'fecha_solicitud'  => new sfWidgetFormDateTime(),
      'fecha_entrega'    => new sfWidgetFormDateTime(),
      'fecha_retorno'    => new sfWidgetFormDateTime(),
      'fecha_devolucion' => new sfWidgetFormDateTime(),
      'observaciones'    => new sfWidgetFormTextarea(),
      'serial_lib_item'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibItem'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_prestamo'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_prestamo')), 'empty_value' => $this->getObject()->get('id_prestamo'), 'required' => false)),
      'id_prestamista'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'id_solicitante'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_3'))),
      'fecha_solicitud'  => new sfValidatorDateTime(),
      'fecha_entrega'    => new sfValidatorDateTime(array('required' => false)),
      'fecha_retorno'    => new sfValidatorDateTime(array('required' => false)),
      'fecha_devolucion' => new sfValidatorDateTime(array('required' => false)),
      'observaciones'    => new sfValidatorString(array('required' => false)),
      'serial_lib_item'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibItem'))),
    ));

    $this->widgetSchema->setNameFormat('lib_prestamo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibPrestamo';
  }

}
