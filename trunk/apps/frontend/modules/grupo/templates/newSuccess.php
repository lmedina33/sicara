<?php
slot('title', 'Nuevo Grupo')
?>

<h1>Nuevo Grupo</h1>
<a href="<?php echo url_for('grupo/index' ) ?>" class="button back">Volver</a>
<?php include_partial('form', array('form' => $form,'pensums'=>$pensums)) ?>
