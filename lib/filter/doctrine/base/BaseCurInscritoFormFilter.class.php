<?php

/**
 * CurInscrito filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCurInscritoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'primer_nombre'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_nombre'    => new sfWidgetFormFilterInput(),
      'primer_apellido'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_apellido'  => new sfWidgetFormFilterInput(),
      'documento'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_documento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => true)),
      'lugar_expedicion'  => new sfWidgetFormFilterInput(),
      'telefono1'         => new sfWidgetFormFilterInput(),
      'telefono2'         => new sfWidgetFormFilterInput(),
      'correo'            => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'primer_nombre'     => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'    => new sfValidatorPass(array('required' => false)),
      'primer_apellido'   => new sfValidatorPass(array('required' => false)),
      'segundo_apellido'  => new sfValidatorPass(array('required' => false)),
      'documento'         => new sfValidatorPass(array('required' => false)),
      'id_tipo_documento' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoDocumento'), 'column' => 'id_tipo_documento')),
      'lugar_expedicion'  => new sfValidatorPass(array('required' => false)),
      'telefono1'         => new sfValidatorPass(array('required' => false)),
      'telefono2'         => new sfValidatorPass(array('required' => false)),
      'correo'            => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cur_inscrito_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurInscrito';
  }

  public function getFields()
  {
    return array(
      'id_cur_inscrito'   => 'Number',
      'primer_nombre'     => 'Text',
      'segundo_nombre'    => 'Text',
      'primer_apellido'   => 'Text',
      'segundo_apellido'  => 'Text',
      'documento'         => 'Text',
      'id_tipo_documento' => 'ForeignKey',
      'lugar_expedicion'  => 'Text',
      'telefono1'         => 'Text',
      'telefono2'         => 'Text',
      'correo'            => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
