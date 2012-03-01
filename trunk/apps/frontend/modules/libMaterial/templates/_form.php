<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    jQuery(document).ready(function(){
        jQuery("#form").validationEngine();
        
        <?php
            if($form->getObject()->getIsReferencia()==1)
                echo "$('#soloProf').hide('normal')";
        ?>
        
        $('#lib_material_is_referencia_1').change(
        function(){
            $('#lib_material_is_solo_profesor_0').attr('checked', 'checked');
            $('#soloProf').hide('normal');
        });
        
        $('#lib_material_is_referencia_0').change(
        function(){
            $('#soloProf').show('normal');
        });

    });
    
    function lib_material_fecha_publicacion_jquery_control_onSelect(date){
        $("#lib_material_fecha_actualizacion_jquery_control").datepicker( "option", "minDate",date );
        $("#lib_material_fecha_actualizacion_jquery_control").datepicker('enable');
    }

</script>
<form id="form" action="<?php echo url_for('libMaterial/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?codigo_lib_material=' . $form->getObject()->getCodigoLibMaterial() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table width="100%">
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <br />
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th>
                    <div class="tip" title="<?php echo ($form->getObject()->isNew()? 'Este código debe ser un identificador <b>único</b> en el sistema y <b>no podrá ser modificado</b>.' : 'Este código es un identificador <b>único</b> en el sistema y por tanto <b>no puede ser editado</b>.') ?>"></div>
                    <?php echo $form['codigo_lib_material']->renderLabel() ?>
                    <?php echo $form['codigo_lib_material']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['codigo_lib_material'] ?>
                </td>
        </tr>
        <tr>
            <th>
                <?php echo $form['titulo']->renderLabel() ?>
                <?php echo $form['titulo']->renderError() ?>
            </th>
            <td>
                <?php echo $form['titulo'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $form['sub_titulo']->renderLabel() ?>
                <?php echo $form['sub_titulo']->renderError() ?>
            </th>
            <td>
                <?php echo $form['sub_titulo'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <div class="tip" title="Ingrese un autor por cada línea.<br /><i>Ejemplo:</i><br />PEREZ, Carlos Eduardo<br />RODRIGUEZ, Julian Andrés."></div>
                <?php echo $form['autores']->renderLabel() ?>
                <?php echo $form['autores']->renderError() ?>
            </th>
            <td>
                <?php echo $form['autores'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $form['editorial']->renderLabel() ?>
                <?php echo $form['editorial']->renderError() ?>
            </th>
            <td>
                <?php echo $form['editorial'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $form['fecha_publicacion']->renderLabel() ?>
                <?php echo $form['fecha_publicacion']->renderError() ?>
            </th>
            <td>
                <?php echo $form['fecha_publicacion'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $form['fecha_actualizacion']->renderLabel() ?>
                <?php echo $form['fecha_actualizacion']->renderError() ?>
            </th>
            <td>
                <?php echo $form['fecha_actualizacion'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <div class="tip" title="Ingrese un atributo por cada línea.<br /><i>Ejemplo:</i><br />Páginas: 100p<br />Dimensiones: 25cm x 13cm"></div>
                <?php echo $form['descripcion']->renderLabel() ?>
                <?php echo $form['descripcion']->renderError() ?>
            </th>
            <td>
                <?php echo $form['descripcion'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <div class="tip" title="Ingrese un tema por cada línea.<br /><i>Ejemplo:</i><br />Elementos Químicos<br />Quimica Orgánica"></div>
                <?php echo $form['temas']->renderLabel() ?>
                <?php echo $form['temas']->renderError() ?>
            </th>
            <td>
                <?php echo $form['temas'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <div class="tip" title="Seleccione esta opción si el material no se encuentra disponible para prestamo."></div>
                <?php echo $form['is_referencia']->renderLabel() ?>
                <?php echo $form['is_referencia']->renderError() ?>
            </th>
            <td>
                <?php echo $form['is_referencia'] ?>
            </td>
        </tr>
        <tr id="soloProf">
            <th>
                <div class="tip" title="Seleccione esta opción si el material solo se presta a profesores."></div>
                <?php echo $form['is_solo_profesor']->renderLabel() ?>
                <?php echo $form['is_solo_profesor']->renderError() ?>
            </th>
            <td>
                <?php echo $form['is_solo_profesor'] ?>
            </td>
        </tr>
        <tr>
            <th><?php echo $form['codigo_lib_categoria']->renderLabel() ?></th>
            <td>
                <?php echo $form['codigo_lib_categoria']->renderError() ?>
                <?php echo $form['codigo_lib_categoria'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $form['id_lib_tipo_material']->renderLabel() ?>
                <?php echo $form['id_lib_tipo_material']->renderError() ?>
            </th>
            <td>
                <?php echo $form['id_lib_tipo_material'] ?>
            </td>
        </tr>
        </tbody>
    </table>
</form>
