<?php
slot('title', 'Editar Material Bibliográfico')
?>
<h1>Editar Material</h1>
<a href="<?php echo url_for('libMaterial/ver?codigo_lib_material='.$form->getObject()->getCodigoLibMaterial()) ?>" class="button back">Volver</a>
<?php include_partial('form', array('form' => $form)) ?>
