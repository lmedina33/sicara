<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CargarReferenciasNoEncontradasForm
 *
 * @author rpalacios
 */
class FiltroRefElementoForm extends BaseForm {

    public function configure() {
        
        sfProjectConfiguration::getActive()->loadHelpers('Url'); 
        
        $this->setWidgets(array(
            'id_ref_tipo_elemento' => new sfWidgetFormDoctrineChoice(array('label'=>'Tipo: ','model' => 'RefTipoElemento', 'add_empty' => 'Todos...'),array()),
            'id_ref_estado_elemento' => new sfWidgetFormDoctrineChoice(array('label'=>'Estado: ','model' => 'RefEstadoElemento', 'add_empty' => 'Todos...'),array()),
            'id_usuario_responsable' => new sfWidgetFormDoctrineJQueryAutocompleter(array(
                'url'=>url_for('refElemento/findUsuarios'),
                'model' => 'Usuario',
                'method_for_query' => 'getById',
                'label'=>'Responsable: '
                ),array()),
        ));

        $this->setValidators(array(
            'id_ref_tipo_elemento' => new sfValidatorDoctrineChoice(array('model' => 'RefTipoElemento', 'required' => false)),
            'id_ref_estado_elemento' => new sfValidatorDoctrineChoice(array('model' => 'RefEstadoElemento', 'required' => false)),
            'id_usuario_responsable' => new sfValidatorDoctrineChoice(array('model' => 'Usuario', 'required' => false)),
        ));
        
        $this->widgetSchema->setNameFormat('filtrorefelemento[%s]');
    }

}

?>
