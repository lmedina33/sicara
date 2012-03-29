<?php

/**
 * LibItem form base class.
 *
 * @method LibItem getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLibItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'serial_lib_item'     => new sfWidgetFormInputHidden(),
      'descripcion'         => new sfWidgetFormTextarea(),
      'fecha_actualizacion' => new sfWidgetFormDate(),
      'is_prestado'         => new sfWidgetFormInputText(),
      'id_lib_estado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'), 'add_empty' => false)),
      'codigo_lib_material' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibMaterial'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'serial_lib_item'     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('serial_lib_item')), 'empty_value' => $this->getObject()->get('serial_lib_item'), 'required' => false)),
      'descripcion'         => new sfValidatorString(array('required' => false)),
      'fecha_actualizacion' => new sfValidatorDate(array('required' => false)),
      'is_prestado'         => new sfValidatorInteger(),
      'id_lib_estado'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'))),
      'codigo_lib_material' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibMaterial'))),
    ));

    $this->widgetSchema->setNameFormat('lib_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibItem';
  }

}
