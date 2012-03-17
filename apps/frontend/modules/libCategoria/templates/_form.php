<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    jQuery(document).ready(function(){
        jQuery("#form").validationEngine();
    });
</script>
<a href="<?php echo url_for('libCategoria/index') ?>" class="button back">Volver</a>
<br />
<br />
<form id="form" action="<?php echo url_for('libCategoria/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?codigo_lib_categoria=' . $form->getObject()->getCodigoLibCategoria() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th>
                    <div class="tip" title="<?php echo ($form->getObject()->isNew()? 'Este código debe ser un identificador <b>único</b> en el sistema y <b>no podrá ser modificado</b>.' : 'Este código es un identificador <b>único</b> en el sistema y por tanto <b>no puede ser editado</b>.') ?>"></div>
                    <?php echo $form['codigo_lib_categoria']->renderLabel() ?>
                    <?php echo $form['codigo_lib_categoria']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['codigo_lib_categoria'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo $form['nombre']->renderLabel() ?>
                    <?php echo $form['nombre']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['nombre'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo $form['descripcion']->renderLabel() ?>
                    <?php echo $form['descripcion']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['descripcion'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    <div class="tip" title="Si es un valor de cero, significa que es un documento de <b>consulta en sala</b>."></div>
                    <?php echo $form['dias_prestamo']->renderLabel() ?>
                    <?php echo $form['dias_prestamo']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['dias_prestamo'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['cantidad_sancion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['cantidad_sancion']->renderError() ?>
                    <?php echo $form['cantidad_sancion'] ?>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo $form['id_tipo_sancion']->renderLabel() ?>
                    <?php echo $form['id_tipo_sancion']->renderError() ?>
                </th>
                <td>
                    <?php echo $form['id_tipo_sancion'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
