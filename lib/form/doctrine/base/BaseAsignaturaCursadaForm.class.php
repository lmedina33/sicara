<?php

/**
 * AsignaturaCursada form base class.
 *
 * @method AsignaturaCursada getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAsignaturaCursadaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_asignatura_cursada'                => new sfWidgetFormInputHidden(),
      'nota_asignatura_cursada'              => new sfWidgetFormInputText(),
      'nota_habilitacion_asignatura_cursada' => new sfWidgetFormInputText(),
      'nota_nivelacion_asignatura_cursada'   => new sfWidgetFormInputText(),
      'is_homologacion'                      => new sfWidgetFormInputText(),
      'asistencia'                           => new sfWidgetFormInputText(),
      'observaciones'                        => new sfWidgetFormTextarea(),
      'codigo_estudiante'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'), 'add_empty' => false)),
      'codigo_asignatura'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'), 'add_empty' => false)),
      'nota_aprobatoria'                     => new sfWidgetFormInputText(),
      'is_aprobada'                          => new sfWidgetFormInputText(),
      'id_periodo'                           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => true)),
      'id_asignador'                         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'id_asignatura_homologada'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AsignaturaHomologada'), 'add_empty' => true)),
      'created_at'                           => new sfWidgetFormDateTime(),
      'updated_at'                           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_asignatura_cursada'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_asignatura_cursada')), 'empty_value' => $this->getObject()->get('id_asignatura_cursada'), 'required' => false)),
      'nota_asignatura_cursada'              => new sfValidatorNumber(array('required' => false)),
      'nota_habilitacion_asignatura_cursada' => new sfValidatorNumber(array('required' => false)),
      'nota_nivelacion_asignatura_cursada'   => new sfValidatorNumber(array('required' => false)),
      'is_homologacion'                      => new sfValidatorInteger(array('required' => false)),
      'asistencia'                           => new sfValidatorInteger(array('required' => false)),
      'observaciones'                        => new sfValidatorString(array('required' => false)),
      'codigo_estudiante'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'))),
      'codigo_asignatura'                    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'))),
      'nota_aprobatoria'                     => new sfValidatorNumber(array('required' => false)),
      'is_aprobada'                          => new sfValidatorInteger(array('required' => false)),
      'id_periodo'                           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'required' => false)),
      'id_asignador'                         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'required' => false)),
      'id_asignatura_homologada'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AsignaturaHomologada'), 'required' => false)),
      'created_at'                           => new sfValidatorDateTime(),
      'updated_at'                           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('asignatura_cursada[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AsignaturaCursada';
  }

}
