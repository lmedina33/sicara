<?php

/**
 * PeriodoAcademico form base class.
 *
 * @method PeriodoAcademico getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePeriodoAcademicoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_periodo_academico' => new sfWidgetFormInputHidden(),
      'periodo'              => new sfWidgetFormInputText(),
      'fecha_inicio'         => new sfWidgetFormDate(),
      'fecha_fin'            => new sfWidgetFormDate(),
      'estado'               => new sfWidgetFormInputText(),
      'codigo_pensum'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => false)),
      'id_predecesor'        => new sfWidgetFormInputText(),
      'observacion'          => new sfWidgetFormTextarea(),
      'is_inscribible'       => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_periodo_academico' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_periodo_academico')), 'empty_value' => $this->getObject()->get('id_periodo_academico'), 'required' => false)),
      'periodo'              => new sfValidatorString(array('max_length' => 6)),
      'fecha_inicio'         => new sfValidatorDate(),
      'fecha_fin'            => new sfValidatorDate(array('required' => false)),
      'estado'               => new sfValidatorInteger(array('required' => false)),
      'codigo_pensum'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'))),
      'id_predecesor'        => new sfValidatorInteger(array('required' => false)),
      'observacion'          => new sfValidatorString(array('required' => false)),
      'is_inscribible'       => new sfValidatorInteger(array('required' => false)),
      'created_at'           => new sfValidatorDateTime(),
      'updated_at'           => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('periodo_academico[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PeriodoAcademico';
  }

}
