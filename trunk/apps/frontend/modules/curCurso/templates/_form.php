<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('curCurso/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_cur_curso='.$form->getObject()->getIdCurCurso() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('curCurso/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'curCurso/delete?id_cur_curso='.$form->getObject()->getIdCurCurso(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
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
        <th><?php echo $form['duracion']->renderLabel() ?></th>
        <td>
          <?php echo $form['duracion']->renderError() ?>
          <?php echo $form['duracion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['horario']->renderLabel() ?></th>
        <td>
          <?php echo $form['horario']->renderError() ?>
          <?php echo $form['horario'] ?>
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
        <th><?php echo $form['id_cur_empresa']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_cur_empresa']->renderError() ?>
          <?php echo $form['id_cur_empresa'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['codigo_profesor']->renderLabel() ?></th>
        <td>
          <?php echo $form['codigo_profesor']->renderError() ?>
          <?php echo $form['codigo_profesor'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
