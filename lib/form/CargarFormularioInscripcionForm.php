<?php

class CargarFormularioInscripcionForm extends BaseForm {

    public function configure() {
        
        sfProjectConfiguration::getActive()->loadHelpers('Url'); 
        
        $this->setWidgets(array(
            'documento' => new sfWidgetFormInputText(array('label' => 'Número de Documento'),array('class' => 'validate[required,custom[onlyNumberSp],maxSize[45]]')),
            'codigo' => new sfWidgetFormInputText(array('label' => 'Código del Formulario'),array('class' => 'validate[required,maxSize[10],minSize[10]]')),
        ));

        $this->setValidators(array(
            'documento' => new sfValidatorString(array('max_length' => 45)),
            'codigo' => new sfValidatorString(array('max_length' => 45)),
        ));
        
        $this->widgetSchema->setNameFormat('cargarforminscripcion[%s]');
    }

}
?>
