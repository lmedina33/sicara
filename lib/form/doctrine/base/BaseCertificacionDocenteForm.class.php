<?php

/**
 * CertificacionDocente form base class.
 *
 * @method CertificacionDocente getObject() Returns the current form's model object
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCertificacionDocenteForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_certificacion_docente' => new sfWidgetFormInputHidden(),
      'titulo'                   => new sfWidgetFormInputText(),
      'numero'                   => new sfWidgetFormInputText(),
      'id_tipo_certificacion'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCertificacion'), 'add_empty' => true)),
      'codigo_profesor'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'), 'add_empty' => false)),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id_certificacion_docente' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_certificacion_docente')), 'empty_value' => $this->getObject()->get('id_certificacion_docente'), 'required' => false)),
      'titulo'                   => new sfValidatorString(array('max_length' => 45)),
      'numero'                   => new sfValidatorString(array('max_length' => 45)),
      'id_tipo_certificacion'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoCertificacion'), 'required' => false)),
      'codigo_profesor'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Profesor'))),
      'created_at'               => new sfValidatorDateTime(),
      'updated_at'               => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('certificacion_docente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CertificacionDocente';
  }

}
