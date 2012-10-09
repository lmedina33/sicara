<?php

/**
 * CurFormulario form base class.
 *
 * @method CurFormulario getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCurFormularioForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_cur_formulario' => new sfWidgetFormInputHidden(),
      'direccion'         => new sfWidgetFormTextarea(),
      'dependencia'       => new sfWidgetFormInputText(),
      'cargo'             => new sfWidgetFormInputText(),
      'telefono'          => new sfWidgetFormInputText(),
      'horario'           => new sfWidgetFormTextarea(),
      'licencia_basica1'  => new sfWidgetFormInputText(),
      'numero_licencia1'  => new sfWidgetFormInputText(),
      'habilitacion1'     => new sfWidgetFormInputText(),
      'fecha_expedicion1' => new sfWidgetFormDate(),
      'fecha_repaso1'     => new sfWidgetFormDate(),
      'licencia_basica2'  => new sfWidgetFormInputText(),
      'numero_licencia2'  => new sfWidgetFormInputText(),
      'habilitacion2'     => new sfWidgetFormInputText(),
      'fecha_expedicion2' => new sfWidgetFormDate(),
      'fecha_repaso2'     => new sfWidgetFormDate(),
      'licencia_basica3'  => new sfWidgetFormInputText(),
      'numero_licencia3'  => new sfWidgetFormInputText(),
      'habilitacion3'     => new sfWidgetFormInputText(),
      'fecha_expedicion3' => new sfWidgetFormDate(),
      'fecha_repaso3'     => new sfWidgetFormDate(),
      'licencia_basica4'  => new sfWidgetFormInputText(),
      'numero_licencia4'  => new sfWidgetFormInputText(),
      'habilitacion4'     => new sfWidgetFormInputText(),
      'fecha_expedicion4' => new sfWidgetFormDate(),
      'fecha_repaso4'     => new sfWidgetFormDate(),
      'id_cur_inscrito'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CurInscrito'), 'add_empty' => true)),
      'id_cur_curso'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CurCurso'), 'add_empty' => true)),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_cur_formulario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_formulario')), 'empty_value' => $this->getObject()->get('id_cur_formulario'), 'required' => false)),
      'direccion'         => new sfValidatorString(),
      'dependencia'       => new sfValidatorString(array('max_length' => 100)),
      'cargo'             => new sfValidatorString(array('max_length' => 100)),
      'telefono'          => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'horario'           => new sfValidatorString(array('required' => false)),
      'licencia_basica1'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'numero_licencia1'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'habilitacion1'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fecha_expedicion1' => new sfValidatorDate(array('required' => false)),
      'fecha_repaso1'     => new sfValidatorDate(array('required' => false)),
      'licencia_basica2'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'numero_licencia2'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'habilitacion2'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fecha_expedicion2' => new sfValidatorDate(array('required' => false)),
      'fecha_repaso2'     => new sfValidatorDate(array('required' => false)),
      'licencia_basica3'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'numero_licencia3'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'habilitacion3'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fecha_expedicion3' => new sfValidatorDate(array('required' => false)),
      'fecha_repaso3'     => new sfValidatorDate(array('required' => false)),
      'licencia_basica4'  => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'numero_licencia4'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'habilitacion4'     => new sfValidatorString(array('max_length' => 45, 'required' => false)),
      'fecha_expedicion4' => new sfValidatorDate(array('required' => false)),
      'fecha_repaso4'     => new sfValidatorDate(array('required' => false)),
      'id_cur_inscrito'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CurInscrito'), 'required' => false)),
      'id_cur_curso'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CurCurso'), 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('cur_formulario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurFormulario';
  }

}
