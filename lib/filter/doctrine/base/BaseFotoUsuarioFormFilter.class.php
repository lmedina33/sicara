<?php

/**
 * FotoUsuario filter form base class.
 *
 * @package    sicara2
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFotoUsuarioFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tipo'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'imagen'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'id_usuario'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'          => new sfValidatorPass(array('required' => false)),
      'tipo'            => new sfValidatorPass(array('required' => false)),
      'fecha'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'imagen'          => new sfValidatorPass(array('required' => false)),
      'id_usuario'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Usuario'), 'column' => 'id_usuario')),
    ));

    $this->widgetSchema->setNameFormat('foto_usuario_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FotoUsuario';
  }

  public function getFields()
  {
    return array(
      'id_foto_usuario' => 'Number',
      'nombre'          => 'Text',
      'tipo'            => 'Text',
      'fecha'           => 'Date',
      'imagen'          => 'Text',
      'id_usuario'      => 'ForeignKey',
    );
  }
}
