<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<script>
    jQuery(document).ready(function(){
        jQuery("#form").validationEngine();
        
        <?php
            if($form->getObject()->getIsPrestable()==0 || $form->getObject()->isNew()){
        ?>
        $('#trCantidadSancion').hide('normal');                
        $('#trTipoSancion').hide('normal');
        
        <?php } ?>
        
        $('#ref_elemento_is_prestable').change(
        function(){
            if($(this).val()=='1'){                
                $('#trCantidadSancion').show('normal');
                $('#trTipoSancion').show('normal');
            }else{
                $('#trCantidadSancion').hide('normal');                
                $('#trTipoSancion').hide('normal');
            }
        });
        
        $.ajax({
           type: 'POST',
           url: '<?php echo url_for('refElemento/getArbol') ?>',
           data: 0,
           success: function(arbol){
               $("#tree").html(arbol);
               $("#tree").treeview({
		collapsed: true,
		unique: true
                });
           },
           dataType: 'text'
        });
        
        
        $( "#selectorLugares" ).dialog({
            modal: true,
            autoOpen: false
        });
        
        
    });
    
    function selectLugar(id){
        $('#ref_elemento_id_ref_lugar').val(id);
        $('#lugar').val($('#ref_elemento_id_ref_lugar').html());
    }
    
    function showLugares(){
        $( "#selectorLugares" ).dialog('open');
        return false;
    }
</script>

<form id="form" action="<?php echo url_for('refElemento/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id_ref_elemento='.$form->getObject()->getIdRefElemento() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table width="100%">
    <tfoot>
      <tr>
        <td></td>
        <td>
          <?php echo $form->renderHiddenFields(false) ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>
            <?php echo $form['id_ref_tipo_elemento']->renderError() ?>
            <?php echo $form['id_ref_tipo_elemento']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['id_ref_tipo_elemento'] ?>
        </td>
      </tr>
      <tr>
        <th>
    <div class="tip" title="La mayoría de elementos tienen un <b>código serial único</b> que debería ser incluido; si el elemento no tiene dicho código, no es necesario incluirlo."></div>
            <?php echo $form['serial']->renderLabel() ?>
            <?php echo $form['serial']->renderError() ?>
        </th>
        <td>
          <?php echo $form['serial'] ?>
        </td>
      </tr>
      <tr>
        <th>
      <div class="tip" title="Algunas instituciones cuentan con un sistema interno de identificación de elementos por medio de un <b>código interno único</b> que debería ser colocado en este campo; Si la institución no cuenta con dicho sistema, no es necesario incluirlo."></div>
            <?php echo $form['serial_interno']->renderError() ?>
            <?php echo $form['serial_interno']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['serial_interno'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <div class="tip" title="Todo elemento <b>debe</b> tener un nómbre que lo identifique."></div>
            <?php echo $form['nombre']->renderError() ?>
            <?php echo $form['nombre']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['nombre'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <?php echo $form['marca']->renderError() ?>
            <?php echo $form['marca']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['marca'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <?php echo $form['modelo']->renderError() ?>
            <?php echo $form['modelo']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['modelo'] ?>
        </td>
      </tr>
      <tr>
        <th>
      <div class="tip" title="Ingrese el nombre de un usuario que sea la persona responsable por la integridad de este elemento.<br/>Este campo es autocompletable para facilitar su búsqueda."></div>
            <?php echo $form['id_usuario_responsable']->renderError() ?>
            <?php echo $form['id_usuario_responsable']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['id_usuario_responsable'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <?php echo $form['id_ref_estado_elemento']->renderError() ?>
            <?php echo $form['id_ref_estado_elemento']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['id_ref_estado_elemento'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <div class="tip" title="En este texto incluya datos importantes como:<br/><ul><li>Atributos del elemento (medidas, capacidad, color,...)</li><li>Componentes (piezas, accesorios, ...)</li><li>Cuidados y recomendaciones</li></ul>"></div>
            <?php echo $form['descripcion']->renderError() ?>
            <?php echo $form['descripcion']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <?php echo $form['is_prestable']->renderError() ?>
            <?php echo $form['is_prestable']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['is_prestable'] ?>
        </td>
      </tr>
      <tr id="trTipoSancion">
        <th>
            <?php echo $form['id_ref_tipo_sancion']->renderError() ?>
            <?php echo $form['id_ref_tipo_sancion']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['id_ref_tipo_sancion'] ?>
        </td>
      </tr>
      <tr id="trCantidadSancion">
        <th>
            <?php echo $form['cantidad_sancion']->renderError() ?>
            <?php echo $form['cantidad_sancion']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['cantidad_sancion'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <?php echo $form['id_ref_lugar']->renderError() ?>
            <?php echo $form['id_ref_lugar']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['id_ref_lugar'] ?>
        </td>
      </tr>
      <tr>
        <th>
            <div class="tip" title="Registre la ubicación del elemento dentro del lugar asignado."></div>
            <?php echo $form['ubicacion']->renderError() ?>
            <?php echo $form['ubicacion']->renderLabel() ?>
        </th>
        <td>
          <?php echo $form['ubicacion'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>

<div id="selectorLugares" title="Seleccione el lugar" style="display:none">
    <ul id="tree">
    </ul>
</div>