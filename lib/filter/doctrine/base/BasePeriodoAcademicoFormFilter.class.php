<?php

/**
 * PeriodoAcademico filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePeriodoAcademicoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'periodo'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_inicio'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_fin'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'estado'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo_pensum'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => true)),
      'id_predecesor'        => new sfWidgetFormFilterInput(),
      'observacion'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'periodo'              => new sfValidatorPass(array('required' => false)),
      'fecha_inicio'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_fin'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'estado'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codigo_pensum'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pensum'), 'column' => 'codigo_pensum')),
      'id_predecesor'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observacion'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('periodo_academico_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PeriodoAcademico';
  }

  public function getFields()
  {
    return array(
      'id_periodo_academico' => 'Number',
      'periodo'              => 'Text',
      'fecha_inicio'         => 'Date',
      'fecha_fin'            => 'Date',
      'estado'               => 'Number',
      'codigo_pensum'        => 'ForeignKey',
      'id_predecesor'        => 'Number',
      'observacion'          => 'Text',
    );
  }
}
