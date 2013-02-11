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
class RenovarPassForm extends BaseForm {

    public function configure() {
        
        $this->setWidgets(array(
            'correo' => new sfWidgetFormInputText(array(
            ),array(
                'class' => 'validate[required,custom[email]]'
            )),
            'old_pass' => new sfWidgetFormInputPassword(array(
            ),array(
//                'class' => 'validate[required,minSize[6]]'
            )),
            'new_pass' => new sfWidgetFormInputPassword(array(
            ),array(
//                'class' => 'validate[required,minSize[6]]'
            )),
            'renew_pass' => new sfWidgetFormInputPassword(array(
            ),array(
//                'class' => 'validate[required,minSize[6],equals[renovar_pass_new_pass]]'
            )),
        ));

        $this->setValidators(array(
            'correo' => new sfValidatorPass(),
            'old_pass' => new sfValidatorPass(),
            'new_pass' => new sfValidatorPass(),
            'renew_pass' => new sfValidatorPass(),
        ));
        $this->widgetSchema->setLabels(array(
            'correo' => "Correo Electrónico",
            'old_pass' => "Contraseña",
            'new_pass' => "Nueva Contraseña",
            'renew_pass' => "Confirmación de Nueva Contraseña",
        ));
        $this->widgetSchema->setNameFormat('renovar_pass[%s]');
        
    }

}

?>
