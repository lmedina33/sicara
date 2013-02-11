<?php

/**
 * Estudiante form base class.
 *
 * @method Estudiante getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstudianteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'codigo_estudiante'    => new sfWidgetFormInputHidden(),
      'fecha_ingreso'        => new sfWidgetFormDate(),
      'fecha_retiro'         => new sfWidgetFormDate(),
      'id_estado'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoEstudiante'), 'add_empty' => true)),
      'id_estado_secundario' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoEstudianteSecundario'), 'add_empty' => true)),
      'id_usuario'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'codigo_pensum'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'codigo_estudiante'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_estudiante')), 'empty_value' => $this->getObject()->get('codigo_estudiante'), 'required' => false)),
      'fecha_ingreso'        => new sfValidatorDate(),
      'fecha_retiro'         => new sfValidatorDate(),
      'id_estado'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoEstudiante'), 'required' => false)),
      'id_estado_secundario' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoEstudianteSecundario'), 'required' => false)),
      'id_usuario'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'codigo_pensum'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'))),
    ));

    $this->widgetSchema->setNameFormat('estudiante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiante';
  }

}
