<?php

/**
 * CurCurso form base class.
 *
 * @method CurCurso getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCurCursoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_cur_curso'        => new sfWidgetFormInputHidden(),
      'nombre'              => new sfWidgetFormInputText(),
      'duracion'            => new sfWidgetFormInputText(),
      'horario'             => new sfWidgetFormTextarea(),
      'fecha_inicio'        => new sfWidgetFormDate(),
      'fecha_fin'           => new sfWidgetFormDate(),
      'inicio_calificacion' => new sfWidgetFormDate(),
      'fin_calificacion'    => new sfWidgetFormDate(),
      'is_inscribible'      => new sfWidgetFormInputText(),
      'id_cur_empresa'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CurEmpresa'), 'add_empty' => false)),
      'codigo_profesor'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_cur_curso'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_curso')), 'empty_value' => $this->getObject()->get('id_cur_curso'), 'required' => false)),
      'nombre'              => new sfValidatorString(array('max_length' => 150)),
      'duracion'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'horario'             => new sfValidatorString(array('required' => false)),
      'fecha_inicio'        => new sfValidatorDate(),
      'fecha_fin'           => new sfValidatorDate(),
      'inicio_calificacion' => new sfValidatorDate(array('required' => false)),
      'fin_calificacion'    => new sfValidatorDate(array('required' => false)),
      'is_inscribible'      => new sfValidatorInteger(array('required' => false)),
      'id_cur_empresa'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CurEmpresa'))),
      'codigo_profesor'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cur_curso[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurCurso';
  }

}
