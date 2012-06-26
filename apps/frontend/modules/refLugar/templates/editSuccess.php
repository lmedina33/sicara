<h1>Editar Lugar</h1>
<?php
slot('title', 'Editar Lugar')
?>
<a href="<?php echo url_for('refLugar/index') ?>" class="button back">Volver</a>
<?php include_partial('form', array('form' => $form)) ?>
