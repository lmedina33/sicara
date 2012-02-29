<?php

/**
 * AsignaturaCursada filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsignaturaCursadaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nota_asignatura_cursada'              => new sfWidgetFormFilterInput(),
      'nota_habilitacion_asignatura_cursada' => new sfWidgetFormFilterInput(),
      'nota_nivelacion_asignatura_cursada'   => new sfWidgetFormFilterInput(),
      'is_homologacion'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'asistencia'                           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones'                        => new sfWidgetFormFilterInput(),
      'codigo_estudiante'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'), 'add_empty' => true)),
      'codigo_asignatura'                    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'), 'add_empty' => true)),
      'id_periodo'                           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => true)),
      'id_asignador'                         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nota_asignatura_cursada'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'nota_habilitacion_asignatura_cursada' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'nota_nivelacion_asignatura_cursada'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_homologacion'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'asistencia'                           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observaciones'                        => new sfValidatorPass(array('required' => false)),
      'codigo_estudiante'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estudiante'), 'column' => 'codigo_estudiante')),
      'codigo_asignatura'                    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Asignatura'), 'column' => 'codigo_asignatura')),
      'id_periodo'                           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PeriodoAcademico'), 'column' => 'id_periodo_academico')),
      'id_asignador'                         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
    ));

    $this->widgetSchema->setNameFormat('asignatura_cursada_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AsignaturaCursada';
  }

  public function getFields()
  {
    return array(
      'id_asignatura_cursada'                => 'Number',
      'nota_asignatura_cursada'              => 'Number',
      'nota_habilitacion_asignatura_cursada' => 'Number',
      'nota_nivelacion_asignatura_cursada'   => 'Number',
      'is_homologacion'                      => 'Number',
      'asistencia'                           => 'Number',
      'observaciones'                        => 'Text',
      'codigo_estudiante'                    => 'ForeignKey',
      'codigo_asignatura'                    => 'ForeignKey',
      'id_periodo'                           => 'ForeignKey',
      'id_asignador'                         => 'ForeignKey',
    );
  }
}
