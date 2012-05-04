<?php

/**
 * Grupo filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGrupoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_periodo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'certificacion_primaria'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CertificacionDocente'), 'add_empty' => true)),
      'certificacion_secundaria' => new sfWidgetFormFilterInput(),
      'fecha_inicio'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_fin'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'observaciones'            => new sfWidgetFormFilterInput(),
      'codigo_asignatura'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'), 'add_empty' => true)),
      'codigo_profesor'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
      'inicio_calificacion'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fin_calificacion'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'nombre'                   => new sfValidatorPass(array('required' => false)),
      'id_periodo'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'certificacion_primaria'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CertificacionDocente'), 'column' => 'id_certificacion_docente')),
      'certificacion_secundaria' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_inicio'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_fin'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'observaciones'            => new sfValidatorPass(array('required' => false)),
      'codigo_asignatura'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Asignatura'), 'column' => 'codigo_asignatura')),
      'codigo_profesor'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesor'), 'column' => 'codigo_profesor')),
      'inicio_calificacion'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fin_calificacion'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('grupo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grupo';
  }

  public function getFields()
  {
    return array(
      'id_grupo'                 => 'Number',
      'nombre'                   => 'Text',
      'id_periodo'               => 'Number',
      'certificacion_primaria'   => 'ForeignKey',
      'certificacion_secundaria' => 'Number',
      'fecha_inicio'             => 'Date',
      'fecha_fin'                => 'Date',
      'observaciones'            => 'Text',
      'codigo_asignatura'        => 'ForeignKey',
      'codigo_profesor'          => 'ForeignKey',
      'inicio_calificacion'      => 'Date',
      'fin_calificacion'         => 'Date',
    );
  }
}
