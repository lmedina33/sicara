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
            'id_lib_material'      => new sfWidgetFormInputHidden(),
            'codigo_lib_material' => new sfWidgetFormInputText(array(
                'label' => 'Código'
                    ), array(
                'class' => 'validate[required,maxSize[25],ajax[ajaxLibMaterialCallPhp_' . sfConfig::get('sf_environment') . ']]')
            ),
            'titulo' => new sfWidgetFormInputText(array('label' => 'Título'), array('class' => 'validate[required]')),
            'sub_titulo' => new sfWidgetFormInputText(array('label' => 'Sub Título')),
            'autores' => new sfWidgetFormTextarea(array(), array('class' => 'validate[required]')),
            'editorial' => new sfWidgetFormInputText(array(), array('class' => 'validate[required,maxSize[45]]')),
            'fecha_publicacion' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Publicación',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'config' => "{
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    buttonText: ['Ver Calendario...'],
                    changeMonth: true,
                    changeYear: true }",
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('class' => 'validate[required,custom[date]]')),
            'fecha_actualizacion' => new sfWidgetFormJQueryDate(array(
                'label' => 'Fecha de Actualización',
                'image' => '/images/iconos/calendar.png',
                'culture' => 'es',
                'disabled' => 'true',
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
                'date_widget' => new sfWidgetFormInputText()
                    ),
                    array('class' => 'validate[custom[date]]')),
            'descripcion' => new sfWidgetFormTextarea(array('label' => 'Descripción',), array('class' => 'validate[required]')),
            'temas' => new sfWidgetFormTextarea(array(), array('class' => 'validate[required]')),
            'is_referencia' => new sfWidgetFormChoice(array(
                'label' => 'Material de solo Referencia',
                'expanded' => true,
                'choices' => array('0' => 'No', '1' => 'Si'),
                'default' => '0'
                    ), array('class' => 'horizontal')
            ),
            'is_solo_profesor' => new sfWidgetFormChoice(array(
                'label' => 'Material solo para Profesores',
                'expanded' => true,
                'choices' => array('0' => 'No', '1' => 'Si'),
                'default' => '0'
                    ), array('class' => 'horizontal')
            ),
            'is_prestado' => new sfWidgetFormInputHidden(),
            'codigo_lib_categoria' => new sfWidgetFormDoctrineChoice(array(
                'label' => 'Categoría',
                'model' => $this->getRelatedModelName('LibCategoria'),
                'add_empty' => 'Seleccione...'
            ),array(
                'class' => 'validate[required]'
            )),
            'id_lib_tipo_material' => new sfWidgetFormDoctrineChoice(array(
                'label' => 'Tipo de Material',
                'model' => $this->getRelatedModelName('LibTipoMaterial'),
                'add_empty' => 'Seleccione...'
            ),array(
                'class' => 'validate[required]'
            )),
        ));

        $this->setValidators(array(
            'id_lib_material'      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id_lib_material')), 'empty_value' => $this->getObject()->get('id_lib_material'), 'required' => false)),
            'codigo_lib_material' => new sfValidatorString(array('required' => true)),
            'titulo' => new sfValidatorString(array()),
            'sub_titulo' => new sfValidatorString(array('required' => false)),
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
            'id_lib_tipo_material' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('LibTipoMaterial'))),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array(
                    'model' => 'LibMaterial',
                    'column' => 'codigo_lib_material',
                    'primary_key' => 'codigo_lib_material'
                        )
                        , array('invalid' => 'My message about email.')
                )
        );

        $this->widgetSchema->setNameFormat('lib_material[%s]');
    }

}
