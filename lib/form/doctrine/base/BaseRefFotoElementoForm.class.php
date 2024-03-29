<?php

/**
 * RefFotoElemento form base class.
 *
 * @method RefFotoElemento getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefFotoElementoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_foto_elemento' => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(),
      'path'                 => new sfWidgetFormInputText(),
      'id_ref_elemento'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_ref_foto_elemento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_foto_elemento')), 'empty_value' => $this->getObject()->get('id_ref_foto_elemento'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'path'                 => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'id_ref_elemento'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ref_foto_elemento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefFotoElemento';
  }

}
