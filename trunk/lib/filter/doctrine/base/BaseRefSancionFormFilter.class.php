<?php

/**
 * RefSancion filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRefSancionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'cantidad'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_ref_elemento'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
      'fecha_imposicion'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_inicio'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_fin'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'observaciones'       => new sfWidgetFormFilterInput(),
      'id_sancionado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario_2'), 'add_empty' => true)),
      'id_ejecutor'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'id_ref_tipo_sancion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoSancion'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'cantidad'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_ref_elemento'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefElemento'), 'column' => 'id_ref_elemento')),
      'fecha_imposicion'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_inicio'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'fecha_fin'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'observaciones'       => new sfValidatorPass(array('required' => false)),
      'id_sancionado'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario_2'), 'column' => 'id_usuario')),
      'id_ejecutor'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
      'id_ref_tipo_sancion' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefTipoSancion'), 'column' => 'id_ref_tipo_sancion')),
    ));

    $this->widgetSchema->setNameFormat('ref_sancion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefSancion';
  }

  public function getFields()
  {
    return array(
      'id_ref_sancion'      => 'Number',
      'cantidad'            => 'Number',
      'id_ref_elemento'     => 'ForeignKey',
      'fecha_imposicion'    => 'Date',
      'fecha_inicio'        => 'Date',
      'fecha_fin'           => 'Date',
      'observaciones'       => 'Text',
      'id_sancionado'       => 'ForeignKey',
      'id_ejecutor'         => 'ForeignKey',
      'id_ref_tipo_sancion' => 'ForeignKey',
    );
  }
}
