<?php

/**
 * RefLugar filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRefLugarFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'             => new sfWidgetFormFilterInput(),
      'capacidad_personas'      => new sfWidgetFormFilterInput(),
      'ubicacion'               => new sfWidgetFormFilterInput(),
      'id_ref_lugar_contenedor' => new sfWidgetFormFilterInput(),
      'id_ref_tipo_lugar'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoLugar'), 'add_empty' => true)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'                  => new sfValidatorPass(array('required' => false)),
      'descripcion'             => new sfValidatorPass(array('required' => false)),
      'capacidad_personas'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ubicacion'               => new sfValidatorPass(array('required' => false)),
      'id_ref_lugar_contenedor' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_ref_tipo_lugar'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefTipoLugar'), 'column' => 'id_ref_tipo_lugar')),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ref_lugar_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefLugar';
  }

  public function getFields()
  {
    return array(
      'id_ref_lugar'            => 'Number',
      'nombre'                  => 'Text',
      'descripcion'             => 'Text',
      'capacidad_personas'      => 'Number',
      'ubicacion'               => 'Text',
      'id_ref_lugar_contenedor' => 'Number',
      'id_ref_tipo_lugar'       => 'ForeignKey',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
    );
  }
}
