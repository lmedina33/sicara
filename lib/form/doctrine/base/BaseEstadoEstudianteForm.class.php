<?php

/**
 * EstadoEstudiante form base class.
 *
 * @method EstadoEstudiante getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseEstadoEstudianteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_estado_estudiante' => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(),
      'is_primario'          => new sfWidgetFormInputText(),
      'descripcion'          => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id_estado_estudiante' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_estado_estudiante')), 'empty_value' => $this->getObject()->get('id_estado_estudiante'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 50)),
      'is_primario'          => new sfValidatorInteger(),
      'descripcion'          => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('estado_estudiante[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EstadoEstudiante';
  }

}
