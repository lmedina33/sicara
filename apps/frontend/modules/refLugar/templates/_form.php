<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script>
    jQuery(document).ready(function(){
        jQuery("#form").validationEngine();
    });
</script>

<form id="form" action="<?php echo url_for('refLugar/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_ref_lugar=' . $form->getObject()->getIdRefLugar() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td></td>
                <td>
                    <?php echo $form->renderHiddenFields(false) ?>
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to('<img src="/images/iconos/removeSmall.png" />', 'refLugar/delete?id_ref_lugar=' . $form->getObject()->getIdRefLugar(), array('method' => 'delete', 'confirm' => 'Esta seguro de querer eliminar este lugar?')) ?>
                    <?php endif; ?>
                    <input type="submit" value="Guardar" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['nombre']->renderLabel() ?></th>
                <td>
                    <?php echo $form['nombre']->renderError() ?>
                    <?php echo $form['nombre'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['descripcion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['descripcion']->renderError() ?>
                    <?php echo $form['descripcion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['capacidad_personas']->renderLabel() ?></th>
                <td>
                    <?php echo $form['capacidad_personas']->renderError() ?>
                    <?php echo $form['capacidad_personas'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['ubicacion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['ubicacion']->renderError() ?>
                    <?php echo $form['ubicacion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_ref_lugar_contenedor']->renderLabel() ?></th>
                <td>
                    <?php echo $form['id_ref_lugar_contenedor']->renderError() ?>
                    <?php echo $form['id_ref_lugar_contenedor'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_ref_tipo_lugar']->renderLabel() ?></th>
                <td>
                    <?php echo $form['id_ref_tipo_lugar']->renderError() ?>
                    <?php echo $form['id_ref_tipo_lugar'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
