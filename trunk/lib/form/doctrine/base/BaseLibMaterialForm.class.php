<?php

/**
 * LibMaterial form base class.
 *
 * @method LibMaterial getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLibMaterialForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_lib_material'  => new sfWidgetFormInputHidden(),
      'titulo'               => new sfWidgetFormInputText(),
      'sub_titulo'           => new sfWidgetFormInputText(),
      'autores'              => new sfWidgetFormTextarea(),
      'editorial'            => new sfWidgetFormInputText(),
      'fecha_publicacion'    => new sfWidgetFormDate(),
      'fecha_actualizacion'  => new sfWidgetFormDate(),
      'descripcion'          => new sfWidgetFormTextarea(),
      'temas'                => new sfWidgetFormTextarea(),
      'is_referencia'        => new sfWidgetFormInputText(),
      'is_solo_profesor'     => new sfWidgetFormInputText(),
      'is_prestado'          => new sfWidgetFormInputText(),
      'codigo_lib_categoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibCategoria'), 'add_empty' => false)),
      'id_lib_estado'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'), 'add_empty' => false)),
      'id_lib_tipo_material' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoMaterial'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'codigo_lib_material'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_lib_material')), 'empty_value' => $this->getObject()->get('codigo_lib_material'), 'required' => false)),
      'titulo'               => new sfValidatorString(array('max_length' => 45)),
      'sub_titulo'           => new sfValidatorString(array('max_length' => 45)),
      'autores'              => new sfValidatorString(),
      'editorial'            => new sfValidatorString(array('max_length' => 45)),
      'fecha_publicacion'    => new sfValidatorDate(),
      'fecha_actualizacion'  => new sfValidatorDate(array('required' => false)),
      'descripcion'          => new sfValidatorString(array('required' => false)),
      'temas'                => new sfValidatorString(),
      'is_referencia'        => new sfValidatorInteger(array('required' => false)),
      'is_solo_profesor'     => new sfValidatorInteger(array('required' => false)),
      'is_prestado'          => new sfValidatorInteger(array('required' => false)),
      'codigo_lib_categoria' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibCategoria'))),
      'id_lib_estado'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'))),
      'id_lib_tipo_material' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoMaterial'))),
    ));

    $this->widgetSchema->setNameFormat('lib_material[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibMaterial';
  }

}
