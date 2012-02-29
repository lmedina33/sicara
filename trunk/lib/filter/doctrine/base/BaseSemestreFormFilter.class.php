<?php

/**
 * Semestre filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseSemestreFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'intensidad_horaria' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo_pensum'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'numero'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'intensidad_horaria' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'codigo_pensum'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pensum'), 'column' => 'codigo_pensum')),
    ));

    $this->widgetSchema->setNameFormat('semestre_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Semestre';
  }

  public function getFields()
  {
    return array(
      'id_semestre'        => 'Number',
      'numero'             => 'Number',
      'intensidad_horaria' => 'Number',
      'codigo_pensum'      => 'ForeignKey',
    );
  }
}
