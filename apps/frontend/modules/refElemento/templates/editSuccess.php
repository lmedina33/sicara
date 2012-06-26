<?php
slot('title', 'Editar Recurso Físico')
?>
<h1>Editar Recurso Físico</h1>
<a href="<?php echo url_for('refElemento/ver?id_ref_elemento='.$form->getObject()->getIdRefElemento()) ?>" class="button back">Volver</a>
<?php include_partial('form', array('form' => $form)) ?>
