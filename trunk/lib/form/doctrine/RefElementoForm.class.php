<?php

/**
 * RefElemento form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RefElementoForm extends BaseRefElementoForm {

    public function configure() {
        sfProjectConfiguration::getActive()->loadHelpers('Url');      
        
        $this->setWidgets(array(
            'id_ref_elemento' => new sfWidgetFormInputHidden(),
            'serial' => new sfWidgetFormInputText(array(),array('class' => 'validate[maxSize[100]]')),
            'serial_interno' => new sfWidgetFormInputText(array('label'=>'Serial Interno'),array('class' => 'validate[maxSize[100]]')),
            'nombre' => new sfWidgetFormInputText(array(),array('class' => 'validate[required,maxSize[150]]')),
            'marca' => new sfWidgetFormInputText(array(),array('class' => 'validate[maxSize[150]]')),
            'modelo' => new sfWidgetFormInputText(array(),array('class' => 'validate[maxSize[150]]')),
            'descripcion' => new sfWidgetFormTextarea(array('label'=>'Descripción'),array('class'=>'validate[required]')),
            'cantidad_sancion' => new sfWidgetFormInputText(array('label'=>'Cantidad de la Sanción')),
            'ubicacion' => new sfWidgetFormTextarea(array('label'=>'Ubicación'),array('class'=>'validate[required]')),
            'is_prestable' => new sfWidgetFormChoice(array('label'=>'Prestable','choices'=>array('0'=>'No','1'=>'Si'))),
            'id_ref_tipo_elemento' => new sfWidgetFormDoctrineChoice(array('label'=>'Tipo de Elemento','model' => $this->getRelatedModelName('RefTipoElemento'), 'add_empty' => 'Seleccione...'),array('class'=>'validate[required]')),
            'id_ref_lugar' => new sfWidgetFormDoctrineChoice(array(
                'label'=>'Lugar',
                'model' => $this->getRelatedModelName('RefLugar'),
                'method' => 'getPath',
                'add_empty' => 'Seleccione...'
                ),array('onclick'=>'javascript:return showLugares();','class'=>'validate[required]')),
            'id_ref_estado_elemento' => new sfWidgetFormDoctrineChoice(array('label'=>'Estado del Elemento','model' => $this->getRelatedModelName('RefEstadoElemento'), 'add_empty' => 'Seleccione...'),array('class'=>'validate[required]')),
            'id_ref_tipo_sancion' => new sfWidgetFormDoctrineChoice(array('label' => 'Tipo de Sanción','model' => $this->getRelatedModelName('RefTipoSancion'), 'add_empty' => 'Ninguna')),
//            'id_usuario_responsable' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioResponsable'), 'add_empty' => 'Seleccione...','label'=>'Usuario Responsable'),array('class'=>'validate[required]')),
            'id_usuario_responsable' => new sfWidgetFormDoctrineJQueryAutocompleter(array(
                'url'=>url_for('refElemento/findUsuarios'),
                'model' => 'Usuario',
                'method_for_query' => 'getById',
                'label'=>'Usuario Responsable'
                ),array('class'=>'validate[required]')),
        ));

        $this->setValidators(array(
            'id_ref_elemento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_elemento')), 'empty_value' => $this->getObject()->get('id_ref_elemento'), 'required' => false)),
            'serial' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'serial_interno' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 150)),
            'marca' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'modelo' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'descripcion' => new sfValidatorString(array('required' => false)),
            'cantidad_sancion' => new sfValidatorNumber(array('required' => false)),
            'ubicacion' => new sfValidatorString(array('required' => false)),
            'is_prestable' => new sfValidatorPass(),
            'id_ref_tipo_elemento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoElemento'))),
            'id_ref_lugar' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefLugar'), 'required' => false)),
            'id_ref_estado_elemento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefEstadoElemento'))),
            'id_ref_tipo_sancion' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefTipoSancion'), 'required' => false)),
//            'id_usuario_responsable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioResponsable'), 'required' => false)),
            'id_usuario_responsable' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioResponsable'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('ref_elemento[%s]');
    }

}
