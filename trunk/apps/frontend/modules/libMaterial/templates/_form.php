<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    jQuery(document).ready(function(){
        jQuery("#form").validationEngine();
    });
</script>
<form id="form" action="<?php echo url_for('libMaterial/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?codigo_lib_material='.$form->getObject()->getCodigoLibMaterial() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table width="100%">
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('libMaterial/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'libMaterial/delete?codigo_lib_material='.$form->getObject()->getCodigoLibMaterial(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['titulo']->renderLabel() ?></th>
        <td>
          <?php echo $form['titulo']->renderError() ?>
          <?php echo $form['titulo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sub_titulo']->renderLabel() ?></th>
        <td>
          <?php echo $form['sub_titulo']->renderError() ?>
          <?php echo $form['sub_titulo'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['autores']->renderLabel() ?></th>
        <td>
          <?php echo $form['autores']->renderError() ?>
          <?php echo $form['autores'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['editorial']->renderLabel() ?></th>
        <td>
          <?php echo $form['editorial']->renderError() ?>
          <?php echo $form['editorial'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha_publicacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_publicacion']->renderError() ?>
          <?php echo $form['fecha_publicacion'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['fecha_actualizacion']->renderLabel() ?></th>
        <td>
          <?php echo $form['fecha_actualizacion']->renderError() ?>
          <?php echo $form['fecha_actualizacion'] ?>
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
        <th><?php echo $form['temas']->renderLabel() ?></th>
        <td>
          <?php echo $form['temas']->renderError() ?>
          <?php echo $form['temas'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_referencia']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_referencia']->renderError() ?>
          <?php echo $form['is_referencia'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_solo_profesor']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_solo_profesor']->renderError() ?>
          <?php echo $form['is_solo_profesor'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['codigo_lib_categoria']->renderLabel() ?></th>
        <td>
          <?php echo $form['codigo_lib_categoria']->renderError() ?>
          <?php echo $form['codigo_lib_categoria'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_lib_estado']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_lib_estado']->renderError() ?>
          <?php echo $form['id_lib_estado'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['id_lib_tipo_material']->renderLabel() ?></th>
        <td>
          <?php echo $form['id_lib_tipo_material']->renderError() ?>
          <?php echo $form['id_lib_tipo_material'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
