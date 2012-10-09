<?php

/**
 * FormularioInscripcion filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFormularioInscripcionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'numero'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'primer_nombre'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_nombre'            => new sfWidgetFormFilterInput(),
      'primer_apellido'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_apellido'          => new sfWidgetFormFilterInput(),
      'documento'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_documento'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => true)),
      'lugar_expedicion'          => new sfWidgetFormFilterInput(),
      'lugar_nacimiento'          => new sfWidgetFormFilterInput(),
      'fecha_nacimiento'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'libreta_militar'           => new sfWidgetFormFilterInput(),
      'foto_path'                 => new sfWidgetFormFilterInput(),
      'es_trabajador'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono1'                 => new sfWidgetFormFilterInput(),
      'telefono2'                 => new sfWidgetFormFilterInput(),
      'direccion'                 => new sfWidgetFormFilterInput(),
      'correo'                    => new sfWidgetFormFilterInput(),
      'conocio'                   => new sfWidgetFormFilterInput(),
      'id_tipo_pago'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => true)),
      'edu_basica_ano'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_basica_institucion'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_basica_lugar'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_media_en_curso'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_media_ano'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_media_institucion'     => new sfWidgetFormFilterInput(),
      'edu_media_titulo'          => new sfWidgetFormFilterInput(),
      'edu_media_lugar'           => new sfWidgetFormFilterInput(),
      'edu_superior1_en_curso'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_superior1_ano'         => new sfWidgetFormFilterInput(),
      'edu_superior1_institucion' => new sfWidgetFormFilterInput(),
      'edu_superior1_titulo'      => new sfWidgetFormFilterInput(),
      'edu_superior1_lugar'       => new sfWidgetFormFilterInput(),
      'edu_superior2_en_curso'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_superior2_ano'         => new sfWidgetFormFilterInput(),
      'edu_superior2_institucion' => new sfWidgetFormFilterInput(),
      'edu_superior2_titulo'      => new sfWidgetFormFilterInput(),
      'edu_superior2_lugar'       => new sfWidgetFormFilterInput(),
      'edu_superior3_en_curso'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'edu_superior3_ano'         => new sfWidgetFormFilterInput(),
      'edu_superior3_institucion' => new sfWidgetFormFilterInput(),
      'edu_superior3_titulo'      => new sfWidgetFormFilterInput(),
      'edu_superior3_lugar'       => new sfWidgetFormFilterInput(),
      'codigo_pensum'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Pensum'), 'add_empty' => true)),
      'id_periodo'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => true)),
      'id_jornada'                => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'add_empty' => true)),
      'is_cerrado'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_inscrito'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'numero'                    => new sfValidatorPass(array('required' => false)),
      'codigo'                    => new sfValidatorPass(array('required' => false)),
      'primer_nombre'             => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'            => new sfValidatorPass(array('required' => false)),
      'primer_apellido'           => new sfValidatorPass(array('required' => false)),
      'segundo_apellido'          => new sfValidatorPass(array('required' => false)),
      'documento'                 => new sfValidatorPass(array('required' => false)),
      'id_tipo_documento'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoDocumento'), 'column' => 'id_tipo_documento')),
      'lugar_expedicion'          => new sfValidatorPass(array('required' => false)),
      'lugar_nacimiento'          => new sfValidatorPass(array('required' => false)),
      'fecha_nacimiento'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'libreta_militar'           => new sfValidatorPass(array('required' => false)),
      'foto_path'                 => new sfValidatorPass(array('required' => false)),
      'es_trabajador'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'telefono1'                 => new sfValidatorPass(array('required' => false)),
      'telefono2'                 => new sfValidatorPass(array('required' => false)),
      'direccion'                 => new sfValidatorPass(array('required' => false)),
      'correo'                    => new sfValidatorPass(array('required' => false)),
      'conocio'                   => new sfValidatorPass(array('required' => false)),
      'id_tipo_pago'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoPago'), 'column' => 'id_tipo_pago')),
      'edu_basica_ano'            => new sfValidatorPass(array('required' => false)),
      'edu_basica_institucion'    => new sfValidatorPass(array('required' => false)),
      'edu_basica_lugar'          => new sfValidatorPass(array('required' => false)),
      'edu_media_en_curso'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'edu_media_ano'             => new sfValidatorPass(array('required' => false)),
      'edu_media_institucion'     => new sfValidatorPass(array('required' => false)),
      'edu_media_titulo'          => new sfValidatorPass(array('required' => false)),
      'edu_media_lugar'           => new sfValidatorPass(array('required' => false)),
      'edu_superior1_en_curso'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'edu_superior1_ano'         => new sfValidatorPass(array('required' => false)),
      'edu_superior1_institucion' => new sfValidatorPass(array('required' => false)),
      'edu_superior1_titulo'      => new sfValidatorPass(array('required' => false)),
      'edu_superior1_lugar'       => new sfValidatorPass(array('required' => false)),
      'edu_superior2_en_curso'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'edu_superior2_ano'         => new sfValidatorPass(array('required' => false)),
      'edu_superior2_institucion' => new sfValidatorPass(array('required' => false)),
      'edu_superior2_titulo'      => new sfValidatorPass(array('required' => false)),
      'edu_superior2_lugar'       => new sfValidatorPass(array('required' => false)),
      'edu_superior3_en_curso'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'edu_superior3_ano'         => new sfValidatorPass(array('required' => false)),
      'edu_superior3_institucion' => new sfValidatorPass(array('required' => false)),
      'edu_superior3_titulo'      => new sfValidatorPass(array('required' => false)),
      'edu_superior3_lugar'       => new sfValidatorPass(array('required' => false)),
      'codigo_pensum'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Pensum'), 'column' => 'codigo_pensum')),
      'id_periodo'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PeriodoAcademico'), 'column' => 'id_periodo_academico')),
      'id_jornada'                => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Jornada'), 'column' => 'id_jornada')),
      'is_cerrado'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'is_inscrito'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('formulario_inscripcion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FormularioInscripcion';
  }

  public function getFields()
  {
    return array(
      'id_formulario_inscripcion' => 'Number',
      'numero'                    => 'Text',
      'codigo'                    => 'Text',
      'primer_nombre'             => 'Text',
      'segundo_nombre'            => 'Text',
      'primer_apellido'           => 'Text',
      'segundo_apellido'          => 'Text',
      'documento'                 => 'Text',
      'id_tipo_documento'         => 'ForeignKey',
      'lugar_expedicion'          => 'Text',
      'lugar_nacimiento'          => 'Text',
      'fecha_nacimiento'          => 'Date',
      'libreta_militar'           => 'Text',
      'foto_path'                 => 'Text',
      'es_trabajador'             => 'Number',
      'telefono1'                 => 'Text',
      'telefono2'                 => 'Text',
      'direccion'                 => 'Text',
      'correo'                    => 'Text',
      'conocio'                   => 'Text',
      'id_tipo_pago'              => 'ForeignKey',
      'edu_basica_ano'            => 'Text',
      'edu_basica_institucion'    => 'Text',
      'edu_basica_lugar'          => 'Text',
      'edu_media_en_curso'        => 'Number',
      'edu_media_ano'             => 'Text',
      'edu_media_institucion'     => 'Text',
      'edu_media_titulo'          => 'Text',
      'edu_media_lugar'           => 'Text',
      'edu_superior1_en_curso'    => 'Number',
      'edu_superior1_ano'         => 'Text',
      'edu_superior1_institucion' => 'Text',
      'edu_superior1_titulo'      => 'Text',
      'edu_superior1_lugar'       => 'Text',
      'edu_superior2_en_curso'    => 'Number',
      'edu_superior2_ano'         => 'Text',
      'edu_superior2_institucion' => 'Text',
      'edu_superior2_titulo'      => 'Text',
      'edu_superior2_lugar'       => 'Text',
      'edu_superior3_en_curso'    => 'Number',
      'edu_superior3_ano'         => 'Text',
      'edu_superior3_institucion' => 'Text',
      'edu_superior3_titulo'      => 'Text',
      'edu_superior3_lugar'       => 'Text',
      'codigo_pensum'             => 'ForeignKey',
      'id_periodo'                => 'ForeignKey',
      'id_jornada'                => 'ForeignKey',
      'is_cerrado'                => 'Number',
      'is_inscrito'               => 'Number',
      'created_at'                => 'Date',
      'updated_at'                => 'Date',
    );
  }
}
