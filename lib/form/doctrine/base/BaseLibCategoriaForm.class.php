<?php

/**
 * LibCategoria form base class.
 *
 * @method LibCategoria getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseLibCategoriaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_lib_categoria' => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(),
      'descripcion'          => new sfWidgetFormTextarea(),
      'dias_prestamo'        => new sfWidgetFormInputText(),
      'cantidad_sancion'     => new sfWidgetFormInputText(),
      'id_tipo_sancion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'codigo_lib_categoria' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_lib_categoria')), 'empty_value' => $this->getObject()->get('codigo_lib_categoria'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 100)),
      'descripcion'          => new sfValidatorString(array('required' => false)),
      'dias_prestamo'        => new sfValidatorInteger(array('required' => false)),
      'cantidad_sancion'     => new sfValidatorNumber(array('required' => false)),
      'id_tipo_sancion'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('lib_categoria[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibCategoria';
  }

}
