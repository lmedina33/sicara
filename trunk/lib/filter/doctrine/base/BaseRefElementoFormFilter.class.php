<?php

/**
 * RefElemento filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRefElementoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'serial'                 => new sfWidgetFormFilterInput(),
      'serial_interno'         => new sfWidgetFormFilterInput(),
      'nombre'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'marca'                  => new sfWidgetFormFilterInput(),
      'modelo'                 => new sfWidgetFormFilterInput(),
      'descripcion'            => new sfWidgetFormFilterInput(),
      'cantidad_sancion'       => new sfWidgetFormFilterInput(),
      'ubicacion'              => new sfWidgetFormFilterInput(),
      'is_prestable'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_ref_tipo_elemento'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoElemento'), 'add_empty' => true)),
      'id_ref_lugar'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefLugar'), 'add_empty' => true)),
      'id_ref_estado_elemento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefEstadoElemento'), 'add_empty' => true)),
      'id_ref_tipo_sancion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoSancion'), 'add_empty' => true)),
      'id_usuario_responsable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioResponsable'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'serial'                 => new sfValidatorPass(array('required' => false)),
      'serial_interno'         => new sfValidatorPass(array('required' => false)),
      'nombre'                 => new sfValidatorPass(array('required' => false)),
      'marca'                  => new sfValidatorPass(array('required' => false)),
      'modelo'                 => new sfValidatorPass(array('required' => false)),
      'descripcion'            => new sfValidatorPass(array('required' => false)),
      'cantidad_sancion'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'ubicacion'              => new sfValidatorPass(array('required' => false)),
      'is_prestable'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_ref_tipo_elemento'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefTipoElemento'), 'column' => 'id_ref_tipo_elemento')),
      'id_ref_lugar'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefLugar'), 'column' => 'id_ref_lugar')),
      'id_ref_estado_elemento' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefEstadoElemento'), 'column' => 'id_ref_estado_elemento')),
      'id_ref_tipo_sancion'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RefTipoSancion'), 'column' => 'id_ref_tipo_sancion')),
      'id_usuario_responsable' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UsuarioResponsable'), 'column' => 'id_usuario')),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('ref_elemento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefElemento';
  }

  public function getFields()
  {
    return array(
      'id_ref_elemento'        => 'Number',
      'serial'                 => 'Text',
      'serial_interno'         => 'Text',
      'nombre'                 => 'Text',
      'marca'                  => 'Text',
      'modelo'                 => 'Text',
      'descripcion'            => 'Text',
      'cantidad_sancion'       => 'Number',
      'ubicacion'              => 'Text',
      'is_prestable'           => 'Number',
      'id_ref_tipo_elemento'   => 'ForeignKey',
      'id_ref_lugar'           => 'ForeignKey',
      'id_ref_estado_elemento' => 'ForeignKey',
      'id_ref_tipo_sancion'    => 'ForeignKey',
      'id_usuario_responsable' => 'ForeignKey',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
