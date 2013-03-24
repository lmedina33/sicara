<?php

/**
 * Grupo form base class.
 *
 * @method Grupo getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGrupoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_grupo'                 => new sfWidgetFormInputHidden(),
      'nombre'                   => new sfWidgetFormInputText(),
      'id_periodo'               => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => false)),
      'certificacion_primaria'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CertificacionDocente'), 'add_empty' => true)),
      'certificacion_secundaria' => new sfWidgetFormInputText(),
      'fecha_inicio'             => new sfWidgetFormDate(),
      'fecha_fin'                => new sfWidgetFormDate(),
      'observaciones'            => new sfWidgetFormTextarea(),
      'codigo_asignatura'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'), 'add_empty' => false)),
      'codigo_profesor'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
      'inicio_calificacion'      => new sfWidgetFormDateTime(),
      'fin_calificacion'         => new sfWidgetFormDateTime(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_grupo'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_grupo')), 'empty_value' => $this->getObject()->get('id_grupo'), 'required' => false)),
      'nombre'                   => new sfValidatorString(array('max_length' => 250)),
      'id_periodo'               => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'))),
      'certificacion_primaria'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CertificacionDocente'), 'required' => false)),
      'certificacion_secundaria' => new sfValidatorInteger(array('required' => false)),
      'fecha_inicio'             => new sfValidatorDate(array('required' => false)),
      'fecha_fin'                => new sfValidatorDate(array('required' => false)),
      'observaciones'            => new sfValidatorString(array('required' => false)),
      'codigo_asignatura'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asignatura'))),
      'codigo_profesor'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'required' => false)),
      'inicio_calificacion'      => new sfValidatorDateTime(array('required' => false)),
      'fin_calificacion'         => new sfValidatorDateTime(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('grupo[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grupo';
  }

}
