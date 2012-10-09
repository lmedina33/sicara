<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script>
    $(function() {
        jQuery("#form").validationEngine();
    });
    
    function cur_curso_fecha_inicio_jquery_control_onSelect(date){
        $("#cur_curso_fecha_fin_jquery_control").datepicker( "option", "minDate",date );
        $("#cur_curso_fecha_fin_jquery_control").datepicker('enable');
        
        $("#cur_curso_inicio_calificacion_jquery_control").datepicker( "option", "minDate",date );
        $("#cur_curso_inicio_calificacion_jquery_control").datepicker('enable');
    }
    
    function cur_curso_inicio_calificacion_jquery_control_onSelect(date){
        $("#cur_curso_fin_calificacion_jquery_control").datepicker( "option", "minDate",date );
        $("#cur_curso_fin_calificacion_jquery_control").datepicker('enable');
    }
</script>
<a href="<?php echo url_for('curCurso/index') ?>" class="button back">Volver</a>
<br />
<br />
<form id="form" action="<?php echo url_for('curCurso/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_cur_curso=' . $form->getObject()->getIdCurCurso() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td>
                </td>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['nombre']->renderLabel() ?>
                    <?php echo $form['nombre']->renderError() ?></th>
                <td>
                    <?php echo $form['nombre'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['duracion']->renderLabel() ?>
                    <?php echo $form['duracion']->renderError() ?></th>
                <td>
                    <?php echo $form['duracion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['horario']->renderLabel() ?>
                    <?php echo $form['horario']->renderError() ?></th>
                <td>
                    <?php echo $form['horario'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fecha_inicio']->renderLabel() ?>
                    <?php echo $form['fecha_inicio']->renderError() ?></th>
                <td>
                    <?php echo $form['fecha_inicio'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fecha_fin']->renderLabel() ?>
                    <?php echo $form['fecha_fin']->renderError() ?></th>
                <td>
                    <?php echo $form['fecha_fin'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['inicio_calificacion']->renderLabel() ?>
                    <?php echo $form['inicio_calificacion']->renderError() ?></th>
                <td>
                    <?php echo $form['inicio_calificacion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fin_calificacion']->renderLabel() ?>
                    <?php echo $form['fin_calificacion']->renderError() ?></th>
                <td>
                    <?php echo $form['fin_calificacion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['is_inscribible']->renderLabel() ?>
                    <?php echo $form['is_inscribible']->renderError() ?></th>
                <td>
                    <?php echo $form['is_inscribible'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_cur_empresa']->renderLabel() ?>
                    <?php echo $form['id_cur_empresa']->renderError() ?></th>
                <td>
                    <?php echo $form['id_cur_empresa'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['codigo_profesor']->renderLabel() ?>
                    <?php echo $form['codigo_profesor']->renderError() ?></th>
                <td>
                    <?php echo $form['codigo_profesor'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
