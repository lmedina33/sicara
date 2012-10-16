<?php

/**
 * Notificacion form base class.
 *
 * @method Notificacion getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseNotificacionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_notificacion'    => new sfWidgetFormInputHidden(),
      'titulo'             => new sfWidgetFormInputText(),
      'contenido'          => new sfWidgetFormTextarea(),
      'permiso'            => new sfWidgetFormInputText(),
      'id_usuario'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'fecha_notificacion' => new sfWidgetFormDate(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_notificacion'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_notificacion')), 'empty_value' => $this->getObject()->get('id_notificacion'), 'required' => false)),
      'titulo'             => new sfValidatorString(array('max_length' => 150)),
      'contenido'          => new sfValidatorString(),
      'permiso'            => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'id_usuario'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'fecha_notificacion' => new sfValidatorDate(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('notificacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Notificacion';
  }

}
