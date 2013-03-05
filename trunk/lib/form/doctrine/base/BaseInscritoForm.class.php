<?php

/**
 * Inscrito form base class.
 *
 * @method Inscrito getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseInscritoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero_formulario' => new sfWidgetFormInputHidden(),
      'id_jornada'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'add_empty' => true)),
      'id_tipo_pago'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => true)),
      'id_periodo'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => false)),
      'id_usuario'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => false)),
      'is_matriculado'    => new sfWidgetFormInputText(),
      'fecha_inscripcion' => new sfWidgetFormDate(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'numero_formulario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('numero_formulario')), 'empty_value' => $this->getObject()->get('numero_formulario'), 'required' => false)),
      'id_jornada'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'required' => false)),
      'id_tipo_pago'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'required' => false)),
      'id_periodo'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'))),
      'id_usuario'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
      'is_matriculado'    => new sfValidatorInteger(array('required' => false)),
      'fecha_inscripcion' => new sfValidatorDate(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('inscrito[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Inscrito';
  }

}
