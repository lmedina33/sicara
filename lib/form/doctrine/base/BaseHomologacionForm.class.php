<?php

/**
 * Homologacion form base class.
 *
 * @method Homologacion getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHomologacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_homologacion'       => new sfWidgetFormInputHidden(),
      'is_interna'            => new sfWidgetFormInputText(),
      'observaciones'         => new sfWidgetFormTextarea(),
      'codigo_pensum_destino' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PensumDestino'), 'add_empty' => false)),
      'id_usuario'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'id_sf_guard_user'      => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_homologacion'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_homologacion')), 'empty_value' => $this->getObject()->get('id_homologacion'), 'required' => false)),
      'is_interna'            => new sfValidatorInteger(array('required' => false)),
      'observaciones'         => new sfValidatorString(),
      'codigo_pensum_destino' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PensumDestino'))),
      'id_usuario'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'id_sf_guard_user'      => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('homologacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Homologacion';
  }

}
