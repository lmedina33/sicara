<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('estudiante/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?codigo_estudiante='.$form->getObject()->getCodigoEstudiante() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('estudiante/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'estudiante/delete?codigo_estudiante='.$form->getObject()->getCodigoEstudiante(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['fecha_ingreso']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_ingreso']->renderError() ?>
          <?php echo $form['fecha_ingreso'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha_retiro']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_retiro']->renderError() ?>
          <?php echo $form['fecha_retiro'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_estado']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_estado']->renderError() ?>
          <?php echo $form['id_estado'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_estado_secundario']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_estado_secundario']->renderError() ?>
          <?php echo $form['id_estado_secundario'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_usuario']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_usuario']->renderError() ?>
          <?php echo $form['id_usuario'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['codigo_pensum']->renderLabel() ?></th>
        <td>
          <?php echo $form['codigo_pensum']->renderError() ?>
          <?php echo $form['codigo_pensum'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
