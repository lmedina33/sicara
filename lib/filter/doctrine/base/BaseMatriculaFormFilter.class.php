<?php

/**
 * Matricula filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseMatriculaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'nombre_beneficiario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'documento'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_periodo'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => true)),
      'id_jornada'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'add_empty' => true)),
      'id_tipo_pago'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => true)),
      'codigo_estudiante'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Estudiante'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'fecha'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'nombre_beneficiario' => new sfValidatorPass(array('required' => false)),
      'documento'           => new sfValidatorPass(array('required' => false)),
      'telefono'            => new sfValidatorPass(array('required' => false)),
      'id_periodo'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PeriodoAcademico'), 'column' => 'id_periodo_academico')),
      'id_jornada'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Jornada'), 'column' => 'id_jornada')),
      'id_tipo_pago'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoPago'), 'column' => 'id_tipo_pago')),
      'codigo_estudiante'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Estudiante'), 'column' => 'codigo_estudiante')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('matricula_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Matricula';
  }

  public function getFields()
  {
    return array(
      'id_matricula'        => 'Number',
      'fecha'               => 'Date',
      'nombre_beneficiario' => 'Text',
      'documento'           => 'Text',
      'telefono'            => 'Text',
      'id_periodo'          => 'ForeignKey',
      'id_jornada'          => 'ForeignKey',
      'id_tipo_pago'        => 'ForeignKey',
      'codigo_estudiante'   => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
