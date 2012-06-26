<?php

/**
 * RefElemento form base class.
 *
 * @method RefElemento getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseRefElementoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_ref_elemento'        => new sfWidgetFormInputHidden(),
      'serial'                 => new sfWidgetFormInputText(),
      'serial_interno'         => new sfWidgetFormInputText(),
      'nombre'                 => new sfWidgetFormInputText(),
      'marca'                  => new sfWidgetFormInputText(),
      'modelo'                 => new sfWidgetFormInputText(),
      'descripcion'            => new sfWidgetFormTextarea(),
      'cantidad_sancion'       => new sfWidgetFormInputText(),
      'ubicacion'              => new sfWidgetFormTextarea(),
      'is_prestable'           => new sfWidgetFormInputText(),
      'id_ref_tipo_elemento'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoElemento'), 'add_empty' => false)),
      'id_ref_lugar'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefLugar'), 'add_empty' => true)),
      'id_ref_estado_elemento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefEstadoElemento'), 'add_empty' => false)),
      'id_ref_tipo_sancion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoSancion'), 'add_empty' => true)),
      'id_usuario_responsable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioResponsable'), 'add_empty' => true)),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_ref_elemento'        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_elemento')), 'empty_value' => $this->getObject()->get('id_ref_elemento'), 'required' => false)),
      'serial'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'serial_interno'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'nombre'                 => new sfValidatorString(array('max_length' => 150)),
      'marca'                  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'modelo'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'descripcion'            => new sfValidatorString(array('required' => false)),
      'cantidad_sancion'       => new sfValidatorNumber(array('required' => false)),
      'ubicacion'              => new sfValidatorString(array('required' => false)),
      'is_prestable'           => new sfValidatorInteger(array('required' => false)),
      'id_ref_tipo_elemento'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoElemento'))),
      'id_ref_lugar'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefLugar'), 'required' => false)),
      'id_ref_estado_elemento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefEstadoElemento'))),
      'id_ref_tipo_sancion'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoSancion'), 'required' => false)),
      'id_usuario_responsable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioResponsable'), 'required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ref_elemento[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RefElemento';
  }

}
