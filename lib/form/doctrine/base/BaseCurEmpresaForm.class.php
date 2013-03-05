<?php

/**
 * CurEmpresa form base class.
 *
 * @method CurEmpresa getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCurEmpresaForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_cur_empresa' => new sfWidgetFormInputHidden(),
      'nombre'         => new sfWidgetFormInputText(),
      'descripcion'    => new sfWidgetFormTextarea(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_cur_empresa' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_empresa')), 'empty_value' => $this->getObject()->get('id_cur_empresa'), 'required' => false)),
      'nombre'         => new sfValidatorString(array('max_length' => 150)),
      'descripcion'    => new sfValidatorString(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cur_empresa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurEmpresa';
  }

}
