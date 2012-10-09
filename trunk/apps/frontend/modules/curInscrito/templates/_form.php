<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('curInscrito/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_cur_inscrito='.$form->getObject()->getIdCurInscrito() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('curInscrito/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'curInscrito/delete?id_cur_inscrito='.$form->getObject()->getIdCurInscrito(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['primer_nombre']->renderLabel() ?></th>
        <td>
          <?php echo $form['primer_nombre']->renderError() ?>
          <?php echo $form['primer_nombre'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['segundo_nombre']->renderLabel() ?></th>
        <td>
          <?php echo $form['segundo_nombre']->renderError() ?>
          <?php echo $form['segundo_nombre'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['primer_apellido']->renderLabel() ?></th>
        <td>
          <?php echo $form['primer_apellido']->renderError() ?>
          <?php echo $form['primer_apellido'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['segundo_apellido']->renderLabel() ?></th>
        <td>
          <?php echo $form['segundo_apellido']->renderError() ?>
          <?php echo $form['segundo_apellido'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['documento']->renderLabel() ?></th>
        <td>
          <?php echo $form['documento']->renderError() ?>
          <?php echo $form['documento'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_tipo_documento']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_tipo_documento']->renderError() ?>
          <?php echo $form['id_tipo_documento'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['lugar_expedicion']->renderLabel() ?></th>
        <td>
          <?php echo $form['lugar_expedicion']->renderError() ?>
          <?php echo $form['lugar_expedicion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['telefono1']->renderLabel() ?></th>
        <td>
          <?php echo $form['telefono1']->renderError() ?>
          <?php echo $form['telefono1'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['telefono2']->renderLabel() ?></th>
        <td>
          <?php echo $form['telefono2']->renderError() ?>
          <?php echo $form['telefono2'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['correo']->renderLabel() ?></th>
        <td>
          <?php echo $form['correo']->renderError() ?>
          <?php echo $form['correo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
