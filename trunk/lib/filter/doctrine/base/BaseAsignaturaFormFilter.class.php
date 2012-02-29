<?php

/**
 * Asignatura filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAsignaturaFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'intensidad_horaria' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_practica'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_semestre'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Semestre'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'             => new sfValidatorPass(array('required' => false)),
      'intensidad_horaria' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_practica'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_semestre'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Semestre'), 'column' => 'id_semestre')),
    ));

    $this->widgetSchema->setNameFormat('asignatura_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asignatura';
  }

  public function getFields()
  {
    return array(
      'codigo_asignatura'  => 'Text',
      'nombre'             => 'Text',
      'intensidad_horaria' => 'Number',
      'is_practica'        => 'Number',
      'id_semestre'        => 'ForeignKey',
    );
  }
}
