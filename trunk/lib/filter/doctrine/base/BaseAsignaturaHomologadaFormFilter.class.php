<?php

/**
 * AsignaturaHomologada filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsignaturaHomologadaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'calificacion'             => new sfWidgetFormFilterInput(),
      'nota_aprobatoria'         => new sfWidgetFormFilterInput(),
      'observaciones'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo_asignatura'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'), 'add_empty' => true)),
      'id_homologacion'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Homologacion'), 'add_empty' => true)),
      'id_sf_guard_user'         => new sfWidgetFormFilterInput(),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'                   => new sfValidatorPass(array('required' => false)),
      'calificacion'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'nota_aprobatoria'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observaciones'            => new sfValidatorPass(array('required' => false)),
      'codigo_asignatura'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Asignatura'), 'column' => 'codigo_asignatura')),
      'id_homologacion'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Homologacion'), 'column' => 'id_homologacion')),
      'id_sf_guard_user'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('asignatura_homologada_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'AsignaturaHomologada';
  }

  public function getFields()
  {
    return array(
      'id_asignatura_homologada' => 'Number',
      'nombre'                   => 'Text',
      'calificacion'             => 'Number',
      'nota_aprobatoria'         => 'Number',
      'observaciones'            => 'Text',
      'codigo_asignatura'        => 'ForeignKey',
      'id_homologacion'          => 'ForeignKey',
      'id_sf_guard_user'         => 'Number',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
    );
  }
}
