<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('grupo/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id_grupo=' . $form->getObject()->getIdGrupo() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
                    <?php if (!$form->getObject()->isNew()): ?>
                        &nbsp;<?php echo link_to('Delete', 'grupo/delete?id_grupo=' . $form->getObject()->getIdGrupo(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
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
                <th><?php echo $form['id_periodo']->renderLabel() ?></th>
                <td>
                    <?php echo $form['id_periodo']->renderError() ?>
                    <?php echo $form['id_periodo'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['certificacion_primaria']->renderLabel() ?></th>
                <td>
                    <?php echo $form['certificacion_primaria']->renderError() ?>
                    <?php echo $form['certificacion_primaria'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['certificacion_secundaria']->renderLabel() ?></th>
                <td>
                    <?php echo $form['certificacion_secundaria']->renderError() ?>
                    <?php echo $form['certificacion_secundaria'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fecha_inicio']->renderLabel() ?></th>
                <td>
                    <?php echo $form['fecha_inicio']->renderError() ?>
                    <?php echo $form['fecha_inicio'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fecha_fin']->renderLabel() ?></th>
                <td>
                    <?php echo $form['fecha_fin']->renderError() ?>
                    <?php echo $form['fecha_fin'] ?>
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
                <th><?php echo $form['codigo_asignatura']->renderLabel() ?></th>
                <td>
                    <?php echo $form['codigo_asignatura']->renderError() ?>
                    <?php echo $form['codigo_asignatura'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['codigo_profesor']->renderLabel() ?></th>
                <td>
                    <?php echo $form['codigo_profesor']->renderError() ?>
                    <?php echo $form['codigo_profesor'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['inicio_calificacion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['inicio_calificacion']->renderError() ?>
                    <?php echo $form['inicio_calificacion'] ?>
                </td>
            </tr>
            <tr>
                <th><?php echo $form['fin_calificacion']->renderLabel() ?></th>
                <td>
                    <?php echo $form['fin_calificacion']->renderError() ?>
                    <?php echo $form['fin_calificacion'] ?>
                </td>
            </tr>
        </tbody>
    </table>
</form>
