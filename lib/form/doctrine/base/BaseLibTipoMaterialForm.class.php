<?php

/**
 * LibTipoMaterial form base class.
 *
 * @method LibTipoMaterial getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLibTipoMaterialForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_lib_tipo_material' => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(),
      'descripcion'          => new sfWidgetFormTextarea(),
      'dias_prestamo'        => new sfWidgetFormInputText(),
      'cantidad_sancion'     => new sfWidgetFormInputText(),
      'id_lib_tipo_sancion'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_lib_tipo_material' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_lib_tipo_material')), 'empty_value' => $this->getObject()->get('id_lib_tipo_material'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 100)),
      'descripcion'          => new sfValidatorString(array('required' => false)),
      'dias_prestamo'        => new sfValidatorInteger(),
      'cantidad_sancion'     => new sfValidatorNumber(),
      'id_lib_tipo_sancion'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lib_tipo_material[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibTipoMaterial';
  }

}
