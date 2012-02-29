<?php

/**
 * LibMaterial form.
 *
 * @package    sicara2
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LibMaterialForm extends BaseLibMaterialForm {

    public function configure() {
        $this->setWidgets(array(
            'codigo_lib_material' => new sfWidgetFormInputHidden(),
            'titulo' => new sfWidgetFormInputText(array(), array('class' => 'validate[required]')),
            'sub_titulo' => new sfWidgetFormInputText(),
            'autores' => new sfWidgetFormTextarea(array(), array('class' => 'validate[required]')),
            'editorial' => new sfWidgetFormInputText(array(), array('class' => 'validate[required]')),
            'fecha_publicacion' => new sfWidgetFormJQueryDate(array(
                'image' => '/images/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    buttonText: ['Ver Calendario...'],
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText(array(), array('readonly' => 'readonly'))
                    ),
                    array('class' => 'validate[required]')),
            'fecha_actualizacion' => new sfWidgetFormJQueryDate(array(
                'image' => '/images/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    buttonText: ['Ver Calendario...'],
                    changeMonth: true,
                    changeYear: true,
                    prevText: 'Anterior',
                    nextText: 'Siguiente'}",
                'date_widget' => new sfWidgetFormInputText(array(), array('readonly' => 'readonly'))
                    ),
                    array('class' => 'validate[required]')),
            'descripcion' => new sfWidgetFormTextarea(array(), array('class' => 'validate[required]')),
            'temas' => new sfWidgetFormTextarea(array(), array('class' => 'validate[required]')),
            'is_referencia' => new sfWidgetFormChoice(array(
                'expanded' => true,
                'choices' => array('0' => 'No', '1' => 'Si'),
                'default' => '0'
                    ), array('class' => 'horizontal')
            ),
            'is_solo_profesor' => new sfWidgetFormChoice(array(
                'expanded' => true,
                'choices' => array('0' => 'No', '1' => 'Si'),
                'default' => '0'
                    ), array('class' => 'horizontal')
            ),
            'is_prestado' => new sfWidgetFormInputHidden(),
            'codigo_lib_categoria' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibCategoria'), 'add_empty' => false)),
            'id_lib_estado' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'), 'add_empty' => false)),
            'id_lib_tipo_material' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoMaterial'), 'add_empty' => false)),
        ));

        $this->setValidators(array(
            'codigo_lib_material' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('codigo_lib_material')), 'empty_value' => $this->getObject()->get('codigo_lib_material'), 'required' => false)),
            'titulo' => new sfValidatorString(array('max_length' => 45)),
            'sub_titulo' => new sfValidatorString(array('max_length' => 45)),
            'autores' => new sfValidatorString(),
            'editorial' => new sfValidatorString(array('max_length' => 45)),
            'fecha_publicacion' => new sfValidatorDate(),
            'fecha_actualizacion' => new sfValidatorDate(array('required' => false)),
            'descripcion' => new sfValidatorString(array('required' => false)),
            'temas' => new sfValidatorString(),
            'is_referencia' => new sfValidatorInteger(array('required' => false)),
            'is_solo_profesor' => new sfValidatorInteger(array('required' => false)),
            'is_prestado' => new sfValidatorInteger(array('required' => false)),
            'codigo_lib_categoria' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibCategoria'))),
            'id_lib_estado' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibEstado'))),
            'id_lib_tipo_material' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoMaterial'))),
        ));

        $this->widgetSchema->setNameFormat('lib_material[%s]');
    }

}
