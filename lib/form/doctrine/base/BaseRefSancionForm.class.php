<?php

/**
 * RefSancion form base class.
 *
 * @method RefSancion getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefSancionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_sancion'      => new sfWidgetFormInputHidden(),
      'cantidad'            => new sfWidgetFormInputText(),
      'id_ref_elemento'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
      'fecha_imposicion'    => new sfWidgetFormDateTime(),
      'fecha_inicio'        => new sfWidgetFormDateTime(),
      'fecha_fin'           => new sfWidgetFormDateTime(),
      'observaciones'       => new sfWidgetFormTextarea(),
      'id_sancionado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_2'), 'add_empty' => false)),
      'id_ejecutor'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'id_ref_tipo_sancion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoSancion'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_ref_sancion'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_sancion')), 'empty_value' => $this->getObject()->get('id_ref_sancion'), 'required' => false)),
      'cantidad'            => new sfValidatorNumber(),
      'id_ref_elemento'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'required' => false)),
      'fecha_imposicion'    => new sfValidatorDateTime(),
      'fecha_inicio'        => new sfValidatorDateTime(),
      'fecha_fin'           => new sfValidatorDateTime(),
      'observaciones'       => new sfValidatorString(array('required' => false)),
      'id_sancionado'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_2'))),
      'id_ejecutor'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'id_ref_tipo_sancion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoSancion'))),
    ));

    $this->widgetSchema->setNameFormat('ref_sancion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefSancion';
  }

}
