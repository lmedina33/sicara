<?php

/**
 * CurEmpresa form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CurEmpresaForm extends BaseCurEmpresaForm {

    public function configure() {
        $this->setWidgets(array(
            'id_cur_empresa' => new sfWidgetFormInputHidden(),
            'nombre' => new sfWidgetFormInputText(array(),array('class' => 'validate[required,maxSize[150]]')),
            'descripcion' => new sfWidgetFormTextarea(array('label' => 'Descripción')),
        ));

        $this->setValidators(array(
            'id_cur_empresa' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_empresa')), 'empty_value' => $this->getObject()->get('id_cur_empresa'), 'required' => false)),
            'nombre' => new sfValidatorString(array('max_length' => 150)),
            'descripcion' => new sfValidatorString(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('cur_empresa[%s]');
    }

}
