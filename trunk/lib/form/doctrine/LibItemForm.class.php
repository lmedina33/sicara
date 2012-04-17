<?php

/**
 * LibItem form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LibItemForm extends BaseLibItemForm
{
  public function configure()
  {
      $this->setWidgets(array(
      'serial_lib_item'     => new sfWidgetFormInputText(array(
                'label' => 'Serial'
                    ), array(
                'class' => ($this->getObject()->isNew()? 'validate[required,maxSize[25],ajax[ajaxLibItemCallPhp_' . sfConfig::get('sf_environment') . ']]' : ''),
                ($this->getObject()->isNew()? '' : 'readonly') => ($this->getObject()->isNew()? '' : 'readonly')
            )),
      'descripcion'         => new sfWidgetFormTextarea(array('label'=>'Descripción')),
      'ubicacion'         => new sfWidgetFormTextarea(array('label'=>'Ubicación')),
      'fecha_actualizacion' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Actualización',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    buttonText: ['Ver Calendario...'],
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('class' => 'validate[required,custom[date]]')),
      'id_lib_estado'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'), 'add_empty' => 'Seleccione...', 'label' => 'Estado'),array('class' => 'validate[required]')),
      'codigo_lib_material' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'serial_lib_item'     => new sfValidatorPass(),
      'descripcion'         => new sfValidatorString(array('required' => false)),
      'ubicacion'         => new sfValidatorString(array('required' => false)),
      'fecha_actualizacion' => new sfValidatorDate(array('required' => false)),
      'id_lib_estado'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'))),
      'codigo_lib_material' => new sfValidatorPass(),
    ));

    $this->widgetSchema->setNameFormat('lib_item[%s]');
  }
}
