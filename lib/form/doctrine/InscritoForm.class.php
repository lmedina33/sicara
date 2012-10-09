<?php

/**
 * Inscrito form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InscritoForm extends BaseInscritoForm {

    public function configure() {
        $this->setWidgets(array(
            'numero_formulario' => new sfWidgetFormInputText(array('label' => 'Número de Formulario'),array('readonly' => 'readonly')),
            'id_jornada' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'add_empty' => true, 'label' => 'Jornada')),
            'id_tipo_pago' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'add_empty' => true, 'label' => 'Tipo de Pago')),
            'id_periodo' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'), 'add_empty' => false, 'label' => 'Periodo Académico')),
            'id_usuario' => new sfWidgetFormInputHidden(),
            'is_matriculado' => new sfWidgetFormInputHidden(),
            'fecha_inscripcion' => new sfWidgetFormInputHidden(),
        ));

        $this->setValidators(array(
            'numero_formulario' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('numero_formulario')), 'empty_value' => $this->getObject()->get('numero_formulario'), 'required' => false)),
            'id_jornada' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Jornada'), 'required' => false)),
            'id_tipo_pago' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoPago'), 'required' => false)),
            'id_periodo' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PeriodoAcademico'))),
            'id_usuario' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Usuario'))),
            'is_matriculado' => new sfValidatorInteger(array('required' => false)),
            'fecha_inscripcion' => new sfValidatorDate(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('inscrito[%s]');
    }

}
