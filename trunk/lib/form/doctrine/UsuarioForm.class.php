<?php

/**
 * Usuario form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioForm extends BaseUsuarioForm {

    public function configure() {
        $this->setWidgets(array(
            'id_usuario' => new sfWidgetFormInputHidden(),
            'primer_nombre' => new sfWidgetFormInputText(array('label' => 'Primer Nombre'),array('class' => 'validate[required]')),
            'segundo_nombre' => new sfWidgetFormInputText(array('label' => 'Segundo Nombre')),
            'primer_apellido' => new sfWidgetFormInputText(array('label' => 'Primer Apellido'),array('class' => 'validate[required]')),
            'segundo_apellido' => new sfWidgetFormInputText(array('label' => 'Segundo Apellido')),
            'documento' => new sfWidgetFormInputText(array('label' => 'Número de Documento'),array('class' => 'validate[required,maxSize[20],ajax[ajaxDocumentoCallPhp_' . sfConfig::get('sf_environment') . ']]')),
            'id_tipo_documento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => false, 'label' => 'Tipo de Documento'),array('class' => 'validate[required,maxSize[20],ajax[ajaxTipoDocumentoCallPhp_' . sfConfig::get('sf_environment') . ']]')),
            'lugar_expedicion' => new sfWidgetFormInputText(array('label' => 'Lugar de Expedición'),array('class' => 'validate[required]')),
            'telefono1' => new sfWidgetFormInputText(array('label' => 'Teléfono 1'),array('class' => 'validate[required]')),
            'telefono2' => new sfWidgetFormInputText(array('label' => 'Teléfono 2')),
            'direccion' => new sfWidgetFormInputText(array('label' => 'Dirección'),array('class' => 'validate[required]')),
            'correo' => new sfWidgetFormInputText(array('label' => 'E-Mail')),
            'acudiente1' => new sfWidgetFormInputText(array('label' => 'Primer Acudiente'),array('class' => 'validate[required]')),
            'telefono_acudiente1' => new sfWidgetFormInputText(array('label' => 'Teléfono de Primer Acudiente'),array('class' => 'validate[required]')),
            'acudiente2' => new sfWidgetFormInputText(array('label' => 'Segundo Acudiente')),
            'telefono_acudiente2' => new sfWidgetFormInputText(array('label' => 'Teléfono de Segundo Acudiente')),
            'especificaciones_medicas' => new sfWidgetFormTextarea(array('label' => 'Especificaciones Médicas'),array('class' => 'validate[required]')),
            'observaciones' => new sfWidgetFormTextarea(array('label' => 'Otras Observaciones')),
            'foto_path' => new sfWidgetFormInputFile(array('label' => 'Foto')),
            'id_sf_guard_user' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'id_usuario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_usuario')), 'empty_value' => $this->getObject()->get('id_usuario'), 'required' => false)),
            'primer_nombre' => new sfValidatorString(array('max_length' => 45)),
            'segundo_nombre' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'primer_apellido' => new sfValidatorString(array('max_length' => 45)),
            'segundo_apellido' => new sfValidatorString(array('max_length' => 45, 'required' => false)),
            'documento' => new sfValidatorString(array('max_length' => 20)),
            'id_tipo_documento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
            'lugar_expedicion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
            'telefono1' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'telefono2' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'direccion' => new sfValidatorString(array('required' => false)),
            'correo' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
            'acudiente1' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'telefono_acudiente1' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'acudiente2' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
            'telefono_acudiente2' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
            'especificaciones_medicas' => new sfValidatorString(array('required' => false)),
            'observaciones' => new sfValidatorString(array('required' => false)),
            'foto_path' => new sfValidatorFile(array(
                'mime_types' => 'web_images',
                'max_size' => '512000',
                'required' => false
                ),array(
                    'max_size' => 'Este archivo es demasiado grande.'
                )),
            'id_sf_guard_user' => new sfValidatorInteger(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('usuario[%s]');
    }

}
