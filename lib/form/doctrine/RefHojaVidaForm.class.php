<?php

/**
 * RefHojaVida form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class RefHojaVidaForm extends BaseRefHojaVidaForm {

    public function configure() {
        $this->setWidgets(array(
            'id_ref_hoja_vida' => new sfWidgetFormInputHidden(),
            'descripcion' => new sfWidgetFormTextarea(array('label'=>'Descripción'),array('class' => 'validate[required,maxSize[150]]')),
            'id_ref_elemento' => new sfWidgetFormInputHidden(),
            'id_usuario_creador' => new sfWidgetFormInputHidden(),
        ));

        $this->setValidators(array(
            'id_ref_hoja_vida' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_ref_hoja_vida')), 'empty_value' => $this->getObject()->get('id_ref_hoja_vida'), 'required' => false)),
            'descripcion' => new sfValidatorString(array('required' => false)),
            'id_ref_elemento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RefElemento'))),
            'id_usuario_creador' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UsuarioCreador'))),
        ));

        $this->widgetSchema->setNameFormat('ref_hoja_vida[%s]');
    }

}
