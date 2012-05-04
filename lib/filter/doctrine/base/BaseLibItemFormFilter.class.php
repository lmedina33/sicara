<?php

/**
 * LibItem filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLibItemFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion'         => new sfWidgetFormFilterInput(),
      'ubicacion'           => new sfWidgetFormFilterInput(),
      'fecha_actualizacion' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_prestado'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_lib_estado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'), 'add_empty' => true)),
      'id_lib_material'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibMaterial'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'descripcion'         => new sfValidatorPass(array('required' => false)),
      'ubicacion'           => new sfValidatorPass(array('required' => false)),
      'fecha_actualizacion' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'is_prestado'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_lib_estado'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibEstado'), 'column' => 'id_lib_estado')),
      'id_lib_material'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibMaterial'), 'column' => 'id_lib_material')),
    ));

    $this->widgetSchema->setNameFormat('lib_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibItem';
  }

  public function getFields()
  {
    return array(
      'serial_lib_item'     => 'Text',
      'descripcion'         => 'Text',
      'ubicacion'           => 'Text',
      'fecha_actualizacion' => 'Date',
      'is_prestado'         => 'Number',
      'id_lib_estado'       => 'ForeignKey',
      'id_lib_material'     => 'ForeignKey',
    );
  }
}
