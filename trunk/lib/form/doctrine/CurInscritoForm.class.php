<?php

/**
 * CurInscrito form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CurInscritoForm extends BaseCurInscritoForm {

    public function configure() {
        $this->setWidgets(array(
            'id_cur_inscrito' => new sfWidgetFormInputHidden(),
            'primer_nombre' => new sfWidgetFormInputText(array('label' => 'Primer Nombre'),array('class' => 'validate[required,maxSize[45]]')),
            'segundo_nombre' => new sfWidgetFormInputText(array('label' => 'Segundo Nombre'),array('class' => 'validate[maxSize[45]]')),
            'primer_apellido' => new sfWidgetFormInputText(array('label' => 'Primer Apellido'),array('class' => 'validate[required,maxSize[45]]')),
            'segundo_apellido' => new sfWidgetFormInputText(array('label' => 'Segundo Apellido'),array('class' => 'validate[maxSize[45]]')),
            'documento' => new sfWidgetFormInputText(array('label' => 'Número Documento'),array('class' => 'validate[required,custom[onlyNumberSp],maxSize[20]]','readonly' => 'readonly')),
            'id_tipo_documento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => 'Seleccione...', 'label' => 'Tipo de Documento'),array('class' => 'validate[required]')),
            'lugar_expedicion' => new sfWidgetFormInputText(array('label' => 'Lugar de Expedición'),array('class' => 'validate[required,maxSize[200]]')),
            'telefono1' => new sfWidgetFormInputText(array('label' => 'Teléfono Fijo'),array()),
            'telefono2' => new sfWidgetFormInputText(array('label' => 'Teléfono Móvil'),array()),
            'correo' => new sfWidgetFormInputText(array('label' => 'Correo Electrónico'),array('class' => 'validate[required,custom[email],maxSize[50]]')),
        ));

        $this->setValidators(array(
            'id_cur_inscrito' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_cur_inscrito')), 'empty_value' => $this->getObject()->get('id_cur_inscrito'), 'required' => false)),
            'primer_nombre' => new sfValidatorString(array('max_length' => 45)),
            'segundo_nombre' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'primer_apellido' => new sfValidatorString(array('max_length' => 45)),
            'segundo_apellido' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'documento' => new sfValidatorString(array('max_length' => 20)),
//            'id_tipo_documento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
            'id_tipo_documento' => new sfValidatorPass(),
            'lugar_expedicion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'telefono1' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'telefono2' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'correo' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
        ));

        $this->widgetSchema->setNameFormat('cur_inscrito[%s]');
    }

}
