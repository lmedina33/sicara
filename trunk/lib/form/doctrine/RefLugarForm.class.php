<?php

/**
 * RefLugar form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RefLugarForm extends BaseRefLugarForm {

    public function configure() {
        $this->setWidgets(array(
            'id_ref_lugar' => new sfWidgetFormInputHidden(),
            'nombre' => new sfWidgetFormInputText(array(),array('class' => 'validate[required,maxSize[100]]')),
            'descripcion' => new sfWidgetFormTextarea(array('label' => 'Descripción')),
            'capacidad_personas' => new sfWidgetFormInputText(array('label' => 'Capacidad de Personas')),
            'ubicacion' => new sfWidgetFormTextarea(array('label' => 'Ubicación',)),
            'id_ref_lugar_contenedor' => new sfWidgetFormDoctrineChoice(array(
                'model' => $this->getRelatedModelName('LugarContenedor'),
                'method' => 'getPath',
                'label' => 'Lugar que lo Contiene',
                'add_empty' => '--'
                )),
            'id_ref_tipo_lugar' => new sfWidgetFormDoctrineChoice(array(
                'model' => $this->getRelatedModelName('RefTipoLugar'),
                'add_empty' => false,
                'label' => 'Tipo de Lugar',
                )),
        ));

        $this->setValidators(array(
            'id_ref_lugar' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_lugar')), 'empty_value' => $this->getObject()->get('id_ref_lugar'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 100)),
            'descripcion' => new sfValidatorString(array('required' => false)),
            'capacidad_personas' => new sfValidatorInteger(array('required' => false)),
            'ubicacion' => new sfValidatorString(array('required' => false)),
            'id_ref_lugar_contenedor' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LugarContenedor'), 'required' => false)),
            'id_ref_tipo_lugar' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoLugar'), 'required' => true)),
        ));

        $this->widgetSchema->setNameFormat('ref_lugar[%s]');
    }

}
