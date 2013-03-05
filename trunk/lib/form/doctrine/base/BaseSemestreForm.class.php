<?php

/**
 * Semestre form base class.
 *
 * @method Semestre getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseSemestreForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_semestre'        => new sfWidgetFormInputHidden(),
      'numero'             => new sfWidgetFormInputText(),
      'intensidad_horaria' => new sfWidgetFormInputText(),
      'codigo_pensum'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => false)),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_semestre'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_semestre')), 'empty_value' => $this->getObject()->get('id_semestre'), 'required' => false)),
      'numero'             => new sfValidatorInteger(),
      'intensidad_horaria' => new sfValidatorInteger(),
      'codigo_pensum'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'))),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('semestre[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Semestre';
  }

}
