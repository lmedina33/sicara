<?php
slot('title', 'Editar Grupo')
?>

<h1>Editar Grupo</h1>
<a href="<?php echo url_for('grupo/index' ) ?>" class="button back">Volver</a>
<a href="<?php echo url_for('grupo/ver?id='.$form->getObject()->getIdGrupo() ) ?>" class="button detail">Ver</a>
<?php include_partial('form', array('form' => $form,'pensums'=>$pensums)) ?>
