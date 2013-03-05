<?php

/**
 * Usuario filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'primer_nombre'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_nombre'           => new sfWidgetFormFilterInput(),
      'primer_apellido'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'segundo_apellido'         => new sfWidgetFormFilterInput(),
      'documento'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_tipo_documento'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => true)),
      'lugar_expedicion'         => new sfWidgetFormFilterInput(),
      'fecha_nacimiento'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'genero'                   => new sfWidgetFormFilterInput(),
      'telefono1'                => new sfWidgetFormFilterInput(),
      'telefono2'                => new sfWidgetFormFilterInput(),
      'direccion'                => new sfWidgetFormFilterInput(),
      'correo'                   => new sfWidgetFormFilterInput(),
      'acudiente1'               => new sfWidgetFormFilterInput(),
      'telefono_acudiente1'      => new sfWidgetFormFilterInput(),
      'acudiente2'               => new sfWidgetFormFilterInput(),
      'telefono_acudiente2'      => new sfWidgetFormFilterInput(),
      'especificaciones_medicas' => new sfWidgetFormFilterInput(),
      'observaciones'            => new sfWidgetFormFilterInput(),
      'foto_path'                => new sfWidgetFormFilterInput(),
      'id_sf_guard_user'         => new sfWidgetFormFilterInput(),
      'id_tipo_sangre'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoSangre'), 'add_empty' => true)),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'primer_nombre'            => new sfValidatorPass(array('required' => false)),
      'segundo_nombre'           => new sfValidatorPass(array('required' => false)),
      'primer_apellido'          => new sfValidatorPass(array('required' => false)),
      'segundo_apellido'         => new sfValidatorPass(array('required' => false)),
      'documento'                => new sfValidatorPass(array('required' => false)),
      'id_tipo_documento'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoDocumento'), 'column' => 'id_tipo_documento')),
      'lugar_expedicion'         => new sfValidatorPass(array('required' => false)),
      'fecha_nacimiento'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'genero'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'telefono1'                => new sfValidatorPass(array('required' => false)),
      'telefono2'                => new sfValidatorPass(array('required' => false)),
      'direccion'                => new sfValidatorPass(array('required' => false)),
      'correo'                   => new sfValidatorPass(array('required' => false)),
      'acudiente1'               => new sfValidatorPass(array('required' => false)),
      'telefono_acudiente1'      => new sfValidatorPass(array('required' => false)),
      'acudiente2'               => new sfValidatorPass(array('required' => false)),
      'telefono_acudiente2'      => new sfValidatorPass(array('required' => false)),
      'especificaciones_medicas' => new sfValidatorPass(array('required' => false)),
      'observaciones'            => new sfValidatorPass(array('required' => false)),
      'foto_path'                => new sfValidatorPass(array('required' => false)),
      'id_sf_guard_user'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'id_tipo_sangre'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TipoSangre'), 'column' => 'id_tipo_sangre')),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }

  public function getFields()
  {
    return array(
      'id_usuario'               => 'Number',
      'primer_nombre'            => 'Text',
      'segundo_nombre'           => 'Text',
      'primer_apellido'          => 'Text',
      'segundo_apellido'         => 'Text',
      'documento'                => 'Text',
      'id_tipo_documento'        => 'ForeignKey',
      'lugar_expedicion'         => 'Text',
      'fecha_nacimiento'         => 'Date',
      'genero'                   => 'Number',
      'telefono1'                => 'Text',
      'telefono2'                => 'Text',
      'direccion'                => 'Text',
      'correo'                   => 'Text',
      'acudiente1'               => 'Text',
      'telefono_acudiente1'      => 'Text',
      'acudiente2'               => 'Text',
      'telefono_acudiente2'      => 'Text',
      'especificaciones_medicas' => 'Text',
      'observaciones'            => 'Text',
      'foto_path'                => 'Text',
      'id_sf_guard_user'         => 'Number',
      'id_tipo_sangre'           => 'ForeignKey',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
    );
  }
}
