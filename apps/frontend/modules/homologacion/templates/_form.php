<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script>
    $(document).ready(function(){
        tinyMCE.init({
            theme: "simple",
            mode: "textareas",
            width: "400",
            height: "100"
        });
    
        jQuery("#form").validationEngine();
    });
</script>       

<form id="form" action="<?php echo url_for('homologacion/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_homologacion=' . $form->getObject()->getIdHomologacion() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tfoot>
            <tr>
                <td colspan="2">
                    <?php echo $form->renderHiddenFields(false) ?>
                    &nbsp;<a href="<?php echo url_for('homologacion/index') ?>">Back to list</a>
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to('Delete', 'homologacion/delete?id_homologacion=' . $form->getObject()->getIdHomologacion(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
                    <?php endif; ?>
                    <input type="submit" value="Save" />
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php echo $form->renderGlobalErrors() ?>
            <tr>
                <th><?php echo $form['institucion_origen']->renderLabel() ?></th>
                <td>
                    <?php echo $form['institucion_origen']->renderError() ?>
                    <?php echo $form['institucion_origen'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['programa_origen']->renderLabel() ?></th>
                <td>
                    <?php echo $form['programa_origen']->renderError() ?>
                    <?php echo $form['programa_origen'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['nota_aprobatoria']->renderLabel() ?></th>
                <td>
                    <?php echo $form['nota_aprobatoria']->renderError() ?>
                    <?php echo $form['nota_aprobatoria'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['is_oficializado']->renderLabel() ?></th>
                <td>
                    <?php echo $form['is_oficializado']->renderError() ?>
                    <?php echo $form['is_oficializado'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['is_interna']->renderLabel() ?></th>
                <td>
                    <?php echo $form['is_interna']->renderError() ?>
                    <?php echo $form['is_interna'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['observaciones']->renderLabel() ?></th>
                <td>
                    <?php echo $form['observaciones']->renderError() ?>
                    <?php echo $form['observaciones'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['codigo_pensum_destino']->renderLabel() ?></th>
                <td>
                    <?php echo $form['codigo_pensum_destino']->renderError() ?>
                    <?php echo $form['codigo_pensum_destino'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['codigo_pensum_origen']->renderLabel() ?></th>
                <td>
                    <?php echo $form['codigo_pensum_origen']->renderError() ?>
                    <?php echo $form['codigo_pensum_origen'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['id_usuario']->renderLabel() ?></th>
                <td>
                    <?php echo $form['id_usuario']->renderError() ?>
                    <?php echo $form['id_usuario'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
