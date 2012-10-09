<?php

/**
 * CurInscrito form base class.
 *
 * @method CurInscrito getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCurInscritoForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_cur_inscrito'   => new sfWidgetFormInputHidden(),
      'primer_nombre'     => new sfWidgetFormInputText(),
      'segundo_nombre'    => new sfWidgetFormInputText(),
      'primer_apellido'   => new sfWidgetFormInputText(),
      'segundo_apellido'  => new sfWidgetFormInputText(),
      'documento'         => new sfWidgetFormInputText(),
      'id_tipo_documento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => false)),
      'lugar_expedicion'  => new sfWidgetFormInputText(),
      'telefono1'         => new sfWidgetFormInputText(),
      'telefono2'         => new sfWidgetFormInputText(),
      'correo'            => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id_cur_inscrito'   => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_inscrito')), 'empty_value' => $this->getObject()->get('id_cur_inscrito'), 'required' => false)),
      'primer_nombre'     => new sfValidatorString(array('max_length' => 45)),
      'segundo_nombre'    => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'primer_apellido'   => new sfValidatorString(array('max_length' => 45)),
      'segundo_apellido'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'documento'         => new sfValidatorString(array('max_length' => 20)),
      'id_tipo_documento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
      'lugar_expedicion'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'telefono1'         => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'telefono2'         => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'correo'            => new sfValidatorString(array('max_length' => 50, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cur_inscrito[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurInscrito';
  }

}
