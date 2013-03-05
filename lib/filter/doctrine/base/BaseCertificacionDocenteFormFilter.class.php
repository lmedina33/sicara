<?php

/**
 * CertificacionDocente filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCertificacionDocenteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numero'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_certificacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCertificacion'), 'add_empty' => true)),
      'codigo_profesor'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'titulo'                   => new sfValidatorPass(array('required' => false)),
      'numero'                   => new sfValidatorPass(array('required' => false)),
      'id_tipo_certificacion'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoCertificacion'), 'column' => 'id_tipo_certificacion')),
      'codigo_profesor'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesor'), 'column' => 'codigo_profesor')),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('certificacion_docente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CertificacionDocente';
  }

  public function getFields()
  {
    return array(
      'id_certificacion_docente' => 'Number',
      'titulo'                   => 'Text',
      'numero'                   => 'Text',
      'id_tipo_certificacion'    => 'ForeignKey',
      'codigo_profesor'          => 'ForeignKey',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
    );
  }
}
