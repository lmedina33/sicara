<?php

/**
 * FotoUsuario form base class.
 *
 * @method FotoUsuario getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFotoUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_foto_usuario' => new sfWidgetFormInputHidden(),
      'nombre'          => new sfWidgetFormInputText(),
      'tipo'            => new sfWidgetFormInputText(),
      'fecha'           => new sfWidgetFormDate(),
      'imagen'          => new sfWidgetFormTextarea(),
      'id_usuario'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_foto_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_foto_usuario')), 'empty_value' => $this->getObject()->get('id_foto_usuario'), 'required' => false)),
      'nombre'          => new sfValidatorString(array('max_length' => 30)),
      'tipo'            => new sfValidatorString(array('max_length' => 30)),
      'fecha'           => new sfValidatorDate(),
      'imagen'          => new sfValidatorString(),
      'id_usuario'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('foto_usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FotoUsuario';
  }

}
