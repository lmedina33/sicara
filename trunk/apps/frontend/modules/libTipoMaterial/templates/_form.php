<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    jQuery(document).ready(function(){
        jQuery("#form").validationEngine();
    });
</script>
<a href="<?php echo url_for('libTipoMaterial/index') ?>" class="button back">Volver</a>
<br />
<br />
<form id="form" action="<?php echo url_for('libTipoMaterial/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_lib_tipo_material=' . $form->getObject()->getIdLibTipoMaterial() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
            <th>
                <?php echo $form['cantidad_sancion']->renderLabel() ?></th>
            <?php echo $form['cantidad_sancion']->renderError() ?>
            <td>
                <?php echo $form['cantidad_sancion'] ?>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo $form['id_lib_tipo_sancion']->renderLabel() ?>
                <?php echo $form['id_lib_tipo_sancion']->renderError() ?>
            </th>
            <td>
                <?php echo $form['id_lib_tipo_sancion'] ?>
            </td>
        </tr>
        </tbody>
    </table>
</form>
