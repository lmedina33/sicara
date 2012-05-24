<?php

/**
 * RefHojaVida form base class.
 *
 * @method RefHojaVida getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefHojaVidaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_hoja_vida'         => new sfWidgetFormInputHidden(),
      'descripcion'              => new sfWidgetFormTextarea(),
      'id_ref_elemento'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => false)),
      'created_by_sf_guard_user' => new sfWidgetFormInputText(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_ref_hoja_vida'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_hoja_vida')), 'empty_value' => $this->getObject()->get('id_ref_hoja_vida'), 'required' => false)),
      'descripcion'              => new sfValidatorString(array('required' => false)),
      'id_ref_elemento'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'))),
      'created_by_sf_guard_user' => new sfValidatorInteger(),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ref_hoja_vida[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefHojaVida';
  }

}
