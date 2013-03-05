<?php

/**
 * Inscrito filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseInscritoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_jornada'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'add_empty' => true)),
      'id_tipo_pago'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => true)),
      'id_periodo'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => true)),
      'id_usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'is_matriculado'    => new sfWidgetFormFilterInput(),
      'fecha_inscripcion' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'id_jornada'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Jornada'), 'column' => 'id_jornada')),
      'id_tipo_pago'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoPago'), 'column' => 'id_tipo_pago')),
      'id_periodo'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PeriodoAcademico'), 'column' => 'id_periodo_academico')),
      'id_usuario'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
      'is_matriculado'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fecha_inscripcion' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('inscrito_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inscrito';
  }

  public function getFields()
  {
    return array(
      'numero_formulario' => 'Text',
      'id_jornada'        => 'ForeignKey',
      'id_tipo_pago'      => 'ForeignKey',
      'id_periodo'        => 'ForeignKey',
      'id_usuario'        => 'ForeignKey',
      'is_matriculado'    => 'Number',
      'fecha_inscripcion' => 'Date',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
