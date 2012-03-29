<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CargarReferenciasNoEncontradasForm
 *
 * @author dvillarraga
 */
class SelectorFiltroForm extends BaseForm {

    public function configure() {
        
        
        $this->setWidgets(array(
            'tipo_filtro' => new sfWidgetFormChoice(array(
                'choices' => array(
                    'codigo' => 'Código',
                    'titulos' => 'Título',
                    'autores' => 'Autores',
                    'editorial' => 'Editorial',
                    'temas' => 'Temas'
                ),
                    ),
                    array(
                        'class' => 'validate[required]'
                    )
            ),
            'tipo_material' => new sfWidgetFormDoctrineChoice(array(
                'model' => 'LibTipoMaterial',
                'expanded' => true,
                'multiple' => true,
            ),array(
                'class' => 'horizontal tipo_material validate[required]'
            )),
            'filtro' => new sfWidgetFormInputText(array(),array('class' => 'validate[required]'))
        ));

        $this->setValidators(array(
            'tipo_filtro' => new sfValidatorChoice(array(
                'choices' => array(
                    'codigo',
                    'titulos',
                    'autores',
                    'editorial',
                    'temas'
                ),
            )),
//            'tipo_material' => new sfValidatorPass(),
            'tipo_material' => new sfValidatorDoctrineChoice(array(
                'model' => 'LibTipoMaterial',
                'multiple' => true,
                )),
            'filtro' => new sfValidatorPass()
        ));
        $this->widgetSchema->setLabels(array(
            'tipo_filtro' => "Parámetro de búsqueda",
            'tipo_material' => "Tipo de material",
            'filtro' => "Criterio de búsqueda",
        ));
        $this->widgetSchema->setNameFormat('selectorfiltro[%s]');
        
        $ids = Doctrine_Core::getTable('LibTipoMaterial')->createQuery('t')->select('t.id_lib_tipo_material')->fetchArray();
            
        $defaults=array();
        
        foreach ($ids as $id):
            $defaults[]=$id['id_lib_tipo_material'];
        endforeach;
        
        $this->setDefault('tipo_material',$defaults );
    }

}

?>
