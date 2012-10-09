<?php

/**
 * RefMantenimiento filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRefMantenimientoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_programada'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_ejecutado'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_asignador'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignador'), 'add_empty' => true)),
      'id_ejecutor'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Ejecutor'), 'add_empty' => true)),
      'id_ref_elemento'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'descripcion'          => new sfValidatorPass(array('required' => false)),
      'fecha_programada'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'is_ejecutado'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_asignador'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Asignador'), 'column' => 'id_usuario')),
      'id_ejecutor'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Ejecutor'), 'column' => 'id_usuario')),
      'id_ref_elemento'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefElemento'), 'column' => 'id_ref_elemento')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ref_mantenimiento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefMantenimiento';
  }

  public function getFields()
  {
    return array(
      'id_ref_mantenimiento' => 'Number',
      'nombre'               => 'Text',
      'descripcion'          => 'Text',
      'fecha_programada'     => 'Date',
      'is_ejecutado'         => 'Number',
      'id_asignador'         => 'ForeignKey',
      'id_ejecutor'          => 'ForeignKey',
      'id_ref_elemento'      => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
