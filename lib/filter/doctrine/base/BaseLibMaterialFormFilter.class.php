<?php

/**
 * LibMaterial filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseLibMaterialFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sub_titulo'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'autores'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'editorial'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha_publicacion'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_actualizacion'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'descripcion'          => new sfWidgetFormFilterInput(),
      'temas'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_referencia'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_solo_profesor'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_prestado'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo_lib_categoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibCategoria'), 'add_empty' => true)),
      'id_lib_estado'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'), 'add_empty' => true)),
      'id_lib_tipo_material' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoMaterial'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'titulo'               => new sfValidatorPass(array('required' => false)),
      'sub_titulo'           => new sfValidatorPass(array('required' => false)),
      'autores'              => new sfValidatorPass(array('required' => false)),
      'editorial'            => new sfValidatorPass(array('required' => false)),
      'fecha_publicacion'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_actualizacion'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'descripcion'          => new sfValidatorPass(array('required' => false)),
      'temas'                => new sfValidatorPass(array('required' => false)),
      'is_referencia'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_solo_profesor'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_prestado'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codigo_lib_categoria' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibCategoria'), 'column' => 'codigo_lib_categoria')),
      'id_lib_estado'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibEstado'), 'column' => 'id_lib_estado')),
      'id_lib_tipo_material' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('LibTipoMaterial'), 'column' => 'id_lib_tipo_material')),
    ));

    $this->widgetSchema->setNameFormat('lib_material_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'LibMaterial';
  }

  public function getFields()
  {
    return array(
      'codigo_lib_material'  => 'Text',
      'titulo'               => 'Text',
      'sub_titulo'           => 'Text',
      'autores'              => 'Text',
      'editorial'            => 'Text',
      'fecha_publicacion'    => 'Date',
      'fecha_actualizacion'  => 'Date',
      'descripcion'          => 'Text',
      'temas'                => 'Text',
      'is_referencia'        => 'Number',
      'is_solo_profesor'     => 'Number',
      'is_prestado'          => 'Number',
      'codigo_lib_categoria' => 'ForeignKey',
      'id_lib_estado'        => 'ForeignKey',
      'id_lib_tipo_material' => 'ForeignKey',
    );
  }
}
