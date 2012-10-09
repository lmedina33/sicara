<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script>
    $(function() {
        jQuery("#form").validationEngine();
    });
</script>

<a href="<?php echo url_for('curCurso/index') ?>" class="button back">Volver</a>
<br />
<br />
<form id="form" action="<?php echo url_for('curEmpresa/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_cur_empresa='.$form->getObject()->getIdCurEmpresa() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
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
        <th><?php echo $form['descripcion']->renderLabel() ?>
        <?php echo $form['descripcion']->renderError() ?></th>
        <td>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
