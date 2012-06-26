<?php

/**
 * RefFotoElemento filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRefFotoElementoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'               => new sfWidgetFormFilterInput(),
      'path'                 => new sfWidgetFormFilterInput(),
      'id_ref_elemento'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'path'                 => new sfValidatorPass(array('required' => false)),
      'id_ref_elemento'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefElemento'), 'column' => 'id_ref_elemento')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ref_foto_elemento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefFotoElemento';
  }

  public function getFields()
  {
    return array(
      'id_ref_foto_elemento' => 'Number',
      'nombre'               => 'Text',
      'path'                 => 'Text',
      'id_ref_elemento'      => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
