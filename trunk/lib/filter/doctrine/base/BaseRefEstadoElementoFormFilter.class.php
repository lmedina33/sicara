<?php

/**
 * RefEstadoElemento filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseRefEstadoElementoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'nombre'                 => new sfValidatorPass(array('required' => false)),
      'descripcion'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ref_estado_elemento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefEstadoElemento';
  }

  public function getFields()
  {
    return array(
      'id_ref_estado_elemento' => 'Number',
      'nombre'                 => 'Text',
      'descripcion'            => 'Text',
    );
  }
}
