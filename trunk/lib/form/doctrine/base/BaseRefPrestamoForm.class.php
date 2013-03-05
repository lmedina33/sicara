<?php

/**
 * RefPrestamo form base class.
 *
 * @method RefPrestamo getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefPrestamoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_prestamo'  => new sfWidgetFormInputHidden(),
      'id_prestamista'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'id_solicitante'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_3'), 'add_empty' => false)),
      'fecha_solicitud'  => new sfWidgetFormDateTime(),
      'fecha_entrega'    => new sfWidgetFormDateTime(),
      'fecha_retorno'    => new sfWidgetFormDateTime(),
      'fecha_devolucion' => new sfWidgetFormDateTime(),
      'observaciones'    => new sfWidgetFormTextarea(),
      'id_ref_elemento'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_ref_prestamo'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_prestamo')), 'empty_value' => $this->getObject()->get('id_ref_prestamo'), 'required' => false)),
      'id_prestamista'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'id_solicitante'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_3'))),
      'fecha_solicitud'  => new sfValidatorDateTime(),
      'fecha_entrega'    => new sfValidatorDateTime(array('required' => false)),
      'fecha_retorno'    => new sfValidatorDateTime(array('required' => false)),
      'fecha_devolucion' => new sfValidatorDateTime(array('required' => false)),
      'observaciones'    => new sfValidatorString(array('required' => false)),
      'id_ref_elemento'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ref_prestamo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefPrestamo';
  }

}
