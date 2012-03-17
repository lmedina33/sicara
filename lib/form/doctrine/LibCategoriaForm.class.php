<?php

/**
 * LibCategoria form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LibCategoriaForm extends BaseLibCategoriaForm
{
  public function configure()
  {
      $this->setWidgets(array(
      'codigo_lib_categoria' => new sfWidgetFormInputText(array(
                'label' => 'Código'
                    ), array(
                'class' => ($this->getObject()->isNew()? 'validate[required,maxSize[25],ajax[ajaxLibCategoriaCallPhp_' . sfConfig::get('sf_environment') . ']]' : ''),
                ($this->getObject()->isNew()? '' : 'readonly') => ($this->getObject()->isNew()? '' : 'readonly')
            )),
      'nombre'               => new sfWidgetFormInputText(array(),array('class' => 'validate[required]')),
      'descripcion'          => new sfWidgetFormTextarea(array('label'=>'Descripción')),
      'dias_prestamo'        => new sfWidgetFormInputText(array('label'=>'Días de Prestamo'),array('class' => 'validate[required]')),
      'cantidad_sancion'     => new sfWidgetFormInputText(array('label'=>'Cantidad de Sanción'),array('class' => 'validate[required]')),
      'id_tipo_sancion'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'add_empty' => 'Seleccione...', 'label' => 'Tipo de Sanción'),array('class' => 'validate[required]')),
    ));

    $this->setValidators(array(
      'codigo_lib_categoria' => new sfValidatorString(array('required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 100)),
      'descripcion'          => new sfValidatorString(array('required' => false)),
      'dias_prestamo'        => new sfValidatorInteger(array('required' => false)),
      'cantidad_sancion'     => new sfValidatorNumber(array('required' => false)),
      'id_tipo_sancion'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoSancion'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('lib_categoria[%s]');
  }
}
