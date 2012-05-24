<?php

/**
 * RefLugar form base class.
 *
 * @method RefLugar getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefLugarForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_lugar'            => new sfWidgetFormInputHidden(),
      'nombre'                  => new sfWidgetFormInputText(),
      'descripcion'             => new sfWidgetFormTextarea(),
      'capacidad_personas'      => new sfWidgetFormInputText(),
      'ubicacion'               => new sfWidgetFormTextarea(),
      'id_ref_lugar_contenedor' => new sfWidgetFormInputText(),
      'id_ref_tipo_lugar'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoLugar'), 'add_empty' => true)),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_ref_lugar'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_lugar')), 'empty_value' => $this->getObject()->get('id_ref_lugar'), 'required' => false)),
      'nombre'                  => new sfValidatorString(array('max_length' => 100)),
      'descripcion'             => new sfValidatorString(array('required' => false)),
      'capacidad_personas'      => new sfValidatorInteger(array('required' => false)),
      'ubicacion'               => new sfValidatorString(array('required' => false)),
      'id_ref_lugar_contenedor' => new sfValidatorInteger(array('required' => false)),
      'id_ref_tipo_lugar'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoLugar'), 'required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ref_lugar[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefLugar';
  }

}
