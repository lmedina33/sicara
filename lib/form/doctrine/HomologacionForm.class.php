<?php

/**
 * Homologacion form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class HomologacionForm extends BaseHomologacionForm {

    public function configure() {
        $this->setWidgets(array(
            'id_homologacion' => new sfWidgetFormInputHidden(),
            'institucion_origen' => new sfWidgetFormInputText(array('label' => 'Institución de Origen'), array('class' => 'validate[required,maxSize[255]]')),
            'programa_origen' => new sfWidgetFormInputText(array('label' => 'Programa de Origen'), array('class' => 'validate[required,maxSize[255]]')),
            'nota_aprobatoria' => new sfWidgetFormInputText(array('label' => 'Nota Aprobatoria'), array('class' => 'validate[required,custom[number]]')),
            'is_oficializado' => new sfWidgetFormInputHidden(),
            'is_interna' => new sfWidgetFormInputHidden(),
            'observaciones' => new sfWidgetFormTextarea(),
            'codigo_pensum_destino' => new sfWidgetFormDoctrineChoice(array('label' => 'Pensum a Homologar','model' => $this->getRelatedModelName('PensumDestino'), 'add_empty' => 'Seleccione...'), array('class' => 'validate[required]')),
            'codigo_pensum_origen' => new sfWidgetFormInputHidden(),
            'id_usuario' => new sfWidgetFormInputHidden(),
            'id_sf_guard_user' => new sfWidgetFormInputHidden(),
        ));

        $this->setValidators(array(
            'id_homologacion' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_homologacion')), 'empty_value' => $this->getObject()->get('id_homologacion'), 'required' => false)),
            'institucion_origen' => new sfValidatorPass(),
            'programa_origen' => new sfValidatorPass(),
            'nota_aprobatoria' => new sfValidatorNumber(array('required' => false)),
            'is_oficializado' => new sfValidatorInteger(array('required' => false)),
            'is_interna' => new sfValidatorInteger(array('required' => false)),
            'observaciones' => new sfValidatorString(),
            'codigo_pensum_destino' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PensumDestino'))),
            'codigo_pensum_origen' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PensumOrigen'), 'required' => false)),
            'id_usuario' => new sfValidatorPass(),
            'id_sf_guard_user' => new sfValidatorPass(),
        ));

        $this->widgetSchema->setNameFormat('homologacion[%s]');
    }

}
