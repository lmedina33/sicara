<?php

/**
 * LibTipoMaterial form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LibTipoMaterialForm extends BaseLibTipoMaterialForm
{
  public function configure()
  {
      $this->setWidgets(array(
      'id_lib_tipo_material' => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(array(),array('class' => 'validate[required]')),
      'descripcion'          => new sfWidgetFormTextarea(array('label'=>'Descripción')),
      'dias_prestamo'        => new sfWidgetFormInputText(array('label'=>'Días de Prestamo'),array('class' => 'validate[required]')),
      'cantidad_sancion'     => new sfWidgetFormInputText(array('label'=>'Cantidad de Sanción'),array('class' => 'validate[required]')),
      'id_lib_tipo_sancion'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'add_empty' => 'Seleccione...', 'label' => 'Tipo de Sanción'),array('class' => 'validate[required]')),
    ));

    $this->setValidators(array(
      'id_lib_tipo_material' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_lib_tipo_material')), 'empty_value' => $this->getObject()->get('id_lib_tipo_material'), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 100)),
      'descripcion'          => new sfValidatorString(array('required' => false)),
      'dias_prestamo'        => new sfValidatorInteger(),
      'cantidad_sancion'     => new sfValidatorNumber(),
      'id_lib_tipo_sancion'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'required' => true)),
    ));

    $this->widgetSchema->setNameFormat('lib_tipo_material[%s]');
  }
}
