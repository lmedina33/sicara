<?php

/**
 * LibPrestamo filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLibPrestamoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_prestamista'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'id_solicitante'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_3'), 'add_empty' => true)),
      'fecha_solicitud'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_entrega'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_retorno'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_devolucion'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'observaciones'       => new sfWidgetFormFilterInput(),
      'codigo_lib_material' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibMaterial'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_prestamista'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
      'id_solicitante'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario_3'), 'column' => 'id_usuario')),
      'fecha_solicitud'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_entrega'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_retorno'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_devolucion'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'observaciones'       => new sfValidatorPass(array('required' => false)),
      'codigo_lib_material' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibMaterial'), 'column' => 'codigo_lib_material')),
    ));

    $this->widgetSchema->setNameFormat('lib_prestamo_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibPrestamo';
  }

  public function getFields()
  {
    return array(
      'id_prestamo'         => 'Number',
      'id_prestamista'      => 'ForeignKey',
      'id_solicitante'      => 'ForeignKey',
      'fecha_solicitud'     => 'Date',
      'fecha_entrega'       => 'Date',
      'fecha_retorno'       => 'Date',
      'fecha_devolucion'    => 'Date',
      'observaciones'       => 'Text',
      'codigo_lib_material' => 'ForeignKey',
    );
  }
}