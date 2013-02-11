<?php

/**
 * Estudiante filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEstudianteFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'fecha_ingreso'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_retiro'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'id_estado'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoEstudiante'), 'add_empty' => true)),
      'id_estado_secundario' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('EstadoEstudianteSecundario'), 'add_empty' => true)),
      'id_usuario'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
      'codigo_pensum'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'fecha_ingreso'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_retiro'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_estado'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadoEstudiante'), 'column' => 'id_estado_estudiante')),
      'id_estado_secundario' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('EstadoEstudianteSecundario'), 'column' => 'id_estado_estudiante')),
      'id_usuario'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
      'codigo_pensum'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pensum'), 'column' => 'codigo_pensum')),
    ));

    $this->widgetSchema->setNameFormat('estudiante_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Estudiante';
  }

  public function getFields()
  {
    return array(
      'codigo_estudiante'    => 'Text',
      'fecha_ingreso'        => 'Date',
      'fecha_retiro'         => 'Date',
      'id_estado'            => 'ForeignKey',
      'id_estado_secundario' => 'ForeignKey',
      'id_usuario'           => 'ForeignKey',
      'codigo_pensum'        => 'ForeignKey',
    );
  }
}
