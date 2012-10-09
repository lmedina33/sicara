<?php

/**
 * RefMantenimiento form base class.
 *
 * @method RefMantenimiento getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefMantenimientoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_mantenimiento' => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(),
      'descripcion'          => new sfWidgetFormTextarea(),
      'fecha_programada'     => new sfWidgetFormDate(),
      'is_ejecutado'         => new sfWidgetFormInputText(),
      'id_asignador'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignador'), 'add_empty' => true)),
      'id_ejecutor'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ejecutor'), 'add_empty' => true)),
      'id_ref_elemento'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_ref_mantenimiento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_mantenimiento')), 'empty_value' => $this->getObject()->get('id_ref_mantenimiento'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 150)),
      'descripcion'          => new sfValidatorString(),
      'fecha_programada'     => new sfValidatorDate(),
      'is_ejecutado'         => new sfValidatorInteger(array('required' => false)),
      'id_asignador'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asignador'), 'required' => false)),
      'id_ejecutor'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Ejecutor'), 'required' => false)),
      'id_ref_elemento'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ref_mantenimiento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefMantenimiento';
  }

}
