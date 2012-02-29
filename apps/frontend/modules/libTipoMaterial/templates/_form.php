<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('libTipoMaterial/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_lib_tipo_material='.$form->getObject()->getIdLibTipoMaterial() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('libTipoMaterial/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'libTipoMaterial/delete?id_lib_tipo_material='.$form->getObject()->getIdLibTipoMaterial(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
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
        <th><?php echo $form['dias_prestamo']->renderLabel() ?></th>
        <td>
          <?php echo $form['dias_prestamo']->renderError() ?>
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
        <th><?php echo $form['id_lib_tipo_sancion']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_lib_tipo_sancion']->renderError() ?>
          <?php echo $form['id_lib_tipo_sancion'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
