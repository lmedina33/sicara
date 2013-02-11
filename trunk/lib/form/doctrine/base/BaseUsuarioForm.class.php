<?php

/**
 * Usuario form base class.
 *
 * @method Usuario getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsuarioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_usuario'               => new sfWidgetFormInputHidden(),
      'primer_nombre'            => new sfWidgetFormInputText(),
      'segundo_nombre'           => new sfWidgetFormInputText(),
      'primer_apellido'          => new sfWidgetFormInputText(),
      'segundo_apellido'         => new sfWidgetFormInputText(),
      'documento'                => new sfWidgetFormInputText(),
      'id_tipo_documento'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => false)),
      'lugar_expedicion'         => new sfWidgetFormInputText(),
      'fecha_nacimiento'         => new sfWidgetFormDate(),
      'genero'                   => new sfWidgetFormInputText(),
      'telefono1'                => new sfWidgetFormInputText(),
      'telefono2'                => new sfWidgetFormInputText(),
      'direccion'                => new sfWidgetFormTextarea(),
      'correo'                   => new sfWidgetFormInputText(),
      'acudiente1'               => new sfWidgetFormInputText(),
      'telefono_acudiente1'      => new sfWidgetFormInputText(),
      'acudiente2'               => new sfWidgetFormInputText(),
      'telefono_acudiente2'      => new sfWidgetFormInputText(),
      'especificaciones_medicas' => new sfWidgetFormTextarea(),
      'observaciones'            => new sfWidgetFormTextarea(),
      'foto_path'                => new sfWidgetFormInputText(),
      'id_sf_guard_user'         => new sfWidgetFormInputText(),
      'id_tipo_sangre'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoSangre'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_usuario'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
      'primer_nombre'            => new sfValidatorString(array('max_length' => 45)),
      'segundo_nombre'           => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'primer_apellido'          => new sfValidatorString(array('max_length' => 45)),
      'segundo_apellido'         => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'documento'                => new sfValidatorString(array('max_length' => 20)),
      'id_tipo_documento'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
      'lugar_expedicion'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'fecha_nacimiento'         => new sfValidatorDate(),
      'genero'                   => new sfValidatorInteger(array('required' => false)),
      'telefono1'                => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'telefono2'                => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'direccion'                => new sfValidatorString(array('required' => false)),
      'correo'                   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'acudiente1'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telefono_acudiente1'      => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'acudiente2'               => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telefono_acudiente2'      => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'especificaciones_medicas' => new sfValidatorString(array('required' => false)),
      'observaciones'            => new sfValidatorString(array('required' => false)),
      'foto_path'                => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'id_sf_guard_user'         => new sfValidatorInteger(array('required' => false)),
      'id_tipo_sangre'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoSangre'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

}
