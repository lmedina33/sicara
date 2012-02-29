<?php

/**
 * Matricula form base class.
 *
 * @method Matricula getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseMatriculaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_matricula'      => new sfWidgetFormInputHidden(),
      'fecha'             => new sfWidgetFormDate(),
      'id_periodo'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => false)),
      'id_jornada'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'add_empty' => true)),
      'id_tipo_pago'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => true)),
      'codigo_estudiante' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'), 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id_matricula'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_matricula')), 'empty_value' => $this->getObject()->get('id_matricula'), 'required' => false)),
      'fecha'             => new sfValidatorDate(),
      'id_periodo'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'))),
      'id_jornada'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'required' => false)),
      'id_tipo_pago'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'required' => false)),
      'codigo_estudiante' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'))),
    ));

    $this->widgetSchema->setNameFormat('matricula[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Matricula';
  }

}
