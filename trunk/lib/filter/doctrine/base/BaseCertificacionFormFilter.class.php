<?php

/**
 * Certificacion filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCertificacionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numero'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_certificacion' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCertificacion'), 'add_empty' => true)),
      'codigo_profesor'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'titulo'                => new sfValidatorPass(array('required' => false)),
      'numero'                => new sfValidatorPass(array('required' => false)),
      'id_tipo_certificacion' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoCertificacion'), 'column' => 'id_tipo_certificacion')),
      'codigo_profesor'       => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesor'), 'column' => 'codigo_profesor')),
    ));

    $this->widgetSchema->setNameFormat('certificacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Certificacion';
  }

  public function getFields()
  {
    return array(
      'id_certificacion'      => 'Number',
      'titulo'                => 'Text',
      'numero'                => 'Text',
      'id_tipo_certificacion' => 'ForeignKey',
      'codigo_profesor'       => 'ForeignKey',
    );
  }
}
