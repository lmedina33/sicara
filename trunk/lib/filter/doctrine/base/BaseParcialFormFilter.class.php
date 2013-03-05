<?php

/**
 * Parcial filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseParcialFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'porcentaje'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'calificacion'          => new sfWidgetFormFilterInput(),
      'id_asignatura_cursada' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AsignaturaCursada'), 'add_empty' => true)),
      'id_calificador'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'porcentaje'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'calificacion'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_asignatura_cursada' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AsignaturaCursada'), 'column' => 'id_asignatura_cursada')),
      'id_calificador'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('parcial_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Parcial';
  }

  public function getFields()
  {
    return array(
      'id_parcial'            => 'Number',
      'porcentaje'            => 'Number',
      'calificacion'          => 'Number',
      'id_asignatura_cursada' => 'ForeignKey',
      'id_calificador'        => 'ForeignKey',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
