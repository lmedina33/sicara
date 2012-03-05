<?php
slot('title', 'Editar Material Bibliográfico')
?>
<h1>Editar Material</h1>
<a href="<?php echo url_for('libMaterial/ver?id='.$form->getObject()->getCodigoLibMaterial()) ?>" class="button">Volver</a>
<?php include_partial('form', array('form' => $form)) ?>
