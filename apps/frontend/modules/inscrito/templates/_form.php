<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('inscrito/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_inscrito='.$form->getObject()->getIdInscrito() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('inscrito/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'inscrito/delete?id_inscrito='.$form->getObject()->getIdInscrito(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['numero_formulario']->renderLabel() ?></th>
        <td>
          <?php echo $form['numero_formulario']->renderError() ?>
          <?php echo $form['numero_formulario'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_jornada']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_jornada']->renderError() ?>
          <?php echo $form['id_jornada'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_tipo_pago']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_tipo_pago']->renderError() ?>
          <?php echo $form['id_tipo_pago'] ?>
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
        <th><?php echo $form['id_usuario']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_usuario']->renderError() ?>
          <?php echo $form['id_usuario'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_matriculado']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_matriculado']->renderError() ?>
          <?php echo $form['is_matriculado'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha_inscripcion']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_inscripcion']->renderError() ?>
          <?php echo $form['fecha_inscripcion'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
