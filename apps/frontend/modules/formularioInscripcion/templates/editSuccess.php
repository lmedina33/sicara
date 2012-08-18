<h1>Editar Formulario de Inscripción <?php echo $numero ?></h1>

<a href="<?php echo url_for('formularioInscripcion/ver?id=').$form->getObject()->getIdFormularioInscripcion() ?>" class="button back">Volver</a>

<?php include_partial('form', array('form' => $form, 'isUpdate' => false)) ?>
