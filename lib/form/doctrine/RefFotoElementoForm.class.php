<?php

/**
 * RefFotoElemento form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RefFotoElementoForm extends BaseRefFotoElementoForm {

    public function configure() {
        $this->setWidgets(array(
            'id_ref_foto_elemento' => new sfWidgetFormInputHidden(),
            'nombre' => new sfWidgetFormInputHidden(),
            'path' =>  new sfWidgetFormInputHidden(),
            'file' =>  new sfWidgetFormInputFile(array('label' => 'Foto')),
            'id_ref_elemento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'add_empty' => true)),
        ));

        $this->setValidators(array(
            'id_ref_foto_elemento' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_foto_elemento')), 'empty_value' => $this->getObject()->get('id_ref_foto_elemento'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 150, 'required' => false)),
            'path' => new sfValidatorString(array('max_length' => 150, 'required' => false)),
            'file' => new sfValidatorFile(array(
                'mime_types' => 'web_images',
                'max_size' => '1572864',
                'required' => false
                ),array(
                    'max_size' => 'Este archivo es demasiado grande.'
                )),
            'id_ref_elemento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'), 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('ref_foto_elemento[%s]');
    }

}
