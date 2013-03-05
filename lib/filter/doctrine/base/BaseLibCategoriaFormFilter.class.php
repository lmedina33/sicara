<?php

/**
 * LibCategoria filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLibCategoriaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'          => new sfWidgetFormFilterInput(),
      'dias_prestamo'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cantidad_sancion'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_sancion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'add_empty' => true)),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'descripcion'          => new sfValidatorPass(array('required' => false)),
      'dias_prestamo'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cantidad_sancion'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'id_tipo_sancion'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibTipoSancion'), 'column' => 'id_lib_tipo_sancion')),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('lib_categoria_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibCategoria';
  }

  public function getFields()
  {
    return array(
      'codigo_lib_categoria' => 'Text',
      'nombre'               => 'Text',
      'descripcion'          => 'Text',
      'dias_prestamo'        => 'Number',
      'cantidad_sancion'     => 'Number',
      'id_tipo_sancion'      => 'ForeignKey',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
    );
  }
}
