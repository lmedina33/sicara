<?php

/**
 * CurInscrito form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CurInscritoDocForm extends BaseCurInscritoForm {

    public function configure() {
        $this->setWidgets(array(
            'documento' => new sfWidgetFormInputText(array('label' => 'Número de Documento'), array('class' => 'validate[required,custom[onlyNumberSp],maxSize[20]]')),
            'id_tipo_documento' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'), 'add_empty' => 'Seleccione...','label' => 'Tipo de Documento'), array('class' => 'validate[required]')),
            'curso' => new sfWidgetFormInputHidden(),
        ));

        $this->setValidators(array(
            'documento' => new sfValidatorString(array('max_length' => 20)),
            'id_tipo_documento' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TipoDocumento'))),
            'curso' => new sfValidatorDoctrineChoice(array('model' => 'CurCurso')),
        ));

        $this->widgetSchema->setNameFormat('cur_inscrito_doc[%s]');
    }

}

?>
