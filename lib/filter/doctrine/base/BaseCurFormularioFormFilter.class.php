<?php

/**
 * CurFormulario filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCurFormularioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'direccion'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'dependencia'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cargo'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono'          => new sfWidgetFormFilterInput(),
      'horario'           => new sfWidgetFormFilterInput(),
      'licencia_basica1'  => new sfWidgetFormFilterInput(),
      'numero_licencia1'  => new sfWidgetFormFilterInput(),
      'habilitacion1'     => new sfWidgetFormFilterInput(),
      'fecha_expedicion1' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_repaso1'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'licencia_basica2'  => new sfWidgetFormFilterInput(),
      'numero_licencia2'  => new sfWidgetFormFilterInput(),
      'habilitacion2'     => new sfWidgetFormFilterInput(),
      'fecha_expedicion2' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_repaso2'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'licencia_basica3'  => new sfWidgetFormFilterInput(),
      'numero_licencia3'  => new sfWidgetFormFilterInput(),
      'habilitacion3'     => new sfWidgetFormFilterInput(),
      'fecha_expedicion3' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_repaso3'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'licencia_basica4'  => new sfWidgetFormFilterInput(),
      'numero_licencia4'  => new sfWidgetFormFilterInput(),
      'habilitacion4'     => new sfWidgetFormFilterInput(),
      'fecha_expedicion4' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fecha_repaso4'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'id_cur_inscrito'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CurInscrito'), 'add_empty' => true)),
      'id_cur_curso'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CurCurso'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'direccion'         => new sfValidatorPass(array('required' => false)),
      'dependencia'       => new sfValidatorPass(array('required' => false)),
      'cargo'             => new sfValidatorPass(array('required' => false)),
      'telefono'          => new sfValidatorPass(array('required' => false)),
      'horario'           => new sfValidatorPass(array('required' => false)),
      'licencia_basica1'  => new sfValidatorPass(array('required' => false)),
      'numero_licencia1'  => new sfValidatorPass(array('required' => false)),
      'habilitacion1'     => new sfValidatorPass(array('required' => false)),
      'fecha_expedicion1' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_repaso1'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'licencia_basica2'  => new sfValidatorPass(array('required' => false)),
      'numero_licencia2'  => new sfValidatorPass(array('required' => false)),
      'habilitacion2'     => new sfValidatorPass(array('required' => false)),
      'fecha_expedicion2' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_repaso2'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'licencia_basica3'  => new sfValidatorPass(array('required' => false)),
      'numero_licencia3'  => new sfValidatorPass(array('required' => false)),
      'habilitacion3'     => new sfValidatorPass(array('required' => false)),
      'fecha_expedicion3' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_repaso3'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'licencia_basica4'  => new sfValidatorPass(array('required' => false)),
      'numero_licencia4'  => new sfValidatorPass(array('required' => false)),
      'habilitacion4'     => new sfValidatorPass(array('required' => false)),
      'fecha_expedicion4' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'fecha_repaso4'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'id_cur_inscrito'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CurInscrito'), 'column' => 'id_cur_inscrito')),
      'id_cur_curso'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CurCurso'), 'column' => 'id_cur_curso')),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('cur_formulario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurFormulario';
  }

  public function getFields()
  {
    return array(
      'id_cur_formulario' => 'Number',
      'direccion'         => 'Text',
      'dependencia'       => 'Text',
      'cargo'             => 'Text',
      'telefono'          => 'Text',
      'horario'           => 'Text',
      'licencia_basica1'  => 'Text',
      'numero_licencia1'  => 'Text',
      'habilitacion1'     => 'Text',
      'fecha_expedicion1' => 'Date',
      'fecha_repaso1'     => 'Date',
      'licencia_basica2'  => 'Text',
      'numero_licencia2'  => 'Text',
      'habilitacion2'     => 'Text',
      'fecha_expedicion2' => 'Date',
      'fecha_repaso2'     => 'Date',
      'licencia_basica3'  => 'Text',
      'numero_licencia3'  => 'Text',
      'habilitacion3'     => 'Text',
      'fecha_expedicion3' => 'Date',
      'fecha_repaso3'     => 'Date',
      'licencia_basica4'  => 'Text',
      'numero_licencia4'  => 'Text',
      'habilitacion4'     => 'Text',
      'fecha_expedicion4' => 'Date',
      'fecha_repaso4'     => 'Date',
      'id_cur_inscrito'   => 'ForeignKey',
      'id_cur_curso'      => 'ForeignKey',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
