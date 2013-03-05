<?php

/**
 * CurCurso filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCurCursoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'duracion'            => new sfWidgetFormFilterInput(),
      'horario'             => new sfWidgetFormFilterInput(),
      'fecha_inicio'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fecha_fin'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'inicio_calificacion' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fin_calificacion'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_inscribible'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_cur_empresa'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CurEmpresa'), 'add_empty' => true)),
      'codigo_profesor'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'nombre'              => new sfValidatorPass(array('required' => false)),
      'duracion'            => new sfValidatorPass(array('required' => false)),
      'horario'             => new sfValidatorPass(array('required' => false)),
      'fecha_inicio'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_fin'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'inicio_calificacion' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fin_calificacion'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'is_inscribible'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_cur_empresa'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CurEmpresa'), 'column' => 'id_cur_empresa')),
      'codigo_profesor'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Profesor'), 'column' => 'codigo_profesor')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cur_curso_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurCurso';
  }

  public function getFields()
  {
    return array(
      'id_cur_curso'        => 'Number',
      'nombre'              => 'Text',
      'duracion'            => 'Text',
      'horario'             => 'Text',
      'fecha_inicio'        => 'Date',
      'fecha_fin'           => 'Date',
      'inicio_calificacion' => 'Date',
      'fin_calificacion'    => 'Date',
      'is_inscribible'      => 'Number',
      'id_cur_empresa'      => 'ForeignKey',
      'codigo_profesor'     => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
