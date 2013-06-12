<?php

/**
 * Homologacion filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseHomologacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_interna'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observaciones'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo_pensum_destino' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PensumDestino'), 'add_empty' => true)),
      'id_usuario'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'id_sf_guard_user'      => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'is_interna'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'observaciones'         => new sfValidatorPass(array('required' => false)),
      'codigo_pensum_destino' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PensumDestino'), 'column' => 'codigo_pensum')),
      'id_usuario'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
      'id_sf_guard_user'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('homologacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Homologacion';
  }

  public function getFields()
  {
    return array(
      'id_homologacion'       => 'Number',
      'is_interna'            => 'Number',
      'observaciones'         => 'Text',
      'codigo_pensum_destino' => 'ForeignKey',
      'id_usuario'            => 'ForeignKey',
      'id_sf_guard_user'      => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
